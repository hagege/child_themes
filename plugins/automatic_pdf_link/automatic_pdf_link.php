<?php
/*
Plugin Name: Automatic PDF Link
Plugin URI: http://haurand.com
Description: A plugin to post automatic per shortcode an actual PDF-File as link
Version: 0.4.3
Author: Hans-Gerd Gerhards
Author URI: http://haurand.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

add_shortcode( 'wochenplan' , 'wochenplan_shortcode' );
function wochenplan_shortcode(){
  $upload_dir = wp_upload_dir();
  $out = '';
  /* https://seniorensport-attendorn.de/wp-content/uploads/2023/05/KW_21_Wochenplan_SeniorenSport.pdf */ 
  $week_number = date("W");
  for ($i=$week_number-1; $i <= $week_number+1; $i++) { 
	  $pdf_file = $upload_dir['url'] . '/KW_' . $i . '_Wochenplan_SeniorenSport.pdf';
	  $pdf_file_name = 'KW_' . $i . '_Wochenplan_SeniorenSport.pdf';
  	  if(UR_exists($pdf_file)){
		  $out .= '<div class="pdf-button"><a href="';
		  $out .= esc_url( $pdf_file) . '">';
		  $out .= 'KW - ' . $i . ' - Hier klicken';
		  $out .= '</a></div>';
	  } else {
		  $out .= '<div class="pdf-button-not-found">Die Datei <strong>' . $pdf_file_name . '</strong> ist noch nicht oder nicht mehr vorhanden.</div>';
	  }
  }
  return $out;
}

function UR_exists($url){
	   $headers=get_headers($url);
	   return stripos($headers[0],"200 OK")?true:false;
}