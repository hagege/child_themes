<?php
/**
 * haurand-child-theme-circles Child Theme: Circles functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

function child_theme_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));

}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );

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

/*----------------------------------------------------------------*/
/* Start: Anzeige image in der Beitragsliste
/* Datum: 25.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/

add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
  // Spalte mit featured image am Ende:
  $columns['img'] = 'Featured Image';
  // Spalte mit featured image ale 1. Spalte:
  // $columns = array_slice($columns, 0, 1, true) + array("img" => "Beitragsbild") + array_slice($columns, 1, count($columns) - 1, true);
  return $columns;
}

function manage_img_column($column_name, $post_id) {
 if( $column_name == 'img' ) {
  echo get_the_post_thumbnail($post_id, 'thumbnail');
 }
 return $column_name;
}

/*----------------------------------------------------------------*/
/* Ende: Anzeige image in der Beitragsliste
/* Datum: 25.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/


/*----------------------------------------------------------------*/
/* Start: Shortcode für Kategorienliste - Aufruf mit [haurand_catelist]
/* nicht mehr benötigt
/* Datum: 21.1.2023
/* Autor: hgg
/*----------------------------------------------------------------*/
function createGridCategories() {
  $list = wp_list_categories( array(
      'taxonomy'   => 'category',
      'hide_empty' => 1,
      'echo'       => 0,
      'title_li'   => '',
      'show_count' => 1,
      'exclude'    => array( 1486 ),
      // 1486: Kategorie: Keine Anzeige
      // other args here
) );

  return "<h3>Beitrags-Kategorien</h3><ul>$list</ul>";
}
add_shortcode('haurand_catelist', 'createGridCategories');

/*----------------------------------------------------------------*/
/* Start: Shortcode für Kategorienliste - Aufruf mit [my_category_list]
/* Datum: 04.2.2023
/* Autor: hgg
/*----------------------------------------------------------------*/

function my_category_list_shortcode() {
  $args = array(
      'orderby' => 'name',
      'hide_empty' => 1
  );
  $my_categories = get_categories($args);
  $my_output = '<p><ul>';
  foreach($my_categories as $my_category) {
      $my_output .= '<li><a class="my_category_list" href="' . get_category_link($my_category->term_id) . '">' . $my_category->name . ' (' . $my_category->count . ')</a></li>' . '   ';
  // $my_output .= '<a class="my_category_list" href="' . get_category_link($my_category->term_id) . '">' . $my_category->name . '</a>' . '   ';
  }
  $my_output .= '</p></ul>';
  return "<h3>Alle Beitrags-Kategorien auf haurand.com:</h3>$my_output";
}
add_shortcode('my_category_list', 'my_category_list_shortcode');



/* AntispamBee-Filter, siehe https://antispambee.pluginkollektiv.org/de/dokumentation/#hooks */

function antispam_bee_patterns() {
  add_filter( 'antispam_bee_patterns', 'antispam_bee_add_custom_patterns' );
}
add_action( 'init', 'antispam_bee_patterns' );

// Einzelne Filter bestimmen (author, host, body, ip, email). Mehrere Reguläre Ausdrücke durch | trennen
function antispam_bee_add_custom_patterns($patterns) {

  // Autoren filtern
  $patterns[] = array(
    'author' => 'Neha|Sruti|Autor3'
  );

  // URL filtern (Beispiel filtert example.de.cool und example.de mit und ohne www.)
  $patterns[] = array(
    'host' => '^(www\.)?gigolomania\.com|^(www\.)?gigolomania\.com$'
  );

  // Kommentarinhalt filtern (Beispiel behandelt 3 oder mehr Links im Kommentar als Spam)
  $patterns[] = array(
    'body' => '(.*(http|https|ftp|ftps)\:\/\/){4,}'
  );

  // IP Adresse filtern (Beispiel filtert 192.168.XXX.XXX) 
  /*
  $patterns[] = array(
    'ip' => '^(192\.)(168\.)(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.)([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$'
  );
  */
  // E-Mail-Adresse filtern (Beispiel behandelt .xx oder .xxx als Spam)
  /*
  $patterns[] = array(
    'email' => '(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.(xx|xxx)+$)'
  );
  */
return $patterns;
}

?>