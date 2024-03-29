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
  
/*----------------------------------------------------------------*/
/* Ende: Block Patterns von Vorlagen Haurand 
/* Datum: 30.03.2022
/* Autor: hgg
/*----------------------------------------------------------------*/  
  
register_block_pattern(
	  /* Pattern für blauen Container mit zwei Spalten in blau und Bild links */
	 'two-columns-pattern-picture',
	   array(
	   'title' => __( 'Two columns with picture', 'zwei-kacheln-block-pattern-bild' ),
	   'description' => _x( 'Two columns with picture', 'Block pattern description', 'zwei-kacheln-block-pattern-bild' ),
	   'categories'  => array('Vorlagen Haurand'),
	   'content'     =>
		  '<!-- wp:columns {"align":"wide","backgroundColor":"global-color-9","className":"blauer_container_linke_spalte"} -->
		  <div class="wp-block-columns alignwide blauer_container_linke_spalte has-global-color-9-background-color has-background"><!-- wp:column -->
		  <div class="wp-block-column"><!-- wp:image {"id":38,"sizeSlug":"large","linkDestination":"none"} -->
		  <figure class="wp-block-image size-large"><img src="https://maria-sibylla-merian-gesamtschule.de/wp-content/uploads/2022/03/Beispiel_1-1024x1024.jpg" alt="" class="wp-image-38"/></figure>
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
	/* Pattern für blauen Container mit zwei Spalten in blau und Texten */
   'two-columns-pattern-text',
	 array(
	 'title' => __( 'Two columns with text', 'zwei-kacheln-block-pattern-text' ),
	 'description' => _x( 'Two columns with text', 'Block pattern description', 'zwei-kacheln-block-pattern-text' ),
	 'categories'  => array('Vorlagen Haurand'),
	 'content'     =>
		'<!-- wp:columns {"align":"wide","backgroundColor":"global-color-9"} -->
		<div class="wp-block-columns alignwide has-global-color-9-background-color has-background"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"level":3,"textColor":"base-3"} -->
		<h3 class="has-base-3-color has-text-color">Anmeldung</h3>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"textColor":"base-3"} -->
		<p class="has-base-3-color has-text-color">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"textColor":"base-3"} -->
		<div class="wp-block-column has-base-3-color has-text-color"><!-- wp:paragraph -->
		<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->',
   )
);

register_block_pattern(
	/* Pattern mit 2 Spalten mit Bildern */
   'two-columns-pattern-with-two-iamges',
	 array(
	 'title' => __( 'Two columns with two images', 'zwei-kacheln-block-pattern-zwei-bilder' ),
	 'description' => _x( 'Two columns with two images', 'Block pattern description', 'zwei-kacheln-block-pattern-zwei-bilder' ),
	 'categories'  => array('Vorlagen Haurand'),
	 'content'     =>
		'<!-- wp:columns {"align":"wide","backgroundColor":"global-color-9","className":"blauer_container_linke_spalte"} -->
		<div class="wp-block-columns alignwide blauer_container_linke_spalte has-global-color-9-background-color has-background"><!-- wp:column {"textColor":"base-3"} -->
		<div class="wp-block-column has-base-3-color has-text-color"><!-- wp:image {"id":38,"width":490,"height":490,"sizeSlug":"large","linkDestination":"none"} -->
		<figure class="wp-block-image size-large is-resized"><img src="https://maria-sibylla-merian-gesamtschule.de//wp-content/uploads/2022/03/Beispiel_1-1024x1024.jpg" alt="" class="wp-image-38" width="490" height="490"/><figcaption>Bildunterschrift</figcaption></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"textColor":"base-3"} -->
		<div class="wp-block-column has-base-3-color has-text-color"><!-- wp:image {"id":38,"width":490,"height":490,"sizeSlug":"large","linkDestination":"none"} -->
		<figure class="wp-block-image size-large is-resized"><img src="https://maria-sibylla-merian-gesamtschule.de/wp-content/uploads/2022/03/Beispiel_1-1024x1024.jpg" alt="" class="wp-image-38" width="490" height="490"/><figcaption>Bildunterschrift</figcaption></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->',
		)
);


register_block_pattern(
	/* Pattern mit 2 Spalten für Anmeldung, Schulleitung, etc */
   'two-columns-pattern-text-iamge',
	 array(
	 'title' => __( 'Two columns with text and inage', 'zwei-kacheln-block-pattern-text-bild' ),
	 'description' => _x( 'Two columns with text and inage', 'Block pattern description', 'zwei-kacheln-block-pattern-text-bild' ),
	 'categories'  => array('Vorlagen Haurand'),
	 'content'     =>
		'<!-- wp:columns {"className":"zwei_kacheln"} -->
		<div class="wp-block-columns zwei_kacheln"><!-- wp:column {"className":"zwei_kacheln"} -->
		<div class="wp-block-column zwei_kacheln"><!-- wp:image {"align":"center","id":24,"sizeSlug":"large","linkDestination":"custom","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-large"><img src="https://maria-sibylla-merian-gesamtschule.de/wp-content/uploads/2022/03/Poster_1-1024x576.jpg" alt="" class="wp-image-24"/></figure></div>
		<!-- /wp:image -->

		<!-- wp:heading {"textAlign":"left"} -->
		<h2 class="has-text-align-left" id="anmeldung-jahrgang-5">Anmeldung Jahrgang 5</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"left","className":"zwei_kacheln_abstand"} -->
		<p class="has-text-align-left zwei_kacheln_abstand">Informationen für Schülerinnen und Schüler der 4. Klasse!<br>Tag der offenen Tür, Schnuppertage und Infoveranstaltung</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"zwei_kacheln"} -->
		<div class="wp-block-column zwei_kacheln"><!-- wp:image {"align":"center","id":24,"sizeSlug":"large","linkDestination":"custom","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-large"><img src="https://maria-sibylla-merian-gesamtschule.de/wp-content/uploads/2022/03/Poster_1-1024x576.jpg" alt="" class="wp-image-24"/></figure></div>
		<!-- /wp:image -->

		<!-- wp:heading {"textAlign":"left"} -->
		<h2 class="has-text-align-left" id="anmeldung-oberstufe">Anmeldung Oberstufe</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"left","className":"zwei_kacheln_abstand"} -->
		<p class="has-text-align-left zwei_kacheln_abstand">Informationen für angehende AbiturientInnen<br>Tag der offenen Tür und Infoveranstaltung</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->',
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
/* Start: hervorgehobener Beitrag nur auf der Startseite
/* Datum: 30.03.2022
/* Autor: https://generatepress.com/forums/topic/only-show-post-as-featured-post-on-homepage/
/*----------------------------------------------------------------*/

add_filter( 'option_generate_blog_settings', 'lh_disable_featured_column' );
function lh_disable_featured_column( $options ) {
    if ( ! is_home() ) {
	    $options['featured_column'] = false;
    }
  
    return $options;
}


/*----------------------------------------------------------------*/
//Allow Contributors to Add Media
/* Datum: 24.05.2022
// Autor: https://wpbuffs.com/how-to-allow-contributors-to-upload-images-in-wordpress/
/*----------------------------------------------------------------*/
if ( current_user_can('contributor') && !current_user_can('upload_files') )
add_action('admin_init', 'allow_contributor_uploads');

function allow_contributor_uploads() {
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
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