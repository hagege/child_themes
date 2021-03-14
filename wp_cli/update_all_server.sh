#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites
read -r -p "Are you sure you want to update all specified directories? [y/N] " response

	if [[ "$response" =~ ^([yY][eE][sS]|[yY])$ ]]; then

		#Set the array of folders
		# DIRECTORIES=( 'aachen50plus' 'ackids_50' 'ackids' 'bubenheim' 'eilendorf.net' 'Onepager' 'rs_mausbach' 'sgs' 'sprecherforscher' 'test' 'testseite-2-haurand.com' 'testseite-haurand.com' 'Testseite-Kunde' 'wp53Leer' );
        # DIRECTORIES=( '/home/www/wp' '/home/www/wp_nk' '/home/www/wp5' '/home/www/wp5_n' '/home/www/hochzeitwebseiten.de/_test_');
        # URL	DB	Pfad	Genutzt für
        # hoxeit.de	web7_db1	/home/www/wp	
        # http://www.natascha-kevin.de	web7_db2	/home/www/wp_nk	
        # hochxeit.de	web7_db3	/home/www/wp5	
        # hochxeit.de	web7_db4	/home/www/wp5_n	
        # http://test.hochzeitwebseiten.de	web7_db5	/home/www/hochzeitwebseiten.de/_test_	eilendorf.net
        DIRECTORIES=( '/home/www/wp' '/home/www/wp_nk' '/home/www/wp5' '/home/www/wp5_n' '/home/www/hochzeitwebseiten.de/_test_');
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

		  /home/wp-cli.phar theme update --all;
		  /home/wp-cli.phar plugin update --all;
		  /home/wp-cli.phar theme list;
		  /home/wp-cli.phar plugin list;
		  /home/wp-cli.phar core update;
		  /home/wp-cli.phar checksum core;
		  /home/wp-cli.phar db check;
          /home/wp-cli.phar language plugin --all update
          /home/wp-cli.phar language theme --all update
          

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