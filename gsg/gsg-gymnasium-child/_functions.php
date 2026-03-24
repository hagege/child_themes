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

/**
 * Add Google Fonts - Inter
 */
function gsg_add_google_fonts() {
    wp_enqueue_style(
        'gsg-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'gsg_add_google_fonts');

/**
 * Include Block Patterns
 */
require_once get_stylesheet_directory() . '/patterns.php';

/**
 * Disable Widgets Menu (FSE Theme)
 * Block Themes should not show Widgets menu
 */
function gsg_remove_widgets_menu() {
    remove_submenu_page('themes.php', 'widgets.php');
}
add_action('admin_menu', 'gsg_remove_widgets_menu', 999);

/**
 * Disable Classic Menus (FSE uses Navigation Block)
 * Hide the old Appearance > Menus
 */
function gsg_remove_menus_page() {
    remove_submenu_page('themes.php', 'nav-menus.php');
}
add_action('admin_menu', 'gsg_remove_menus_page', 999);

/**
 * Remove Theme Support for Menus and Widgets
 * This ensures no widgets or classic menus are registered
 */
function gsg_remove_theme_support() {
    // Remove widgets support
    remove_theme_support('widgets');
    remove_theme_support('widgets-block-editor');
    
    // Remove custom header/background (not needed for FSE)
    remove_theme_support('custom-header');
    remove_theme_support('custom-background');
}
add_action('after_setup_theme', 'gsg_remove_theme_support', 11);

/**
 * Cleanup WordPress head
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Add security headers
 */
function gsg_add_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'gsg_add_security_headers');

/**
 * Add custom body classes
 */
function gsg_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'gsg-home';
    }
    
    if (!is_front_page()) {
        $classes[] = 'inner-page';
    }
    
    return $classes;
}
add_filter('body_class', 'gsg_body_classes');
