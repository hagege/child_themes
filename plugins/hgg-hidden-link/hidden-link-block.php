<?php
/*
Plugin Name: Hidden Link Block (PHP-Only Block)
Description: Erstellt einen Block, mit dessen Hilfe ein unsichtbarer Link erstellt wird, 
so dass die ganze Karte klickbar wird. Notwendig sind allerdings noch die folgenden CSS-Regeln.
*/

function hgg_hidden_link_block_register_block() {

    // Schritt 1: CSS registrieren (eigentlich in dem Fall nicht notwendig
	add_action( 'wp_enqueue_scripts', function() {
		wp_enqueue_style(
			'hgg-hidden-link-style',
			plugin_dir_url( __FILE__ ) . 'style.css',
			[],
			filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
		);
	} );

    // Schritte 2 & 3: Block registrieren und autoRegister aktivieren. Color wäre nicht notwendig
    register_block_type( 'hgg-hidden-link/hgg-hidden-link-block', [
        'title'    => 'Hidden-Link-Block',
		'icon'     => 'external',         // Externer Link
        'category' => 'text',
        'attributes' => [
            'text' => [
                'type'    => 'string',
                'label'   => 'Hier bitte den Link eingeben:',
                'default' => '',
            ],
        ],
        'supports' => [
            'autoRegister' => true,
            'color' => [
                'text'       => true,
                'background' => true,
            ],
        ],
        'render_callback' => 'hgg_hidden_link_block_render_block',
    ] );
}
add_action( 'init', 'hgg_hidden_link_block_register_block' );

// Schritte 4 & 5: render_callback mit get_block_wrapper_attributes()
function hgg_hidden_link_block_render_block( $attributes ) {
    // $wrapper = get_block_wrapper_attributes();
    $text    = esc_url( $attributes['text'] ?? '' );
	
    return sprintf(
    '<a class="karte-link" href="%s" aria-label="Zur Karte"></a>',
    $text
);
}