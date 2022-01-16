<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );


/* ------------------------------ */
/* eigene Kategorie               */
/* ------------------------------ */
if ( function_exists( 'register_block_pattern_category' ) ) {
  register_block_pattern_category(
    'haurand',
    array( 'label' => __( 'Forms', 'text-domain' ) )
 );
}


function haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
  register_block_pattern_category(
   'haurand',
   array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category', 'haurand' ) )
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
     'categories'  => array('haurand'),
     'content'     =>
        '<!-- wp:columns -->
			<div class="wp-block-columns"><!-- wp:column {"className":"kacheln_abgerundet"} -->
			<div class="wp-block-column kacheln_abgerundet"><!-- wp:image {"align":"center","id":898,"sizeSlug":"full","linkDestination":"none","className":"kachelbild_abgerundet"} -->
			<div class="wp-block-image kachelbild_abgerundet"><figure class="aligncenter size-full"><img src="https://www.eilendorf.net/wp-content/uploads/2020/09/Pannhaus-1.jpg" alt="Eifelausläufer" class="wp-image-898"/></figure></div>
			<!-- /wp:image -->

			<!-- wp:heading {"textAlign":"center"} -->
			<h2 class="has-text-align-center">Über Uns</h2>
			<!-- /wp:heading -->

			<!-- wp:list -->
			<ul><li><a href="https://test.hochzeitwebseiten.de/stadtteilkonferenz/">Stadtteilkonferenz</a></li><li><a href="https://eilendorf.net/eilendorf-netz/">Eilendorf.net</a></li><li><a href="https://eilendorf.net/projekte/">Projekte</a></li></ul>
			<!-- /wp:list --></div>
			<!-- /wp:column -->

			<!-- wp:column {"className":"kacheln_abgerundet"} -->
			<div class="wp-block-column kacheln_abgerundet"><!-- wp:image {"align":"center","id":409,"sizeSlug":"full","linkDestination":"none","className":"kachelbild_abgerundet"} -->
			<div class="wp-block-image kachelbild_abgerundet"><figure class="aligncenter size-full"><img src="https://www.eilendorf.net/wp-content/uploads/2020/09/Pannhaus-1.jpg" alt="eilendorf.net" class="wp-image-409"/></figure></div>
			<!-- /wp:image -->

			<!-- wp:heading {"textAlign":"center"} -->
			<h2 class="has-text-align-center">Service</h2>
			<!-- /wp:heading -->

			<!-- wp:list -->
			<ul><li><a href="https://eilendorf.net/events/">Termine</a></li><li><a href="https://eilendorf.net/eilendorf-karte/?nocache">Eilendorfkarte</a></li><li><a href="https://www.eilendorf.net/karteneintrag/">Karteneinträge</a></li><li><a href="https://eilendorf.net/veranstaltungseingabe/">Terminerfassung</a></li><li><a href="https://eilendorf.net/baudenkmaeler/">Baudenkmäler </a></li><li><a href="https://eilendorf.net/kontakt/">Kontakt</a></li></ul>
			<!-- /wp:list --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->',
 )
);

