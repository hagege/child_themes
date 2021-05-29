php ../wp-cli.phar updraftplus existing_backups
php ../wp-cli.phar updraftplus get_latest_full_backup
# Doku: https://updraftplus.com/wp-cli-updraftplus-documentation/
# hat funktioniert:
# php ../wp-cli.phar updraftplus restore faf8caf9662d --components="db"
# php ../wp-cli.phar updraftplus restore 89020effac4f --components="uploads"
php ../wp-cli.phar updraftplus restore 89020effac4f
