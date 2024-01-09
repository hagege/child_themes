<?php
/**
 * sort_post_by_modified_date
 *
 * @package       SORTPOST
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   sort_post_by_modified_date
 * Plugin URI:    https://haurand.com
 * Description:   Sorts the posts in the backend not by publication date, but by update date
 * Version:       0.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   sort_post_by_modified_date
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with sort_post_by_modified_date. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

function sort_by_modified( $wp_query ) {
    global $pagenow;
    if ( is_admin() && 'edit.php' == $pagenow) {
        $wp_query->set( 'orderby', 'modified' );
        $wp_query->set( 'order', 'DESC' );
    }
}
add_filter('pre_get_posts', 'sort_by_modified' );

