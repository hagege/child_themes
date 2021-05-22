#!/bin/bash -e

wpuser='exampleuser'

clear

echo "================================================================="
echo "Awesome WordPress Installer!!"
echo "================================================================="

# accept user input for the databse name
echo "Database Name: "
read -e dbname

# accept the name of our website
echo "Site Name: "
read -e sitename

# add a simple yes/no confirmation before we proceed
echo "Run Install? (y/n)"
read -e run

# if the user didn't say no, then go ahead an install
if [ "$run" == n ] ; then
exit
else

# download the WordPress core files
php ../wp-cli.phar wp core download

# create the wp-config file
php ../wp-cli.phar wp core config --dbname=$dbname --dbuser=root --dbpass=root

# parse the current directory name
currentdirectory=${PWD##*/}

# generate random 12 character password
password=$(LC_CTYPE=C tr -dc A-Za-z0-9_\!\@\#\$\%\^\&\*\(\)-+= < /dev/urandom | head -c 12)

# create database, and install WordPress
php ../wp-cli.phar wp db create
php ../wp-cli.phar wp core install --url="http://localhost/$currentdirectory" --title="$sitename" --admin_user="$wpuser" --admin_password="$password" --admin_email="user@example.org"

# install the _s theme
php ../wp-cli.phar wp theme install https://github.com/Automattic/_s/archive/master.zip --activate

# clear

echo "================================================================="
echo "Installation is complete. Your username/password is listed below."
echo ""
echo "Username: $wpuser"
echo "Password: $password"
echo ""
echo "================================================================="

fi