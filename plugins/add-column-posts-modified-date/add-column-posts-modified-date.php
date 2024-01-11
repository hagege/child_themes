<?php
/**
 * Add Column Posts Modified Date 
 *
 * @package       ADDCOLUMNP
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.2
 *
 * @wordpress-plugin
 * Plugin Name:   Add Column Posts Modified Date 
 * Plugin URI:    https://haurand.com
 * Description:   Add a “Last Updated” Column To The WordPress Backend (Works for Posts & Pages)
 * Version:       0.2
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   add-column-posts-modified-date
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Add Column Posts Modified Date . If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

// Adds a new sortable "last updated" column to posts and pages backend.
// Source: https://mintedempire.com/add-a-last-updated-column-to-the-wp-backend/
function custom_columns($defaults) {
    $defaults['last_updated'] = __('Last Updated', 'your-textdomain');
    return $defaults;
}
add_filter('manage_posts_columns', 'custom_columns');
// add_filter('manage_pages_columns', 'custom_columns');

function custom_columns_content($column_name, $post_id) {
    if ($column_name == 'last_updated') {
        $last_updated = get_the_modified_date("d.m.Y - H:i");
        echo $last_updated;
    }
}
add_action('manage_posts_custom_column', 'custom_columns_content', 10, 2);
// add_action('manage_pages_custom_column', 'custom_columns_content', 10, 2);

function custom_columns_sortable($columns) {
    $columns['last_updated'] = 'last_updated';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'custom_columns_sortable');
// add_filter('manage_edit-page_sortable_columns', 'custom_columns_sortable');

function custom_columns_orderby($query) {
    if (!is_admin()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ('last_updated' == $orderby) {
        $query->set('orderby', 'modified');
    }
}
add_action('pre_get_posts', 'custom_columns_orderby');


/* Sort posts in wp_list_table by column in ascending or descending order. */
function custom_post_order($query){
    /* 
        Set post types.
        _builtin => true returns WordPress default post types. 
        _builtin => false returns custom registered post types. 
    */
    $post_types = get_post_types(array('_builtin' => true), 'names');
    /* The current post type. */
    $post_type = $query->get('post_type');
    /* Check post types. */
    if(in_array($post_type, $post_types)){
        /* Post Column: e.g. title */
        if($query->get('orderby') == ''){
            $query->set('orderby', 'Last Updated');
        }
        /* Post Order: ASC / DESC */
        if($query->get('order') == ''){
            $query->set('order', 'DESC');
        }
    }
}
add_action('pre_get_posts', 'custom_post_order');
