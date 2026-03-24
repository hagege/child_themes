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

