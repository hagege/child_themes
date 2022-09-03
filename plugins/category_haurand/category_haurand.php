<?php
/**
 * @package Category Vorlagen Haurand
 * @version 0.3
 */
/*
Plugin Name: Category Vorlagen Haurand
Plugin URI: http://haurand.com
Description: Create a new Category "Haurand" as "Vorlagen Haurand" for Block Patterns
Author: Hans-Gerd Gerhards
Version: 0.3
Author URI: http://haurand.com
*/

/*----------------------------------------------------------------*/
/* Start: Block Patterns von haurand.com "Vorlagen Haurand"
/* Datum: 07.08.2022
/* Autor: hgg
/*----------------------------------------------------------------*/

/* ------------------------------ */
/* eigene Kategorie               */
/* ------------------------------ */
if ( function_exists( 'register_block_pattern_category' ) ) {
    register_block_pattern_category(
      'haurand',
      array( 'label' => __( 'Forms', 'text-domain' ) )
   );
  }
  
  
  add_action('init', function() {
      remove_theme_support('core-block-patterns');
  });
  
  function prefix_unregister_category() {
    unregister_block_pattern_category( 'buttons');
    unregister_block_pattern_category( 'header');
    unregister_block_pattern_category( 'text');
    unregister_block_pattern_category( 'columns');
    unregister_block_pattern_category( 'gallery');
    unregister_block_pattern_category( 'query');
  }
  add_action( 'init', 'prefix_unregister_category' );
  
  
  function haurand_register_block_categories() {
    if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
    register_block_pattern_category(
     'Haurand',
     array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category', 'Haurand' ) )
     );
    }
   }
   add_action( 'init', 'haurand_register_block_categories' );
  