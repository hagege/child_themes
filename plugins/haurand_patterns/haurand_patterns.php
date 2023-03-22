<?php
/**
 * @package Haurand Patterns
 * @version 0.1
 */
/*
Plugin Name: Category Vorlagen Haurand
Plugin URI: http://haurand.com
Description: Create a new Category "Haurand" as "Patterns Haurand" for Block Patterns with our custom Block patterns
Author: Hans-Gerd Gerhards
Version: 0.1
Author URI: http://haurand.com
*/

/*----------------------------------------------------------------*/
/* Start: Block Patterns von haurand.com "Patterns Haurand"
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
	 'Patterns Haurand',
	 array( 'label' => _x( 'Patterns Haurand', 'Block pattern category' ) )
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
    'categories'  => array('Patterns Haurand'),
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


/* Query Block mit Cover und enthaltenen Post excerpt, sowie categories und read more link */
register_block_pattern(
    'spaltenblock_mit_bild',
      array(
      'title' => __( 'Query mit Cover und Text', 'query_cover_text' ),
      'description' => _x( 'Query mit Cover und Text', 'Query mit Cover und Text', 'query_cover_text' ),
      'categories'  => array('Patterns Haurand'),
      'content'     =>
         '<!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"tagName":"main","displayLayout":{"type":"flex","columns":2},"align":"full","layout":{"inherit":false,"wideSize":"1800px","contentSize":"1800px","type":"constrained"}} -->
            <main class="wp-block-query alignfull"><!-- wp:post-template {"align":"wide"} -->
            <!-- wp:cover {"url":"http://localhost/fse_test_meetup/wp-content/uploads/2022/04/diepenbenden_800.jpg","useFeaturedImage":true,"id":105,"dimRatio":20,"minHeight":100,"minHeightUnit":"vh","isDark":false} -->
            <div class="wp-block-cover is-light" style="min-height:100vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-20 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:post-date {"textColor":"white"} /-->

            <!-- wp:columns {"style":{"border":{"radius":"50px"}}} -->
            <div class="wp-block-columns" style="border-radius:50px"><!-- wp:column {"width":"33.33%","style":{"spacing":{"padding":{"top":"10px","right":"30px","bottom":"10px","left":"30px"}},"color":{"background":"#000000a1"}},"className":"linker_kasten","layout":{"contentSize":""}} -->
            <div class="wp-block-column linker_kasten has-background" style="background-color:#000000a1;padding-top:10px;padding-right:30px;padding-bottom:10px;padding-left:30px;flex-basis:33.33%"><!-- wp:post-title {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"luminous-vivid-orange","fontSize":"large"} /-->

            <!-- wp:post-excerpt {"textColor":"white"} /-->

            <!-- wp:read-more {"textColor":"white"} /--></div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"66.66%"} -->
            <div class="wp-block-column" style="flex-basis:66.66%"></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->

            <!-- wp:post-terms {"term":"category","style":{"color":{"background":"#26262633"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}}} /--></div></div>
            <!-- /wp:cover -->
            <!-- /wp:post-template -->

            <!-- wp:query-pagination {"paginationArrow":"arrow","align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
            <!-- wp:query-pagination-previous {"fontSize":"small"} /-->

            <!-- wp:query-pagination-numbers /-->

            <!-- wp:query-pagination-next {"fontSize":"small"} /-->
            <!-- /wp:query-pagination --></main>
            <!-- /wp:query -->',
            )
  );

