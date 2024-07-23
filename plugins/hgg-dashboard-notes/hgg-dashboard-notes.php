<?php
/**
 * hgg dashboard notes
 *
 * @package       HGGDASHBOA
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.2
 *
 * @wordpress-plugin
 * Plugin Name:   hgg dashboard notes
 * Plugin URI:    https://haurand.com
 * Description:   A simple plugin to add notes to the WordPress dashboard.
 * Version:       0.2
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   hgg-dashboard-notes
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with hgg dashboard notes. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


// Add the dashboard widget
function hgg_add_dashboard_widgets() {
    wp_add_dashboard_widget('hgg_dashboard_notes', 'hgg Dashboard Notes', 'hgg_dashboard_notes');
}
add_action('wp_dashboard_setup', 'hgg_add_dashboard_widgets');

// Display the dashboard widget
function hgg_dashboard_notes() {
    // Check if the form has been submitted and nonce is verified
    if (isset($_POST['hgg_notes']) && check_admin_referer('hgg_save_notes', 'hgg_notes_nonce')) {
        // Update the option with the new notes
        update_option('hgg_notes', sanitize_text_field($_POST['hgg_notes']));
        echo '<div id="message" class="updated notice is-dismissible"><p>Notes updated.</p></div>';
    }
    
    // Get the current notes
    $notes = get_option('hgg_notes', '');
    ?>
    <form method="post">
        <?php wp_nonce_field('hgg_save_notes', 'hgg_notes_nonce'); ?>
        <textarea name="hgg_notes" rows="10" style="width: 100%;"><?php echo esc_textarea($notes); ?></textarea>
        <p>
            <input type="submit" class="button-primary" value="Save Notes" />
        </p>
    </form>
    <?php
}
?>
