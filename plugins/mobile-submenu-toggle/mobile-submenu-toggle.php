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
/**
 * Enqueue plugin assets (CSS/JS) with automatic versioning using filemtime.
 */
function mst_enqueue_assets(): void {
	$css_path = plugin_dir_path( __FILE__ ) . 'assets/css/mobile-menu.css';
	$css_url  = plugins_url( 'assets/css/mobile-menu.css', __FILE__ );
	$js_path  = plugin_dir_path( __FILE__ ) . 'assets/js/mobile-menu.js';
	$js_url   = plugins_url( 'assets/js/mobile-menu.js', __FILE__ );

	if ( file_exists( $css_path ) ) {
		wp_enqueue_style(
			'mst_css',
			$css_url,
			array(),
			filemtime( $css_path )
		);
	}

	if ( file_exists( $js_path ) ) {
		wp_enqueue_script(
			'mst_js',
			$js_url,
			array(),
			filemtime( $js_path ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'mst_enqueue_assets' );