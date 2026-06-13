<?php
/*
Plugin Name: Hidden Link Block
Description: Erstellt einen Block, mit dessen Hilfe ein unsichtbarer Link erstellt wird, sodass eine komplette Karte klickbar wird.
Version: 1.0
Author: HGG
*/

/**
 * CSS laden
 */
function hgg_hidden_link_enqueue_styles() {

	wp_enqueue_style(
		'hgg-hidden-link-style',
		plugin_dir_url( __FILE__ ) . 'style.css',
		[],
		filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
	);

}
add_action( 'wp_enqueue_scripts', 'hgg_hidden_link_enqueue_styles' );


/**
 * Block registrieren
 */
function hgg_hidden_link_block_register_block() {

	register_block_type(
		'hgg-hidden-link/hgg-hidden-link-block',
		[
			'title'    => 'Hidden-Link-Block',
			'icon'     => 'external',
			'category' => 'text',

			'attributes' => [
				'url' => [
					'type'    => 'string',
					'label'   => 'Linkziel',
					'default' => '',
				],
				'label' => [
					'type'    => 'string',
					'label'   => 'Aria-Label',
					'default' => 'Karte öffnen',
				],
			],

			'supports' => [
				'autoRegister' => true,
			],

			'render_callback' => 'hgg_hidden_link_block_render_block',
		]
	);

}
add_action( 'init', 'hgg_hidden_link_block_register_block' );


/**
 * Block ausgeben
 */
function hgg_hidden_link_block_render_block( $attributes ) {

	$url   = esc_url( $attributes['url'] ?? '' );
	$label = esc_attr( $attributes['label'] ?? 'Karte öffnen' );

	if ( empty( $url ) ) {
		return '';
	}

	return sprintf(
		'<a class="karte-link" href="%s" aria-label="%s"></a>',
		$url,
		$label
	);

}