<?php

/*----------------------------------------------------------------*/
/* Start: style.css Datei des Eltern-Themes einbinden
/* Datum: 232.09.2019
/* Autor: hgg
/*----------------------------------------------------------------*/

function child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
// die folgende Zeile ist wohl nicht notwendig:
//wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));

}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );


/* eingefügt am 8.3.2017: */
function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');




/*----------------------------------------------------------------*/
/* Start: PHP in Text-Widget nutzen 
/* Datum: 05.04.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
add_filter('widget_text', 'gibmirphp', 99);
function gibmirphp($text) {
  if (strpos($text, '<' . '?') !== false) {
    ob_start();
     eval('?' . '>' . $text);
     $text = ob_get_contents();
    ob_end_clean();
  }
  return $text;
}
/*----------------------------------------------------------------*/
/* Ende: PHP in Text-Widget nutzen 
/* Datum: 05.04.2018
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
          $content .= '<div class="flex-container"><a class="beitrags_bild_link" href="'.get_permalink($post->ID).'"><img class="beitrags_bild" src="'.get_the_post_thumbnail_url($post->ID, 'full').'"></a>';
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

/*----------------------------------------------------------------*/
/* Recaptcha - Script aus Contact Form 7 entfernen */
/* Datum: 14.09.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

remove_action( 'wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts' );
?>