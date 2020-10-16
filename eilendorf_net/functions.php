<?php

// include_once("xlsxwriter.class.php");

function child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'additional-style', get_stylesheet_directory_uri() . '/parallax_scrolling.css' ); 
  /* echo get_stylesheet_directory_uri() . '/parallax_scrolling.css'; */
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
/* Start: Anzeige image in der Beitragsliste
/* Datum: 25.12.2018
/* Autor: hgg
/*----------------------------------------------------------------*/

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
/* Start: Anzeige von GPX Tarckings
/* Datum: 15.10.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

// Beispiel-Aufruf: [gpx_tracking gpx_name="Urbanstr_Rathaus"]
// z. Zt. kann immer nur ein Shortcode auf der Seite ausgegeben werden.
function hole_gpx_tracking( $atts ) {
	$werte = shortcode_atts( array(
		'gpx_name' => '',
	), $atts);
    // echo $werte['gpx_name'];
    // $filepath = 'http://eilendorf.net.test/wp-content/uploads/gpx/eilendorf/Urbanstr_Rathaus.gpx';
    $filepath = 'http://eilendorf.net.test/wp-content/uploads/gpx/eilendorf/' . $werte['gpx_name'] . '.gpx';
    // $filepath = 'http://test.hochzeitwebseiten.de/wp-content/uploads/gpx/eilendorf/' . $werte['gpx_name'] . '.gpx';
    // $filepath = 'http://hochzeitwebseiten.de/_test_/wp-content/uploads/gpx/allgemein/Urbanstr_Rathaus.gpx';
    /* Problem mit der Funktion gpx_view - nur ein shortcode möglich. Deswegen funktioniert folgender code nicht:
    echo "<ul>";
    foreach ($werte as $gpx)
      {
          echo "<li>Eintrag: $gpx </li>";
          $filepath = 'http://eilendorf.net.test/wp-content/uploads/gpx/eilendorf/' . $gpx . '.gpx';
          echo $filepath;
          echo gpx_view(array('src'  => $filepath));
      }
    echo "</ul>";  
    */
    /* echo $werte['gpx_name']; */
    $ausgabe = gpx_view(array('src'  => $filepath));
    /*                $filepath = <absolute path>/wp-content/uploads/gpx/<mycategory>/<file>.gpx 
                    [, 'title' => $track_name]
                    [, 'color' => $track_color]
                    [, 'width' => $track_width] ));
    */
	return $ausgabe;
}
add_shortcode( 'gpx_tracking', 'hole_gpx_tracking' );   


?>
