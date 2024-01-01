<?php
/**
 * Show another Random Text
 *
 * @package       SHOWANOTHE
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Show another Random Text
 * Plugin URI:    https://haurand.com
 * Description:   Zeigt wöchentlich einen zufälligen Text auf einer Seite an.
 * Version:       0.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   show-another-random-text
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Show another Random Text. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

function register_text_post_type() {
    register_post_type('custom_text', array(
        'labels' => array(
            'name' => 'Custom Texts',
            'singular_name' => 'Custom Text',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor'),
    ));
}

add_action('init', 'register_text_post_type');

function display_random_text_shortcode($atts) {
    return get_random_text();
}

add_shortcode('display_random_text', 'display_random_text_shortcode');


function get_random_text() {
    $current_time = current_time('timestamp');
    $last_updated = get_option('random_text_last_updated', 0);
    $one_week = 7 * 24 * 60 * 60; // One week in seconds
    /* 
    echo "Zeit: " . var_dump($current_time);
	echo "zuletzt: " . var_dump($last_updated);
	echo "Woche in Sekunden: " . var_dump($one_week);
    */ 

    /* Wenn eine Woche vorbei ist, neuen Random-Text suchen - aus dem Grund kommt WP-Cron ins Spiel */
    if ($current_time - $last_updated >= $one_week) {
        $args = array(
            'post_type' => 'custom_text',
            'posts_per_page' => -1,
        );

        $texts = get_posts($args);

        if (!$texts) {
            return 'No texts available.';
        }

        $random_text = $texts[array_rand($texts)];
        update_option('random_text_last_updated', $current_time);
        update_option('random_text_last_content', apply_filters('the_content', $random_text->post_content));
    }

    return get_option('random_text_last_content', 'No texts available.');
}



