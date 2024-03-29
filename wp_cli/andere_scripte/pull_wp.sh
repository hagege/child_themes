#!/bin/bash

# von m_andrasch (siehe discord)

## Description: Migrate a remote website to a local DDEV
## Usage: pull-wp [ssh_user_at_host] [wordpress_path_on_remote]
## Example: "pull-wp sshuser@host.xyz /html/wordpress"
## (Remote path - no trailing slash!)

# Requirements:
# This script assumes that updraftplus premium is activated on remote site

# TODO: Use DDEV_DOCROOT variable?
# We use a subdirectory in DDEV container, see "docroot" in .ddev/config.yaml
DDEV_WP_DIR=/var/www/html/ddev-wordpress
mkdir -p "$DDEV_WP_DIR"
cd "$DDEV_WP_DIR"

if [ -z "$1" ]
  then
    echo "Please provide ssh connection information (e.g. ddev pull-wp sshuser@sshost.xyz /html/wordpress) :-)"
    exit 1
  else
    SSH_USER_HOST="${1}"
fi

if [ -z "$2" ]
  then
    echo "Please provide the path to wordpress on remote machine (e.g. ddev pull-wp sshuser@sshost.xyz /html/wordpress) :-)"
    exit 1
  else
    SSH_WORDPRESS_PATH="${2}"
fi

# Flag for updraftplus backup nonce (otherwise new backup is created)
# -nonce=
# TODO add support for "latest backup" as well?
# https://stackoverflow.com/a/9274633
# https://linuxhint.com/getopts-usage-example-linux/
# echo "Received nonce from commandline call: ${UPDRAFT_NONCE}";
# Right now we always create a fresh backup
CREATE_BACKUP_ON_REMOTE='yes'

# TODO add option for updraftplus free support (without cli on remote)
# Right now, we just support updraftplus premium with CLI
UPDRAFT_CLI_ACTIVATED='yes'

# ------------------- Checks -----------------------------

# check if updraftplus CLI is actived on local instance
wp updraftplus existing_backups >/dev/null
if [ $? -eq 0 ]; then
    echo "Updraftplus CLI is active on local machine..."
else
    echo "Please activate updraftplus premium in WP Dashboard in your local DDEV site, aborting."
    exit 1
fi

# checking ssh connection
echo "Checking ssh connection and path ..."
echo "Please provide the SSH password (use SSH keys to avoid this prompt):"
if [ -n "$(ssh "${SSH_USER_HOST}" [ -d "${SSH_WORDPRESS_PATH}" ] && echo 1; exit)" ]; then
    # exists
    echo "Connection test passed ..."
else
    # doesn't exist
    echo "Connection test failed, aborting."
    exit 1
fi

# get remote wordpress version, save it as var
# updraftplus free / standard version does not backup wpcore files, therefore we handle it with wpcli
echo "Getting the wpcore version information from remote site ..."
echo "Please provide the SSH password (use SSH keys to avoid this prompt):"
WP_CORE_VERSION_LIVE_WEBSITE=`ssh ${SSH_USER_HOST} wp core version --path=${SSH_WORDPRESS_PATH}`
echo "Live website has version: ${WP_CORE_VERSION_LIVE_WEBSITE}"

# create fresh backup on remote site

if [[ $UPDRAFT_CLI_ACTIVATED == "yes" ]]
  then
    if [[ $CREATE_BACKUP_ON_REMOTE == "yes" ]]
      then
        echo "Create backup on remote storage via SSH..."
        echo "(This can take some time)"
        # we could set include-files= to wpcore, but we don't do it to be compatible with the free version workflow
        UPDRAFT_TERMINAL_OUTPUT=`ssh ${SSH_USER_HOST} "wp updraftplus backup --path=${SSH_WORDPRESS_PATH} && wp updraftplus get_latest_full_backup --path=${SSH_WORDPRESS_PATH}"`
      else
        # Just get the latest full backup id from remote
        echo "Getting the updraftplus nonce for latest backup on remote site ..."
        echo "Please provide the SSH password (use SSH keys to avoid this prompt):"
        UPDRAFT_TERMINAL_OUTPUT=`ssh ${SSH_USER_HOST} wp updraftplus get_latest_full_backup --path=${SSH_WORDPRESS_PATH}`
    fi

    # we strip identifier from string after last : character
    # (Output will be something like: Success: Latest full backup found identifier: a7cfeXXXXc281)
    UPDRAFT_NONCE=${UPDRAFT_TERMINAL_OUTPUT##*: }
    # TODO: Error handling - check if nonce contains numbers/characters? check format?
    echo "Updraft nonce on remote is ${UPDRAFT_NONCE}"
  # No updratfplus CLI on remote activated, just set it to empty string
  else
    UPDRAFT_NONCE=""
fi

echo "Updraft nonce was set to: ${UPDRAFT_NONCE}"

echo "Sync backup files from remote server to local DDEV (rsync) ..."
# see https://rsync.snipline.io/ for details
if [[ $UPDRAFT_NONCE != "" ]]
  then
    echo "Downloading backup files with nonce ${UPDRAFT_NONCE} to local machine ..."
    echo "Please provide the SSH password (use SSH keys to avoid this prompt):"
    rsync --archive --human-readable --rsh ssh --progress --include="*${UPDRAFT_NONCE}*.zip" --include="*${UPDRAFT_NONCE}*.gz" --exclude="*" ${SSH_USER_HOST}:${SSH_WORDPRESS_PATH}/wp-content/updraft/ wp-content/updraft/
  else
    echo "Downloading all backup files from remote to local machine ..."
    echo "Please provide the SSH password (use SSH keys to avoid this prompt):"
    rsync --archive --human-readable --rsh ssh --progress --include="*.zip" --include="*.gz" --exclude="*" ${SSH_USER_HOST}:${SSH_WORDPRESS_PATH}/wp-content/updraft/ wp-content/updraft/
fi

# Version comparision local instance <-> remote
# (updraftplus does not backup core files)
WP_CORE_VERSION_LOCAL=`wp core version`
if [[ "$WP_CORE_VERSION_LOCAL" == "$WP_CORE_VERSION_LIVE_WEBSITE" ]];
  then
    echo "Local instance runs same wp core version as remote website, no down-/upgrade needed."
  else
    # downgrade current ddev site to that wp version (updraftplus does not backup core files in free version, MoreFiles addon needed)
    echo "We down/upgrade the local environment to match the remote site core version to run a realistic tests on local machine..."
    wp core update --version=${WP_CORE_VERSION_LIVE_WEBSITE} --force
fi

# rescan storage
echo "Restoring latest backup we received from remote machine ..."
echo "Rescan updraftplus storage..."
wp updraftplus rescan_storage local

if [[ $UPDRAFT_NONCE == "" ]]
  then
    # If we don't have nonce information from remote (because of no wp-cli addon on remote), we need to get it from local
    # Updraft does output a full string instead of just the identifier
    # Output will be something like: Success: Latest full backup found identifier: a7cfeXXXXc281
    UPDRAFT_TERMINAL_OUTPUT_LOCAL=`wp updraftplus get_latest_full_backup`
    # we strip identifier after last : character
    UPDRAFT_NONCE=${UPDRAFT_TERMINAL_OUTPUT_LOCAL##*: }
fi

# Restore this site, important: --migration=true (replaces URLs in database)
# We could also set --delete-during-restore=true, but if something fails we have to transfer files again to local machine
# TODO: exclude wpcore, maybe wpcore was included on remote site via premium plugin?
echo "Restoring backup with nonce/identifier ${UPDRAFT_NONCE} and --migration=true..."
wp updraftplus restore $UPDRAFT_NONCE --migration=true

echo "Delete '-old'-directories created by updraftplus"
find . -type d -name '*-old' -exec rm -r {} +

# Setup Symlinks, run another DDEV command
echo "Setting up symlinks ..."
# https://unix.stackexchange.com/a/216915
CURRENT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
source "$CURRENT_DIR/setup-symlinks"
# Important - change back directory afterwards:
cd "$DDEV_WP_DIR"

echo "pull-wp ended, have fun testing locally! (and fight the climate emergency :))"
echo "[You can always open your website with 'ddev launch' from commandline]"