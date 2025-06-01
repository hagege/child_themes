<?php
/**
 * Mobile Submenu Toggle
 *
 * @package       MOBILESUBM
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Mobile Submenu Toggle
 * Plugin URI:    https://haruand.com
 * Description:   Makes submenus in the mobile menu expandable and closes the menu when clicked.
 * Version:       0.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haruand.com
 * Text Domain:   mobile-submenu-toggle
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Mobile Submenu Toggle. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.


add_action( 'wp_enqueue_scripts', 'mobile_submenu_toggle_enqueue_scripts' );
function mobile_submenu_toggle_enqueue_scripts() {
    wp_enqueue_style( 'mobile-submenu-toggle', plugin_dir_url( __FILE__ ) . 'mobile-menu.css', array(), '1.0' );
    wp_enqueue_script( 'mobile-submenu-toggle', plugin_dir_url( __FILE__ ) . 'mobile-menu.js', array('jquery'), '1.0', true );
}
