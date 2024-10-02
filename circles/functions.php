<?php
/**
 * Circles functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Circles
 * @since Circles 0.5
 */


if ( ! function_exists( 'circles_styles' ) ) :
	/**
	 * Enqueue main stylesheet.
	 *
	 * @since Circles 0.5
	 *
	 * @return void
	 */
	function circles_styles() {

		$theme_version  = wp_get_theme()->get( 'Version' );
		$version_string = is_string( $theme_version ) ? $theme_version : false;

		// Register theme stylesheet.
		wp_register_style(
			'circles-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'circles-style' );
	}

endif;

add_action( 'wp_enqueue_scripts', 'circles_styles' );

if ( ! function_exists( 'circles_editor_styles' ) ) :
	/**
	 * Enqueue style.css into the editor.
	 *
	 * @since circles 0.5
	 *
	 * @return void
	 */
	function circles_editor_styles() {

		// Enqueue theme stylesheet there are custom styles.
		add_editor_style( 'style.css' );
	}

endif;

add_action( 'admin_init', 'circles_editor_styles' );

/**
	* Register pattern categories.
 */

function circles_register_pattern_categories() {
	/**
	 * Register pattern categories.
	 *
	 * @since circles 0.5
	 *
	 * @return void
	 */
	register_block_pattern_category(
		'circles_patterns',
			array( 
				'label' => __( 'Circles Patterns', 'Block pattern category', 'circles' ), 
				'description' => __( 'A collection of Circles Patterns.', 'circles' ),
		)
	);
}

add_action( 'init', 'circles_register_pattern_categories' );
