#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites


		#Set the array of folders
		# DIRECTORIES=( 'aachen50plus' 'ackids_test' 'ackids' 'bubenheim' 'eilendorf.net' 'eks_eschweiler' 'leer' 'Onepager' 'sgs' 'test' 'testseite-2-haurand.com' 'testseite-haurand.com' 'Testseite-Kunde' 'twenty-twenty' 'wp53Leer');
		# Achtung: Die Instanzen müssen vorhanden sein
        # DIRECTORIES=( 'aachen50plus' 'ackids_test' 'ackids' 'bubenheim' 'eilendorf.net' 'eks_eschweiler' 'Onepager' 'leer' 'sgs' 'test' 'testseite-2-haurand.com' 'testseite-haurand.com' 'Testseite-Kunde' 'wp53Leer' 'twenty-twenty');
        #
		# um alle Subdirectories einzulesen:
		DIRECTORIES=( */ );
		#
		# nur bestimmte Subdirectories:
        # DIRECTORIES=( 'aachen50plus' 'ackids_test' 'ackids' );
		# 
		# For each item in array, run the commands
        # read -p "Press [Enter] key to continue..."
		laragon_dir='d:/laragon/www/'
		rm -rv plugin_liste.txt;
  	    echo "Plugin-Listen:" > plugin_liste.txt; 
		echo "*****************************************************" >> plugin_liste.txt;        
		for dir in ${DIRECTORIES[@]} ; do
		  act_dir=$laragon_dir;
		  echo ${act_dir};
		  act_dir="$laragon_dir$dir";
		  echo ${act_dir};
		  cd ${act_dir};

		  echo "";
		  echo "";
		  echo "*****************************************************" ;
		  echo "Plugin-Listen:";         
		  echo "*****************************************************" >> ../plugin_liste.txt; 
		  echo "Plugin-Liste für ${act_dir}" >> ../plugin_liste.txt;
		  echo "Plugin-Liste für ${act_dir}";
		  echo "*****************************************************" >> ../plugin_liste.txt;
          # read -p "Press [Enter] key to continue..."

		  php ../wp-cli.phar plugin list >> ../plugin_liste.txt;
		  # php ../wp-cli.phar core update;
		  # php ../wp-cli.phar checksum core;
		  # php ../wp-cli.phar db check;
          # php ../wp-cli.phar language plugin --all update
          # php ../wp-cli.phar language Plugin --all update
          

  		  echo "" >> ../plugin_liste.txt;
		  echo "" >> ../plugin_liste.txt;
		  echo '';
		  echo '';
		  echo "*****************************************************" ;
		  echo "*****************************************************" ;
		  echo "*****************************************************" ;
		  echo '';
		  echo '';

		  # cd .. ;
		done

    read -p "FINISHED - Press [Enter] key to continue..."