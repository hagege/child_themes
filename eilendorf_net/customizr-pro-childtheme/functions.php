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
/* Start: WPCF7 > Übertragung Formular mit Excel-Tabelle
/* Datum: 6.2.2020
/* Autor: hgg
/*----------------------------------------------------------------*/

function get_xlsx_before_mail($WPCF7_ContactForm)
{
	$wpcf7 = WPCF7_ContactForm :: get_current() ;
	$submission = WPCF7_Submission :: get_instance() ;
	if ($submission) {
		$posted_data = $submission->get_posted_data();
		if ( empty ($posted_data))
			return ;
		$mail = $WPCF7_ContactForm->prop('mail');
		if($posted_data['Institution'] == 'Verein'){
			$mail['body'] = str_replace('@@PLACEHOLDER@@','Anzahl Personen: '.$posted_data['AnzahlPersonen'],$mail['body']);
			
			$data = array(
				array('Institution', 'Institutionsname', 'Straße', 'PLZ', 'Ort','Anzahl zahlende Personen', 'Vorname', 'Name', 'E-Mail'),
				array($posted_data['Institution'], $posted_data['institutionsname'], $posted_data['str'], $posted_data['plz'], $posted_data['ort'], $posted_data['AnzahlPersonen'], $posted_data['first-name'], $posted_data['last-name'], $posted_data['your-email'])
			);
      /* hgg, 13.02.2020. Nicht mehr verwendet:
			$writer = new XLSXWriter();
			$writer->writeSheet($data);
			$writer->writeToFile('wp-content/form/'.$posted_data['last-name'].$posted_data['first-name'].'.xlsx');
       hgg, 13.02.2020. Nicht mehr verwendet: */
		}
				else{
			$mail['body'] = str_replace('@@PLACEHOLDER@@','Anzahl Betreuer / Erwachsene: '.$posted_data['AnzahlBetreuer'].' , Anzahl Kinder: '.$posted_data['AnzahlKinder']. ' , Alter der Kinder: '.$posted_data['alter_kinder'],$mail['body']);
			
			$kk = floor ($posted_data['AnzahlKinder'] / 10);
			$freeBetreuer = $posted_data['AnzahlBetreuer'] - $kk;
			if($freeBetreuer < 0)
				$freeBetreuer = 0;
			$data = array(
				array('Institution', 'Institutionsname', 'Straße', 'PLZ', 'Ort','Anzahl zahlende Personen', 'Vorname', 'Name', 'E-Mail'),
				array($posted_data['Institution'], $posted_data['institutionsname'], $posted_data['str'], $posted_data['plz'], $posted_data['ort'], $posted_data['AnzahlKinder'] + $freeBetreuer, $posted_data['first-name'], $posted_data['last-name'], $posted_data['your-email'])
			);
      /* hgg, 13.02.2020. Nicht mehr verwendet:
			$writer = new XLSXWriter();
			$writer->writeSheet($data);
			$writer->writeToFile('wp-content/form/'.$posted_data['last-name'].$posted_data['first-name'].'.xlsx');
       hgg, 13.02.2020. Nicht mehr verwendet: */
		}
			
		if($posted_data['newsletter']){
			$timestamp = time();
			$datum = date("d.m.Y - H:i:s", $timestamp);
			$mail['body'] = str_replace('@@PLACEHOLDER2@@', 'ja , Zeitpunkt der Zustimmung: '.$datum ,$mail['body']);
      // hgg, 13.02.2020. Nicht mehr verwendet:
			$path = 'form/'.$posted_data['last-name'].$posted_data['first-name'].'.xlsx';
			$mail['attachments'] = $path;
      // hgg, 13.02.2020: Zusätzliche Felder ausgeben
      $mail['body'] = str_replace('@@PLACEHOLDER3@@', $posted_data['Institution'] . "\n" . $posted_data['institutionsname'] . "\n" . $posted_data['str'] . "\n" . $posted_data['plz'] . "\n" . $posted_data['ort'] . "\n" . $posted_data['first-name'] . "\n" . $posted_data['last-name'] . "\n" . $posted_data['your-email'], $mail['body']);
      // Alternative: Auflistung mit Komma und dann in Excel > Daten > Text in Spalten
      // hat aber leider beim Test nicht ganz sauber funktioniert, wenn z. B. ein Komma im Text übergeben wird.
      // $mail['body'] = str_replace('@@PLACEHOLDER3@@', $posted_data['Institution'] . ", " . $posted_data['institutionsname'] . ", " . $posted_data['str'] . ", " . $posted_data['plz'] . ", " . $posted_data['ort'] . ", " . $posted_data['first-name'] . ", " . $posted_data['last-name'] . ", " . $posted_data['your-email'], $mail['body']);
		} else {
			$mail['body'] = str_replace('@@PLACEHOLDER2@@', 'nein',$mail['body']);
		}
		
		$WPCF7_ContactForm->set_properties( array("mail" => $mail)) ;
		return $WPCF7_ContactForm ;
	}
}
add_action('wpcf7_before_send_mail','get_xlsx_before_mail');
	
function clean_xlsx($WPCF7_ContactForm){
	$submission = WPCF7_Submission :: get_instance();
	$posted_data = $submission->get_posted_data();
	unlink('wp-content/form/'.$posted_data['last-name'].$posted_data['first-name'].'.xlsx');
}
add_action('wpcf7_mail_sent', 'clean_xlsx');
add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
add_action('wp_head', 'replacethiswithyourthemename_wcf7_datepickerfix');
function replacethiswithyourthemename_wcf7_datepickerfix(){
    ?><style>#ui-datepicker-div {z-index:99!important;}</style><?php
};
add_filter( 'wpcf7_validate_select*', 'custom_email_confirmation_validation_filter', 20, 2 );
function custom_email_confirmation_validation_filter( $result, $tag ) {
	if ('Institution' == $tag->name) {
		$selected_field = $_POST['Institution'];
		if ( $selected_field == "---" ) {
			$result->invalidate( $tag, "Bitte Institution auswählen!" );
		}
	}
	if ('anrede' == $tag->name) {
		$selected_field = $_POST['anrede'];
		if ( $selected_field == "---" ) {
			$result->invalidate( $tag, "Bitte Anrede auswählen!" );
		}
	}
	return $result;
};

/*----------------------------------------------------------------*/
/* Ende: WPCF7 > Übertragung Formular mit Excel-Tabelle
/* Datum: 6.2.2020
/* Autor: hgg
/*----------------------------------------------------------------*/



?>
