<?php

/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

/*----------------------------------------------------------------*/
/* Start: style.css Datei des Eltern-Themes einbinden
/* scheint nicht nötig zu sein, siehe hier: https://docs.generatepress.com/article/using-child-theme/
/* Datum: 30.12.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

/* function child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );
*/ 

/*----------------------------------------------------------------*/
/* Start: Damit 2 Spalten korrekt bei Schlagwörtern angezeigt werden
/* Datum: 30.12.2020
/* Autor: hgg
/*---------------------------------------------------------------- */
add_filter( 'generate_blog_columns', function( $columns ) {
    if ( ! is_singular() && 'tribe_events' === get_post_type() && ! is_post_type_archive( 'tribe_events' ) ) {
        $columns = true;
    }

    return $columns;
} );

/* ------------------------------ */
/* eigene Kategorie               */
/* ------------------------------ */
if ( function_exists( 'register_block_pattern_category' ) ) {
	register_block_pattern_category(
	  'msmg',
	  array( 'label' => __( 'Forms', 'text-domain' ) )
   );
  }
  
  

/* Erst mal alle Kategorien zulassen */
/*
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
*/  
  
  function haurand_register_block_categories() {
	if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
	register_block_pattern_category(
	 'msmg',
	 array( 'label' => _x( 'Vorlagen msmg', 'Block pattern category', 'msmg' ) )
	 );
	}
   }
   add_action( 'init', 'haurand_register_block_categories' );
  
  
  
   register_block_pattern(
	  /* https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/ */
	  /* maskieren ist nicht mehr nötig, wenn man einfache Hochkommatas nimmt */
	 'two-tile-card-pattern',
	   array(
	   'title' => __( 'Two columns with pictures', 'zwei-kacheln-block-pattern' ),
	   'description' => _x( 'Two columns with pictures (tiles)', 'Block pattern description', 'zwei-kacheln-block-pattern' ),
	   'categories'  => array('msmg'),
	   'content'     =>
		  '<!-- wp:columns {"style":{"color":{"background":"#2c6997"}}} -->
		  <div class="wp-block-columns has-background" style="background-color:#2c6997"><!-- wp:column -->
		  <div class="wp-block-column"><!-- wp:image {"id":44,"sizeSlug":"large","linkDestination":"none"} -->
		  <figure class="wp-block-image size-large"><img src="https://www.web102.s116.goserver.host/wp-content/uploads/2022/03/Beispiel_2-1024x1024.jpg" alt="" class="wp-image-44"/></figure>
		  <!-- /wp:image --></div>
		  <!-- /wp:column -->
		  
		  <!-- wp:column {"textColor":"base-3"} -->
		  <div class="wp-block-column has-base-3-color has-text-color"><!-- wp:heading {"level":3,"textColor":"base-3"} -->
		  <h3 class="has-base-3-color has-text-color">Anmeldung</h3>
		  <!-- /wp:heading -->
		  
		  <!-- wp:paragraph -->
		  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet</p>
		  <!-- /wp:paragraph --></div>
		  <!-- /wp:column --></div>
		  <!-- /wp:columns -->',
	 )
   );


 

 register_block_pattern(
   'icon-block-office',
     array(
     'title' => __( 'Icons with office Application', 'icon-block-office' ),
     'description' => _x( 'Icons with office Application (ppt)', 'Block pattern description', 'icon-block-office' ),
     'categories'  => array('msmg'),
     'content'     =>
        '<!-- wp:group {"align":"full"} -->
		<div class="wp-block-group alignfull"><!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"><strong>Powerpoint Präsentation </strong><br><strong>(bitte klicken):</strong></p>
		<!-- /wp:paragraph -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"><a rel="noreferrer noopener" href="https://test.gesamtschule-stolberg.de/wp-content/uploads/2018/11/Differenzierung2_neu.pptx" target="_blank">Fachleistungsdifferenzierung</a></p>
		<!-- /wp:paragraph -->
		
		<!-- wp:image {"align":"center","id":1354,"width":64,"height":64,"sizeSlug":"full","linkDestination":"custom","className":"office-icon"} -->
		<div class="wp-block-image office-icon"><figure class="aligncenter size-full is-resized"><a href="https://test.gesamtschule-stolberg.de/wp-content/uploads/2018/11/Differenzierung2_neu.pptx"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2018/10/ppt-3.png" alt="" class="wp-image-1354" width="64" height="64"/></a></figure></div>
		<!-- /wp:image --></div>
		<!-- /wp:group -->',
		)
);

/*----------------------------------------------------------------*/
/* Ende: Block Patterns von sgs 
/* Datum: 18.11.2021
/* Autor: hgg
/*----------------------------------------------------------------*/

/*----------------------------------------------------------------*/
/* Start: Weiterlesen-Button, auch wenn der Textauszug eingetragen ist
/* Datum: 27.05.2021
/* Autor: hgg
/*----------------------------------------------------------------*/
add_filter( 'wp_trim_excerpt', 'tu_excerpt_metabox_more' );
function tu_excerpt_metabox_more( $excerpt ) {
	$output = $excerpt;
    $settings = wp_parse_args( 
		get_option( 'generate_blog_settings', array() ), 
		generate_blog_get_defaults() 
	);
	
	if ( has_excerpt() ) {
    $excerpt = $excerpt . ' ...';
		$output = sprintf( '%1$s <p class="read-more-container"><a class="read-more button" href="%2$s">%3$s</a></p>',
			$excerpt,
			get_permalink(),
      wp_kses_post( $settings['read_more'] )
		);
	}
	
	return $output;
}
/*----------------------------------------------------------------*/
/* Start: Weiterlesen-Link, auch wenn der Textauszug eingetragen ist
/* Datum: 27.05.2021
/* Autor: hgg
/*----------------------------------------------------------------*/


/*----------------------------------------------------------------/
/ Start: Keine Überschrift im Excerpt
/ Datum: 01.01.2021
/ Autor: hgg
/----------------------------------------------------------------/
/ Klappt zwar so weit, aber bei einem customer excerpt wird zwei Mal der Button gezeigt 
function wp_strip_header_tags( $excerpt='' ) {
	$raw_excerpt = $excerpt;
	if ( '' == $excerpt ) {
		$excerpt = get_the_content('');
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = apply_filters('the_content', $excerpt);
		$excerpt = str_replace(']]>', ']]>', $excerpt);
	}
	$regex = '#(<h([1-6])[^>]>)\s?(.*)?\s?(<\/h\2>)#';
	$excerpt = preg_replace($regex,'', $excerpt);
	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
	return apply_filters('wp_trim_excerpt', preg_replace($regex,'', $excerpt), $raw_excerpt);
	}
	add_filter( 'get_the_excerpt', 'wp_strip_header_tags', 9);
*/
?>