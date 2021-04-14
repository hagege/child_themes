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

/* eigene Kategorie */
if ( function_exists( 'register_block_pattern_category' ) ) {
  register_block_pattern_category(
    'haurand',
    array( 'label' => __( 'Forms', 'text-domain' ) )
 );
}

function haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
  register_block_pattern_category(
   'Haurand',
   array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category', 'Haurand' ) )
   );
  }
 }
 add_action( 'init', 'haurand_register_block_categories' );


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


register_block_pattern(
  'container_hellgrau',
    array(
    'title' => __( 'Hellgrauer Container', 'container_hellgrau' ),
    'description' => _x( 'Hellgrauer Container', 'Ein Container für Bilder mit hellgrauem Hintergrund', 'container_hellgrau' ),
    'categories'  => array('Haurand'),
    'content'     =>
      "<!-- wp:columns {\"align\":\"full\",\"style\":{\"color\":{\"background\":\"#d4dadb\"}}} -->
      <div class=\"wp-block-columns alignfull has-background\" style=\"background-color:#d4dadb\"><!-- wp:column -->
      <div class=\"wp-block-column\"><!-- wp:columns -->
      <div class=\"wp-block-columns\"><!-- wp:column {\"verticalAlignment\":\"center\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:image {\"align\":\"right\",\"id\":3766,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"alignright size-large\"><a href=\"https://www.hochxeit.de/wp-content/uploads/2021/04/Logo.png\"><img src=\"https://www.hochxeit.de/wp-content/uploads/2021/04/Logo.png\" alt=\"ein Bild\" class=\"wp-image-3766\"/></a></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column -->
      <!-- wp:column {\"verticalAlignment\":\"center\"} -->
      <div class=\"wp-block-column is-vertically-aligned-center\"><!-- wp:image {\"align\":\"left\",\"id\":3711,\"sizeSlug\":\"large\",\"linkDestination\":\"media\"} -->
      <div class=\"wp-block-image\"><figure class=\"alignleft size-large\"><a href=\"https://www.hochxeit.de/wp-content/uploads/2021/03/2021-03-30-09_23_59-Window.png\"><img src=\"https://www.hochxeit.de/wp-content/uploads/2021/03/2021-03-30-09_23_59-Window.png\" alt=\"Auswahl im Block-Editor\" class=\"wp-image-3711\"/></a><figcaption>Grafik: haurand.com</figcaption></figure></div>
      <!-- /wp:image --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
  )
);



register_block_pattern(
  'container_rot_drei_spalten',
    array(
    'title' => __( 'Roter dreispaltiger Container', 'container_rot_drei_spalten' ),
    'description' => _x( 'Roter dreispaltiger Container', 'Ein Container mit Bild / Listbox / Eckengrafik', 'container_rot_drei_spalten' ),
    'categories'  => array('Haurand'),
    'content'     =>
      " <!-- wp:columns {\"style\":{\"color\":{\"background\":\"#b70000\"}}} -->
        <div class=\"wp-block-columns has-background\" style=\"background-color:#b70000\"><!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"15%\"} -->
        <div class=\"wp-block-column is-vertically-aligned-center\" style=\"flex-basis:15%\"><!-- wp:image {\"align\":\"center\",\"id\":3822,\"width\":120,\"height\":120,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->
        <div class=\"wp-block-image\"><figure class=\"aligncenter size-large is-resized\"><img src=\"https://www.hochxeit.de/wp-content/uploads/2021/01/WordPress_Chart_Zeichenfläche-1.png\" alt=\"\" class=\"wp-image-3822\" width=\"120\" height=\"120\"/><figcaption>Stand: 2021</figcaption></figure></div>
        <!-- /wp:image --></div>
        <!-- /wp:column -->

        <!-- wp:column {\"width\":\"80%\"} -->
        <div class=\"wp-block-column\" style=\"flex-basis:80%\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"textColor\":\"white\"} -->
        <h3 class=\"has-text-align-center has-white-color has-text-color\">Circa 40% aller Internetseiten verwenden WordPress – Sie möchten auch:</h3>
        <!-- /wp:heading -->

        <!-- wp:list {\"textColor\":\"white\"} -->
        <ul class=\"has-white-color has-text-color\"><li>einen Internetauftritt, z. B. für Ihre Firma, Ihren Verein oder Ihr Hobby?</li><li>selber Inhalte verändern oder erstellen?</li><li>Ihre Produkte oder Dienstleistungen zeitgemäß präsentieren?</li><li>Responsivität (das heißt, dass Ihre Seite auch auf Smartphones gut dargestellt wird)?</li><li>eine schnelle Webseite (wichtig vor allem bei mobilen Endgeräten)?</li><li>für Ihre Internetseite ein übersichtliches und klares Design?</li><li>eine einfach zu bedienende Webseite</li><li>eine logische Menüstruktur?</li><li>für die Besucher Ihrer Webseite eine klare Orientierung?</li></ul>
        <!-- /wp:list --></div>
        <!-- /wp:column -->

        <!-- wp:column {\"verticalAlignment\":\"bottom\",\"width\":\"5%\"} -->
        <div class=\"wp-block-column is-vertically-aligned-bottom\" style=\"flex-basis:5%\"><!-- wp:image {\"align\":\"right\",\"id\":3823,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->
        <div class=\"wp-block-image\"><figure class=\"alignright size-large\"><img src=\"https://www.hochxeit.de/wp-content/uploads/2021/04/Eckendeko.png\" alt=\"\" class=\"wp-image-3823\"/></figure></div>
        <!-- /wp:image --></div>
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
        $content .= '<div class="beitrags_titel">'.$post->post_title.'</a></div>';
        // $content .= '<p class="beitrags_text">'.get_the_category($post->ID).'</p>';
        $thumbnail_id = get_post_thumbnail_id( $post->ID );
        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        // alte Einstellung: 
        // $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></a>';
        // $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').' alt="'.$alt_text.'"></a>';
        $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full'). '" width=auto height=auto alt="'.$alt_text.'"></a>';
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
        $content .= '</p></div><hr>';
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