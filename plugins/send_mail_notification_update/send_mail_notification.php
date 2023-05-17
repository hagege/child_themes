<?php
/**
 * @package Send Mail Notification
 * @version 0.1
 */
/*
Plugin Name: Send Mail Notification
Plugin URI: http://haurand.com
Description: Send Mail Notification to owner of a wordpress website
Author: Hans-Gerd Gerhards
Version: 0.1
Author URI: http://haurand.com
*/
add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

$to = 'gerhards@haurand.com';
$subject = 'Wartungsvertrag: Updates durchgeführt';
$body = 'Hallo, <br>wir haben gerade einige Plugins im Rahmen des Wartungsvertrages aktualisiert und anschließend die Website getestet. <br>Bitte prüfen Sie sicherheitshalber auch noch mal die Website, ob alles ok ist. <br>Viele Grüße<br>Hans-Gerd Gerhards<br>haurand.com ';

wp_mail( $to, $subject, $body );

// Reset content-type to avoid conflicts -- https://core.trac.wordpress.org/ticket/23578
remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

function wpdocs_set_html_mail_content_type() {
	return 'text/html';
} 