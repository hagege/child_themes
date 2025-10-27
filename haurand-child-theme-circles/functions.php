<?php
/**
 * haurand-child-theme-circles-wp Child Theme: circles-wp functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

function child_theme_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));

}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );

/* XML-RPC-API deaktivieren */
add_filter('xmlrpc_enabled', '__return_false');

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
  // Spalte mit featured image als 1. Spalte:
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

/*
function wpu_enqueue_block_variations() {
	wp_enqueue_script(
		'wpu-block-variations',
		get_theme_file_uri( '/assets/js/block-variations.js' ),
		array( 
			'wp-blocks', 
			'wp-dom-ready',
			'wp-edit-post' 
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'wpu_enqueue_block_variations' );

*/
add_action( 'init', 'circles_wp_enqueue_block_styles' );

function circles_wp_enqueue_block_styles() {
   wp_enqueue_block_style(
       'core/cover',
       array(
           'handle' => 'circles-wp--card-interactive',
           'src'    => get_theme_file_uri( 'assets/css/blocks/core/cover-card-interactive.css' ),
           'path'   => get_theme_file_path( 'assets/css/blocks/core/cover-card-interactive.css' ),
       )
   );
}

add_action( 'init', 'circles_wp_register_block_styles' );

function circles_wp_register_block_styles() {
   register_block_style(
       'core/cover',
       array(
           'name'         => 'card--interactive',
           'label'        => __( 'Card (Interactive)', 'circles-wp' ),
           'style_handle' => 'circles-wp--card-interactive',
       )
   );
}

/* Restrict searches to posts only
function limit_search_posts($query) {
if ( ! is_admin() && $query->is_search() ) {
   $query->set('post_type', 'post');
}
   return $query;
}
add_filter('pre_get_posts', 'limit_search_posts');
*/

/**
 * Entfernt Bilder oder Blöcke mit der CSS-Klasse "rss-hide" aus dem RSS-Feed.
 */
function my_hide_rss_images_with_class( $block_content, $block ) {
    if ( is_feed() && strpos( $block_content, 'rss-hide' ) !== false ) {
        return ''; // Block auslassen
    }
    return $block_content;
}
add_filter( 'render_block', 'my_hide_rss_images_with_class', 10, 2 );

function featured_image_in_rss($content) {
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $content = '<div>' . get_the_post_thumbnail($post->ID, 'large', array('style' => 'margin-bottom: 15px;')) . '</div>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'featured_image_in_rss');
add_filter('the_content_feed', 'featured_image_in_rss');
