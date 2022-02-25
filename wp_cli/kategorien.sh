#!/bin/bash

function taxonomy() {
	parent=$(php ../wp-cli.phar term get category --by=slug --field=term_taxonomy_id Weltreise-1)
	echo ${parent}
	# php ../wp-cli.phar term create category Weltreise-1 --description="Weltreise 1" --porcelain
	# parent='Weltreise 1'
	php ../wp-cli.phar term create category Niederlande --description="Niederlande" --parent=${parent} --porcelain
	php ../wp-cli.phar term create category Frankreich --description="Frankreich" --parent=${parent} --porcelain
	php ../wp-cli.phar term create category Italien --description="Italien" --parent=${parent} --porcelain
	parent=$(php ../wp-cli.phar term get category --by=slug --field=term_taxonomy_id Weltreise-2)
	# parent=$(php ../wp-cli.phar term create category Weltreise-2 --description="Weltreise 2" --porcelain)
	# parent='Weltreise 2'
	php ../wp-cli.phar term create category Niederlande --description="Niederlande" --parent=${parent} --porcelain
	php ../wp-cli.phar term create category Frankreich --description="Frankreich" --parent=${parent} --porcelain
}

taxonomy