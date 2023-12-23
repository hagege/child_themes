<?php
/**
 * Disable Admin Bar in Maintenance Mode
 *
 * @package       DISABLEADM
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.2
 *
 * @wordpress-plugin
 * Plugin Name:   Disable Admin Bar in Maintenance Mode
 * Plugin URI:    https://haurand.com
 * Description:   A plugin with which the admin bar in WordPress can be optionally deactivated in maintenance mode
 * Version:       0.2
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

// Add a checkbox option in the WordPress admin under Settings > General
function maintenance_mode_admin_bar_option() {
    add_settings_field(
        'maintenance_mode_admin_bar_checkbox',
        'Deactivate Admin Bar in Maintenance Mode',
        'maintenance_mode_admin_bar_checkbox_callback',
        'general'
    );
    register_setting('general', 'maintenance_mode_admin_bar_checkbox', 'intval');
}

add_action('admin_init', 'maintenance_mode_admin_bar_option');

// Callback function to render the checkbox
function maintenance_mode_admin_bar_checkbox_callback() {
    $option = get_option('maintenance_mode_admin_bar_checkbox');
    echo '<input type="checkbox" id="maintenance_mode_admin_bar_checkbox" name="maintenance_mode_admin_bar_checkbox" value="1" ' . checked(1, $option, false) . ' />';
    echo '<label for="maintenance_mode_admin_bar_checkbox">Deactivate the admin bar during maintenance mode</label>';
}

// Check if maintenance mode is active and admin bar should be deactivated
function check_maintenance_mode() {
    $maintenance_mode_option = get_option('maintenance_mode_admin_bar_checkbox');
    if ($maintenance_mode_option == 1 && is_user_logged_in()) {
        add_filter('show_admin_bar', '__return_false');
    }
}

add_action('init', 'check_maintenance_mode');

