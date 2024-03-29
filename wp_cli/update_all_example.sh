#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to update all specified directories? [y/N] " response

	if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then

		#Set the array of folders
		DIRECTORIES=( 'testinstanz1' 'testinstanz2' 'testinstanz3');
		#For each item in array, run the commands
        # read -p "Press [Enter] key to continue..."
		for dir in ${DIRECTORIES[@]} ; do

		  cd ${dir};

		  echo "";
		  echo "";
		  echo "*****************************************************" ;
		  echo "UPDATING: " ${dir} " in " `pwd` ;
		  echo "*****************************************************" ;
		  echo "";
		  echo "";
          # read -p "Press [Enter] key to continue..."

		  php ../wp-cli.phar theme update --all;
		  php ../wp-cli.phar plugin update --all;
		  php ../wp-cli.phar theme list;
		  php ../wp-cli.phar plugin list;
		  # Don't update WordPress:
		  ../wp-cli.phar core update;
		  # php ../wp-cli.phar checksum core;
		  php ../wp-cli.phar db check;
          php ../wp-cli.phar language plugin --all update
          php ../wp-cli.phar language theme --all update
          

		  echo '';
		  echo '';
		  echo "*****************************************************" ;
		  echo "UPDATE for ${dir} COMPLETE!" ;
		  echo "*****************************************************" ;
		  echo '';
		  echo '';

		  cd .. ;
		done

	fi
read -p "FINISHED - Press [Enter] key to continue..."