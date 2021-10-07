<?php
/*
Plugin Name: Haurand Block Styles
Plugin URI: https://haurand.com
Description: Beipiel für Block-Styles bei Headern. Header werden verschiedenfarbig dargestellt, Auswahl bei den Eigenschaften
Author: Hans-Gerd Gerhards
Author URI: https://haurand.com (Quelle: Automattic: https://github.com/Automattic/gutenberg-block-styles/)
Version: 1.0




/**
 * 1. Register Custom Block Styles
 */
 
if ( ! defined( 'ABSPATH' ) ) exit;

if ( function_exists( 'register_block_style' ) ) {
	function haurand_block_styles() {
		/**
		 * Register stylesheet
		 */
		wp_register_style(
			'block-styles-stylesheet',
			plugins_url( 'style.css', __FILE__ ),
			array(),
			'1.2'
		);

		
		/* Headings */ 
        register_block_style(
			'core/heading',
			array(
	           'name'          => 'gradient-red-headline',
	           'label'         => 'Gradient rote Überschrift',
			   'style_handle'  => 'block-styles-stylesheet',
          	)
		);       
        register_block_style(
			'core/heading',
			array(
	           'name'          => 'gradient-blue-headline',
	           'label'         => 'Gradient blaue Überschrift',
			   'style_handle'  => 'block-styles-stylesheet',
          	)
		);       
        register_block_style(
			'core/heading',
			array(
	           'name'          => 'gradient-green-headline',
	           'label'         => 'Gradient grüne Überschrift',
			   'style_handle'  => 'block-styles-stylesheet',
          	)
		);       
        register_block_style(
			'core/heading',
			array(
	           'name'          => 'gradient-yellow-headline',
	           'label'         => 'Gradient gelbe Überschrift',
			   'style_handle'  => 'block-styles-stylesheet',
          	)
		);       
        register_block_style(
			'core/heading',
			array(
	           'name'          => 'gradient-grey-headline',
	           'label'         => 'Gradient graue Überschrift',
			   'style_handle'  => 'block-styles-stylesheet',
          	)
		);       
	}
    

	add_action( 'init', 'haurand_block_styles' );
}

