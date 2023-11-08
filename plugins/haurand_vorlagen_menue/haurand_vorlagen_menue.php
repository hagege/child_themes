<?php
/*
Plugin Name:  Menueoption Vorlagen
Plugin URI:   https://haurand.com
Description:  Menüpunkt im Backend zu Vorlagen (Patterns)
Version:      0.1.2
Author:       HG Gerhards
Author URI:   https://haurand.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  backend-feature
Domain Path:  /languages
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/* Menüpunkt zu Vorlagen:*/
function patterns_admin_menu() {
add_menu_page( 'Vorlagen', 'Vorlagen', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
}
add_action( 'admin_menu', 'patterns_admin_menu' );