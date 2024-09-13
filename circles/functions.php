<?php
/**
 * Circles functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Circles
 * @since Circles 0.5
 */


/**
 * Register pattern categories.
 */

if ( ! function_exists( 'circles_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Circles 1.0
	 * @return void
	 */
	function circles_pattern_categories() {

		register_block_pattern_category(
			'circles_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'circles' ),
				'description' => __( 'A collection of full page layouts.', 'circles' ),
			)
		);
	}
endif;

add_action( 'init', 'circles_pattern_categories' );
