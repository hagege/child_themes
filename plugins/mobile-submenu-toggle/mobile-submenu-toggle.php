<?php
/**
 * Mobile Submenu Toggle
 *
 * @package       MOBILESUBM
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.2
 *
 * @wordpress-plugin
 * Plugin Name:   Mobile Submenu Toggle
 * Plugin URI:    https://haruand.com
 * Description:   Makes submenus in the mobile menu expandable and closes the menu when clicked.
 * Version:       0.2
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

// set version.
const MST_VERSION = '0.2';


  /**
 * Enqueue script.
 *
 * @return void
 */
function mst_css_enqueue(): void {
	wp_enqueue_script(
		'mst_css',
		plugins_url( 'assets/css/mobile-menu.css', __FILE__ ),
		array(),
		MST_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'mst_css_enqueue' );

function mst_js_enqueue(): void {
	wp_enqueue_script(
		'mst_js',
		plugins_url( 'assets/js/mobile-menu.js', __FILE__ ),
		array(),
		MST_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'mst_js_enqueue' );
