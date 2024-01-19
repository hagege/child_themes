<?php
/*
Plugin Name: Haurand Block Styles
Plugin URI: https://haurand.com
Description: Beipiel für Block-Styles bei Headern. Header werden verschiedenfarbig dargestellt, Auswahl bei den Eigenschaften
Author: Hans-Gerd Gerhards
Author URI: https://haurand.com (Quelle: Automattic: https://github.com/Automattic/gutenberg-block-styles/)
Version: 1.1




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


		/* Absätze - paragraph */ 
		register_block_style(
			'core/paragraph',
			array(
				'name'         => 'blue-paragraph',
				'label'        => 'Absatz mit blauem Hintergrund',
				'style_handle' => 'block-styles-stylesheet',
			)
		);
		register_block_style(
			'core/paragraph',
			array(
				'name'         => 'haurand-paragraph',
				'label'        => 'Absatz mit Rahmen und Hintergrundfarbe',
				'style_handle' => 'block-styles-stylesheet',
			)
		);
		register_block_style(
			'core/paragraph',
			array(
				'name'         => 'haurand-paragraph-ligthgrey-border-top',
				'label'        => 'Absatz mit Linie oben, hellgrauer Hintergrund',
				'style_handle' => 'block-styles-stylesheet',
			)
		);		
		register_block_style(
			'core/paragraph',
			array(
				'name'         => 'full-width-Paragraph',
				'label'        => 'Absatz mit voller Breite',
				'style_handle' => 'block-styles-stylesheet',
			)
		);
		
		/* Buttons*/ 
        register_block_style( 
            'core/button', 
            array(
	           'name'          => 'fancy-button',
	           'label'         => 'Fancy Button',
  			   'style_handle'  => 'block-styles-stylesheet',
            )
        );
		
        /* Listen */ 
        register_block_style( 
            'core/list',
            array(
            	'name'         => '2col-list',
	            'label'        => '2-Spaltige Liste',
    			'style_handle' => 'block-styles-stylesheet',
            )
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

