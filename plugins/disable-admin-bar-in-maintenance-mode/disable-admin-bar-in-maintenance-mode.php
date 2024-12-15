<?php
/**
 * Disable Admin Bar in Maintenance Mode
 *
 * @package DISABLEADM
 * @author Hans-Gerd Gerhards
 * @license gplv2
 * @version 0.1.1
 *
 * @wordpress-plugin
 * Plugin Name:   Disable Admin Bar in Maintenance Mode
 * Plugin URI:    https://haurand.com
 * Description:   A plugin with which the admin bar in WordPress can be optionally deactivated in maintenance mode
 * Version:       0.1.1
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
if (!defined('ABSPATH')) {
    exit;
}

// Add settings to the WordPress admin menu
function maintenance_mode_admin_bar_menu()
{
    add_options_page('Maintenance Mode Admin Bar Settings', 'Maintenance Mode Admin Bar', 'manage_options', 'maintenance-mode-admin-bar', 'maintenance_mode_admin_bar_page');
}

add_action('admin_menu', 'maintenance_mode_admin_bar_menu');

// Callback function to render the settings page
function maintenance_mode_admin_bar_page()
{
    ?>
    <div class="wrap">
        <h1>Maintenance Mode Admin Bar Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('maintenance_mode_admin_bar_settings_group');?>
            <?php do_settings_sections('maintenance-mode-admin-bar');?>
            <?php submit_button();?>
        </form>
    </div>
    <?php
}

// Register settings and fields
function maintenance_mode_admin_bar_settings()
{
    register_setting('maintenance_mode_admin_bar_settings_group', 'disable_admin_bar');

    add_settings_section('maintenance_mode_admin_bar_main_section', 'Admin Bar Settings', 'maintenance_mode_admin_bar_section_text', 'maintenance-mode-admin-bar');

    add_settings_field('disable_admin_bar', 'Deactivate Admin Bar in Maintenance Mode', 'disable_admin_bar_checkbox', 'maintenance-mode-admin-bar', 'maintenance_mode_admin_bar_main_section');
}

add_action('admin_init', 'maintenance_mode_admin_bar_settings');

// Section text callback
function maintenance_mode_admin_bar_section_text()
{
    echo '<p>Configure admin bar settings during maintenance mode.</p>';
}

// Admin bar deactivated checkbox callback
function disable_admin_bar_checkbox()
{
    $disable_admin_bar = get_option('disable_admin_bar');
    echo '<input type="checkbox" id="disable_admin_bar" name="disable_admin_bar" value="1" ' . checked(1, $disable_admin_bar, false) . ' />';
    echo '<label for="disable_admin_bar">Deactivate admin bar during maintenance mode</label>';
}

// Check if maintenance mode is active and admin bar should be deactivated
function check_maintenance_mode()
{
    $disable_admin_bar = get_option('disable_admin_bar');
    $maintenance_mode_active = get_option('maintenance_mode_active');

    if ($disable_admin_bar && $maintenance_mode_active && is_user_logged_in()) {
        add_filter('show_admin_bar', '__return_false');
    }
}

add_action('init', 'check_maintenance_mode');