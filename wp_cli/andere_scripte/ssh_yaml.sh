# Pull a live site into DDEV

# von m_andrasch (siehe discord)

# This pulls a live wordpress site via SSH, 
# WP-CLI (or mysqldump) and rsync into DDEV

# Requires DDEV version >= 1.18.2 !
# (https://github.com/drud/ddev/releases/tag/v1.18.2)

# Variables retrieved from .ddev/config.yaml -> web_enviroment=[]
environment_variables:
  sshUser: ${PRODUCTION_SSH_USER}
  sshHost: ${PRODUCTION_SSH_HOST}
  sshWpPath: ${PRODUCTION_SSH_WP_PATH}
  childThemeFolderName: ${CHILD_THEME_FOLDER_NAME} 
  remoteDbCharset: ${REMOTE_DB_CHARSET}
# 1. Add ssh keys to the user agent
auth_command:
  command: |
    ssh-add -l >/dev/null || ( echo "Please 'ddev auth ssh' before running this command." && exit 1 )

# 2. Pull a fresh database dump via SSH
# 
# Get db connection credentials from wp-config.php on live server,
# dump database via mysqldump to local .sql.gz file in .ddev/downloads
# 
# (Possible alternative, not implemented because detecting availability was complicated:
# Use 'wp db export' command if WP-CLI is installed on remote, it'll use wp-config.php DB settings )
# 
db_pull_command:
  command: |
    # set -x   # You can enable bash debugging output by uncommenting
    set -eu -o pipefail
    pushd "/var/www/html/${DDEV_DOCROOT}" >/dev/null

    # Database dump via mysqldump on remote, db connection credentials are parsed from live sites 
    # wp-config.php via bash on remote server (https://tomjn.com/2014/03/01/wordpress-bash-magic/),
    # Important: Use backslash for mysqldump values, thanks to https://stackoverflow.com/a/13826220

    ssh ${sshUser}@${sshHost} "cd ${sshWpPath} && mysqldump \
      --default-character-set=${REMOTE_DB_CHARSET} \
      --user=\$(cat wp-config.php | grep DB_USER | cut -d \' -f 4) \
      --password=\$(cat wp-config.php | grep DB_PASSWORD | cut -d \' -f 4) \
      --host=\$(cat wp-config.php | grep DB_HOST | cut -d \' -f 4) \
      \$(cat wp-config.php | grep DB_NAME | cut -d \' -f 4) | gzip -9 -c" > .ddev/.downloads/db.sql.gz
    
    # TODO: add warning if values come up empty ... (How can this be checked in a robust way?)
    # TODO: handle other charsets then default 'utf8' via --default-character-set=utf8mb4, see README
    # TODO: add solution for use of double quotes / single quotes / mixed quotes (e.g. define('DB_HOST', "mysql03.host.net");)

  service: web

# 3. Rsync all the files (except excludes)
files_pull_command:
  command: |
    # set -x   # You can enable bash debugging output by uncommenting
    set -eu -o pipefail
    ls /var/www/html/.ddev >/dev/null 
    pushd /var/www/html/${DDEV_DOCROOT} >/dev/null

    # Add trailing slash for sshWpPath if missing, 
    # (thx https://gist.github.com/luciomartinez/c322327605d40f86ee0c)
    [[ "${sshWpPath}" != */ ]] && sshWpPath="${sshWpPath}/"

    echo "Downloading files from remote site, except child theme folder ${childThemeFolderName} ..."
    # exclude child theme + some default locations of wordpress backup plugins
    # (exclude pattern is glob based, not path based)
    # add -v for output of files transferred, -vv for full debug
    rsync -azh --stats \
      --exclude=".git/" \
      --exclude=".gitignore" \
      --exclude=".ddev/" \
      --exclude="README.md" \
      --exclude="LICENSE" \
      --exclude="wp-content/themes/${childThemeFolderName}" \
      --exclude="wp-content/updraft" \
      ${sshUser}@${sshHost}:${sshWpPath} .
  service: web

# 4. Set database connection + migrate URLs in DB
# 
# We use this step to run some important WP-CLI commands locally
# a) Replace db connection settings in wp-config.php
# b) Replace live site url (determined from backup)
# with DDEV_PRIMARY_URL (<your-project>.ddev.site) in local databse
# TODO: c) re-generate permalinks? other steps needed?
files_import_command:
  command: |
    # set -x  # You can enable bash debugging output by uncommenting
    set -eu -o pipefail
    pushd "/var/www/html/${DDEV_DOCROOT}" >/dev/null

    echo "Adjusting wp-config db connection settings for DDEV ..."
    wp config set DB_NAME "db" && wp config set DB_USER "db" && wp config set DB_PASSWORD "db" && wp config set DB_HOST "db"

    # Important: Use wp search-replace for URL replacement
    echo "Replacing the old URL ($(wp option get siteurl)) in database with DDEV local url (${DDEV_PRIMARY_URL})..."
    wp search-replace $(wp option get siteurl) "${DDEV_PRIMARY_URL}"

    # Additional update the wp config values, because some devs/hoster, e.g. raidboxes
    # put it here (only remove if existent)
    # TODO: if [wp config has] would be better, but how to implement it here?
    # if [ "$(wp config has WP_HOME)" = 0 ]; then wp config delete WP_HOME; fi
    # if [ "$(wp config has WP_SITEURL)" = 1 ]; then wp config delete WP_SITEURL; fi
    wp config set WP_HOME "${DDEV_PRIMARY_URL}"
    wp config set WP_SITEURL "${DDEV_PRIMARY_URL}/"

    # Optional: more steps would be possible here after import
    # echo "Deleting config path for WP Super Cache (if installed) ..."
    # wp config delete WPCACHEHOME

    echo "All set, have fun! Run 'ddev launch' to open your site."
  service: web
