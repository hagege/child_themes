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
/* Start: Block Patterns von haurand.com 
/* Datum: 14.01.2021
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





/* ---------------------------------- */
/* zentrierter Button                 */
/* ---------------------------------- */
register_block_pattern(
  'button_zentriert',
    array(
    'title' => __( 'zentrierter Button mit Hover-Effekt', 'button_zentriert' ),
    'description' => _x( 'zentrierter Button mit Hover-Effekt', 'zentrierter Button mit Hover-Effekt', 'button_zentriert' ),
    'categories'  => array('Haurand'),
    'content'     =>
       "<!-- wp:buttons {\"contentJustification\":\"center\",\"className\":\"eigener_block-button\"} -->
      <div class=\"wp-block-buttons is-content-justification-center eigener_block-button\"><!-- wp:button {\"className\":\"eigener_block-button\"} -->
      <div class=\"wp-block-button eigener_block-button\"><a class=\"wp-block-button__link\" href=\"https://wp.haurand.com/blog/\">Zum Blog</a></div>
      <!-- /wp:button --></div>
      <!-- /wp:buttons -->",
  )
);


/* ---------------------------------- */
/* Container für H2 (gelb)             */
/* ---------------------------------- */
register_block_pattern(
  'container_h2_gelb',
    array(
    'title' => __( 'Gelber Container H2', 'container_h2_gelb' ),
    'description' => _x( 'Gelber Container H2', 'Gelber Container H2', 'container_h2_gelb' ),
    'categories'  => array('Haurand'),
    'content'     =>
       "<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"background\":\"#F8DE17\"}},\"className\":\"h2_gelb\"} -->
       <h2 class=\"has-text-align-center h2_gelb has-background\" style=\"background-color:#F8DE17\">Gelber Container H2</h2>
       <!-- /wp:heading -->",
  )
);


/* ---------------------------------- */
/* Container für H2 (rot)             */
/* ---------------------------------- */
register_block_pattern(
  'container_h2_rot',
    array(
    'title' => __( 'Roter Container H2', 'container_h2_rot' ),
    'description' => _x( 'Roter Container H2', 'Roter Container H2', 'container_h2_rot' ),
    'categories'  => array('Haurand'),
    'content'     =>
    "<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"background\":\"#E62115\"}},\"className\":\"h2_rot\"} -->
    <h2 class=\"has-text-align-center h2_rot has-background\" style=\"background-color:#E62115\">Roter Container H2</h2>
    <!-- /wp:heading -->",
  )
);

/* ---------------------------------- */
/* Container für H2 (lila)             */
/* ---------------------------------- */
register_block_pattern(
  'container_h2_lila',
    array(
    'title' => __( 'Lila Container H2', 'container_h2_lila' ),
    'description' => _x( 'Lila Container H2', 'Lila Container H2', 'container_h2_lila' ),
    'categories'  => array('Haurand'),
    'content'     =>
    "<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"background\":\"#7982AD\"}},\"className\":\"h2_lila\"} -->
    <h2 class=\"has-text-align-center h2_lila has-background\" style=\"background-color:#7982AD\">Lila Container H2</h2>
    <!-- /wp:heading -->",
  )
);

/* ---------------------------------- */
/* Container für H2 (ocker)             */
/* ---------------------------------- */
register_block_pattern(
  'container_h2_ocker',
    array(
    'title' => __( 'ocker Container H2', 'container_h2_ocker' ),
    'description' => _x( 'Ocker Container H2', 'Ocker Container H2', 'container_h2_ocker' ),
    'categories'  => array('Haurand'),
    'content'     =>
    "<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"background\":\"#D5A12F\"}},\"className\":\"h2_ocker\"} -->
    <h2 class=\"has-text-align-center h2_ocker has-background\" style=\"background-color:#D5A12F\">Ocker Container H2</h2>
    <!-- /wp:heading -->",
  )
);


/* ---------------------------------- */
/* Container für H2 (blau)             */
/* ---------------------------------- */
register_block_pattern(
  'container_h2_blau',
    array(
    'title' => __( 'Blauer Container H2', 'container_h2_blau' ),
    'description' => _x( 'Blauer Container H2', 'Blauer Container H2', 'container_h2_blau' ),
    'categories'  => array('Haurand'),
    'content'     =>
    "<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"background\":\"#4587D3\"}},\"className\":\"h2_blau\"} -->
    <h2 class=\"has-text-align-center h2_blau has-background\" style=\"background-color:#4587D3\">Blauer Container H2</h2>
    <!-- /wp:heading -->",
  )
);


/* ---------------------------------- */
/* Container für H2 (grün)             */
/* ---------------------------------- */
register_block_pattern(
  'container_h2_gruen',
    array(
    'title' => __( 'Grüner Container H2', 'container_h2_gruen' ),
    'description' => _x( 'Grüner Container H2', 'Grüner Container H2', 'container_h2_gruen' ),
    'categories'  => array('Haurand'),
    'content'     =>
    "<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"background\":\"#67AB34\"}},\"className\":\"h2_gruen\"} -->
    <h2 class=\"has-text-align-center h2_gruen has-background\" style=\"background-color:#67AB34\">Grüner Container H2</h2>
    <!-- /wp:heading -->",
  )
);


/* ---------------------------------- */
/* Container für H2 (Orange)             */
/* ---------------------------------- */
register_block_pattern(
  'container_h2_orange',
    array(
    'title' => __( 'Oranger Container H2', 'container_h2_orange' ),
    'description' => _x( 'Oranger Container H2', 'Oranger Container H2', 'container_h2_orange' ),
    'categories'  => array('Haurand'),
    'content'     =>
    "<!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"background\":\"#F18A1A\"}},\"className\":\"h2_orange\"} -->
    <h2 class=\"has-text-align-center h2_orange has-background\" style=\"background-color:#F18A1A\">Oranger Container H2</h2>
    <!-- /wp:heading -->",
  )
);


/* ------------------------------ */
/* Container weiß mit Listen      */
/* ------------------------------ */
register_block_pattern(
  'listbox_weiss',
    array(
    'title' => __( 'Listbox weiß', 'listbox_weiss' ),
    'description' => _x( 'Listbox weiß ', 'Eine Listbox mit weißer Hintergrundfarbe und roten Bullets', 'listbox_weiss' ),
    'categories'  => array('Haurand'),
    'content'     =>
       "<!-- wp:list {\"className\":\"eks_liste\"} -->
       <ul class=\"eks_liste\"><li>eins</li><li>zwei</li><li>drei</li><li>vier</li><li>fünf</li></ul>
       <!-- /wp:list -->",
  )
);


/*----------------------------------------------------------------*/
/* Ende: Block Patterns von haurand.com 
/* Datum: 14.01.2021
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