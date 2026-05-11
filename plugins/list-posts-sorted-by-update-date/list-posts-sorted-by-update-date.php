<?php
/**
 * List Posts sorted by update date
 *
 * @package       LISTPOSTSS
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.3
 *
 * @wordpress-plugin
 * Plugin Name:   List Posts sorted by update date
 * Plugin URI:    https://haurand.com
 * Description:   the posts are listed sorted by update date in \"All posts\". 
 * Version:       0.3
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   list-posts-sorted-by-update-date
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with List Posts sorted by update date. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function hgg_custom_posts_orderby( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( 'post' !== $query->get( 'post_type' ) ) {
		return;
	}

	$orderby_options = array(
		'date'     => 'Date',
		'title'    => 'Title',
		'modified' => 'Last Modified',
	);

	$orderby_options = apply_filters( 'custom_posts_orderby_options', $orderby_options );

	$default_orderby = 'modified';
	$orderby         = isset( $_GET['orderby'] ) ? sanitize_key( wp_unslash( $_GET['orderby'] ) ) : $default_orderby;

	if ( ! array_key_exists( $orderby, $orderby_options ) ) {
		$orderby = $default_orderby;
	}

	$query->set( 'orderby', $orderby );
	
	// FIX: Sortierungsrichtung setzen (DESC = neueste zuerst)
	$query->set( 'order', 'DESC' );
}
add_action( 'pre_get_posts', 'hgg_custom_posts_orderby' );