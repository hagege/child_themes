	dir='ackids'
	# cp -r -v d:/laragon/sicherungen/updraftplus d:/laragon/www/ackids/wp-content/plugins/updraftplus
	cd $dir;
	# php ../wp-cli.phar plugin activate updraftplus
	# Ordner für Backups anlegen:
	# mkdir d:/laragon/www/ackids/wp-content/updraft
	# Sicherungen in den Ordner updraft kopieren:
	# cp y:/webseiten_sicherung/extern_sicherung/aachenerkinder/backup_2021-09-12-0100_aachenerkinderde_fdc5fc556884*.* d:/laragon/www/ackids/wp-content/updraft
	php ../wp-cli.phar updraftplus rescan_storage local
	php ../wp-cli.phar updraftplus existing_backups
	# Key für Sicherung ggfs. ersetzen:
	php ../wp-cli.phar updraftplus restore fdc5fc556884
	php ../wp-cli.phar updraftplus restore dbb947323883 --components="db"
    php ../wp-cli.phar theme update --all;
	php ../wp-cli.phar plugin update --all;
	php ../wp-cli.phar db check;
    php ../wp-cli.phar language plugin --all update
    php ../wp-cli.phar language theme --all update
