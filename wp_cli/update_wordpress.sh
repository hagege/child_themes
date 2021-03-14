#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to update all specified directories? [y/N] " response

	if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then

		#Set the array of folders
		# DIRECTORIES=( 'aachen50plus' 'ackids_50' 'ackids' 'bubenheim' 'eilendorf.net' 'eks_eschweiler' 'leer' 'Onepager' 'rs_mausbach' 'sgs' 'sprecherforscher' 'sprecherforscher-neu' test' 'testseite-2-haurand.com' 'testseite-haurand.com' 'Testseite-Kunde' 'twenty-twenty' 'wp53Leer');
        DIRECTORIES=( 'aachen50plus' 'ackids_50' 'ackids' 'bubenheim' 'eilendorf.net' 'eks_eschweiler' 'Onepager' 'rs_mausbach' 'leer' 'sgs' 'sprecherforscher' 'test' 'testseite-2-haurand.com' 'testseite-haurand.com' 'Testseite-Kunde' 'wp53Leer' 'twenty-twenty');
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

		  # update WordPress:
		  php ../wp-cli.phar core update;
		  php ../wp-cli.phar checksum core;
          

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
wp     read -p "FINISHED - Press [Enter] key to continue..."