#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to install WordPress? [y/N] " response

# username, database-name, sitename - der folgende User wird nur lokal verwendet:
wpuser="lokal"
wpuser_pwd="Test_2019"

### ---------------------- WICHTIG: ANFANG - Korrekt ersetzen ---------------------- ###
# hier die Sicherungsdatei aus UpdraftPlus eintragen:
wp_restore="backup_2022-09-25-0100_aachenerkinderde_32ef214fc6df"

# ggfs. Datenbank mit anderer ID, sonst auskommentieren
wp_restore_db=$wp_restore
# wp_restore_db="backup_2022-01-13-0500_aachenerkinderde_132a552b97c6"

search_string="https://aachenerkinder.de" 
dbname="ackids_test"
### ---------------------- WICHTIG: ENDE - Korrekt ersetzen ---------------------- ###

# wird ersetzt - keine Änderung notwendig:
sitename=$dbname
dir=$dbname
replace_string="http://localhost/${dbname}"

### ---------------------- WICHTIG: Prüfen ---------------------- ###
# braucht in der Regel nicht geändert zu werden, evtl. Laufwerk ändern
target_dir="d:/laragon/www/${dir}/wp-content"
# backup_dir="d:/laragon/sicherungen/"
backup_dir="Y:/webseiten_sicherung/extern_sicherung/aachenerkinder/"
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
	### ---------------------- Datenbank ---------------------- ###
	# -> Datenbank ggfs. entpacken
	sicherung="${backup_dir}${wp_restore_db}-db.gz"
	gzip -d -r $sicherung
	# -> Datenbank importieren
	
	sicherung="${backup_dir}${wp_restore_db}-db"
	php ../wp-cli.phar db import $sicherung
	# php ../wp-cli.phar site switch-language de_DE
	# ------------------- WordPress installed ------------------- #

	### ---------------------- Plugins, Themes, Uploads, Others entpacken ---------------------- ###	
	# -> UpdraftPlus - Sicherungen müssen im folgenden Ordner liegen und alle Daten werden überschrieben:
	### unzip 'd:/laragon/sicherungen/backup_2022-01-17-2000_Das_BubenheimerSpieleland_6d354e071931-*.zip' -d $target_dir
	# alles entpacken ...
	sicherung="${backup_dir}${wp_restore}-*.zip"
	unzip "$sicherung" -d "$target_dir"
	# oder einzeln ...
	### sicherung="${backup_dir}${wp_restore}-others.zip"
	### unzip $sicherung -d $target_dir
	### sicherung="${backup_dir}${wp_restore}-plugins.zip"
	### unzip $sicherung -d $target_dir
	### sicherung="${backup_dir}${wp_restore}-themes.zip"
	### unzip $sicherung -d $target_dir
	### sicherung="${backup_dir}${wp_restore}-uploads*.zip"
	### unzip $sicherung -d $target_dir
	
	
	### php ../wp-cli.phar updraftplus restore $wp_restore --components="db"
	# hat funktioniert, dauert aber lange - daher wenn möglich besser direkt lokal entpacken:
	### php ../wp-cli.phar updraftplus restore $wp_restore --components="uploads,plugins,themes"
	### php ../wp-cli.phar updraftplus restore $wp_restore --components="other"
	
	# Update Themes and Plugins
	# NinjaFirewall macht keinen Sinn und funktioniert auch nicht
	
	# Plugins löschen:
	php ../wp-cli.phar plugin delete ninjafirewall
	php ../wp-cli.phar plugin delete hello
	php ../wp-cli.phar plugin delete akismet
	
	# health-check zusätzlich installieren:
	php ../wp-cli.phar plugin install health-check --activate
	php ../wp-cli.phar plugin activate --all;
	
	# lokal nicht genutzte Plugins deaktivieren:
	php ../wp-cli.phar plugin deactivate koko-analytics
	php ../wp-cli.phar plugin deactivate adrotate-pro
	php ../wp-cli.phar plugin deactivate wp-rocket
	php ../wp-cli.phar plugin deactivate wordpress-seo
	php ../wp-cli.phar plugin deactivate wordpress-seo-premium
	php ../wp-cli.phar plugin deactivate real-cookie-banner-pro
	
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
	php ../wp-cli.phar search-replace $search_string $replace_string
	
	# rewrite permalink structure (hat nicht geklappt -> daher nach der Wiederherstellung auf Einstellungen > Permalinks
	php ../wp-cli.phar rewrite flush
	
	# funktioniert:
	# php ../wp-cli.phar option update timezone_string "America/New York"
	# funktioniert nicht:
	# php ../wp-cli.phar option update timezone_string "Europa/Berlin" - das hier testen:
	php ../wp-cli.phar option update timezone_string "Europe/Berlin"
	echo "================================================================="
	echo "Adminbereich öffnen mit http://localhost/${dir}/wp-login.php"
	echo "$wpuser - Anmeldung mit $wpuser_pwd"
	echo "================================================================="

read -p "FINISHED - Press [Enter] key to continue..."