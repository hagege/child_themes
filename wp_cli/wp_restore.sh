	dir='weitere_testseite'
	cp -r -v d:/laragon/www/ackids_50/wp-content/plugins/updraftplus d:/laragon/www/weitere_testseite/wp-content/plugins/updraftplus
	cd $dir;
	php ../wp-cli.phar plugin activate updraftplus
	# Ordner für Backups anlegen:
	mkdir d:/laragon/www/weitere_testseite/wp-content/updraft
	# Sicherungen in den Ordner updraft kopieren:
	cp d:/laragon/sicherungen/backup_2021-06-22-1735_Neue_Testseite*.* d:/laragon/www/weitere_testseite/wp-content/updraft
	php ../wp-cli.phar updraftplus existing_backups
	php ../wp-cli.phar updraftplus restore a8f39e7f3d4a
    php ../wp-cli.phar theme update --all;
	php ../wp-cli.phar plugin update --all;
	php ../wp-cli.phar db check;
    php ../wp-cli.phar language plugin --all update
    php ../wp-cli.phar language theme --all update
