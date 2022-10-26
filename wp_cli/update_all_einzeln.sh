#!/bin/bash

#Double-check you're ready to rock and roll with an update
# https://n8finch.com/wrote-first-bash-script-implement-wp-cli-managed-sites


		#Set the array of folders
		#For each item in array, run the commands
        # read -p "Press [Enter] key to continue..."



		  php ../wp-cli.phar theme update --all;
		  php ../wp-cli.phar plugin update --all;
		  php ../wp-cli.phar theme list;
		  php ../wp-cli.phar plugin list;
		  php ../wp-cli.phar core update;
		  php ../wp-cli.phar checksum core;
		  php ../wp-cli.phar db check;
          php ../wp-cli.phar language plugin --all update
          php ../wp-cli.phar language theme --all update
          

read -p "FINISHED - Press [Enter] key to continue..."