#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to install WordPress? [y/N] " response

# username, database-name, sitename
wpuser='hagege'
dbname='sgs'
sitename='SGS'
dir='sgs'
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
	password=$(LC_CTYPE=C tr -dc A-Za-z0-9_\!\@\#\$\%\^\&\*\(\)-+= < /dev/urandom | head -c 12)

	# delete database
	 php ../wp-cli.phar db drop
	# create database, and install WordPress
	 php ../wp-cli.phar db create
	 php ../wp-cli.phar core install --url="http://localhost/$currentdirectory" --title="$sitename" --admin_user="$wpuser" --admin_password="$password" --admin_email="postmaster@aachenerkinder.de"
	# german language:
	 php ../wp-cli.phar language core install de_DE
	 php ../wp-cli.phar language core activate de_DE
	# php ../wp-cli.phar site switch-language de_DE
	# ------------------- WordPress installed ------------------- #
	# install the _s theme
	# php ../wp-cli.phar theme install https://github.com/Automattic/_s/archive/master.zip --activate

	# clear
	 php ../wp-cli.phar plugin delete hello
	
	 php ../wp-cli.phar plugin delete akismet
	
	 php ../wp-cli.phar plugin install health-check --activate

	# Installation und Aktivierung von UpdraftPlus
	# php ../wp-cli.phar plugin install updraftplus --activate

	# Wiederherstellung 
	# php ../wp-cli.phar updraftplus restore 59958c9144e1
	
	# gesicherten UpdraftPlus-Ordner kopieren, damit die Premiumversion installiert ist
	 cp -r -iv d:/laragon/sicherungen/updraftplus d:/laragon/www/$dir/wp-content/plugins/updraftplus
	 php ../wp-cli.phar plugin activate updraftplus
	 php ../wp-cli.phar updraftplus get_latest_full_backup
	# Ordner für Backups anlegen (wahrscheinlich nicht notwendig):
	 mkdir d:/laragon/www/$dir/wp-content/updraft
	# Sicherungen in den Ordner updraft kopieren:
	cp -iv Y:/webseiten_sicherung/extern_sicherung/entwicklung/backup_2021-12-27-0837_Stdtische_Gesamtschule_Stolber_6615b4685829*.* d:/laragon/www/$dir/wp-content/updraft
	# cp -iv Y:/webseiten_sicherung/extern_sicherung/aachenerkinder/log*.* d:/laragon/www/$dir/wp-content/updraft
	
	# Rescan either local or remote storage for backup sets
	php ../wp-cli.phar updraftplus rescan_storage local
	php ../wp-cli.phar updraftplus existing_backups
	# php ../wp-cli.phar updraftplus restore 59958c9144e1
	# UpdraftPlus Premium muss aktiviert sein:
	# Doku: https://updraftplus.com/wp-cli-updraftplus-documentation/
	# Achtung: Falls die Datenbank aus einer anderen Sicherung stammt: Immer prüfen, ob die DB im Set enthalten ist (siehe job_id)
	# Nach Korrektur der Job_id und Restore aus einer anderen Sicherung hat es funktioniert:
	# Schneller klappt es mit dem Import direkt in phpMyAdmin und anschließend Korrektur über Better Search and Replace oder über 
	# php ../wp-cli.phar search-replace "https://gesamtschule-stolberg.de/" "http://sgs.test/"
	
	php ../wp-cli.phar updraftplus restore 6615b4685829 --components="db"
	# Create User HGG:
	php ../wp-cli.phar user create HGG gerhards@haurand.com --role=administrator --user_pass=Test_2019
	# hat funktioniert, dauert aber lange - daher wenn möglich besser direkt lokal entpacken:
	# php ../wp-cli.phar updraftplus restore 6615b4685829 --components="uploads,plugins,themes"
	# php ../wp-cli.phar updraftplus restore 6615b4685829 --components="other"
	
	# Update Themes and Plugins
	php ../wp-cli.phar theme update --all;
	php ../wp-cli.phar plugin update --all;
	# php ../wp-cli.phar plugin activate --all;
	php ../wp-cli.phar db check;
    php ../wp-cli.phar language plugin --all update
    php ../wp-cli.phar language theme --all update
	
	# Ersetzen der Domain in der Datenbank (bei UpdraftPlus Premium nicht notwendig):
	# php ../wp-cli.phar search-replace "https://gesamtschule-stolberg.de/" "http://sgs.test/"
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