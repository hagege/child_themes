<?php
/**
Plugin Name: Haurand Block Styles
Plugin URI: https://haurand.com
Description: Box-Variante für den Absatz-Block
Version: 1.0
Author: Hans-Gerd Gerhards
*/
/**
Register Custom Block Styles
*/
if ( ! defined( 'ABSPATH' ) ) exit;
/**
Enqueue Block Styles Javascript
*/
function haurand_absatz_box() {
	wp_enqueue_script(
		'haurand-block-styles-js', plugins_url( '/blocks.js', __FILE__ ), array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), filemtime( plugin_dir_path( __FILE__ ) . '/blocks.js' )
	);
}
add_action( 'enqueue_block_editor_assets', 'haurand_absatz_box' );

/**
Enqueue Block Styles Stylesheet
*/
function haurand_absatz_box_styles() {
	wp_enqueue_style( 'haurand-block-styles-css', plugins_url( '/block-styles.css', __FILE__ ));
}
add_action( 'enqueue_block_assets', 'haurand_absatz_box_styles' );