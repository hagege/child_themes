<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Enqueue parent action

if ( ! function_exists( 'evolve_parent_css' ) ) {
	function evolve_parent_css() {
		wp_enqueue_style( 'evolve-parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'evolve-bootstrap' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'evolve_parent_css', 10 );

// You can insert custom functions below

/* https://theeventscalendar.com/support/forums/topic/counting-posts/ */
function tribe_count_by_cat ( $event_category_slug ) {
 
    if ( ! class_exists('Tribe__Events__Main') ) return false;
 
     
    $tax_query = array(    'taxonomy'    => Tribe__Events__Main::TAXONOMY,
                        'field'        => 'slug',
                        'terms'        => $event_category_slug );
 
      $args = array( 'post_type' => Tribe__Events__Main::POSTTYPE, 'post_status' => 'publish', 'tax_query' => array( $tax_query ), 'posts_per_page' => -1);
 
    $query = new WP_Query( $args );
 
    return $query->found_posts;
}


 
/**
 * Test if the current widget is an Advanced List Widget and fix the event limit if it is.
 */
function increase_event_widget_limit(array $instance, $widget) {
    if (is_a($widget, 'Tribe__Events__Pro__Advanced_List_Widget'))
        $instance['limit'] = 30;
 
    return $instance;
}
add_filter('avf_title_args', 'fix_blog_page_title', 10, 2);




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
/* Start: Funktion, um nur bestimmte Kategorie-Beiträge auf der Startseite anzuzeigen 
/* Datum: 19.03.2019
/* Autor: hgg
/*----------------------------------------------------------------*/
// 
/**
* show only posts from category id 5 on homepage
* @param object $query data
* example from Monika texto.de
* Kategorie 1 ist die Kategorie "Allgemein"
*/
function mts_include_category_homepage($query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '1' );
    }
}
add_action( 'pre_get_posts', 'mts_include_category_homepage' );
/*----------------------------------------------------------------*/
/* Ende: Funktion, um nur bestimmte Kategorie-Beiträge auf der Startseite anzuzeigen 
/* Datum: 19.03.2019
/* Autor: hgg
/*----------------------------------------------------------------*/

/*----------------------------------------------------------------*/
/* Start: Funktion, um Beiträge einer bestimmten Kategorie nicht anzuzeigen 
/* Datum: 8.6.2020
/* Autor: hgg
/* hat nicht ganz funktioniert, daher jetzt über Plugin "Ultimate Category Excluder"
/*----------------------------------------------------------------

function theme_slug_exclude_categories( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', '-29' );
    }
}
add_action( 'pre_get_posts', 'theme_slug_exclude_categories' );
/*----------------------------------------------------------------*/
/* Ende: Funktion, um Beiträge einer bestimmten Kategorie nicht anzuzeigen 
/* Datum: 8.6.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

