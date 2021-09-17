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
	password=$(LC_CTYPE=C tr -dc A-Za-z0-9_\!\@\#\$\%\^\&\*\(\)-+= < /dev/urandom | head -c 12)

	# delete database
	php ../wp-cli.phar db drop
	# create database, and install WordPress
	php ../wp-cli.phar db create
	php ../wp-cli.phar core install --url="http://localhost/$currentdirectory" --title="$sitename" --admin_user="$wpuser" --admin_password="$password" --admin_email="postmaster@aachenerkinder.de"
	# Change User-Password:
	php ../wp-cli.phar user create HansGerd gerhards@haurand.com --role=administrator --user_pass=Test_2019
	# german language:
	php ../wp-cli.phar language core install de_DE
	php ../wp-cli.phar language core activate de_DE
	# php ../wp-cli.phar site switch-language de_DE

	# install the _s theme
	# php ../wp-cli.phar theme install https://github.com/Automattic/_s/archive/master.zip --activate

	# clear
	php ../wp-cli.phar plugin delete hello
	
	php ../wp-cli.phar plugin delete akismet
	
	php ../wp-cli.phar plugin install health-check --activate

	# Installation und Aktivierung von UpdraftPlus
	# php ../wp-cli.phar plugin install updraftplus --activate

	# Wiederherstellung 
	# php ../wp-cli.phar updraftplus restore 99d2af14ce61
	
    # php ../wp-cli.phar updraftplus get_latest_full_backup
	# UpdraftPlus-Ordner aus ackids_50 kopieren, damit die Premiumversion installiert ist
	cp -r -v d:/laragon/sicherungen/updraftplus d:/laragon/www/$dir/wp-content/plugins/updraftplus
	php ../wp-cli.phar plugin activate updraftplus
	# Ordner für Backups anlegen:
	mkdir d:/laragon/www/$dir/wp-content/updraft
	# Sicherungen in den Ordner updraft kopieren:
	cp d:/laragon/sicherungen/backup_2021-06-22-1735_Neue_Testseite*.* d:/laragon/www/$dir/wp-content/updraft
	
	# Rescan either local or remote storage for backup sets
	php ../wp-cli.phar updraftplus rescan_storage local
	php ../wp-cli.phar updraftplus existing_backups
	php ../wp-cli.phar updraftplus restore a8f39e7f3d4a
	
	# Themes und Plugins updaten
	php ../wp-cli.phar theme update --all;
	php ../wp-cli.phar plugin update --all;
	php ../wp-cli.phar db check;
    php ../wp-cli.phar language plugin --all update
    php ../wp-cli.phar language theme --all update

	# UpdraftPlus Premium muss aktiviert sein:
	# Doku: https://updraftplus.com/wp-cli-updraftplus-documentation/
	# hat funktioniert:
	# php ../wp-cli.phar updraftplus restore faf8caf9662d --components="db"
	# hat funktioniert:
	# php ../wp-cli.phar updraftplus restore 89020effac4f --components="uploads"
	# php ../wp-cli.phar updraftplus restore dac99363559f
	# php ../wp-cli.phar updraftplus restore 89020effac4f
	
	# funktioniert:
	# php ../wp-cli.phar option update timezone_string "America/New York"
	# funktioniert nicht:
	# php ../wp-cli.phar option update timezone_string "Europa/Berlin"

	echo "================================================================="
	echo "Installation is complete. Your username/password is listed below."
	echo ""
	echo "Username: $wpuser"
	echo "Password: $password"
	echo ""
	echo "================================================================="


read -p "FINISHED - Press [Enter] key to continue..."