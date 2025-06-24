<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package shrinkingLO
 */

// if uninstall.php is not called by WordPress, die.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Delete Options
delete_option( 'slsh_header_shrink_height' );
delete_option( 'slsh_animation_duration' );
delete_option( 'slsh_heigth_header' );
delete_option( 'slsh_logo_in_header_shrink_height' );
delete_option( 'slsh_enable_nav_css' );
delete_option( 'slsh_nav_breakpoint' );
delete_option( 'slsh_enable_off_canvas' );
delete_option( 'slsh_logo_in_header_shrink_left' );
delete_option( 'slsh_enable_background_color' );
