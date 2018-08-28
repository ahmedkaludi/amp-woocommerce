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



