<?php
/**
 * WordCampRole
 *
 * @package       WCROLE
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   WordCampRole
 * Plugin URI:    https://haurand.com
 * Description:   A Plugin for limited access to a website - show only posts with the category WordCamp
 * Version:       1.0.0
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   wordcamprole
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with WordCampRole. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

/**
 * Requires at least: 5.0
 * Requires PHP: 5.6
 */

// Restrict access to posts in the "wordcamp" category for WC role users
add_action( 'template_redirect', 'restrict_wordcamp_category_access' );
function restrict_wordcamp_category_access() {
    $allowed_role = 'wc';
    $restricted_category = 'wordcamp';

    if ( is_single() && has_category( $restricted_category ) && !current_user_can( $allowed_role ) ) {
        wp_redirect( home_url() );
        exit;
    }
}