<?php
/**
 * Disable Admin Bar in Maintenance Mode
 *
 * @package       DISABLEADM
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.3.1
 *
 * @wordpress-plugin
 * Plugin Name:   Disable Admin Bar in Maintenance Mode
 * Plugin URI:    https://haurand.com
 * Description:   A plugin with which the admin bar in WordPress can be optionally deactivated in maintenance mode
 * Version:       0.3.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   disable-admin-bar-in-maintenance-mode
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Disable Admin Bar in Maintenance Mode. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Add settings to the WordPress admin menu
function maintenance_mode_admin_bar_menu() {
    add_options_page('Maintenance Mode Admin Bar Settings', 'Maintenance Mode Admin Bar', 'manage_options', 'maintenance-mode-admin-bar', 'maintenance_mode_admin_bar_page');
}

add_action('admin_menu', 'maintenance_mode_admin_bar_menu');

// Callback function to render the settings page
function maintenance_mode_admin_bar_page() {
    ?>
    <div class="wrap">
        <h1>Maintenance Mode Admin Bar Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('maintenance_mode_admin_bar_settings_group'); ?>
            <?php do_settings_sections('maintenance-mode-admin-bar'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings and fields
function maintenance_mode_admin_bar_settings() {
    register_setting('maintenance_mode_admin_bar_settings_group', 'admin_bar_deactivated_roles');

    add_settings_section('maintenance_mode_admin_bar_main_section', 'Admin Bar Settings', 'maintenance_mode_admin_bar_section_text', 'maintenance-mode-admin-bar');

    $all_roles = wp_roles()->get_names();

    foreach ($all_roles as $role => $name) {
        add_settings_field("admin_bar_deactivated_roles_$role", "Deactivate Admin Bar for $name", 'admin_bar_deactivated_role_checkbox', 'maintenance-mode-admin-bar', 'maintenance_mode_admin_bar_main_section', array('role' => $role));
    }
}

add_action('admin_init', 'maintenance_mode_admin_bar_settings');

// Section text callback
function maintenance_mode_admin_bar_section_text() {
    echo '<p>Configure admin bar settings for each user role during maintenance mode.</p>';
}

// Admin bar deactivated role checkbox callback
function admin_bar_deactivated_role_checkbox($args) {
    $admin_bar_deactivated_roles = get_option('admin_bar_deactivated_roles');
    $role = $args['role'];

    echo '<input type="checkbox" id="admin_bar_deactivated_roles_' . esc_attr($role) . '" name="admin_bar_deactivated_roles[]" value="' . esc_attr($role) . '" ' . checked(in_array($role, $admin_bar_deactivated_roles), true, false) . ' />';
    echo '<label for="admin_bar_deactivated_roles_' . esc_attr($role) . '">Deactivate admin bar for ' . esc_html($role) . '</label>';
}

// Check if maintenance mode is active and admin bar should be deactivated
function check_maintenance_mode() {
    $maintenance_mode_active = get_option('maintenance_mode_active');
    $admin_bar_deactivated_roles = get_option('admin_bar_deactivated_roles');

    if ($maintenance_mode_active && is_user_logged_in()) {
        $user = wp_get_current_user();
        $user_roles = $user->roles;

        // Check if the user role should have the admin bar deactivated
        if (array_intersect($user_roles, $admin_bar_deactivated_roles)) {
            add_filter('show_admin_bar', '__return_false');
        }
    }
}

add_action('init', 'check_maintenance_mode');