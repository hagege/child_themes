<?php
/**
 * Outdated Post
 *
 * @package       OUTDATEDPO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.3.1
 *
 * @wordpress-plugin
 * Plugin Name:   Outdated Post
 * Plugin URI:    https://haurand.com
 * Description:   This plugin displays a warning if the last update of a post is older than one year. In this case, a warning is displayed after the title of the post 
 * Version:       0.3.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   outdated-post
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Outdated Post. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


// Add a warning message to posts with updates older than a year
function op_post_update_warning_message( $op_content ) {
    // Check if we are in a single post view
    if ( is_singular( 'post' ) ) {
        // Get the post ID
        $op_post_id = get_the_ID();

        // Check if the post has been updated within the last year
        $op_last_updated_time = get_post_modified_time( 'U', true, $op_post_id );
		$op_post_date = get_the_date('d.m.Y');
		$op_last_updated_date = get_the_modified_date('d.m.Y');
/*        $op_current_time = current_time( 'timestamp' );
        $op_year_ago = strtotime( '-1 year', $op_current_time );
		$op_words = str_word_count($op_content) - 100;
		// count words without contact block: estimated 100 words
		$op_reading_time = ceil( $op_words/ 200);
		if ( $op_reading_time < 1 ) {
			$op_output_reading_time = "Weniger als 1 Minute";
		} else {
			$op_output_reading_time = $op_reading_time . " Minuten";
		}	
		*/ 
		// $op_show_last_updated = '<div class="post-show-update">Beitragsdatum: ' . $op_post_date . ' | Letztes Update: ' . $op_last_updated_date . '<br>Geschätzte Lesezeit: ' . $op_output_reading_time . ' | Wörter in relevantem Text: ' . $op_words . '</div>';
		$op_show_last_updated = '<div class="post-show-update">Beitragsdatum: ' . $op_post_date . ' | Letztes Update: ' . $op_last_updated_date . '</div>';
		/*
		// $op_output_reading_time = '<div class="post-update-warning">geschätzte Lesezeit: ' . $op_output_reading_time'</div>'
        if ( $op_last_updated_time < $op_year_ago ) {
            // Add a warning message after the post excerpt
            // $warning_message = '<div class="post-update-warning">This post has not been updated in over a year. Please note that the information may be outdated.</div>';
			$op_warning_message = '<div class="post-update-warning">Dieser Beitrag wurde seit über einem Jahr nicht mehr aktualisiert. Bitte beachte, dass die Informationen veraltet sein können.</div>';
            $op_content = $op_warning_message . $op_content;
        }
        */
		$op_content = $op_show_last_updated . $op_content;
    }

    return $op_content;
}
add_filter( 'the_content', 'op_post_update_warning_message' );