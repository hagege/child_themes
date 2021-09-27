<?php 
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


/*excerpt 'continue reading' link
function twentytwentychild_excerpt_more_add_continue_reading( $more ) {
    return ' ... <div class="read-more-button-wrap"><a href="' . get_permalink( get_the_ID() ) . '" class="more-link"><span class="faux-button">Continue reading</span> <span class="screen-reader-text">�' . get_the_title( get_the_ID() ) . '�</span></a></div>';
}
add_filter('excerpt_more', 'twentytwentychild_excerpt_more_add_continue_reading' );

*/


/* Fügt nach dem Auszug (Excerpt) einen Read more-Link "  weiterlesen" ein  */
function new_excerpt_more($more) {
   global $post;
      return '<div class="read-more-button-wrap"><a class="moretag" href="'. get_permalink($post->ID) . '"> ... weiterlesen</a></div>'; 
 }
 add_filter('excerpt_more', 'new_excerpt_more');
 
/* Fügt nach dem manuellen Auszug (Excerpt) einen Read more-Link "  weiterlesen" ein  */
function manual_excerpt_more( $excerpt ) {
 $excerpt_more = '';
 if( has_excerpt() ) {
     $excerpt_more = '<div class="read-more-button-wrap"><a href="' . get_permalink() . '"> ... weiterlesen</a></div>';
 }
 return $excerpt . $excerpt_more;
}
add_filter( 'get_the_excerpt', 'manual_excerpt_more' ); 


/*----------------------------------------------------------------*/
/* Start: Block Patterns von haurand.com 
/* Datum: 14.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/

/* ------------------------------ */
/* eigene Kategorie               */
/* ------------------------------ */

 
  /* Um alle WordPress-Standard-Block Patterns auszublenden  */
  add_action('after_setup_theme', 'removeCorePatterns');
 
  function removeCorePatterns() {
    remove_theme_support('core-block-patterns');
  }
 
 
  
  /* bestimmte Kategorien ausblenden */
  function prefix_unregister_category() {
    unregister_block_pattern_category( 'buttons'); 
    unregister_block_pattern_category( 'header'); 
    unregister_block_pattern_category( 'text'); 
    unregister_block_pattern_category( 'columns');
    unregister_block_pattern_category( 'gallery');
    unregister_block_pattern_category( 'uncategorized');
    unregister_block_pattern_category( 'query');
    unregister_block_pattern_category( 'Twenty Twenty'); 
  }
  add_action( 'init', 'prefix_unregister_category' );

  
  /* eigene Vorlagen registrieren - im Beispiel "Vorlagen Haurand" */
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
         "<!-- wp:buttons {\"contentJustification\":\"center\"} -->
         <div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"backgroundColor\":\"secondary\",\"className\":\"ein_button\"} -->
         <div class=\"wp-block-button ein_button\"><a class=\"wp-block-button__link has-secondary-background-color has-background\">Test-Button</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons -->",
    )
  );


/* -------------------------------------------------------------------------------------------------------------------- */
/* zentrierter roter Button                                                                                             */
/* dieser Button wird im Dashboard rot angezeigt, weil hier bei den Eigenschaften scbhon die Farbe geändert worden ist  */
/* -------------------------------------------------------------------------------------------------------------------- */
register_block_pattern(
    'button_zentriert_rot',
      array(
      'title' => __( 'zentrierter roter Button mit Hover-Effekt', 'button_zentriert_rot' ),
      'description' => _x( 'zentrierter roter Button mit Hover-Effekt', 'zentrierter roter Button mit Hover-Effekt', 'button_zentriert_rot' ),
      'categories'  => array('Haurand'),
      'content'     =>
         "<!-- wp:buttons {\"contentJustification\":\"center\"} -->
         <div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"style\":{\"color\":{\"background\":\"#b70000\"}},\"className\":\"ein_button\"} -->
         <div class=\"wp-block-button ein_button\"><a class=\"wp-block-button__link has-background\" style=\"background-color:#b70000\">Test-Button</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons -->",
    )
  );




/* -------------------------------------------------------------------------------------------------------------------- */
/* Drei Spalten mit Bildern als Kacheln                                                                                            */
/* -------------------------------------------------------------------------------------------------------------------- */
register_block_pattern(
    'drei_spalten_kacheln',
      array(
      'title' => __( 'Drei Spalten mit Bildern als Kacheln', 'drei_spalten_kacheln' ),
      'description' => _x( 'Drei Spalten mit Bildern als Kacheln', 'Drei Spalten mit Bildern als Kacheln', 'drei_spalten_kacheln' ),
      'categories'  => array('Haurand'),
      'content'     =>
         "<!-- wp:columns {\"align\":\"full\",\"className\":\"has-3-columns\"} -->
          <div class=\"wp-block-columns alignfull has-3-columns\"><!-- wp:column {\"className\":\"drei_kacheln\"} -->
          <div class=\"wp-block-column drei_kacheln\"><!-- wp:image {\"id\":48891,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\",\"className\":\"kachelbild\"} -->
          <figure class=\"wp-block-image size-large kachelbild\"><img src=\"https://test3.haurand.com/wp-content/uploads/2021/09/dom_2-1024x768.jpg\" alt=\"\" class=\"wp-image-48891\"/><figcaption>Dom in Aachen</figcaption></figure>
          <!-- /wp:image --></div>
          <!-- /wp:column -->

          <!-- wp:column {\"className\":\"drei_kacheln\"} -->
          <div class=\"wp-block-column drei_kacheln\"><!-- wp:image {\"id\":48887,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\",\"className\":\"kachelbild\"} -->
          <figure class=\"wp-block-image size-large kachelbild\"><img src=\"https://test3.haurand.com/wp-content/uploads/2021/09/bild_1_vortrag-1024x768.jpg\" alt=\"\" class=\"wp-image-48887\"/><figcaption>Sonnenuntergang</figcaption></figure>
          <!-- /wp:image --></div>
          <!-- /wp:column -->

          <!-- wp:column {\"className\":\"drei_kacheln\"} -->
          <div class=\"wp-block-column drei_kacheln\"><!-- wp:image {\"id\":48889,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\",\"className\":\"kachelbild\"} -->
          <figure class=\"wp-block-image size-large kachelbild\"><img src=\"https://test3.haurand.com/wp-content/uploads/2021/09/bild_3_vortrag-1024x768.jpg\" alt=\"\" class=\"wp-image-48889\"/><figcaption>Landschaft</figcaption></figure>
          <!-- /wp:image --></div>
          <!-- /wp:column --></div>
          <!-- /wp:columns -->",
    )
  );
?>