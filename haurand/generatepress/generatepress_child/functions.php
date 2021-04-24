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
/* Container mittelgrau mit 2 Bildern */
/* ---------------------------------- */
register_block_pattern(
  'container_mittelgrau_bilder',
    array(
    'title' => __( 'Mittelgrauer Container mit 2 Bildern', 'container_mittelgrau_bilder' ),
    'description' => _x( 'Mittelgrauer Container für 2 Bilder', 'Ein Container für 2 Bilder mit mittelgrauem Hintergrund', 'container_mittelgrau_bilder' ),
    'categories'  => array('Haurand'),
    'content'     =>
      "<!-- wp:columns {\"align\":\"full\",\"style\":{\"color\":{\"background\":\"#a9b2b5\"}}} -->
      <div class=\"wp-block-columns alignfull has-background\" style=\"background-color:#a9b2b5\"><!-- wp:column -->
      <div class=\"wp-block-column\"><!-- wp:columns -->
      <div class=\"wp-block-columns\"><!-- wp:column {\"verticalAlignment\":\"center\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:image {\"align\":\"right\",\"id\":3780,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"alignright size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/04/Logo.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Logo.png\" alt=\"\" class=\"wp-image-3780\"/></a></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"verticalAlignment\":\"center\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:image {\"align\":\"left\",\"id\":3711,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"alignleft size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/03/2021-03-30-09_23_59-Window.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/03/2021-03-30-09_23_59-Window.png\" alt=\"Auswahl im Block-Editor\" class=\"wp-image-3711\"/></a><figcaption>Grafik: haurand.com</figcaption></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
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
      "<!-- wp:columns {\"align\":\"full\",\"style\":{\"color\":{\"background\":\"#a9b2b5\"}}} -->
        <div class=\"wp-block-columns alignfull has-background\" style=\"background-color:#a9b2b5\"><!-- wp:column -->
        <div class=\"wp-block-column\"><!-- wp:columns -->
        <div class=\"wp-block-columns\"><!-- wp:column {\"verticalAlignment\":\"center\"} -->
        <div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:paragraph {\"textColor\":\"white\"} -->
        <p class=\"has-white-color has-text-color\">Normalerweise ruft man über das Icon „+“ die Auswahlliste mit den Blöcken auf. Hier werden die Blöcke aufgelistet, die man bei der letzten Bearbeitung benutzt hat.</p>
        <!-- /wp:paragraph -->

        <!-- wp:paragraph {\"textColor\":\"white\"} -->
        <p class=\"has-white-color has-text-color\">Standardmäßig könnte man aber auch direkt schreiben, wenn man den Absatz-Block nutzen möchte.</p>
        <!-- /wp:paragraph -->

        <!-- wp:paragraph {\"textColor\":\"white\"} -->
        <p class=\"has-white-color has-text-color\">Wenn allerdings der gewünschte Block nicht direkt zur Auswahl steht, dann klickt man in der Regel auf den Button „Alle durchsuchen“ und es erscheinen alle Blöcke im linken Bereich.</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column -->

        <!-- wp:column {\"verticalAlignment\":\"center\"} -->
        <div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:image {\"align\":\"left\",\"id\":3711,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
        <div class=\"wp-block-image\"><figure class=\"alignleft size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/03/2021-03-30-09_23_59-Window.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/03/2021-03-30-09_23_59-Window.png\" alt=\"Auswahl im Block-Editor\" class=\"wp-image-3711\"/></a><figcaption>Grafik: haurand.com</figcaption></figure></div>
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
      "<!-- wp:columns {\"align\":\"full\",\"style\":{\"color\":{\"background\":\"#a9b2b5\"}}} -->
        <div class=\"wp-block-columns alignfull has-background\" style=\"background-color:#a9b2b5\"><!-- wp:column -->
        <div class=\"wp-block-column\"><!-- wp:image {\"align\":\"center\",\"id\":3713,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
        <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/03/2021-03-30-09_35_50-Window.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/03/2021-03-30-09_35_50-Window.png\" alt=\"Direkteingabe beim Block-Editor im Auswahlfeld\" class=\"wp-image-3713\"/></a><figcaption>Grafik: haurand.com</figcaption></figure></div>
        <!-- /wp:image --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->",
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
      <div class=\"wp-block-column\"><!-- wp:columns {\"align\":\"wide\"} -->
      <div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"22.22%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:22.22%\"><!-- wp:image {\"align\":\"center\",\"id\":3767,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/kontakt-2/\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Kontakt_FFFFFF.png\" alt=\"\" class=\"wp-image-3767\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Kontakt</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\",\"className\":\"grauer_kasten\"} -->
      <p class=\"has-text-align-center grauer_kasten has-white-color has-text-color\">Nehmen Sie jetzt<br>Kontakt zu uns auf</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"22.22%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:22.22%\"><!-- wp:image {\"align\":\"center\",\"id\":3765,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/webseitenerstellung/\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_IhreWebsite_FFFFFF.png\" alt=\"\" class=\"wp-image-3765\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Ihre Website</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\",\"className\":\"grauer_kasten\"} -->
      <p class=\"has-text-align-center grauer_kasten has-white-color has-text-color\">Passende Websites<br>für jeden Bedarf</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"22.22%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:22.22%\"><!-- wp:image {\"align\":\"center\",\"id\":3779,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/blog/\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_ZumBlog_FFFFFF.png\" alt=\"\" class=\"wp-image-3779\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Zum Blog</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\",\"className\":\"grauer_kasten\"} -->
      <p class=\"has-text-align-center grauer_kasten has-white-color has-text-color\">Tipps zu WordPress<br>und Entwicklung</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column -->
      <div class=\"wp-block-column\"></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->
      
      <!-- wp:columns {\"align\":\"wide\"} -->
      <div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20.83%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20.83%\"><!-- wp:image {\"align\":\"center\",\"id\":3771,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wordpress-webseiten-referenzen/\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Referenzen_FFFFFF.png\" alt=\"\" class=\"wp-image-3771\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Referenzen</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\",\"className\":\"grauer_kasten\"} -->
      <p class=\"has-text-align-center grauer_kasten has-white-color has-text-color\">Eine Auswahl von Seiten,<br>Die wir erstellt haben</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20.83%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20.83%\"><!-- wp:image {\"align\":\"center\",\"id\":3777,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wordpress-wartung-ab-30-e-monat/\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Wartung_FFFFFF.png\" alt=\"\" class=\"wp-image-3777\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Wartung</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\",\"className\":\"grauer_kasten\"} -->
      <p class=\"has-text-align-center grauer_kasten has-white-color has-text-color\">Eine Auswahl von Seiten,<br>Die wir erstellt haben</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20.83%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20.83%\"><!-- wp:image {\"align\":\"center\",\"id\":3773,\"sizeSlug\":\"large\",\"linkDestination\":\"custom\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/webseiten-analyse/\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Support_FFFFFF.png\" alt=\"\" class=\"wp-image-3773\"/></a></figure></div>
      <!-- /wp:image -->
      
      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Support</strong></h4>
      <!-- /wp:heading -->
      
      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\",\"className\":\"grauer_kasten\"} -->
      <p class=\"has-text-align-center grauer_kasten has-white-color has-text-color\">Erfahren Sie hier mehr<br>über unser Hilfsangebote</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"20%\",\"className\":\"fuenf_spalten\"} -->
      <div class=\"wp-block-column fuenf_spalten\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->
      ",
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
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/WordPress_Chart_Zeichenflaeche.png\" alt=\"\" class=\"wp-image-3797\"/><figcaption>Stand: 2021</figcaption></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"width\":\"80%\"} -->
      <div class=\"wp-block-column\" style=\"flex-basis:80%\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"textColor\":\"white\"} -->
      <h3 class=\"has-text-align-center has-white-color has-text-color\" id=\"h-circa-40-aller-internetseiten-verwenden-wordpress-sie-m-chten-auch\">Circa 40% aller Internetseiten verwenden WordPress – Sie möchten auch:</h3>
      <!-- /wp:heading -->
      
      <!-- wp:list {\"style\":{\"typography\":{\"fontSize\":22}},\"textColor\":\"white\"} -->
      <ul class=\"has-white-color has-text-color\" style=\"font-size:22px\"><li>einen Internetauftritt, z. B. für Ihre Firma, Ihren Verein oder Ihr Hobby?</li><li>selber Inhalte verändern oder erstellen?</li><li>Ihre Produkte oder Dienstleistungen zeitgemäß präsentieren?</li><li>Responsivität (das heißt, dass Ihre Seite auch auf Smartphones gut dargestellt wird)?</li><li>eine schnelle Webseite (wichtig vor allem bei mobilen Endgeräten)?</li><li>für Ihre Internetseite ein übersichtliches und klares Design?</li><li>eine einfach zu bedienende Webseite</li><li>eine logische Menüstruktur?</li><li>für die Besucher Ihrer Webseite eine klare Orientierung?</li></ul>
      <!-- /wp:list --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
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
       "<!-- wp:list {\"style\":{\"color\":{\"background\":\"#b70000\"}},\"textColor\":\"white\"} -->
<ul class=\"has-white-color has-text-color has-background\" style=\"background-color:#b70000\"><li>Fotos</li><li>Texten</li><li>Formularen</li><li>Social Media Buttons</li><li>Downloadbereich</li><li>Newsverwaltung</li><li>Mehrsprachigkeit</li><li>DSGVO- Sicherheit</li><li>und allem, was Ihnen wichtig ist</li></ul>
<!-- /wp:list -->",
  )
);


/*----------------------------------------------------------------*/
/* Ende: Block Patterns von haurand.com 
/* Datum: 14.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/


/*----------------------------------------------------------------*/
/* Start: Shortcode zur Ausgabe eines aktuellen Beitrags
/* Datum: 04.01.2020
/* Autor: hgg
/*----------------------------------------------------------------*/
function shortcode_posts_function($atts){
  // Parameter für Posts
  // Voreinstellung für Parameter, falls keine angegeben werden:
  $werte = shortcode_atts( array(
      'headline' => 'Aktuelle Informationen',
      'category_posts' => 'allgemein',
      'anzahl_posts' => 2,
      'auszug' => 'ja',
      'content_laenge' => 55,
      'show_categories' => 'ja'
    ), $atts);


  // Werte aus dem Shortcode zuordnen: //
  $args['category'] = $werte['category_posts'];
  $args['numberposts'] = $werte['anzahl_posts'];
  // ID von der Kategorie "holen":
  $args['category'] = get_cat_ID($args['category']);
  // Beiträge holen
  $custom_posts = get_posts($args);
  // var_dump($args);
  // var_dump($args['numberposts']);
  // var_dump($posts);
  // Beiträge aufbereiten
  $content = '<h2>' . $werte['headline'] .'</h2>';
  $content .= '<div class="aktuelle_beitraege">';
  // found posts
  if( ! empty( $custom_posts ) ){
    foreach ($custom_posts as $post) {
        // $content .= '<p class="beitrags_text">'.get_the_category($post->ID).'</p>';
        $thumbnail_id = get_post_thumbnail_id( $post->ID );
        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        // alte Einstellung: 
        // $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></a>';
        // $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').' alt="'.$alt_text.'"></a>';
        $content .= '<article>';
        $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full'). '" width=auto height=auto alt="'.$alt_text.'"></a>';
        $content .= '<h2 class="beitrags_titel">'.$post->post_title.'</a></h2>';
        // hier entweder den Auszug anzeigen (vergisst man leicht, unter Dokument > Auszug)
        if (esc_attr($werte['auszug']) == 'ja'){
          $content .= '<p class="beitrags_text">' . $post->post_excerpt;
        } else {
          // Alternative: Wenn in der Regel Beiträge nur intern genutzt werden, ist diese Lösung einfacher: // 
          $content .= '<p class="beitrags_text">' . custom_post_excerpt($post->post_content, intval($werte['content_laenge']));
        }
        $content .= '<br><a href="'.get_permalink($post->ID).'">Weiterlesen</a>';
        if (esc_attr($werte['show_categories']) == 'ja'){
          $content .= '<br>';
          // $content .= '<div class="flex-container_fuss">';
          $content .= '<span class="beitrags_categories">Kategorien:&nbsp;</span>';
          foreach((get_the_category($post->ID)) as $cat) {
            $content .= '<span class="beitrags_categories"> ' . $cat->cat_name . ',&nbsp;' . '</span>';
          }
          $content .= '<br>';
          // $content .= '</div>';
        }
        $content .= '</p></div></article>';
        // $content .= '<div class="flex-container_fuss"><a href="'.get_permalink($post->ID).'">Weiterlesen</a></div><hr>';
    }
  }
  $content .= '</div>';
  //Beiträge übergeben
  return $content;
}
add_shortcode('aktuelle_posts', 'shortcode_posts_function');



/*----------------------------------------------------------------*/
/* Diese Funktion reduziert den Content $content_text auf eine Länge von $c_laenge
/*----------------------------------------------------------------*/
function custom_post_excerpt($content_text, $c_laenge ){
// var_dump($content_text);
// $content_text = strip_shortcodes( $post->post_content );
$content_text = apply_filters( 'the_content', $content_text );
$content_text = str_replace(']]>', ']]&gt;', $content_text);
$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
$content_text = wp_trim_words( $content_text,  $c_laenge, $excerpt_more );
// var_dump($content_text);
// var_dump($c_laenge);
return $content_text;
}
/*----------------------------------------------------------------*/
/* Ende: Shortcode zur Ausgabe eines aktuellen Beitrags
/* Datum: 04.01.2020
/* Autor: hgg
/*----------------------------------------------------------------*/




?>