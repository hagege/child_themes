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

function haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
  register_block_pattern_category(
   'Haurand',
   array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category', 'Haurand' ) )
   );
  }
 }
 add_action( 'init', 'haurand_register_block_categories' );



/* ------------------------------ */
/* Absatz zentriert               */
/* ------------------------------ */
register_block_pattern(
   'absatz_zentriert',
     array(
     'title' => __( 'Absatz zentriert', 'absatz_zentriert' ),
     'description' => _x( 'Zentrierter Absatz', 'Ein Absatz mit zentriertem Text', 'absatz_zentriert' ),
     'categories'  => array('Haurand'),
     'content'     =>
        "<!-- wp:paragraph {\"align\":\"center\"} -->
        <p class=\"has-text-align-center\">Wir sind eine WordPress - Agentur in Aachen, die professionelle Webseiten zu fairen Konditionen erstellt. Beim Webdesign sorgen wir dafür, dass Ihre neue Homepage grafisch optimal gestaltet ist. Wir erstellen ansprechende und funktionelle Webseiten mit schnellen Ladezeiten (Performance).&nbsp;</p>
        <!-- /wp:paragraph -->",
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

/* -------------------------------- */
/* Container mittelgrau mit Bildern */
/* -------------------------------- */
register_block_pattern(
  'container_mittelgrau',
    array(
    'title' => __( 'Mittelgrauer Container', 'container_mittelgrau' ),
    'description' => _x( 'Mittelgrauer Container', 'Ein Container für Bilder mit mittelgrauem Hintergrund', 'container_mittelgrau' ),
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
      <div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":\"20%\"} -->
      <div class=\"wp-block-column\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column -->

      <!-- wp:column {\"width\":22.22} -->
      <div class=\"wp-block-column\" style=\"flex-basis:22.22%\"><!-- wp:image {\"align\":\"center\",\"id\":3767,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Kontakt_FFFFFF.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Kontakt_FFFFFF.png\" alt=\"\" class=\"wp-image-3767\"/></a></figure></div>
      <!-- /wp:image -->

      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Kontakt</strong></h4>
      <!-- /wp:heading -->

      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Nehmen Sie jetzt<br>Kontakt zu uns auf</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->

      <!-- wp:column {\"width\":22.22} -->
      <div class=\"wp-block-column\" style=\"flex-basis:22.22%\"><!-- wp:image {\"align\":\"center\",\"id\":3765,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_IhreWebsite_FFFFFF.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_IhreWebsite_FFFFFF.png\" alt=\"\" class=\"wp-image-3765\"/></a></figure></div>
      <!-- /wp:image -->

      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Ihre Website</strong></h4>
      <!-- /wp:heading -->

      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Passende Websites<br>für jeden Bedarf</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->

      <!-- wp:column {\"width\":22.22} -->
      <div class=\"wp-block-column\" style=\"flex-basis:22.22%\"><!-- wp:image {\"align\":\"center\",\"id\":3779,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_ZumBlog_FFFFFF.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_ZumBlog_FFFFFF.png\" alt=\"\" class=\"wp-image-3779\"/></a></figure></div>
      <!-- /wp:image -->

      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Zum Blog</strong></h4>
      <!-- /wp:heading -->

      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Tipps zu WordPress<br>und Entwicklung</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->

      <!-- wp:column {\"width\":\"20%\"} -->
      <div class=\"wp-block-column\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->

      <!-- wp:columns {\"align\":\"wide\"} -->
      <div class=\"wp-block-columns alignwide\"><!-- wp:column {\"width\":\"20%\"} -->
      <div class=\"wp-block-column\" style=\"flex-basis:20%\"></div>
      <!-- /wp:column -->

      <!-- wp:column {\"width\":20.83} -->
      <div class=\"wp-block-column\" style=\"flex-basis:20.83%\"><!-- wp:image {\"align\":\"center\",\"id\":3771,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Referenzen_FFFFFF.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Referenzen_FFFFFF.png\" alt=\"\" class=\"wp-image-3771\"/></a></figure></div>
      <!-- /wp:image -->

      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Referenzen</strong></h4>
      <!-- /wp:heading -->

      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Eine Auswahl von Seiten,<br>Die wir erstellt haben</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->

      <!-- wp:column {\"width\":20.83} -->
      <div class=\"wp-block-column\" style=\"flex-basis:20.83%\"><!-- wp:image {\"align\":\"center\",\"id\":3777,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Wartung_FFFFFF.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Wartung_FFFFFF.png\" alt=\"\" class=\"wp-image-3777\"/></a></figure></div>
      <!-- /wp:image -->

      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Wartung</strong></h4>
      <!-- /wp:heading -->

      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Eine Auswahl von Seiten,<br>Die wir erstellt haben</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->

      <!-- wp:column {\"width\":20.83} -->
      <div class=\"wp-block-column\" style=\"flex-basis:20.83%\"><!-- wp:image {\"align\":\"center\",\"id\":3773,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"aligncenter size-large\"><a href=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Support_FFFFFF.png\"><img src=\"https://wp.haurand.com/wp-content/uploads/2021/04/Icons_Support_FFFFFF.png\" alt=\"\" class=\"wp-image-3773\"/></a></figure></div>
      <!-- /wp:image -->

      <!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"textColor\":\"white\"} -->
      <h4 class=\"has-text-align-center has-white-color has-text-color\"><strong>Support<strong></h4>
      <!-- /wp:heading -->

      <!-- wp:paragraph {\"align\":\"center\",\"textColor\":\"white\"} -->
      <p class=\"has-text-align-center has-white-color has-text-color\">Erfahren Sie hier mehr<br>über unser Hilfsangebote</p>
      <!-- /wp:paragraph --></div>
      <!-- /wp:column -->

      <!-- wp:column {\"width\":\"20%\"} -->
      <div class=\"wp-block-column\" style=\"flex-basis:20%\"></div>
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
/*----------------------------------------------------------------*/
/* Ende: Block Patterns von haurand.com 
/* Datum: 14.01.2021
/* Autor: hgg
/*----------------------------------------------------------------*/





?>