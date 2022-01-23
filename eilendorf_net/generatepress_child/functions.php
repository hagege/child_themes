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
     'title' => __( 'Two column with pictures', 'zwei-kachel-block-pattern' ),
     'description' => _x( 'Two column with pictures (tiles)', 'Block pattern description', 'zwei-kachel-block-pattern' ),
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
			<ul><li><a href="https://www.eilendorf.net/stadtteilkonferenz/">Stadtteilkonferenz</a></li><li><a href="https://www.eilendorf.net/eilendorf-netz/">Eilendorf.net</a></li><li><a href="https://www.eilendorf.net/projekte/">Projekte</a></li></ul>
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
			<ul><li><a href="https://www.eilendorf.net/events/">Termine</a></li><li><a href="https://www.eilendorf.net/eilendorf-karte/?nocache">Eilendorfkarte</a></li><li><a href="https://www.eilendorf.net/karteneintrag/">Karteneinträge</a></li><li><a href="https://www.eilendorf.net/veranstaltungseingabe/">Terminerfassung</a></li><li><a href="https://www.eilendorf.net/baudenkmaeler/">Baudenkmäler </a></li><li><a href="https://www.eilendorf.net/kontakt/">Kontakt</a></li></ul>
			<!-- /wp:list --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->',
 )
);


register_block_pattern(
	/* https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/ */
	/* maskieren ist nicht mehr nötig, wenn man einfache Hochkommatas nimmt */
   'two-tile-newest-post-pattern',
     array(
     'title' => __( 'Two column with pictures newest posts', 'zwei-kachel-neueste-beitraege-pattern' ),
     'description' => _x( 'Two column with pictures newest posts (tiles)', 'Block pattern description', 'zwei-kachel-neueste-beitraege-pattern' ),
     'categories'  => array('haurand'),
     'content'     =>
        '<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column {"className":"kacheln_abgerundet"} -->
		<div class="wp-block-column kacheln_abgerundet"><!-- wp:image {"align":"center","id":898,"sizeSlug":"full","linkDestination":"none","className":"kachelbild_abgerundet"} -->
		<div class="wp-block-image kachelbild_abgerundet"><figure class="aligncenter size-full"><img src="https://www.eilendorf.net/wp-content/uploads/2020/09/Pannhaus-1.jpg" alt="Pannhaus" class="wp-image-898"/></figure></div>
		<!-- /wp:image -->

		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center">Neues aus der Stadtteilkonferenz</h2>
		<!-- /wp:heading -->

		<!-- wp:latest-posts {"categories":[{"id":16,"count":1,"description":"","link":"https://www.eilendorf.net/category/stadtteilkonferenz/","name":"Stadtteilkonferenz","slug":"stadtteilkonferenz","taxonomy":"category","parent":0,"meta":[],"_links":{"self":[{"href":"https://www.eilendorf.net/wp-json/wp/v2/categories/16"}],"collection":[{"href":"https://www.eilendorf.net/wp-json/wp/v2/categories"}],"about":[{"href":"https://www.eilendorf.net/wp-json/wp/v2/taxonomies/category"}],"wp:post_type":[{"href":"https://www.eilendorf.net/wp-json/wp/v2/posts?categories=16"}],"curies":[{"name":"wp","href":"https://api.w.org/{rel}","templated":true}]}}],"postsToShow":1,"displayPostContent":true,"align":"center","className":"beitrag_in_kachel"} /--></div>
		<!-- /wp:column -->

		<!-- wp:column {"className":"kacheln_abgerundet"} -->
		<div class="wp-block-column kacheln_abgerundet"><!-- wp:image {"align":"center","id":409,"sizeSlug":"full","linkDestination":"none","className":"kachelbild_abgerundet"} -->
		<div class="wp-block-image kachelbild_abgerundet"><figure class="aligncenter size-full"><img src="https://www.eilendorf.net/wp-content/uploads/2020/09/Pannhaus-1.jpg" alt="eilendorf.net" class="wp-image-409"/></figure></div>
		<!-- /wp:image -->

		<!-- wp:heading {"textAlign":"center"} -->
		<h2 class="has-text-align-center">Neues aus der Verwaltung</h2>
		<!-- /wp:heading -->

		<!-- wp:latest-posts {"categories":[{"id":17,"count":1,"description":"","link":"https://www.eilendorf.net/category/verwaltung/","name":"Verwaltung","slug":"verwaltung","taxonomy":"category","parent":0,"meta":[],"_links":{"self":[{"href":"https://www.eilendorf.net/wp-json/wp/v2/categories/17"}],"collection":[{"href":"https://www.eilendorf.net/wp-json/wp/v2/categories"}],"about":[{"href":"https://www.eilendorf.net/wp-json/wp/v2/taxonomies/category"}],"wp:post_type":[{"href":"https://www.eilendorf.net/wp-json/wp/v2/posts?categories=17"}],"curies":[{"name":"wp","href":"https://api.w.org/{rel}","templated":true}]}}],"postsToShow":1,"displayPostContent":true,"align":"center","className":"beitrag_in_kachel"} /--></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns -->',
 )
);

register_block_pattern(
	/* https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/ */
	/* maskieren ist nicht mehr nötig, wenn man einfache Hochkommatas nimmt */
   'button-pattern',
     array(
     'title' => __( 'Button', 'button-pattern' ),
     'description' => _x( 'Button', 'Button', 'button-pattern' ),
     'categories'  => array('haurand'),
     'content'     =>
        '<!-- wp:buttons {"contentJustification":"center","className":"eilendorf_button"} -->
		<div class="wp-block-buttons is-content-justification-center eilendorf_button"><!-- wp:button {"backgroundColor":"base-2","className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-base-2-background-color has-background">Ein Button</a></div>
		<!-- /wp:button --></div>
		<!-- /wp:buttons -->',
 )
);


