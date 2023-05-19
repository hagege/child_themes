<?php
/*
Plugin Name: Automatic PDF Link
Plugin URI: http://haurand.com
Description: A plugin to post automatic per shortcode an actual PDF-File as link
Version: 0.2
Author: Hans-Gerd Gerhards
Author URI: http://haurand.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

add_shortcode( 'wochenplan' , 'wochenplan_shortcode' );
function wochenplan_shortcode(){
  $upload_dir = wp_upload_dir();
  /* https://seniorensport-attendorn.de/wp-content/uploads/2023/05/KW_21_Wochenplan_SeniorenSport.pdf */
  $week_number = date("W");
  for ($i=$week_number-1; $i <= $week_number+1; $i++) { 
	  $out .= '<li><a href="';
	  $out .= esc_url( $upload_dir['url'] . '/KW_' . $i . '_Wochenplan_SeniorenSport.pdf') . '">';
	  $out .= 'Aktuellen Wochenplan ansehen und herunterladen - KW - ' . $i;
	  $out .= '</a></li>';
  }
  return $out; 
}