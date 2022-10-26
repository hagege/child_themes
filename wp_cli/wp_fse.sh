#!/bin/bash

# Quelle: https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to install WordPress? [y/N] " response

# username, database-name, sitename
wpuser='hagege'
# a web page with the name "$sitename" and the database "$dbname" should be created
dbname='fse'
sitename='FSE Program Testing Call'
dir='fse'

	# remove directory (show the process: v)
	# rm -rv $dir; 
	
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


	# download the WordPress core files (german)
	php ../wp-cli.phar core download --locale=de_DE

	# create the wp-config file
	php ../wp-cli.phar core config --dbname=$dbname --dbuser=root --dbpass=

	# parse the current directory name
	currentdirectory=${PWD##*/}

	# generate random 12 character password
	password=$(LC_CTYPE=C tr -dc A-Za-z0-9_\!\@\#\$\%\^\&\*\(\)-+= < /dev/urandom | head -c 12)

	# delete database if necessary
	# php ../wp-cli.phar db drop
	# create database, and install WordPress
	php ../wp-cli.phar db create
	php ../wp-cli.phar core install --url="http://localhost/$currentdirectory" --title="$sitename" --admin_user="$wpuser" --admin_password="$password" --admin_email="postmaster@aachenerkinder.de"
	# php ../wp-cli.phar core install --url="http://$currentdirectory" --title="$sitename" --admin_user="$wpuser" --admin_password="$password" --admin_email="postmaster@aachenerkinder.de"
	# Default User in development environments:
	php ../wp-cli.phar user create lokal lokal@haurand.com --role=administrator --user_pass=Test_2019
	# german language:
	# php ../wp-cli.phar language core install de_DE
	# php ../wp-cli.phar language core activate de_DE
	php ../wp-cli.phar site switch-language de_DE
	
	# deinstall Akismet and Hello Dolly, install some themes and plugins:
	php ../wp-cli.phar plugin delete hello
	php ../wp-cli.phar plugin delete akismet
	php ../wp-cli.phar plugin install gutenberg --activate
	# php ../wp-cli.phar plugin install updraftplus --activate
	# php ../wp-cli.phar theme install tove 
	# php ../wp-cli.phar theme install tt1-blocks --activate
	# php ../wp-cli.phar theme install aino
	# php ../wp-cli.phar theme install armando
	php ../wp-cli.phar language plugin update --all
	php ../wp-cli.phar language theme update --all
	# php ../wp-cli.phar plugin install health-check --activate


	# clear
	# install UpdraftPlus if necessary:
	# php ../wp-cli.phar plugin install updraftplus --activate
	# php ../wp-cli.phar updraftplus restore 99d2af14ce61

	echo "================================================================="
	echo "Installation is complete. Your username/password is listed below."
	echo ""
	echo "Username: $wpuser"
	echo "Password: $password"
	echo ""
	echo "================================================================="


read -p "FINISHED - Press [Enter] key to continue..."