#!/bin/bash

# Quelle: https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites

# username, database-name, sitename
# a web page with the name "$sitename" and the database "$dbname" should be created
dbname='fse_meetup'
sitename='Full Site Editing Testseite '
dir='fse_meetup'

	# remove directory (show the process: v)
	# rm -rv $dir; 
	
	# Make a new directory
	mkdir $dir;
	
	# Change directory
	cd $dir;

	echo "================================================================="
	echo "Awesome WordPress Installer!!"
	echo "================================================================="

	# download the WordPress core files
	php ../wp-cli.phar core download --locale=de_DE

	# create the wp-config file
	php ../wp-cli.phar core config --dbname=$dbname --dbuser=root --dbpass=

	# parse the current directory name
	# currentdirectory=${PWD##*/}

	# create database, and install WordPress
	php ../wp-cli.phar db create
	php ../wp-cli.phar core install --url="http://localhost/$dir" --title="$sitename" --admin_user=lokal --admin_password=Test_2019 --admin_email="lokal@haurand.com"
	# german language:
	# php ../wp-cli.phar site switch-language de_DE
	
	# deinstall Akismet and Hello Dolly, install some themes and plugins:
	php ../wp-cli.phar plugin delete hello
	php ../wp-cli.phar plugin delete akismet
	php ../wp-cli.phar plugin install gutenberg --activate
	php ../wp-cli.phar theme install wabi --activate
	# php ../wp-cli.phar plugin install health-check --activate


	# clear

	echo "================================================================="
	echo "Installation is complete. Your username/password is listed below."
	echo ""
	echo "Username: lokal"
	echo "Password: Test_2019"
	echo ""
	echo "================================================================="


read -p "FINISHED - Press [Enter] key to continue..."
