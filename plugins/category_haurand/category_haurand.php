<?php
/**
 * @package Category Haurand
 * @version 0.1
 */
/*
Plugin Name: Category Haurand
Plugin URI: http://haurand.com
Description: Create a new Category "Haurand" for Block Patterns
Author: Hans-Gerd Gerhards
Version: 0.1
Author URI: http://haurand.com
*/

/* ------------------------------ */
/* eigene Kategorie               */
/* ------------------------------ */
if ( function_exists( 'register_block_pattern_category' ) ) {
	register_block_pattern_category(
	  'Vorlagen Haurand',
	  array( 'label' => __( 'Forms', 'text-domain' ) )
   );
  }
  
  

/* Kategorien deaktivieren */

add_action('after_setup_theme', 'removeCorePatterns');

function removeCorePatterns() {
    remove_theme_support('core-block-patterns');
	unregister_block_pattern_category('buttons');
	unregister_block_pattern_category('columns');
	unregister_block_pattern_category('gallery');
	unregister_block_pattern_category('header');
	unregister_block_pattern_category('text');
	unregister_block_pattern_category('uncategorized');
}
 
  
  function haurand_register_block_categories() {
	if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
	register_block_pattern_category(
	 'Vorlagen Haurand',
	 array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category', 'Vorlagen Haurand' ) )
	 );
	}
   }
   add_action( 'init', 'haurand_register_block_categories' );
