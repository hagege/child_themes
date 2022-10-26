#!/bin/bash
php wp-cli.phar core download --locale=de_DE
php wp-cli.phar core config --dbname=meetupdb --dbuser=lokal --dbpass=Test_2019_db
php wp-cli.phar db create
php wp-cli.phar core install --url=https://meetup.test --title="lokal" --admin_user=lokal --admin_password=Test_2019 --admin_email=lokal@haurand.com