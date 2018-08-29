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

# Travis Tag
if [[ ! $TRAVIS_TAG ]]; then
	echo "Travis Tag is not specified."
	TRAVIS_TAG="beta"
fi
echo "$TRAVIS_TAG"
# Untrailing slash of SVN_REPO path
SVN_REPO=`echo $SVN_REPO | sed -e "s/\/$//"`
# Git repository
GH_REF=https://github.com/${TRAVIS_REPO_SLUG}.git

echo "Starting deploy..."

echo "$GH_REF"

echo "Delete the beta directory first $SVN_REPO/tags/$TRAVIS_TAG/"
#rm -fr $SVN_REPO/tags/$TRAVIS_TAG
svn delete $SVN_REPO/tags/$TRAVIS_TAG --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD --message "Deleting"
echo "Deleting of beta done"

echo "Delete the trunk directory first $SVN_REPO/trunk/"
#rm -fr $SVN_REPO/trunk
svn delete $SVN_REPO/trunk --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD --message "Deleting"
echo "Deleting of trunk done"
svn commit -m "commit version $TRAVIS_TAG" --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD --non-interactive 2>/dev/null
echo "commit done"

# mkdir build

# cd build
# BASE_DIR=$(pwd)

# echo "$BASE_DIR"

# echo "Checking out trunk from $SVN_REPO ..."
# svn co -q $SVN_REPO/trunk

# echo "Getting clone from $GH_REF to $SVN_REPO ..."
# git clone -q $GH_REF ./git
# echo "cloning done"
# cd ./git
# echo "in the directory"

# cd $BASE_DIR
# echo "in $BASE_DIR"
# echo "Syncing git repository to svn"
# rsync -a --exclude=".svn" --checksum --delete ./git/ ./trunk/
# rm -fr ./git
# echo "Syncing done"

# cd ./trunk

# if [ -e ".distignore" ]; then
# 	echo "svn propset form .distignore"
# 	svn propset -q -R svn:ignore -F .distignore .

# else
# 	if [ -e ".svnignore" ]; then
# 		echo "svn propset"
# 		svn propset -q -R svn:ignore -F .svnignore .
# 	fi
# fi
# echo "Ignoring GitHub specific files"
# svn propset svn:ignore "README.md
# Thumbs.db
# .github/*
# .git
# .gitattributes
# .gitignore" "$SVNPATH/trunk/"
# echo "Run svn add"
# svn st | grep '^!' | sed -e 's/\![ ]*/svn del -q /g' | sh
# echo "Run svn del"
# svn st | grep '^?' | sed -e 's/\?[ ]*/svn add -q /g' | sh

# echo " Add and remove done"

# # If tag number and credentials are provided, commit to trunk.
# if [[ $TRAVIS_TAG && $WP_ORG_USERNAME && $WP_ORG_PASSWORD ]]; then
# 	if [[ ! -d tags/$TRAVIS_TAG ]]; then
# 		echo "Commit to $SVN_REPO."
# 		svn commit -m "commit version $TRAVIS_TAG" --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD --non-interactive 2>/dev/null
# 		echo "Take snapshot of $TRAVIS_TAG"
# 		svn copy $SVN_REPO/trunk/ $SVN_REPO/tags/$TRAVIS_TAG -m "Take snapshot of $TRAVIS_TAG" --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD --non-interactive 2>/dev/null
# 	else
# 		echo "tags/$TRAVIS_TAG already exists."
# 	fi
# else
# 	echo "Nothing to commit and check \`svn st\`."
# 	svn st
# fi

# echo "Everythings done"