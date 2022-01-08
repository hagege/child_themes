#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to install WordPress? [y/N] " response

# username, database-name, sitename - der folgende User wird nur lokal verwendet:
wpuser='lokal'
wpuser_pwd='Test_2019'
### ---------------------- WICHTIG: Korrekt ersetzen ---------------------- ###
dbname='sgs'
sitename='sgs'
dir='sgs'
wp_restore='c461274d69c4'
### -> done

	# vielleicht besser über Laragon löschen, daher auskommentiert
	# remove directory (show the process: v)
	rm -rv $dir; 
	
	# Make a new directory
	mkdir $dir;
	
	# Change directory
	cd $dir;

	echo "================================================================="
	echo "Awesome WordPress Installer!!"
	echo "================================================================="

	# accept user input for the databse name - here deactivated
	# echo "Database Name: "
	# read -e dbname

	# accept the name of our website - here deactivated
	# echo "Site Name: "
	# read -e sitename


	# download the WordPress core files
	# php ../wp-cli.phar wp core download
	php ../wp-cli.phar core download

	# create the wp-config file
	php ../wp-cli.phar core config --dbname=$dbname --dbuser=root --dbpass=
	# php ../wp-cli.phar core config --dbname=$dbname --dbuser=root --dbpass=

	# parse the current directory name
	currentdirectory=${PWD##*/}

	# generate random 12 character password
	### password=$(LC_CTYPE=C tr -dc A-Za-z0-9_\!\@\#\$\%\^\&\*\(\)-+= < /dev/urandom | head -c 12)

	# delete database
	php ../wp-cli.phar db drop
	# create database, and install WordPress
	php ../wp-cli.phar db create
	php ../wp-cli.phar core install --url="http://localhost/$currentdirectory" --title="$sitename" --admin_user="$wpuser" --admin_password="$password" --admin_email="postmaster@aachenerkinder.de"
	# german language:
	php ../wp-cli.phar language core install de_DE
	php ../wp-cli.phar language core activate de_DE
	### ---------------------- WICHTIG: Korrekt ersetzen ---------------------- ###
	# -> Datenbank ggfs. entpacken
	gzip -d -r d:/laragon/sicherungen/backup_2022-01-07-1622_Stdtische_Gesamtschule_Stolber_c461274d69c4-db.gz
	### ---------------------- WICHTIG: Korrekt ersetzen ---------------------- ###
	# -> Datenbank importieren
	php ../wp-cli.phar db import d:/laragon/sicherungen/backup_2022-01-07-1622_Stdtische_Gesamtschule_Stolber_c461274d69c4-db
	# php ../wp-cli.phar site switch-language de_DE
	# ------------------- WordPress installed ------------------- #

	### ---------------------- WICHTIG: Korrekt ersetzen ---------------------- ###	
	# -> UpdraftPlus - Sicherungne müssen im folgenden Ordner liegen und alle Daten werden überschrieben:
	unzip 'd:/laragon/sicherungen/backup_2022-01-07-1622_Stdtische_Gesamtschule_Stolber_c461274d69c4-*.zip' -d d:/laragon/www/sgs/wp-content
		
	### php ../wp-cli.phar updraftplus restore $wp_restore --components="db"
	# hat funktioniert, dauert aber lange - daher wenn möglich besser direkt lokal entpacken:
	### php ../wp-cli.phar updraftplus restore $wp_restore --components="uploads,plugins,themes"
	### php ../wp-cli.phar updraftplus restore $wp_restore --components="other"
	
	# Update Themes and Plugins
	# NinjaFirewall macht keinen Sinn und funktioniert auch nicht
	php ../wp-cli.phar plugin delete ninjafirewall
	php ../wp-cli.phar plugin delete hello
	
	php ../wp-cli.phar plugin delete akismet
	
	php ../wp-cli.phar plugin install health-check --activate
	php ../wp-cli.phar plugin activate --all;
	php ../wp-cli.phar theme update --all;
	php ../wp-cli.phar plugin update --all;
	
	
	# php ../wp-cli.phar plugin activate --all;
	php ../wp-cli.phar db check;
    php ../wp-cli.phar language plugin --all update
    php ../wp-cli.phar language theme --all update
	
	# Create new User:
	php ../wp-cli.phar user create $wpuser lokal@haurand.com --role=administrator --user_pass=$wpuser_pwd
	
	

	# Ersetzen der Domain in der Datenbank (bei UpdraftPlus Premium nicht notwendig):
	### ---------------------- WICHTIG: Korrekt ersetzen ---------------------- ###
	php ../wp-cli.phar search-replace "https://test.gesamtschule-stolberg.de" "http://localhost/sgs"
	
	# rewrite permalink structure
	php ../wp-cli.phar rewrite flush
	
	# funktioniert:
	# php ../wp-cli.phar option update timezone_string "America/New York"
	# funktioniert nicht:
	# php ../wp-cli.phar option update timezone_string "Europa/Berlin"
	echo "================================================================="
	echo "$wpuser - Anmeldung mit $wpuser_pwd"
	echo "================================================================="

read -p "FINISHED - Press [Enter] key to continue..."