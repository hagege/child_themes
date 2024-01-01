<?php
/**
 * Weekly Event Display
 *
 * @package       WEEKLYEVEN
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Weekly Event Display
 * Plugin URI:    https://haurand.com
 * Description:   Zeigt wöchentlich einen zufälligen Text auf einer Seite an.
 * Version:       0.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   weekly-event-display
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Weekly Event Display. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.


// Activation hook
register_activation_hook(__FILE__, 'one_weekly_event_plugin_activation');

// Deactivation hook
register_deactivation_hook(__FILE__, 'one_weekly_event_plugin_deactivation');

// Activation function
function one_weekly_event_plugin_activation() {
    // Create the custom post type and fields on activation
    create_one_weekly_event_post_type();
    add_one_weekly_event_custom_fields();
    flush_rewrite_rules();
}

// Deactivation function
function one_weekly_event_plugin_deactivation() {
    // Flush rewrite rules on deactivation
    flush_rewrite_rules();
}

// Create custom post type for one weekly event
function create_one_weekly_event_post_type() {
    register_post_type('one_weekly_event', array(
        'labels' => array(
            'name' => 'One Weekly Events',
            'singular_name' => 'One Weekly Event',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-calendar',
        'supports' => array('title', 'editor'),
    ));
}

// Add custom fields to the one weekly event post type
function add_one_weekly_event_custom_fields() {
    register_post_meta('one_weekly_event', '_event_date', array(
        'type' => 'date',
        'single' => true,
        'show_in_rest' => true,
    ));

    register_post_meta('one_weekly_event', '_event_description', array(
        'type' => 'textarea',
        'single' => true,
        'show_in_rest' => true,
    ));

    register_post_meta('one_weekly_event', '_event_location', array(
        'type' => 'text',
        'single' => true,
        'show_in_rest' => true,
    ));
}

// Get a random event
function get_random_one_weekly_event() {
    $args = array(
        'post_type' => 'one_weekly_event',
        'posts_per_page' => -1,
    );

    $events = get_posts($args);

    if (!$events) {
        return 'No events available.';
    }

    $random_event = $events[array_rand($events)];

    $event_date = get_post_meta($random_event->ID, '_event_date', true);
    $event_description = get_post_meta($random_event->ID, '_event_description', true);
    $event_location = get_post_meta($random_event->ID, '_event_location', true);

    $output = "<p><strong>Date:</strong> $event_date<br>";
    $output .= "<strong>Description:</strong> $event_description<br>";
    $output .= "<strong>Location:</strong> $event_location</p>";

    return apply_filters('the_content', $output);
}

// Create a shortcode to display the random event
function display_random_one_weekly_event_shortcode() {
    return get_random_one_weekly_event();
}

add_shortcode('display_random_one_weekly_event', 'display_random_one_weekly_event_shortcode');