<?php
/**
 * GSG Gymnasium Child Theme Functions
 * 
 * @package GSG_Child
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue parent and child theme styles
 */
function gsg_child_enqueue_styles() {
    // Parent theme stylesheet
    wp_enqueue_style(
        'ollie-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );
    
    // Child theme stylesheet
    wp_enqueue_style(
        'gsg-child-style',
        get_stylesheet_uri(),
        array('ollie-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'gsg_child_enqueue_styles');


// Copyright Shortcode: [copyright_notice]
add_shortcode( 'copyright_notice', 'copyright_notice_shortcode' );

function copyright_notice_shortcode() {
    return sprintf(
        '© %d %s | erstellt von <a href="https://haurand.com">haurand.com</a>',
        intval( current_time( 'Y' ) ),
        esc_html( get_bloginfo( 'name' ) )
    );
}

/* Vollbildmodus deaktivieren */
function jba_disable_editor_fullscreen_by_default() {
    $script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
    wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'jba_disable_editor_fullscreen_by_default' );


/**
 * Disable welcome guides in Gutenberg.
 */
function my_disable_welcome_guides() {
	wp_add_inline_script( 'wp-data', "window.onload = function() {
	const selectPost = wp.data.select( 'core/edit-post' );
	const selectPreferences = wp.data.select( 'core/preferences' );
	const isFullscreenMode = selectPost.isFeatureActive( 'fullscreenMode' );
	const isWelcomeGuidePost = selectPost.isFeatureActive( 'welcomeGuide' );
	const isWelcomeGuideWidget = selectPreferences.get( 'core/edit-widgets', 'welcomeGuide' );
	
	if ( isWelcomeGuideWidget ) {
		wp.data.dispatch( 'core/preferences' ).toggle( 'core/edit-widgets', 'welcomeGuide' );
	}
	
	if ( isFullscreenMode ) {
		wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' );
	}
	
	if ( isWelcomeGuidePost ) {
		wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'welcomeGuide' );
	}
}" );
}

add_action( 'enqueue_block_editor_assets', 'my_disable_welcome_guides', 20 );


/**
 * Default Featured Image (Beitragsbild) nur für Beiträge (post) aktivieren,
 * nicht für Seiten (page) und Events (My Calendar).
 */
function dfi_only_for_posts($dfi_id, $post_id) {
    $post = get_post($post_id);
    
    // Nur für Beiträge (post_type = 'post') das Fallback-Bild zurückgeben
    if ($post->post_type !== 'post') {
        return null; // Kein Fallback-Bild für Seiten, Events, etc.
    }
    
    return $dfi_id; // Original-Fallback-Bild für Beiträge
}

add_filter('dfi_thumbnail_id', 'dfi_only_for_posts', 10, 2);