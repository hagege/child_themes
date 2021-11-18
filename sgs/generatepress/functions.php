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


/*----------------------------------------------------------------*/
/* Start: Block Patterns von sgs
/* Datum: 18.11.2021
/* Autor: hgg
/*----------------------------------------------------------------*/

/* ------------------------------ */
/* eigene Kategorie               */
/* ------------------------------ */
if ( function_exists( 'register_block_pattern_category' ) ) {
  register_block_pattern_category(
    'sgs',
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
}
add_action( 'init', 'prefix_unregister_category' );


function haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
  register_block_pattern_category(
   'sgs',
   array( 'label' => _x( 'Vorlagen sgs', 'Block pattern category', 'sgs' ) )
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
     'categories'  => array('sgs'),
     'content'     =>
        '<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column {"className":"zwei_kacheln"} -->
		<div class="wp-block-column zwei_kacheln"><!-- wp:image {"align":"center","id":4298,"sizeSlug":"full","linkDestination":"custom","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><a href="https://test.gesamtschule-stolberg.de/infos-fuer-die-neuen-5er/"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2021/11/sperberweg_kachel_800.jpg" alt="" class="wp-image-4298"/></a></figure></div>
		<!-- /wp:image -->

		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center">Anmeldung 5. Klasse</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","className":"bg_gelb"} -->
		<p class="has-text-align-center bg_gelb"> Tag der offenen Tür, Schnuppertage und Infoveranstaltung<br> Informationen für Schülerinnen und Schüler der 4. Klasse!  </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"zwei_kacheln"} -->
		<div class="wp-block-column zwei_kacheln"><!-- wp:image {"align":"center","id":4294,"sizeSlug":"full","linkDestination":"custom","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><a href="https://test.gesamtschule-stolberg.de/oberstufe-sgs/"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2021/11/wds_kachel_800.jpg" alt="" class="wp-image-4294"/></a></figure></div>
		<!-- /wp:image -->

		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center">Anmeldung Oberstufe</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","className":"bg_gelb"} -->
		<p class="has-text-align-center bg_gelb">Tag der offenen Tür und Infoveranstaltung <br>Informationen für angehende Abiturienten. </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->',
   )
 );

 register_block_pattern(
	/* https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/ */
	/* maskieren ist nicht mehr nötig, wenn man einfache Hochkommatas nimmt */
   'three-tile-card-pattern',
     array(
     'title' => __( 'Three columns with pictures', 'drei-kacheln-block-pattern' ),
     'description' => _x( 'Three columns with pictures (tiles)', 'Block pattern description', 'drei-kacheln-block-pattern' ),
     'categories'  => array('sgs'),
     'content'     =>
        '<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column {"className":"drei_kacheln"} -->
		<div class="wp-block-column drei_kacheln"><!-- wp:image {"align":"center","id":2176,"sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":["#c7005a","#fff278"]}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2019/03/skifahrt_014.jpg" alt="" class="wp-image-2176"/><figcaption>Klassenfahrten</figcaption></figure></div>
		<!-- /wp:image -->

		<!-- wp:paragraph -->
		<p>Fahrt nach Oberzauch: 26.1.2022 – 5.2.2022</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"drei_kacheln"} -->
		<div class="wp-block-column drei_kacheln"><!-- wp:image {"align":"center","id":4126,"sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":["#000000","#00a5ff"]}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2021/09/schuelerlabor_003-1.jpg" alt="" class="wp-image-4126"/><figcaption> Praktikum </figcaption></figure></div>
		<!-- /wp:image -->

		<!-- wp:paragraph -->
		<p><strong>Praktikum 9</strong>: 20. September – 8. Oktober 2021<br><strong>Praktikum 10er/Oberstufenpraktikum</strong>: Mo, 17.01.2022 bis Fr, 28.01.2022</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"drei_kacheln"} -->
		<div class="wp-block-column drei_kacheln"><!-- wp:image {"align":"center","id":3781,"sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":["#1900d8","#ffa96b"]}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2020/11/rundgang_025.jpg" alt="Städtische Gesamtschule Stolberg" class="wp-image-3781"/><figcaption>Elternsprechtag</figcaption></figure></div>
		<!-- /wp:image -->

		<!-- wp:paragraph -->
		<p>Elternsprechzeiten: es erfolgt eine Terminvergabe durch die Klassenlehrer<br><strong>Elternsprechtag</strong>: 10. November 2021</p>
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
/* Start: Beiträge der Kategorie "Keine Anzeige" nicht zeigen
/* Datum: 25.05.2021
/* Autor: hgg
/*----------------------------------------------------------------*/
function exclude_single_posts_home($query) {
  if ( $query->is_home() && $query->is_main_query() ) {
      /* $query->set( 'post__not_in', array(6873) ); */ /* zeigt einen bestimmten Beitrag nicht */
      $query->set('cat', '-1486'); /* zeigt eine bestimmte Kategorie (in dem Fall "Keine Anzeige" nicht */
  }
}
add_action( 'pre_get_posts', 'exclude_single_posts_home' );
/*----------------------------------------------------------------*/
/* Ende: Beiträge der Kategorie "Keine Anzeige" nicht zeigen
/* Datum: 25.05.2021
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

?>