#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to install WordPress? [y/N] " response

# username, database-name, sitename
wpuser='hagege'
dbname='test_db'
sitename='Neue Testseite'
dir='neue_testseite'

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

	echo "================================================================="
	echo "Installation is complete. Your username/password is listed below."
	echo ""
	echo "Username: $wpuser"
	echo "Password: $password"
	echo ""
	echo "================================================================="


read -p "FINISHED - Press [Enter] key to continue..."