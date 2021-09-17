#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to install WordPress? [y/N] " response

# username, database-name, sitename
wpuser='hagege'
# a web page with the name "Weitere Testseite" and the database "test_db2" should always be created
dbname='test_db3'
sitename='Neue Testseite'
dir='neue_testseite_2'

	# delete database
	php ../wp-cli.phar db drop

	# remove directory (show the process: v)
	rm -rv $dir; 
	


read -p "FINISHED - Press [Enter] key to continue..."