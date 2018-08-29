#!/usr/bin/env bash

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

# Untrailing slash of SVN_REPO path
SVN_REPO=`echo $SVN_REPO | sed -e "s/\/$//"`
# Git repository
GH_REF=https://github.com/${TRAVIS_REPO_SLUG}.git

echo "Starting deploy..."

echo "$GH_REF"

mkdir build

cd build
BASE_DIR=$(pwd)

echo "$BASE_DIR"

echo "Checking out trunk from $SVN_REPO ..."
svn co -q $SVN_REPO/trunk

echo "Getting clone from $GH_REF to $SVN_REPO ..."
git clone -q $GH_REF ./git
echo "cloning done"
cd ./git
echo "in the directory"