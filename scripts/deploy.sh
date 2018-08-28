#!/usr/bin/env bash

if [[ -z "$TRAVIS" ]]; then
	echo "Script is only to be run by Travis CI" 1>&2
	exit 1
fi

if [[ -z "$WP_ORG_PASSWORD" ]]; then
	echo "WordPress.org password not set" 1>&2
	exit 1
fi

if [[ -z "$TRAVIS_BRANCH" ]]; then
	echo "Build branch is required and must be 'master'" 1>&2
	exit 0
fi

PLUGIN="amp-woocommerce"
PROJECT_ROOT="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." && pwd )"
PLUGIN_BUILDS_PATH="$PROJECT_ROOT"
#PLUGIN_BUILDS_PATH="https://github.com/ahmedkaludi/amp-woocommerce/archive/"
PLUGIN_BUILD_CONFIG_PATH="$PROJECT_ROOT/build-cfg"
#VERSION=$(/usr/bin/php -f "$PLUGIN_BUILD_CONFIG_PATH/utils/get_plugin_version.php" "$PROJECT_ROOT" "$PLUGIN")
VERSION="beta"
ZIP_FILE="$PLUGIN_BUILDS_PATH/$PLUGIN.zip"
#ZIP_FILE="https://github.com/ahmedkaludi/amp-woocommerce/archive/0.4-BETA.zip"
#ZIP_FILE="https://travis-ci.org/MARQAS/amp-hide-posts/builds/421068152#L6"
#ZIP_FILE="https://downloads.wordpress.org/plugin/amp-woocommerce.0.3.zip"

# Ensure the zip file for the current version has been built
# if [ ! -f "$ZIP_FILE" ]; then
#     echo "Built zip file $ZIP_FILE does not exist" 1>&2
#     exit 1
# fi

# Check if the tag exists for the version we are building
# TAG=$(svn ls "https://plugins.svn.wordpress.org/$PLUGIN/tags/$VERSION")
# error=$?
# if [ $error == 0 ]; then
#     # Tag exists, don't deploy
#     echo "Tag already exists for version $VERSION, aborting deployment"
#     exit 1
# fi
  
cd "$PLUGIN_BUILDS_PATH"
# Remove any unzipped dir so we start from scratch
rm -fR "$PLUGIN"
# Unzip the built plugin
unzip -q -o "$ZIP_FILE"

# Clean up any previous svn dir
rm -fR svn

# Checkout the SVN repo
svn co -q "http://svn.wp-plugins.org/" svn

# Move out the trunk directory to a temp location
# mv svn/trunk ./svn-trunk
# # Create trunk directory
# mkdir svn/trunk
# # Copy our new version of the plugin into trunk
# rsync -r -p $PLUGIN/* svn/trunk

# # Copy all the .svn folders from the checked out copy of trunk to the new trunk.
# # This is necessary as the Travis container runs Subversion 1.6 which has .svn dirs in every sub dir
# cd svn/trunk/
# TARGET=$(pwd)
# cd ../../svn-trunk/

# Find all .svn dirs in sub dirs
# SVN_DIRS=`find . -type d -iname .svn`

# for SVN_DIR in $SVN_DIRS; do
#     SOURCE_DIR=${SVN_DIR/.}
#     TARGET_DIR=$TARGET${SOURCE_DIR/.svn}
#     TARGET_SVN_DIR=$TARGET${SVN_DIR/.}
#     if [ -d "$TARGET_DIR" ]; then
#         # Copy the .svn directory to trunk dir
#         cp -r $SVN_DIR $TARGET_SVN_DIR
#     fi
# done

# Back to builds dir
# cd ../

# Remove checked out dir
# rm -fR svn-trunk

#Add new version tag
#mkdir svn/$PLUGIN/tags/$VERSION
echo "directory created"
rsync -r -p $PLUGIN/* svn/tags/$VERSION
echo "rsync done"
# Add new files to SVN
svn stat svn | grep '^?' | awk '{print $2}' | xargs -I x svn add x@
echo "Add new files done"
# Remove deleted files from SVN
svn stat svn | grep '^!' | awk '{print $2}' | xargs -I x svn rm --force x@
echo "Remove files done"
svn stat svn
echo "svn stat done"
# Commit to SVN
svn ci --no-auth-cache --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD svn -m "Deploy version $VERSION"
echo "committing done"
# Remove SVN temp dir
rm -fR svn