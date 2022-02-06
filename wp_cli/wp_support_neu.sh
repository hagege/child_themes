#!/bin/bash

function options() {
	printf "\n----  Websitetitel und Beschreibung ersetzen ----\n"
	php ../wp-cli.phar option update blogname "WP – Support"
	php ../wp-cli.phar option update blogdescription "WordPress Support - Neue Testumgebung"
	php ../wp-cli.phar option update timezone_string "Europe/Berlin"
	php ../wp-cli.phar option update date_format "j. F Y"
	php ../wp-cli.phar option update time_format "G:i"
	php ../wp-cli.phar option update permalink_structure "/%postname%/"
	php ../wp-cli.phar site switch-language de_DE
}	

function users() {
    declare -A user
    user["editor"]=Redakteur
    user["author"]=Autor
    user["contributor"]=Mitarbeiter
    user["subscriber"]=Abonennt

    for key in "${!user[@]}"; do
        php ../wp-cli.phar user create ${user[${key}]} ${user[${key}],}@wp.test --role=${key} --user_pass=password
    done
}

function delete_plugins() {
	php ../wp-cli.phar plugin delete hello
	php ../wp-cli.phar plugin delete akismet
}

function activate_themes() {
	php ../wp-cli.phar theme install generatepress --activate
}


#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to install WordPress? [y/N] " response

# username, database-name, sitename
wpuser='hagege'
dbname='support'
sitename='Support-Seite'
dir='support'

	if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then

		
		rm -rv ${dir};

		mkdir ${dir};
		
		cd ${dir};

		echo "================================================================="
		echo "Awesome WordPress Installer!!"
		echo "================================================================="

		# accept user input for the databse name - here deactivated
		# echo "Database Name: "
		# read -e dbname

		# accept the name of our website - here deactivated
		# echo "Site Name: "
		# read -e sitename

		# add a simple yes/no confirmation before we proceed
		echo "Run Install? (y/n)"
		read -e run

		# if the user didn't say no, then go ahead an install
		if [ "$run" == n ] ; then
			exit
		else

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
			php ../wp-cli.phar core install --url="http://localhost/$currentdirectory" --title="$sitename" --admin_user="$wpuser" --admin_password="$password" --admin_email="user@example.org"
			# Change User-Password:
			php ../wp-cli.phar user create lokal lokal@haurand.com --role=administrator --user_pass=Test_2019
			# german language:
			php ../wp-cli.phar language core install de_DE
			# php ../wp-cli.phar language core activate de_DE
			
			
			options
			users
			echo 'Alle Benutzer angelegt'.
			delete_plugins
			activate_themes

			
			printf "\n----  Zehn Beiträge mit Blindtext erstellen ----\n"
			curl -N http://loripsum.net/api/5 | php ../wp-cli.phar post generate --post_content --count=10 --post_date=2022-02-01
			php ../wp-cli.phar media import D:/laragon/sicherungen/bilder/bild_{1..15}.jpg
			# hier sollten den Beiträgen featured images zugeordnet werden. Klappt leider so nicht:
			# https://danielbachhuber.com/tip/assign-featured-image-generated-post/
			# php ../wp-cli.phar post generate --format=ids | xargs -0 -d ' ' -I % wp post meta update % _thumbnail_id 19
			# install the _s theme
			# php ../wp-cli.phar theme install https://github.com/Automattic/_s/archive/master.zip --activate
			# Bilder bei den Beiträgen als featured image zuordnen. Nicht ganz so schön, aber klappt:
			# siehe https://dev-notes.eu/2016/07/bulk-import-images-using-wp-cli/
			bild=14
			for i in {4..16}
			do
			   bild=$(($bild+1));	
			   php ../wp-cli.phar post meta update $i _thumbnail_id $bild
			   echo "Beitrag $i mit Bild $bild"
			done
			# clear

			echo "================================================================="
			echo "Installation is complete. Your username/password is listed below."
			echo ""
			echo "Username: $wpuser"
			echo "Password: $password"
			echo ""
			echo "http://localhost/$currentdirectory"
			echo ""				
			echo "================================================================="

		fi

	fi
read -p "FINISHED - Press [Enter] key to continue..."