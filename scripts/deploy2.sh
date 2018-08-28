#! /bin/bash
# See https://github.com/GaryJones/wordpress-plugin-svn-deploy for instructions and credits.
#
# Steps to deploying:
#
#  1. Ask for plugin slug.
#  2. Ask for local plugin directory.
#  3. Check local plugin directory exists.
#  4. Ask for main plugin file name.
#  5. Check main plugin file exists.
#  6. Check readme.txt version matches main plugin file version.
#  7. Ask for temporary SVN path.
#  8. Ask for remote SVN repo.
#  9. Ask for SVN username.
# 10. Ask if input is correct, and give chance to abort.
# 11. Check if Git tag exists for version number (must match exactly).
# 12. Checkout SVN repo.
# 13. Set to SVN ignore some GitHub-related files.
# 14. Export HEAD of master from git to the trunk of SVN.
# 15. Initialise and update and git submodules.
# 16. Move /trunk/assets up to /assets.
# 17. Move into /trunk, and SVN commit.
# 18. Move into /assets, and SVN commit.
# 19. Copy /trunk into /tags/{version}, and SVN commit.
# 20. Delete temporary local SVN checkout.

echo
echo "WordPress Plugin SVN Deploy v3.0.0"
echo
echo "Let's collect some information first. There are six questions."
echo
echo "Default values are in brackets - just hit enter to accept them."
echo

# Get some user input
# Can't use the -i flag for read, since that doesn't work for bash 3
# printf "Q1. WordPress Repo Plugin Slug e.g. my-awesome-plugin: "
# read -e PLUGINSLUG
# echo
PLUGINSLUG="amp-woocommerce"

# Set up some default values. Feel free to change these in your own script
CURRENTDIR=$(pwd)
default_svnpath="/tmp/$PLUGINSLUG"
default_svnurl="https://plugins.svn.wordpress.org/$PLUGINSLUG"
default_svnuser="marqas"
default_plugindir="$CURRENTDIR/$PLUGINSLUG"
default_mainfile="$PLUGINSLUG.php"

# echo "Q2. Your local plugin root directory (the Git repo)."
# printf "($default_plugindir): "
# read -e  input
# input="${input%/}" # Strip trailing slash
PLUGINDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )/.." && pwd )" # Populate with default if empty
echo

# Check directory exists.
if [ ! -d "$PLUGINDIR" ]; then
  echo "Directory $PLUGINDIR not found. Aborting."
  exit 1;
fi

# printf "Q3. Name of the main plugin file ($default_mainfile): "
# read -e input
MAINFILE="$default_mainfile" # Populate with default if empty
echo

# Check main plugin file exists.
if [ ! -f "$PLUGINDIR/$MAINFILE" ]; then
  echo "Plugin file $PLUGINDIR/$MAINFILE not found. Aborting."
  exit 1;
fi

echo "Checking version in main plugin file matches version in readme.txt file..."
echo

SVNPATH="$default_svnpath" # Populate with default if empty
echo

SVNURL="$default_svnurl" # Populate with default if empty
echo

SVNUSER="$default_svnuser" # Populate with default if empty
echo
PLUGINVERSION=$(grep -i "Version:" $PLUGINDIR/$MAINFILE | awk -F' ' '{print $NF}' | tr -d '\r')
echo

echo "That's all of the data collected."
echo
echo "Slug: $PLUGINSLUG"
echo "Plugin directory: $PLUGINDIR"
echo "Main file: $MAINFILE"
echo "Temp checkout path: $SVNPATH"
echo "Remote SVN repo: $SVNURL"
echo "SVN username: $SVNUSER"
echo

# Let's begin...
echo ".........................................."
echo
echo "Preparing to deploy WordPress plugin"
echo
echo ".........................................."
echo

echo

echo "Changing to $PLUGINDIR"
cd $PLUGINDIR

# Check for git branch (may need to allow for leading "v"?)
# if git show-ref --branches --quiet --verify -- "refs/branches /$PLUGINVERSION"
# if git show-ref --branches --quiet --verify -- "refs/branches/$PLUGINVERSION"
# 	then
# 		echo "Git branch with $PLUGINVERSION does exist. Let's continue..."
# 	else
# 		echo "$PLUGINVERSION does not exist as a git branch. Aborting.";
# 		exit 1;
# fi

echo

# echo "Creating local copy of SVN repo trunk..."
# svn checkout $SVNURL $SVNPATH --depth immediates
# svn update --quiet $SVNPATH/trunk --set-depth infinity

echo "Ignoring GitHub specific files"
svn propset svn:ignore "README.md
Thumbs.db
.github/*
.git
.gitattributes
.gitignore" "$SVNPATH/trunk/"

echo "Exporting the HEAD of master from git to the trunk of SVN"
#echo "Moving assets."

# If submodule exist, recursively check out their indexes
# if [ -f ".gitmodules" ]
# 	then
# 		echo "Exporting the HEAD of each submodule from git to the trunk of SVN"
# 		git submodule init
# 		git submodule update
# 		git config -f .gitmodules --get-regexp '^submodule\..*\.path$' |
# 			while read path_key path
# 			do
# 				#url_key=$(echo $path_key | sed 's/\.path/.url/')
# 				#url=$(git config -f .gitmodules --get "$url_key")
# 				#git submodule add $url $path
# 				echo "This is the submodule path: $path"
# 				echo "The following line is the command to checkout the submodule."
# 				echo "git submodule foreach --recursive 'git checkout-index -a -f --prefix=$SVNPATH/trunk/$path/'"
# 				git submodule foreach --recursive 'git checkout-index -a -f --prefix=$SVNPATH/trunk/$path/'
# 			done
# fi

# echo

# Support for the /assets folder on the .org repo.
# Make the directory if it doesn't already exist
# mkdir -p $SVNPATH/assets/
# mv $SVNPATH/trunk/assets/* $SVNPATH/assets/
# svn add --force $SVNPATH/assets/
# svn delete --force $SVNPATH/trunk/assets

#echo "assets done"

echo "Changing directory to SVN and committing to beta tag."
cd $SVNPATH/tags/$VERSION
# Delete all files that should not now be added.
#svn stat svn | grep '^!' | awk '{print $2}' | xargs -I x svn rm --force x@
# Add all new files that are not set to be ignored
svn stat svn | grep '^?' | awk '{print $2}' | xargs -I x svn add x@
svn stat svn
svn commit --no-auth-cache --username $WP_ORG_USERNAME --password $WP_ORG_PASSWORD svn -m "Preparing for $PLUGINVERSION release"

echo "committing done"