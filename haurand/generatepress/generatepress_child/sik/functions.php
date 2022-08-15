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

/* wird nicht mehr genutzt 
function kb_svg ( $svg_mime ){
	$svg_mime['svg'] = 'image/svg+xml';
	return $svg_mime;
}

add_filter( 'upload_mimes', 'kb_svg' );
*/

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
/* Überschrift und zentrierter Absatz */
/* ---------------------------------- */
register_block_pattern(
  'absatz_zentriert',
    array(
    'title' => __( 'Absatz zentriert mit Überschrift', 'absatz_zentriert' ),
    'description' => _x( 'Zentrierter Absatz mit Überschrift', 'Ein Absatz mit zentriertem Text', 'absatz_zentriert' ),
    'categories'  => array('Haurand'),
    'content'     =>
       "<!-- wp:group {\"className\":\"ueber_uns_rand\"} -->
       <div class=\"wp-block-group ueber_uns_rand\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"textAlign\":\"center\"} -->
       <h2 class=\"has-text-align-center\">Wie wir ticken und wie wir die Welt sehen</h2>
       <!-- /wp:heading -->
       
       <!-- wp:paragraph {\"align\":\"center\"} -->
       <p class=\"has-text-align-center\">Wenn Sie wissen möchten mit wem Sie es hier zu tun kriegen, dann verpassen Sie nicht folgende Informationen rund um unsere Person.</p>
       <!-- /wp:paragraph --></div></div>
       <!-- /wp:group -->
       ",
    )
);


/* ---------------------------------- */
/* Weitere Beiträge als Abfrage-Loop  */
/* ---------------------------------- */
register_block_pattern(
  'abfrage_loop_tags',
    array(
    'title' => __( 'Abfrage-Loop mit Schlagwörtern', 'abfrage_loop_tags' ),
    'description' => _x( 'Abfrage-Loop mit Schlagwörtern', 'Ein Absatz mit zentriertem Text', 'abfrage_loop_tags' ),
    'categories'  => array('Haurand'),
    'content'     =>
       "<!-- wp:heading {\"level\":3} -->
       <h3 id=\"htoc-weitere-beitr-ge-zum-thema\">Weitere Beiträge zum Thema</h3>
       <!-- /wp:heading -->
       
       <!-- wp:query {\"queryId\":0,\"query\":{\"perPage\":\"5\",\"pages\":0,\"offset\":0,\"postType\":\"post\",\"order\":\"desc\",\"orderBy\":\"date\",\"author\":\"\",\"search\":\"\",\"exclude\":[],\"sticky\":\"\",\"inherit\":false,\"taxQuery\":{\"post_tag\":[1494]}}} -->
       <div class=\"wp-block-query\"><!-- wp:post-template -->
       <!-- wp:post-title {\"level\":5,\"isLink\":true} /-->
       <!-- /wp:post-template --></div>
       <!-- /wp:query -->
       ",
    )
);


/* ----------------------------------------------------------- */
/* Überschrift (h2), Überschrift (h3) und linksbündiger Absatz */
/* ----------------------------------------------------------- */
register_block_pattern(
  'ueberschrift_blog',
    array(
    'title' => __( 'Überschrift (h2), Überschrift (h3) und linksbündiger Absatz', 'ueberschrift_blog' ),
    'description' => _x( 'Überschrift (h2), Überschrift (h3) und linksbündiger Absatz', 'Überschrift (h2), Überschrift (h3) und linksbündiger Absatz', 'ueberschrift_blog' ),
    'categories'  => array('Haurand'),
    'content'     =>
        "<!-- wp:spacer {\"height\":20} -->
        <div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
        <!-- /wp:spacer -->
        <!-- wp:heading -->
        <h2>Button mit dem Block-Editor erstellen und gestalten.</h2>
        <!-- /wp:heading -->

        <!-- wp:heading {\"textAlign\":\"left\",\"level\":3} -->
        <h3 class=\"has-text-align-left\">Grundsätzlich ist es kein großes Problem, wenn man einen Button mit dem Block-Editor erstellen will. Man klickt auf den entsprechenden Button-Block und schon ist der Button da. Aber die Gestaltungsmöglichkeiten bei den Eigenschaften sind doch arg begrenzt.</h3>
        <!-- /wp:heading -->

        <!-- wp:paragraph -->
        <p>In unserem Fall wollten wir einen Button erstellen, der genau in der Mitte des Bildschirms zu sehen ist und als Hover-Effekt (beim Überfahren mit der Maus) die Farbe von grau auf rot wechselt.</p>
        <!-- /wp:paragraph -->",
        )
);


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
      <div class=\"wp-block-button eigener_block-button\"><a class=\"wp-block-button__link\" href=\"https://haurand.com/blog/\">Zum Blog</a></div>
      <!-- /wp:button --></div>
      <!-- /wp:buttons -->",
  )
);


/* -------------------------------------- */
/* Container mit einem zentrierten Button */
/* -------------------------------------- */
register_block_pattern(
  'container_button_zentriert',
    array(
    'title' => __( 'Container mit einem zentrierten Button', 'container_button_zentriert' ),
    'description' => _x( 'Container mit einem zentrierten Button', 'Ein Container mit Bild / Listbox / Eckengrafik per CSS-Klasse', 'container_button_zentriert' ),
    'categories'  => array('Haurand'),
    'content'     =>
      "<!-- wp:columns -->
        <div class=\"wp-block-columns\"><!-- wp:column {\"className\":\"container-zentriert\"} -->
        <div class=\"wp-block-column container-zentriert\"><!-- wp:html -->
        <a class=\"eigener_block-button\" href=\"https://haurand.com/blog/\">Zum Blog</a>
        <!-- /wp:html --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->",
        )
  );



/* ---------------------------------- */
/* Container mittelgrau mit 2 Bildern */
/* ---------------------------------- */
register_block_pattern(
  'container_mittelgrau_bilder',
    array(
    'title' => __( 'Mittelgrauer Container mit 2 Bildern', 'container_mittelgrau_bilder' ),
    'description' => _x( 'Mittelgrauer Container für 2 Bilder', 'Ein Container für 2 Bilder mit mittelgrauem Hintergrund', 'container_mittelgrau_bilder' ),
    'categories'  => array('Haurand'),
    'content'     =>
      "<!-- wp:columns {\"align\":\"full\"} -->
      <div class=\"wp-block-columns alignfull\"><!-- wp:column {\"width\":\"\",\"className\":\"container_aussen\"} -->
      <div class=\"wp-block-column container_aussen\"><!-- wp:columns {\"align\":\"full\",\"style\":{\"color\":{\"background\":\"#d4dadb\"}},\"className\":\"container_mit_bildern\"} -->
      <div class=\"wp-block-columns alignfull container_mit_bildern has-background\" style=\"background-color:#d4dadb\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"50%\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:50%\"><!-- wp:image {\"align\":\"center\",\"id\":5153,\"sizeSlug\":\"large\",\"linkDestination\":\"media\",\"className\":\"bild_zentriert\"} -->
      <div class=\"wp-block-image bild_zentriert\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/wp-content/uploads/2021/04/button_erfassen_6.jpg\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/button_erfassen_6.jpg\" alt=\"Button mit dem Block-Editor\" class=\"wp-image-5153\"/></a></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"50%\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:50%\"><!-- wp:image {\"align\":\"center\",\"id\":5155,\"sizeSlug\":\"large\",\"linkDestination\":\"media\",\"className\":\"bild_zentriert\"} -->
      <div class=\"wp-block-image bild_zentriert\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/wp-content/uploads/2021/04/button_erfassen_7.jpg\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/button_erfassen_7.jpg\" alt=\"Button mit dem Block-Editor\" class=\"wp-image-5155\"/></a></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
  )
);


/* ---------------------------------- */
/* Container mittelgrau mit 1 Bild    */
/* ---------------------------------- */
register_block_pattern(
  'container_mittelgrau_bild',
    array(
    'title' => __( 'Mittelgrauer Container mit 1 Bild', 'container_mittelgrau_bild' ),
    'description' => _x( 'Mittelgrauer Container für 1 Bild', 'Ein Container für 1 Bild mit mittelgrauem Hintergrund', 'container_mittelgrau_bild' ),
    'categories'  => array('Haurand'),
    'content'     =>
      "<!-- wp:columns {\"align\":\"full\"} -->
      <div class=\"wp-block-columns alignfull\"><!-- wp:column {\"width\":\"\",\"className\":\"container_aussen\"} -->
      <div class=\"wp-block-column container_aussen\"><!-- wp:columns {\"align\":\"full\",\"style\":{\"color\":{\"background\":\"#d4dadb\"}},\"className\":\"container_mit_bildern\"} -->
      <div class=\"wp-block-columns alignfull container_mit_bildern has-background\" style=\"background-color:#d4dadb\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"100%\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:100%\"><!-- wp:image {\"align\":\"center\",\"id\":5149,\"sizeSlug\":\"large\",\"linkDestination\":\"media\",\"className\":\"bild_zentriert\"} -->
      <div class=\"wp-block-image bild_zentriert\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/wp-content/uploads/2021/04/button_erfassen_4.jpg\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/button_erfassen_4.jpg\" alt=\"Button mit dem Block-Editor\" class=\"wp-image-5149\"/></a><figcaption>Grafik: haurand.com</figcaption></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
    )
);

/* ---------------------------------- */
/* Container Achtung                  */
/* ---------------------------------- */
register_block_pattern(
  'container_mittelgrau_achtung',
    array(
    'title' => __( 'Mittelgrauer Container mit Achtung-SVG', 'container_mittelgrau_achtung' ),
    'description' => _x( 'Mittelgrauer Container mit Achtung-SVG', 'Ein Container für Achtung-SVG mit mittelgrauem Hintergrund', 'container_mittelgrau_achtung' ),
    'categories'  => array('Haurand'),
    'content'     =>
      '<!-- wp:group {"style":{"color":{"background":"#d4dadb"}},"className":"svg_container"} -->
      <div class="wp-block-group svg_container has-background" style="background-color:#d4dadb"><!-- wp:spacer {"height":"30px"} -->
      <div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
      <!-- /wp:spacer -->
      
      <!-- wp:columns -->
      <div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"spalte_svg"} -->
      <div class="wp-block-column is-vertically-aligned-center spalte_svg" style="flex-basis:20%"><!-- wp:group {"className":"html_svg","layout":{"inherit":false,"contentSize":"100px"}} -->
      <div class="wp-block-group html_svg"><!-- wp:html -->
      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 246.027 246.027" style="enable-background:new 0 0 246.027 246.027;" xml:space="preserve">
      <path d="M242.751,196.508L143.937,25.358c-4.367-7.564-12.189-12.081-20.924-12.081c-8.735,0-16.557,4.516-20.924,12.081
        L3.276,196.508c-4.368,7.564-4.368,16.596,0,24.161s12.189,12.081,20.924,12.081h197.629c8.734,0,16.556-4.516,20.923-12.08
        C247.119,213.105,247.118,204.073,242.751,196.508z M123.014,204.906c-8.672,0-15.727-7.055-15.727-15.727
        c0-8.671,7.055-15.726,15.727-15.726s15.727,7.055,15.727,15.726C138.74,197.852,131.685,204.906,123.014,204.906z M138.847,137.68
        c0,8.73-7.103,15.833-15.833,15.833s-15.833-7.103-15.833-15.833V65.013c0-4.142,3.358-7.5,7.5-7.5h16.667
        c4.143,0,7.5,3.358,7.5,7.5V137.68z"></path>
      </svg>
      <!-- /wp:html --></div>
      <!-- /wp:group -->
      
      <!-- wp:paragraph {"align":"center","className":"achtung_update"} -->
      <p class="has-text-align-center achtung_update"><strong>Achtung</strong></p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {"width":"80%"} -->
      <div class="wp-block-column" style="flex-basis:80%"><!-- wp:paragraph {"className":"svg_meldung"} -->
      <p class="svg_meldung">Weil das umständlich ist, habe ich bereits einen Hinweis (Issue) an die Entwickler dazu eröffnet.</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:group -->',
        )
   );
    

/* ---------------------------------- */
/* Container Update                   */
/* ---------------------------------- */
register_block_pattern(
  'container_mittelgrau_update',
    array(
    'title' => __( 'Mittelgrauer Container mit Update-SVG', 'container_mittelgrau_update' ),
    'description' => _x( 'Mittelgrauer Container mit Update-SVG', 'Ein Container für Update-SVG mit mittelgrauem Hintergrund', 'container_mittelgrau_update' ),
    'categories'  => array('Haurand'),
    'content'     =>
      '<!-- wp:group {"style":{"color":{"background":"#d4dadb"}},"className":"svg_container"} -->
      <div class="wp-block-group svg_container has-background" style="background-color:#d4dadb"><!-- wp:spacer {"height":"30px"} -->
      <div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
      <!-- /wp:spacer -->
      
      <!-- wp:columns -->
      <div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"spalte_svg"} -->
      <div class="wp-block-column is-vertically-aligned-center spalte_svg" style="flex-basis:20%"><!-- wp:group {"className":"html_svg","layout":{"inherit":false,"contentSize":"100px"}} -->
      <div class="wp-block-group html_svg"><!-- wp:html -->
      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 506.4 506.4" style="enable-background:new 0 0 506.4 506.4;" xml:space="preserve">
      <g>
        <g>
          <path d="M75,252c-6-6-14-9.2-22.4-9.2c-8.4,0-16.4,3.2-22.4,9.2S21,266,21,274.4c0,8.4,3.2,16.4,9.2,22.4s14,9.2,22.4,9.2
            c8.4,0,16.4-3.2,22.4-9.2s9.2-14,9.2-22.4C84.2,266,81,258,75,252z"></path>
        </g>
      </g>
      <g>
        <g>
          <path d="M130.6,390.4c-10-10.4-18-21.6-24.8-33.6c-5.6-10-16-16-27.6-16c-5.2,0-10.8,1.2-15.6,4c-15.2,8.4-20.8,28-12,43.2
            c9.2,16.8,20.8,32,34,46c6,6.4,14.4,10,23.2,10c8,0,16-3.2,21.6-8.8c6-6,9.6-13.6,10-22C139.8,404.8,136.6,396.8,130.6,390.4z"></path>
        </g>
      </g>
      <g>
        <g>
          <path d="M355,450c-5.6-12-17.6-20-30.4-20c-4,0-7.6,0.8-11.2,2c-19.2,7.2-39.6,11.2-60,11.2c-14.4,0-28.4-1.6-42.4-5.2
            c-1.2-0.4-2.4-0.4-3.2-0.8c-2.8-0.8-5.6-1.2-8.4-1.2c-14,0-26.8,9.6-30.4,23.2c-2.4,8-1.2,16.8,2.8,24S182.6,496,191,498
            c1.6,0.4,3.2,0.8,4.8,1.2c18.8,4.8,38.4,7.2,58,7.2c28.4,0,56.4-5.2,82.8-15.2c8-3.2,14-8.8,17.6-16.8
            C357.8,466.8,357.8,458,355,450z"></path>
        </g>
      </g>
      <g>
        <g>
          <path d="M328.6,55.2c4.8-4.4,8-10,9.6-16.4c2-8.4,0.4-16.8-4-24c-6-9.2-16-14.8-26.8-14.8c-6,0-11.6,1.6-16.8,4.8l-58,36.8
            c-7.2,4.4-12,11.6-14,19.6c-2,8.4-0.4,16.8,4,24l36.8,58c6,9.2,16,14.8,26.8,14.8c6,0,11.6-1.6,16.8-4.8c12-7.6,17.2-22,13.6-35.2
            c63.2,25.6,105.2,87.6,105.2,156.4c0,38-12.4,74-35.6,104c-10.8,13.6-8.4,33.6,5.6,44.4c5.6,4.4,12.4,6.8,19.6,6.8
            c10,0,18.8-4.4,24.8-12c32-41.2,49.2-90.4,49.2-142.8C485,174.4,422.6,87.6,328.6,55.2z"></path>
      </g></g></svg>
      <!-- /wp:html --></div>
      <!-- /wp:group -->
      
      <!-- wp:paragraph {"align":"center","className":"achtung_update"} -->
      <p class="has-text-align-center achtung_update"><strong>Update</strong></p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {"width":"80%"} -->
      <div class="wp-block-column" style="flex-basis:80%"><!-- wp:paragraph {"className":"svg_meldung"} -->
      <p class="svg_meldung">Das ist ein Update</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:group -->',
      )
 );  
 
 

/* ---------------------------------- */
/* Container Info                   */
/* ---------------------------------- */
register_block_pattern(
  'container_mittelgrau_info',
    array(
    'title' => __( 'Mittelgrauer Container mit Info-SVG', 'container_mittelgrau_info' ),
    'description' => _x( 'Mittelgrauer Container mit Info-SVG', 'Ein Container für Info-SVG mit mittelgrauem Hintergrund', 'container_mittelgrau_info' ),
    'categories'  => array('Haurand'),
    'content'     =>
      '<!-- wp:group {"style":{"color":{"background":"#d4dadb"}},"className":"svg_container"} -->
      <div class="wp-block-group svg_container has-background" style="background-color:#d4dadb"><!-- wp:spacer {"height":"30px"} -->
      <div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
      <!-- /wp:spacer -->

      <!-- wp:columns -->
      <div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"20%","className":"spalte_svg"} -->
      <div class="wp-block-column is-vertically-aligned-center spalte_svg" style="flex-basis:20%"><!-- wp:group {"className":"html_svg","layout":{"inherit":false,"contentSize":"100px"}} -->
      <div class="wp-block-group html_svg"><!-- wp:html -->
      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 460 460" style="enable-background:new 0 0 460 460;" xml:space="preserve">
      <g id="XMLID_1055_">
        <g>
          <path d="M230,0C102.975,0,0,102.975,0,230s102.975,230,230,230s230-102.974,230-230S357.025,0,230,0z M268.333,377.36
            c0,8.676-7.034,15.71-15.71,15.71h-43.101c-8.676,0-15.71-7.034-15.71-15.71V202.477c0-8.676,7.033-15.71,15.71-15.71h43.101
            c8.676,0,15.71,7.033,15.71,15.71V377.36z M230,157c-21.539,0-39-17.461-39-39s17.461-39,39-39s39,17.461,39,39
            S251.539,157,230,157z"></path>
      </g>
      </g></svg>
      <!-- /wp:html --></div>
      <!-- /wp:group -->

      <!-- wp:paragraph {"align":"center","className":"achtung_update"} -->
      <p class="has-text-align-center achtung_update"><strong>Info</strong></p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->

      <!-- wp:column {"width":"80%"} -->
      <div class="wp-block-column" style="flex-basis:80%"><!-- wp:paragraph {"className":"svg_meldung"} -->
      <p class="svg_meldung">Das ist eine Info</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:group -->',
  )
);  


/* --------------------------------------------------- */
/* Container mittelgrau mit Text links und Bild rechts */
/* --------------------------------------------------- */
register_block_pattern(
  'container_mittelgrau_bild_text',
    array(
    'title' => __( 'Mittelgrauer Container mit Text und Bild', 'container_mittelgrau_bild_text' ),
    'description' => _x( 'Mittelgrauer Container mit Text links und Bild rechts', 'Mittelgrauer Container mit Text links und Bild rechts', 'container_mittelgrau_bild_text' ),
    'categories'  => array('Haurand'),
    'content'     =>
      "<!-- wp:columns {\"align\":\"full\",\"style\":{\"color\":{\"background\":\"#d4dadb\"}}} -->
      <div class=\"wp-block-columns alignfull has-background\" style=\"background-color:#d4dadb\"><!-- wp:column -->
      <div class=\"wp-block-column\"><!-- wp:columns {\"verticalAlignment\":null} -->
      <div class=\"wp-block-columns\"><!-- wp:column {\"verticalAlignment\":\"center\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:paragraph {\"textColor\":\"black\"} -->
      <p class=\"has-black-color has-text-color\">Normalerweise ruft man über das Icon „+“ die Auswahlliste mit den Blöcken auf. Hier werden die Blöcke aufgelistet, die man bei der letzten Bearbeitung benutzt hat.</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:paragraph {\"textColor\":\"black\"} -->
      <p class=\"has-black-color has-text-color\">Standardmäßig könnte man aber auch direkt schreiben, wenn man den Absatz-Block nutzen möchte.</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:paragraph {\"textColor\":\"black\"} -->
      <p class=\"has-black-color has-text-color\">Wenn allerdings der gewünschte Block nicht direkt zur Auswahl steht, dann klickt man in der Regel auf den Button „Alle durchsuchen“ und es erscheinen alle Blöcke im linken Bereich.</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column -->
      <div class=\"wp-block-column\"><!-- wp:image {\"align\":\"left\",\"id\":3711,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"alignleft size-large\"><a href=\"https://haurand.com/wp-content/uploads/2021/03/2021-03-30-09_23_59-Window.png\"><img src=\"https://haurand.com/wp-content/uploads/2021/03/2021-03-30-09_23_59-Window.png\" alt=\"Auswahl im Block-Editor\" class=\"wp-image-3711\"/></a><figcaption>Grafik: haurand.com</figcaption></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
    )
);


/* ------------------------------ */
/* Container weiß mit Listen      */
/* ------------------------------ */
register_block_pattern(
  'listbox_weiss',
    array(
    'title' => __( 'Listbox weiß', 'listbox_weiss' ),
    'description' => _x( 'Listbox weiß ', 'Eine Listbox mit weißer Hintergrundfarbe und roten Kästchen', 'listbox_weiss' ),
    'categories'  => array('Haurand'),
    'content'     =>
       "<!-- wp:list {\"className\":\"weisse_liste\"} -->
       <ul class=\"weisse_liste\"><li>Fotos</li><li>Texten</li><li>Formularen</li><li>Social Media Buttons</li><li>Downloadbereich</li><li>Newsverwaltung</li><li>Mehrsprachigkeit</li><li>DSGVO- Sicherheit</li><li>und allem, was Ihnen wichtig ist</li></ul>
       <!-- /wp:list -->",
  )
);


/* ------------------------------ */
/* Container rot mit Listen       */
/* ------------------------------ */
register_block_pattern(
  'listbox_rot',
    array(
    'title' => __( 'Listbox rot', 'listbox_rot' ),
    'description' => _x( 'Listbox rot', 'Eine Listbox mit roter Hintergrundfarbe', 'listbox_rot' ),
    'categories'  => array('Haurand'),
    'content'     =>
       "<!-- wp:list {\"style\":{\"color\":{\"background\":\"#b70000\"}},\"textColor\":\"white\",\"className\":\"rote_liste\"} -->
       <ul class=\"rote_liste has-white-color has-text-color has-background\" style=\"background-color:#b70000\"><li>Fotos</li><li>Texten</li><li>Formularen</li><li>Social Media Buttons</li><li>Downloadbereich</li><li>Newsverwaltung</li><li>Mehrsprachigkeit</li><li>DSGVO- Sicherheit</li><li>und allem, was Ihnen wichtig ist</li></ul>
       <!-- /wp:list -->",
  )
);

/* ----------------------------------------------------- */
/* Container mittelgrau mit zwei Zeilen und fünf Spalten */
/* ----------------------------------------------------- */
register_block_pattern(
  'container_mittelgrau_spalten',
    array(
    'title' => __( 'Mittelgrauer Container mit 5 Spalten', 'container_mittelgrau_spalten' ),
    'description' => _x( 'Mittelgrauer Container mit 2 Zeilen und 5 Spalten', 'Ein Container mit mittelgrauem Hintergrund und 2 Zeilen und 5 Spalten', 'container_mittelgrau_spalten' ),
    'categories'  => array('Haurand'),
    'content'     =>
      "<!-- wp:columns {\"align\":\"full\",\"style\":{\"color\":{\"background\":\"#a9b2b5\"}}} -->
      <div class=\"wp-block-columns alignfull has-background\" style=\"background-color:#a9b2b5\"><!-- wp:column -->
      <div class=\"wp-block-column\"><!-- wp:columns {\"align\":\"wide\",\"className\":\"grauer_block\"} -->
      <div class=\"wp-block-columns alignwide grauer_block\"><!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"><!-- wp:image {\"align\":\"center\",\"id\":3767,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/kontakt-2/\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/Icons_Kontakt_FFFFFF.png\" alt=\"\" class=\"wp-image-3767\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong><strong>Kontakt</strong></strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Nehmen Sie jetzt<br>Kontakt zu uns auf</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"><!-- wp:image {\"align\":\"center\",\"id\":3765,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/ihre-neue-webseite-einfach-passend/\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/Icons_IhreWebsite_FFFFFF.png\" alt=\"\" class=\"wp-image-3765\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong><strong>Ihre Website</strong></strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Passende Websites<br>für jeden Bedarf</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"><!-- wp:image {\"align\":\"center\",\"id\":3779,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/blog/\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/Icons_ZumBlog_FFFFFF.png\" alt=\"\" class=\"wp-image-3779\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong><strong><strong><strong>Zum Blog</strong></strong></strong></strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Tipps zu WordPress<br>und Entwicklung</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->
      
      <!-- wp:columns {\"align\":\"wide\",\"className\":\"grauer_block\"} -->
      <div class=\"wp-block-columns alignwide grauer_block\"><!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"><!-- wp:image {\"align\":\"center\",\"id\":3771,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/wordpress-webseiten-referenzen/\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/Icons_Referenzen_FFFFFF.png\" alt=\"\" class=\"wp-image-3771\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Referenzen</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Eine Auswahl von Seiten,<br>Die wir erstellt haben</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"><!-- wp:image {\"align\":\"center\",\"id\":3777,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/wordpress-wartung-ab-30-e-monat/\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/Icons_Wartung_FFFFFF.png\" alt=\"\" class=\"wp-image-3777\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Wartung</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Ab 30 € / Monat<br>sorgenfreier online</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"><!-- wp:image {\"align\":\"center\",\"id\":3773,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://haurand.com/webseiten-analyse/\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/Icons_Support_FFFFFF.png\" alt=\"\" class=\"wp-image-3773\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Support</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Erfahren Sie hier mehr<br>über unser Hilfsangebote</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
      )
  );

/* ------------------------------ */
/* Container rot mit zwei Spalten */
/* ------------------------------ */
register_block_pattern(
  'container_rot_zwei_spalten',
    array(
    'title' => __( 'Roter zweispaltiger Container', 'container_rot_zwei_spalten' ),
    'description' => _x( 'Roter zweispaltiger Container', 'Ein Container mit Bild / Listbox / Eckengrafik per CSS-Klasse', 'container_rot_zwei_spalten' ),
    'categories'  => array('Haurand'),
    'content'     =>
      "<!-- wp:columns {\"style\":{\"color\":{\"background\":\"#b70000\"}},\"className\":\"rechte_untere_ecke\"} -->
      <div class=\"wp-block-columns rechte_untere_ecke has-background\" style=\"background-color:#b70000\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"15%\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:15%\"><!-- wp:image {\"align\":\"center\",\"id\":3797,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"https://haurand.com/wp-content/uploads/2021/04/WordPress_Chart_Zeichenflaeche.png\" alt=\"\" class=\"wp-image-3797\"/><figcaption>Stand: 2021</figcaption></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"80%\"} -->
      <div class=\"wp-block-column\" style=\"flex-basis:80%\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"textColor\":\"white\"} -->
      <h3 class=\"has-text-align-center has-white-color has-text-color\" id=\"h-circa-40-aller-internetseiten-verwenden-wordpress-sie-m-chten-auch\">Circa 40% aller Internetseiten verwenden WordPress – Sie möchten auch:</h3>
      <!-- /wp:heading -->
      
      <!-- wp:list {\"style\":{\"typography\":{\"fontSize\":22}},\"textColor\":\"white\",\"className\":\"rote_liste\"} -->
      <ul class=\"rote_liste has-white-color has-text-color\" style=\"font-size:22px\"><li>einen Internetauftritt, z. B. für Ihre Firma, Ihren Verein oder Ihr Hobby?</li><li>selber Inhalte verändern oder erstellen?</li><li>Ihre Produkte oder Dienstleistungen zeitgemäß präsentieren?</li><li>Responsivität (das heißt, dass Ihre Seite auch auf Smartphones gut dargestellt wird)?</li><li>eine schnelle Webseite (wichtig vor allem bei mobilen Endgeräten)?</li><li>für Ihre Internetseite ein übersichtliches und klares Design?</li><li>eine einfach zu bedienende Webseite</li><li>eine logische Menüstruktur?</li><li>für die Besucher Ihrer Webseite eine klare Orientierung?</li></ul>
      <!-- /wp:list --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
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


/*----------------------------------------------------------------*/
/* Start: Alle Medien zeigen - abschalten von jeweils 40 Medien
/* Datum: 22.08.2021
/* Autor: hgg
/*----------------------------------------------------------------*/
add_filter( 'media_library_infinite_scrolling', '__return_true' );
/*----------------------------------------------------------------*/
/* Ende: Alle Medien zeigen - abschalten von jeweils 40 Medien
/*----------------------------------------------------------------*/

/*----------------------------------------------------------------*/
/* Start: Menüpunkt zu wiederverwendbaren Blöcken
/* Datum: 22.08.2021
/* Autor: hgg
/*----------------------------------------------------------------*/
function be_reusable_blocks_admin_menu() {
  add_menu_page( 'Wiederverwendbare Blöcke', 'Wiederverwendbare Blöcke', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
  }
add_action( 'admin_menu', 'be_reusable_blocks_admin_menu' );
/*----------------------------------------------------------------*/
/* Ende: Menüpunkt zu wiederverwendbaren Blöcken
/*----------------------------------------------------------------*/

?>