<?php
/**
 * haurand modified query loop
 *
 * @package       HAURANDMOD
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.3
 *
 * @wordpress-plugin
 * Plugin Name:   haurand modified query loop
 * Plugin URI:    https://haurand.com
 * Description:   Sorts posts in "Wartung" category by update date (descending - newest first) and displays all posts in a individual category (f. e. Wartung).
 * Version:       0.3
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   haurand-modified-query-loop
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with haurand modified query loop. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function custom_category_sort_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_category() ) {
		return;
	}

	$category = get_queried_object();
	if ( ! $category || ! in_array( $category->slug, array( 'wartung', 'hans-gerd', 'regina' ), true ) ) {
		return;
	}

	$query->set( 'posts_per_page', -1 );
	$query->set( 'orderby', 'modified' );
	$query->set( 'order', 'DESC' ); // FIX: ASC → DESC (neueste zuerst)
}
add_action( 'pre_get_posts', 'custom_category_sort_query' );