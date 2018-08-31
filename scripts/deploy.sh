#!/usr/bin/env bash

set -e

if [[ "false" != "$TRAVIS_PULL_REQUEST" ]]; then
	echo "Not deploying pull requests."
	exit
fi

if [[ ! $WP_PULUGIN_DEPLOY ]]; then
	echo "Not deploying."
	exit
fi

if [[ ! $SVN_REPO ]]; then
	echo "SVN repo is not specified."
	exit
fi
TRAVIS_TAG="beta"
SVN_USER="$WP_ORG_USERNAME"
SVN_PASS="$WP_ORG_PASSWORD"
# Untrailing slash of SVN_REPO path
SVN_REPO=`echo $SVN_REPO | sed -e "s/\/$//"`
# Git repository
GH_REF=https://github.com/${TRAVIS_REPO_SLUG}.git
echo "$TRAVIS_REPO_SLUG"

#svn co -q $SVN_REPO
# cd amp-woocommerce
# wget https://raw.githubusercontent.com/miya0001/wp-svnignore/master/.svnignore
# svn propset -R svn:ignore -F .svnignore .
# cd ..
echo "Starting deploy..."

mkdir build

cd build
BASE_DIR=$(pwd)

echo "Checking out temp from $SVN_REPO ..."
svn co -q $SVN_REPO/temp
# echo "delete current temp/beta"
# rm -fr ./beta
# echo "create new beta in temp"
echo "create $TRAVIS_TAG directory"
mkdir $TRAVIS_TAG
echo "Getting clone from $GH_REF to $SVN_REPO ..."
mkdir git
cd ./git
git clone -q $GH_REF --branch beta
#git branch -a
#git checkout beta
ls
cd $BASE_DIR
ls
echo "Syncing git repository to svn"
rsync -a --exclude=".svn" --checksum --delete ./git/amp-woocommerce/ ./temp/$TRAVIS_TAG/
rm -fr ./git

cd ./temp/$TRAVIS_TAG/

echo "Run svn add"
svn st | grep '^?' | sed -e 's/\?[ ]*/svn add -q /g' | sh
echo "Run svn del"
svn st | grep '^!' | sed -e 's/\![ ]*/svn del -q /g' | sh

ls 
svn delete --force .git README.md scripts .travis.yml
#svn delete --force $SVN_REPO/temp/$TRAVIS_TAG/.git -m "deleting .git folder"
ls
# If tag number and credentials are provided, commit to temp.
if [[ $TRAVIS_TAG && $SVN_USER && $SVN_PASS ]]; then
	if [[ -d $SVN_REPO/tags/$TRAVIS_TAG ]]; then
		echo "delete existing beta"
    fi
    if [[ ! -d $SVN_REPO/tags/$TRAVIS_TAG ]]; then
        echo "Commit to $SVN_REPO."
        svn commit -m "commit version $TRAVIS_TAG" --username $SVN_USER --password $SVN_PASS --non-interactive 2>/dev/null
        echo "Take snapshot of $TRAVIS_TAG"
        svn co $SVN_REPO
        if [[ -d ./tags/$TRAVIS_TAG ]]; then
            echo "$TRAVIS_TAG exists"
        else
            echo "$TRAVIS_TAG doesnt exists"
        fi
        echo "move temp/$TRAVIS_TAG into tags/$TRAVIS_TAG"
		svn delete $SVN_REPO/tags/$TRAVIS_TAG -m "deleting existing beta" --username $SVN_USER --password $SVN_PASS --force --non-interactive 2>/dev/null
		svn move $SVN_REPO/temp/$TRAVIS_TAG $SVN_REPO/tags/$TRAVIS_TAG -m "Move from temp/beta to tags/beta" --username $SVN_USER --password $SVN_PASS --force --non-interactive 2>/dev/null
	else
		echo "tags/$TRAVIS_TAG already exists."
	fi
else
	echo "Nothing to commit and check \`svn st\`."
	svn st
fi
