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


add_action('wp_enqueue_scripts', function() {
  // CSS nur für mobile Geräte
  wp_enqueue_style('mobile-menu-css', plugins_url('mobile-menu.css', __FILE__), [], filemtime(__DIR__.'/mobile-menu.css'));

  // JavaScript mit Modernem Ansatz
  wp_enqueue_script('mobile-menu-js', plugins_url('mobile-menu.js', __FILE__), [], filemtime(__DIR__.'/mobile-menu.js'), true);
});
