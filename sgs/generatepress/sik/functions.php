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
/* Start: Keine Überschrift im Excerpt
/* Datum: 01.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/
/* Klappt zwar so weit, aber bei einem customer excerpt wird zwei Mal der Button gezeigt */
function wp_strip_header_tags( $excerpt='' ) {

	$raw_excerpt = $excerpt;
	if ( '' == $excerpt ) {
			$excerpt = get_the_content('');
			$excerpt = strip_shortcodes( $excerpt );
			$excerpt = apply_filters('the_content', $excerpt);
			$excerpt = str_replace(']]>', ']]>', $excerpt);
	}
	$regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
	$excerpt = preg_replace($regex,'', $excerpt);
	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );

return apply_filters('wp_trim_excerpt', preg_replace($regex,'', $excerpt), $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'wp_strip_header_tags', 9);


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
   'one-tile-card-pattern',
     array(
     'title' => __( 'One column with pictures', 'eine-kachel-block-pattern' ),
     'description' => _x( 'One column with pictures (tiles)', 'Block pattern description', 'eine-kachel-block-pattern' ),
     'categories'  => array('sgs'),
     'content'     =>
        '<!-- wp:columns {"className":"vier_kacheln"} -->
		<div class="wp-block-columns vier_kacheln"><!-- wp:column {"className":"vier_kacheln"} -->
		<div class="wp-block-column vier_kacheln"><!-- wp:image {"align":"center","id":2603,"sizeSlug":"full","linkDestination":"none"} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2019/09/kollegium_0010.jpg" alt="Agron, Alimi" class="wp-image-2603"/></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center","level":3} -->
		<h3 class="has-text-align-center"> Agron Alimi</h3>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center">ALM</p>
		<!-- /wp:paragraph -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> Biologie, Geschichte </p>
		<!-- /wp:paragraph -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> a.alimi@gesamtschule-stolberg.de </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->',
 )
);


 register_block_pattern(
	/* https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/ */
	/* maskieren ist nicht mehr nötig, wenn man einfache Hochkommatas nimmt */
   'two-tile-card-pattern',
     array(
     'title' => __( 'Two columns with pictures', 'zwei-kacheln-block-pattern' ),
     'description' => _x( 'Two columns with pictures (tiles)', 'Block pattern description', 'zwei-kacheln-block-pattern' ),
     'categories'  => array('sgs'),
     'content'     =>
        '<!-- wp:columns {"className":"zwei_kacheln"} -->
		<div class="wp-block-columns zwei_kacheln"><!-- wp:column {"className":"zwei_kacheln"} -->
		<div class="wp-block-column zwei_kacheln"><!-- wp:image {"align":"center","id":4298,"sizeSlug":"full","linkDestination":"custom","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><a href="https://test.gesamtschule-stolberg.de/sekundarstufe-i/"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2021/11/sperberweg_kachel_800.jpg" alt="" class="wp-image-4298"/></a></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center"> Sekundarstufe I (Stufen 5-10) </h2>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center","className":"bg_gelb"} -->
		<p class="has-text-align-center bg_gelb">  Stufen 5 - 7 im Sperberweg,  Stufen 8 - 10 in der Walther-Dobbelmann-Straße </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"className":"zwei_kacheln"} -->
		<div class="wp-block-column zwei_kacheln"><!-- wp:image {"align":"center","id":4294,"sizeSlug":"full","linkDestination":"custom","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><a href="https://test.gesamtschule-stolberg.de/abteilung-iii/"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2021/11/wds_kachel_800.jpg" alt="" class="wp-image-4294"/></a></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center">Sekundarstufe II (EF, Q1, Q2)</h2>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center","className":"bg_gelb"} -->
		<p class="has-text-align-center bg_gelb"> Oberstufe in der Walther-Dobbelmann-Straße </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->',
   )
 );

 register_block_pattern(
   'three-tile-card-pattern',
     array(
     'title' => __( 'Three columns with pictures', 'drei-kacheln-block-pattern' ),
     'description' => _x( 'Three columns with pictures (tiles)', 'Block pattern description', 'drei-kacheln-block-pattern' ),
     'categories'  => array('sgs'),
     'content'     =>
        '<!-- wp:columns {"className":"drei_kacheln"} -->
		<div class="wp-block-columns drei_kacheln"><!-- wp:column {"className":"drei_kacheln"} -->
		<div class="wp-block-column drei_kacheln"><!-- wp:image {"align":"center","id":2411,"sizeSlug":"full","linkDestination":"custom","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><a href="https://test.gesamtschule-stolberg.de/sgs-testet-neues-programm-des-schuelerlabors/"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2019/07/julab_002.jpg" alt="" class="wp-image-2411"/></a></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center" id="htoc-mint-julab">MINT / Julab</h2>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph -->
		<p>In die Welt des Programmierens von Mikrochips tauchten Schüler der Jahrgänge 7 bis 9 im Schülerlabor JuLab des Forschungszentrums Jülich ein.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"className":"drei_kacheln"} -->
		<div class="wp-block-column drei_kacheln"><!-- wp:image {"align":"center","id":1059,"sizeSlug":"full","linkDestination":"none","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2017/10/platzhalter_apfel_apple-1644393_640.jpg" alt="" class="wp-image-1059"/></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center" id="htoc-gesunde-schule">Gesunde Schule / Mensa</h2>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph -->
		<p>Unsere Schule nutzt die <a href="https://test.gesamtschule-stolberg.de/mensa-schulessen/" data-type="URL" data-id="https://test.gesamtschule-stolberg.de/mensa-schulessen/">gemeinsame Mensa</a> auf dem Gelände des Goethe-Gymnasiums.&nbsp;</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"className":"drei_kacheln"} -->
		<div class="wp-block-column drei_kacheln"><!-- wp:image {"align":"center","id":990,"sizeSlug":"full","linkDestination":"custom","style":{"color":{}}} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><a href="https://gesamtschule-stolberg.de/schule-ohne-rassismus/"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2018/09/schule_ohne_rassismus.jpg" alt="Schule ohne Rassismus" class="wp-image-990"/></a><figcaption> </figcaption></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center" id="htoc-schule-ohne-rassismus">Schule ohne Rassismus</h2>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph -->
		<p>An der Gesamtschule Stolberg wird Toleranz gegenüber allen Mitmenschen “groß geschrieben”. Dies ist ein fester Bestandteil des schulischen Lebens. In diesem Zusammenhang nimmt die Schule an dem Projekt “Schule ohne Rassismus – Schule mit Courage” teil.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->',
   )
 );

 register_block_pattern(
   'four-tile-card-pattern',
     array(
     'title' => __( 'four columns with pictures', 'vier-kacheln-block-pattern' ),
     'description' => _x( 'Four columns with pictures (tiles)', 'Block pattern description', 'vier-kacheln-block-pattern' ),
     'categories'  => array('sgs'),
     'content'     =>
        '<!-- wp:columns {"className":"vier_kacheln"} -->
		<div class="wp-block-columns vier_kacheln"><!-- wp:column {"className":"vier_kacheln"} -->
		<div class="wp-block-column vier_kacheln"><!-- wp:image {"align":"center","id":2603,"sizeSlug":"full","linkDestination":"none"} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2019/09/kollegium_0010.jpg" alt="Agron, Alimi" class="wp-image-2603"/></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center","level":3} -->
		<h3 class="has-text-align-center"> Agron Alimi</h3>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> a.alimi@gesamtschule-stolberg.de </p>
		<!-- /wp:paragraph -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> Biologie, Geschichte </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"className":"vier_kacheln"} -->
		<div class="wp-block-column vier_kacheln"><!-- wp:image {"align":"center","id":1846,"sizeSlug":"full","linkDestination":"none"} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2018/11/Josef_Artz.jpg" alt="" class="wp-image-1846"/></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center","level":3} -->
		<h3 class="has-text-align-center">Josef Artz</h3>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> j.artz@gesamtschule-stolberg.de</p>
		<!-- /wp:paragraph -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> Sport, Spanisch, Biologie, Informatik  </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"className":"vier_kacheln"} -->
		<div class="wp-block-column vier_kacheln"><!-- wp:image {"align":"center","id":1819,"sizeSlug":"full","linkDestination":"none"} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2018/11/Johann_Bauerdick.jpg" alt="" class="wp-image-1819"/></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center","level":3} -->
		<h3 class="has-text-align-center">Johann Bauerdick</h3>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> j.bauerdick@gesamtschule-stolberg.de </p>
		<!-- /wp:paragraph -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> Geschichte, Sozialwissenschaften, Musik, Erdkunde </p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"className":"vier_kacheln"} -->
		<div class="wp-block-column vier_kacheln"><!-- wp:image {"align":"center","id":1844,"sizeSlug":"full","linkDestination":"none"} -->
		<div class="wp-block-image"><figure class="aligncenter size-full"><img src="https://test.gesamtschule-stolberg.de/wp-content/uploads/2018/11/Ursula_Baumann-Groten.jpg" alt="" class="wp-image-1844"/></figure></div>
		<!-- /wp:image -->
		
		<!-- wp:heading {"textAlign":"center","level":3} -->
		<h3 class="has-text-align-center">Ursula Baumann-Groten</h3>
		<!-- /wp:heading -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> u.baumann-groten@gesamtschule-stolberg.de </p>
		<!-- /wp:paragraph -->
		
		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center"> Deutsch, Naturwissenschaften </p>
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
     'categories'  => array('sgs'),
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

?>