<?php
/**
 * @package Category Vorlagen Haurand
 * @version 0.2
 */
/*
Plugin Name: Category Vorlagen Haurand
Plugin URI: http://haurand.com
Description: Create a new Category "Haurand" as "Vorlagen Haurand" for Block Patterns with my own custom Block patterns
Author: Hans-Gerd Gerhards
Version: 0.2
Author URI: http://haurand.com
*/

/*----------------------------------------------------------------*/
/* Start: Block Patterns von haurand.com "Vorlagen Haurand"
/* Datum: 31.10.2022
/* Autor: hgg
/*----------------------------------------------------------------*/

/* Allows a theme to de-register its support of a certain feature */  
  add_action('init', function() {
      remove_theme_support('core-block-patterns');
  });
  
  
/* Unregisters a pattern category */  
 function prefix_unregister_category() {
    unregister_block_pattern_category( 'buttons');
    unregister_block_pattern_category( 'header');
    unregister_block_pattern_category( 'text');
    unregister_block_pattern_category( 'columns');
    unregister_block_pattern_category( 'gallery');
  }
  add_action( 'init', 'prefix_unregister_category' );
 
 

/* eigene Kategorie Haurand              */
function haurand_register_block_categories() {
if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
	register_block_pattern_category(
	 'Haurand',
	 array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category' ) )
    );
  }
}
add_action( 'init', 'haurand_register_block_categories' );
   
   

/* Beispiel Spaltenblock mit Bild  */
register_block_pattern(
  'spaltenblock_mit_bild',
    array(
    'title' => __( 'Spaltenblock mit Bild', 'spaltenblock_mit_bild' ),
    'description' => _x( 'Spaltenblock mit Bild', 'Spaltenblock mit Bild', 'spaltenblock_mit_bild' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","style":{"color":{"gradient":"linear-gradient(0deg,rgb(255,255,255) 48%,rgb(0,0,0) 48%)"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull has-background" style="background:linear-gradient(0deg,rgb(255,255,255) 48%,rgb(0,0,0) 48%)"><!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
		<div class="wp-block-columns alignwide" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"textColor":"luminous-vivid-amber"} -->
		<h2 class="has-luminous-vivid-amber-color has-text-color">Ein Text</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"style":{"color":{"text":"#e09f12"}}} -->
		<p class="has-text-color" style="color:#e09f12">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:spacer {"height":"200px"} -->
		<div style="height:200px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:image {"id":5723,"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"30px"}},"className":"is-style-rounded"} -->
		<figure class="wp-block-image size-large has-custom-border is-style-rounded"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021-1024x768.jpg" alt="" class="wp-image-5723" style="border-radius:30px"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);

