<?php
/**
* Child theme stylesheet einbinden in Abhängigkeit vom Original-Stylesheet
*/

function child_theme_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style( 'child-theme-css', get_stylesheet_directory_uri() .'/style.css' , array('parent-style'));

}
add_action( 'wp_enqueue_scripts', 'child_theme_styles' );


add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

function hgg_cf7_activate_scripts() {
	if (is_page('Kontakt') || is_page('253')) {
		add_filter( 'wpcf7_load_js', '__return_true' );
		add_filter( 'wpcf7_load_css', '__return_true' );
	}
}

add_action( 'get_header', 'hgg_cf7_activate_scripts' );