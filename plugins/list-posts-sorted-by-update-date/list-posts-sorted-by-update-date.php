<?php
/**
 * List Posts sorted by update date
 *
 * @package       LISTPOSTSS
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.2
 *
 * @wordpress-plugin
 * Plugin Name:   List Posts sorted by update date
 * Plugin URI:    https://haurand.com
 * Description:   the posts are listed sorted by update date in \"All posts\". 
 * Version:       0.1
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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

/*

function hgg_custom_posts_orderby( $query ) {
    if ( is_admin() && $query->is_main_query() && $query->get('post_type') == 'post' ) {
        $orderby_options = array(
            'date'       => 'Date',
            'title'      => 'Title',
            'modified'   => 'Last Modified',
        );

        // Set default orderby value
        $default_orderby = 'modified';

        $orderby_options = apply_filters( 'custom_posts_orderby_options', $orderby_options );

        $orderby = isset($_GET['orderby']) && in_array($_GET['orderby'], array_keys($orderby_options)) ? $_GET['orderby'] : $default_orderby;

        $query->set( 'orderby', $orderby );
    }
}
add_action( 'pre_get_posts', 'hgg_custom_posts_orderby' );

function hgg_custom_posts_orderby_options( $orderby_options ) {
    // Add more orderby options if needed
    $orderby_options['date'] = 'Date';
    $orderby_options['title'] = 'Title';
    $orderby_options['modified'] = 'Last Modified';
    return $orderby_options;
}
add_filter( 'custom_posts_orderby_options', 'hgg_custom_posts_orderby_options' );


