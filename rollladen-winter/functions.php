<?php


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
/* Start: Text vor dem loop
/* Datum: 22.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
// Add some text after the header - für theme customizr
/* Nicht genutzt für Bubenheimer Spieleland: 
add_action( '__before_loop' , 'add_promotional_text' );
function add_promotional_text() {
  // If we're not on the home page, do nothing
  if ( !is_front_page() )
    return;
  // Echo the html
  echo "<div class='ackids'><strong>aachenerkinder.de</strong> - Internetportal für Familien und Kinder in der Städteregion Aachen und Umgebung mit Freizeitangeboten und Veranstaltungen, Terminen, vielen Infos und Tipps – Online-Familienzeitung.</div><br>";
}
/*----------------------------------------------------------------*/
/* Ende: Text vor dem loop
/* Datum: 22.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/


/*----------------------------------------------------------------*/
/* Start: Anzeige image in der Beitragsliste
/* Datum: 25.12.2018
/* Autor: hgg
/*----------------------------------------------------------------

add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
  $columns = array_slice($columns, 0, 1, true) + array("img" => "Beitragsbild") + array_slice($columns, 1, count($columns) - 1, true);
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
/* Start: Wartungsmodus
/* Datum: 26.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
/*
function wpr_maintenance_mode() {
 if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
  ?><div style="width: 100%; height: 100%; overflow: hidden; background-image: url(http://aachener-senioren.de/_test_/wp-content/uploads/2016/07/platzhalter_ferien_ocean-1149981_1280.jpg)">
  <?php
  $meldung = "<h1 style=\"text-align: center\">aachenerkinder.de</h1><p style=\"text-align: center\">Sorry, die Webseite befindet sich zur Zeit im Wartungsmodus.<br>Wir ändern gerade die Optik der Seite, aber außer der Optik ändert sich nichts.<br><br>Es wird leider noch ein wenig dauern, bis die Seite wieder zur Verfügung steht.<br>Wir gehen davon aus, dass aachenerkinder.de um ca. 6.30 Uhr wieder online ist.<br>Danke für Dein Verständnis.<br><br>Foto: pixabay.com</div>";
  wp_die($meldung);
 }
}
add_action('get_header', 'wpr_maintenance_mode');
*/
/*----------------------------------------------------------------*/
/* Ende: Wartungsmodus
/* Datum: 26.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/
  
?>
