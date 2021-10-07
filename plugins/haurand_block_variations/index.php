<?php
/**
Plugin Name: Haurand Block Variations
Plugin URI: https://haurand.com
Description: Variante für den Medien-Text-Block mit runden Bildern
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
function haurand_variante_medien_text_block() {
	wp_enqueue_script('haurand-block-styles-js', 
		plugins_url( '/block-variations.js', __FILE__ ), 
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ), filemtime( plugin_dir_path( __FILE__ ) . '/block-variations.js' )	);
}
add_action( 'enqueue_block_editor_assets', 'haurand_variante_medien_text_block' );

/**
Enqueue Block Styles Stylesheet
*/
function haurand_variante_medien_text_block_styles() {
	wp_enqueue_style( 'haurand-block-styles-css', plugins_url( '/block-variations-styles.css', __FILE__ ));
}
add_action( 'enqueue_block_assets', 'haurand_variante_medien_text_block_styles' );