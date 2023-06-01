<?php
/*
Plugin Name: Bild Copyright
Plugin URI: http://haurand.com
Description: A plugin to show copyright of an image
Version: 0.1
Author: Hans-Gerd Gerhards
Author URI: http://haurand.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*----------------------------------------------------------------*/
/* Start: Shortcode zur Anzeige des Copyrights
/* Datum: 11.11.2021
/* Autor: hgg
/* Aufruf mit [bild_copyright]
/* Definition z. Zt. in custom.css
/*---------------------------------------------------------------- */
add_shortcode( 'bild_copyright', 'bild_shortcode' );
function bild_shortcode () {
  $bild_unterschrift = '<p class="em_bild">' . get_post(get_post_thumbnail_id())->post_excerpt  . '</p>';
  return $bild_unterschrift;
}
/*----------------------------------------------------------------*/
/* Ende: Shortcode zur Anzeige des Copyrights
/* Datum: 11.11.2021
/* Autor: hgg
/*---------------------------------------------------------------- */