<?php
/**
 * Plugin Name:       ARIA Block Controls
 * Plugin URI:        https://wordpress.org/plugins/aria-block-controls
 * Description:       Add optional ARIA attributes to all WordPress blocks through the Advanced panel, with special handling for button blocks.
 * Version:           0.1.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            WordPress Telex
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       aria-block-controls
 *
 * @package AriaBlockControls
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue block editor assets
 */
function aria_block_controls_enqueue_editor_assets() {
	$asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

	wp_enqueue_script(
		'aria-block-controls-editor',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version'],
		true
	);

	wp_enqueue_style(
		'aria-block-controls-editor',
		plugins_url( 'build/index.css', __FILE__ ),
		array(),
		$asset_file['version']
	);
}
add_action( 'enqueue_block_editor_assets', 'aria_block_controls_enqueue_editor_assets' );

/**
 * Add ARIA attributes to block wrapper
 */
function aria_block_controls_render_block( $block_content, $block ) {
	if ( empty( $block['attrs'] ) ) {
		return $block_content;
	}

	$aria_label = isset( $block['attrs']['ariaLabel'] ) ? $block['attrs']['ariaLabel'] : '';
	$aria_labelledby = isset( $block['attrs']['ariaLabelledby'] ) ? $block['attrs']['ariaLabelledby'] : '';
	$aria_describedby = isset( $block['attrs']['ariaDescribedby'] ) ? $block['attrs']['ariaDescribedby'] : '';
	$custom_aria = isset( $block['attrs']['customAria'] ) ? $block['attrs']['customAria'] : '';

	if ( empty( $aria_label ) && empty( $aria_labelledby ) && empty( $aria_describedby ) && empty( $custom_aria ) ) {
		return $block_content;
	}

	$aria_attributes = array();

	if ( ! empty( $aria_label ) ) {
		$aria_attributes[] = sprintf( 'aria-label="%s"', esc_attr( $aria_label ) );
	}

	if ( ! empty( $aria_labelledby ) ) {
		$aria_attributes[] = sprintf( 'aria-labelledby="%s"', esc_attr( $aria_labelledby ) );
	}

	if ( ! empty( $aria_describedby ) ) {
		$aria_attributes[] = sprintf( 'aria-describedby="%s"', esc_attr( $aria_describedby ) );
	}

	if ( ! empty( $custom_aria ) ) {
		$custom_attributes = array_map( 'trim', explode( ',', $custom_aria ) );
		foreach ( $custom_attributes as $attr ) {
			if ( strpos( $attr, '=' ) !== false ) {
				list( $key, $value ) = array_map( 'trim', explode( '=', $attr, 2 ) );
				if ( strpos( $key, 'aria-' ) === 0 ) {
					$aria_attributes[] = sprintf( '%s="%s"', esc_attr( $key ), esc_attr( $value ) );
				}
			}
		}
	}

	if ( empty( $aria_attributes ) ) {
		return $block_content;
	}

	$aria_string = ' ' . implode( ' ', $aria_attributes );

	if ( isset( $block['blockName'] ) && strpos( $block['blockName'], 'core/button' ) !== false ) {
		$block_content = preg_replace(
			'/(<a\s+[^>]*)(>)/i',
			'$1' . $aria_string . '$2',
			$block_content,
			1
		);
	} else {
		$processor = new WP_HTML_Tag_Processor( $block_content );
		if ( $processor->next_tag() ) {
			foreach ( $aria_attributes as $attr_string ) {
				if ( preg_match( '/([a-z-]+)="([^"]*)"/', $attr_string, $matches ) ) {
					$processor->set_attribute( $matches[1], $matches[2] );
				}
			}
			$block_content = $processor->get_updated_html();
		}
	}

	return $block_content;
}
add_filter( 'render_block', 'aria_block_controls_render_block', 10, 2 );
