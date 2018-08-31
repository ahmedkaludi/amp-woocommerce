#!/usr/bin/env bash

set -e

if [[ ! $WP_PULUGIN_DEPLOY ]]; then
	echo "Not deploying."
	exit
fi

if [[ ! $SVN_REPO ]]; then
	echo "SVN repo is not specified."
	exit
fi
# Create branch name
TAG="beta"
# Untrailing slash of SVN_REPO path
SVN_REPO=`echo $SVN_REPO | sed -e "s/\/$//"`
# Git repository
GH_REF=https://github.com/${TRAVIS_REPO_SLUG}.git
# make build directory
mkdir build

cd build
BASE_DIR=$(pwd)

# Checking out temp from $SVN_REPO ...
svn co -q $SVN_REPO/temp

# create $TAG directory
mkdir $TAG
# make a temporary git folder
mkdir git
cd ./git
# Getting clone from $GH_REF to $SVN_REPO ...
git clone -q $GH_REF --branch beta

cd $BASE_DIR

# Syncing git repository to svn
rsync -a --exclude=".svn" --checksum --delete ./git/amp-woocommerce/ ./temp/$TAG/
rm -fr ./git

cd ./temp/$TAG/

# Run svn add
svn st | grep '^?' | sed -e 's/\?[ ]*/svn add -q /g' | sh
# Run svn del
svn st | grep '^!' | sed -e 's/\![ ]*/svn del -q /g' | sh

svn delete --force .git scripts .travis.yml

# If tag number and credentials are provided, commit to temp.
if [[ $TAG && $WP_ORG_USERNAME && $WP_ORG_PASSWORD ]]; then
    # "Commit to $SVN_REPO."
    svn commit -m "commit version $TAG" --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD --non-interactive 2>/dev/null
    # "Take snapshot of $TAG"
    # checkout svn repo and delete $Tag directory if its already present
    svn co $SVN_REPO
    if [[ -d $SVN_REPO/tags/$TAG ]]; then
        echo "$TAG exists"
    else
        echo "$TAG doesnt exists"
    fi
    echo "move temp/$TAG into tags/$TAG"
	svn delete $SVN_REPO/tags/$TAG -m "deleting existing beta" --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD --force --non-interactive 2>/dev/null
	svn move $SVN_REPO/temp/$TAG $SVN_REPO/tags/$TAG -m "Move from temp/beta to tags/beta" --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD --force --non-interactive 2>/dev/null
else
	echo "Nothing to commit and check \`svn st\`."
	svn st
fi
