#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to restore DB? [y/N] " response

# username, database-name, sitename - der folgende User wird nur lokal verwendet:
wpuser="lokal"
wpuser_pwd="Test_2019"

### ---------------------- WICHTIG: ANFANG - Korrekt ersetzen ---------------------- ###
# hier die Sicherungsdatei aus UpdraftPlus eintragen:
wp_restore="backup_2022-09-27-0600_aachenerkinderde_3a374d48cba7"
# Sicherung in den ORdner kopieren:
## copy y:\webseiten_sicherung\extern_sicherung\aachenerkinder\backup_2022-09-27-0600_aachenerkinderde_3a374d48cba7-db.gz ..\sicherungen

# ggfs. Datenbank mit anderer ID, sonst auskommentieren
wp_restore_db=$wp_restore
# wp_restore_db="backup_2022-01-13-0500_aachenerkinderde_132a552b97c6"

search_string="https://aachenerkinder.de" 
dbname="ackids"
### ---------------------- WICHTIG: ENDE - Korrekt ersetzen ---------------------- ###

# wird ersetzt - keine Änderung notwendig:
sitename=$dbname
dir=$dbname
replace_string="http://localhost/${dbname}"

### ---------------------- WICHTIG: Prüfen ---------------------- ###
# braucht in der Regel nicht geändert zu werden, evtl. Laufwerk ändern
target_dir="d:/laragon/www/${dir}/wp-content"
# backup_dir="d:/laragon/sicherungen/"
backup_dir="D:/laragon/sicherungen/"
### -> done
	# Change directory
	cd $dir;
	### ---------------------- Datenbank ---------------------- ###
	# -> Datenbank ggfs. entpacken
	sicherung="${backup_dir}${wp_restore_db}-db.gz"
	gzip -d -r -k $sicherung
	# -> Datenbank importieren
	
	### Das könnte so funktionieren:\\nas_2_sicherung
	## backup_dir="//nas_2_sicherung/webseiten_sicherung/extern_sicherung/aachenerkinder/"
	sicherung="${backup_dir}${wp_restore_db}-db"
	# -> db import klappt nicht mit dem Laufwerk Y. Vermutlich Problem mit dem Mapping
	php ../wp-cli.phar db import $sicherung
	# php ../wp-cli.phar site switch-language de_DE
	# ------------------- WordPress installed ------------------- #

	### ---------------------- Plugins, Themes, Uploads, Others entpacken ---------------------- ###	
	# -> UpdraftPlus - Sicherungen müssen im folgenden Ordner liegen und alle Daten werden überschrieben:
	### unzip 'd:/laragon/sicherungen/backup_2022-01-17-2000_Das_BubenheimerSpieleland_6d354e071931-*.zip' -d $target_dir
	# alles entpacken ...
	## sicherung="${backup_dir}${wp_restore}-*.zip"
	## unzip "$sicherung" -d "$target_dir"
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
	
	
	# Create new User:
	php ../wp-cli.phar user create $wpuser lokal@haurand.com --role=administrator --user_pass=$wpuser_pwd
	
	# Farbschema auf hellgrau bei User lokal:
	php ../wp-cli.phar user update lokal --admin_color=light	
	

	# Ersetzen der Domain in der Datenbank (bei UpdraftPlus Premium nicht notwendig):
	### ---------------------- WICHTIG: Korrekt ersetzen ---------------------- ###
	php ../wp-cli.phar rewrite structure '/%postname%'
	php ../wp-cli.phar rewrite flush
	php ../wp-cli.phar option update permalink_structure '/%postname%'
	
	
	php ../wp-cli.phar option update blogname "TESTINSTANZ $(dbname)"
	
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