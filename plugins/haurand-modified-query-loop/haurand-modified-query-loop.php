<?php
/**
 * haurand modified query loop
 *
 * @package       HAURANDMOD
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.2
 *
 * @wordpress-plugin
 * Plugin Name:   haurand modified query loop
 * Plugin URI:    https://haurand.com
 * Description:   Sorts posts in "Wartung" category by update date (ascending) and displays all posts in a individual category (f. e. Wartung).
 * Version:       0.2
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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


// Function to modify the main query
function custom_category_sort_query( $query ) {
	// var_dump($query);
	// echo $query->is_category( 'wartung' );
	if (!is_admin() && ((is_category('wartung')) || (is_category('hans-gerd')) || (is_category('regina')))) {
		$query->set( 'posts_per_page', -1 ); // Display all posts
		$query->set( 'orderby', 'modified' );
	    $query->set( 'order', 'ASC' ); // Order by ascending (oldest first)
	}
}
add_action( 'pre_get_posts', 'custom_category_sort_query' );
