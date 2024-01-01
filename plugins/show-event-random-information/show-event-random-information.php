<?php
/*
 *
 * @wordpress-plugin
 * Plugin Name:   Show Event Random Information
 * Plugin URI:    https://haurand.com
 * Description:   Zeigt wöchentlich einen zufälligen Text auf einer Seite an.
 * Version:       0.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   show-event-random-information
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Show Event Random Information. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

function create_event_post_type() {
    register_post_type('weekly_event', array(
        'labels' => array(
            'name' => 'Weekly Events',
            'singular_name' => 'Weekly Event',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-calendar',
        'supports' => array('title', 'editor'),
    ));
}

add_action('init', 'create_event_post_type');




function add_event_custom_fields() {
    add_post_type_support('weekly_event', 'custom-fields');
}

add_action('init', 'add_event_custom_fields');

function get_random_event() {
    $args = array(
        'post_type' => 'weekly_event',
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

function display_random_event_shortcode() {
    return get_random_event();
}

add_shortcode('display_random_event', 'display_random_event_shortcode');

function update_weekly_event() {
    $current_time = current_time('timestamp');
    $last_updated = get_option('weekly_event_last_updated', 0);
    $one_week = 7 * 24 * 60 * 60; // One week in seconds

    if ($current_time - $last_updated >= $one_week) {
        update_option('weekly_event_last_updated', $current_time);
        delete_transient('random_event_cache'); // Clear the cache to get a new random event
    }
}

add_action('init', 'update_weekly_event');
