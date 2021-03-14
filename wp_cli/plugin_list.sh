#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites


		#Set the array of folders
		# DIRECTORIES=( 'aachen50plus' 'ackids_50' 'ackids' 'bubenheim' 'eilendorf.net' 'eks_eschweiler' 'leer' 'Onepager' 'rs_mausbach' 'sgs' 'sprecherforscher' 'sprecherforscher-neu' test' 'testseite-2-haurand.com' 'testseite-haurand.com' 'Testseite-Kunde' 'twenty-twenty' 'wp53Leer');
        DIRECTORIES=( 'aachen50plus' 'ackids_50' 'ackids' 'bubenheim' 'eilendorf.net' 'eks_eschweiler' 'Onepager' 'rs_mausbach' 'leer' 'sgs' 'sprecherforscher' 'test' 'testseite-2-haurand.com' 'testseite-haurand.com' 'Testseite-Kunde' 'wp53Leer' 'twenty-twenty');
        # DIRECTORIES=( 'aachen50plus' 'ackids_50' 'ackids' );
		#For each item in array, run the commands
        # read -p "Press [Enter] key to continue..."
  	    echo "plugin-Listen:" > ../plugin_liste.txt; 
		echo "*****************************************************" >> ../plugin_liste.txt;        
		for dir in ${DIRECTORIES[@]} ; do

		  cd ${dir};

		  echo "";
		  echo "";
		  echo "*****************************************************" ;
		  echo "plugin-Listen:" ;         
		  echo "*****************************************************" >> ../plugin_liste.txt; 
		  echo "plugin-Liste für ${dir}" >> ../plugin_liste.txt;
		  echo "plugin-Liste für ${dir}" ;
		  echo "*****************************************************" >> ../plugin_liste.txt;
		  echo "";
		  echo "";
          # read -p "Press [Enter] key to continue..."

		  php ../wp-cli.phar plugin list >> ../plugin_liste.txt;
		  # php ../wp-cli.phar core update;
		  # php ../wp-cli.phar checksum core;
		  # php ../wp-cli.phar db check;
          # php ../wp-cli.phar language plugin --all update
          # php ../wp-cli.phar language plugin --all update
          

		  echo '';
		  echo '';
		  echo "*****************************************************" ;
		  echo "*****************************************************" ;
		  echo "*****************************************************" ;
		  echo '';
		  echo '';

		  cd .. ;
		done

    read -p "FINISHED - Press [Enter] key to continue..."