<?php
/*
Plugin Name: Automatic PDF Link
Plugin URI: http://haurand.com
Description: A plugin to post automatic per shortcode an actual PDF-File as link
Version: 1.0
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
  $week_number_before = $week_number - 1;
  $week_number_after = $week_number + 1;
  $out = '<a href="';
  $out .= esc_url( $upload_dir['url'] . '/KW_' . $week_number . '_Wochenplan_SeniorenSport.pdf') . '">';
  $out .= 'Aktuellen Wochenplan ansehen und herunterladen - KW - ' . $week_number;
  $out .= '</a>';

  return $out;
}