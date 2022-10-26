#! /bin/bash

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

users
echo 'Alle Benutzer angelegt'.