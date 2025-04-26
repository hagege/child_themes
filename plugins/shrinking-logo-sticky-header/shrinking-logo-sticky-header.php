<?php
/**
 * Shrinking Logo Sticky Header
 *
 * @package       shrinkingLO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.4.4
 *
 * @wordpress-plugin
 * Plugin Name:   Shrinking Logo Sticky Header
 * Plugin URI:    https://haurand.com
 * Description:   Adds a sticky header with animated logo shrink effect.
 * Version:       0.4.4
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   shrinking-logo-sticky-header
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with shrinking Logo Sticky Header. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

function slsh_load_textdomain() {
    load_plugin_textdomain('slsh', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'slsh_load_textdomain');

// --- Einstellungen registrieren ---
function slsh_register_settings() {
    add_option('slsh_header_shrink_height', 80);
    add_option('slsh_animation_duration', 0.6);
	add_option('slsh_heigth_header', 120);
	add_option('slsh_logo_in_header_shrink_height', 0.8);
    register_setting('slsh_options_group', 'slsh_header_shrink_height', array('type' => 'integer', 'sanitize_callback' => 'absint'));
    register_setting('slsh_options_group', 'slsh_animation_duration', array('type' => 'float', 'sanitize_callback' => 'floatval'));
	register_setting('slsh_options_group', 'slsh_heigth_header', array('type' => 'integer', 'sanitize_callback' => 'absint'));
	register_setting('slsh_options_group', 'slsh_logo_in_header_shrink_height', array('type' => 'float', 'sanitize_callback' => 'floatval'));
}
add_action('admin_init', 'slsh_register_settings');

// --- Einstellungsseite im Admin-Menü ---
function slsh_register_options_page() {
    add_options_page('Shrinking Logo Sticky Header', 'Shrinking Logo Sticky Header', 'manage_options', 'slsh', 'slsh_options_page');
}
add_action('admin_menu', 'slsh_register_options_page');

function slsh_options_page() {
?>
    <div>
        <h2><?php esc_html_e('Shrinking Logo Sticky Header – Settings', 'slsh'); ?></h2>
        <form method="post" action="options.php">
            <?php settings_fields('slsh_options_group'); ?>
            <table>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_header_shrink_height"><?php esc_html_e('Height of the shrunk header (px):', 'slsh'); ?></label></th>
                    <td><input type="number" id="slsh_header_shrink_height" name="slsh_header_shrink_height" value="<?php echo esc_attr(get_option('slsh_header_shrink_height', 80)); ?>" min="40" max="300" /></td>
                </tr>
				<tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_animation_duration"><?php esc_html_e('Animation duration (seconds):', 'slsh'); ?></label></th>
                    <td><input type="number" step="0.05" id="slsh_animation_duration" name="slsh_animation_duration" value="<?php echo esc_attr(get_option('slsh_animation_duration', 0.6)); ?>" min="0.05" max="3" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_heigth_header"><?php esc_html_e('Normal height of header (px):', 'slsh'); ?></label></th>
                    <td><input type="number" id="slsh_heigth_header" name="slsh_heigth_header" value="<?php echo esc_attr(get_option('slsh_heigth_header', 120)); ?>" min="40" max="300" /></td>
                </tr>
				<tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_logo_in_header_shrink_height"><?php esc_html_e('Logo shrinking factor (Value in 0.05 steps):', 'slsh'); ?></label></th>
                    <td><input type="number" step="0.05" id="slsh_logo_in_header_shrink_height" name="slsh_logo_in_header_shrink_height" value="<?php echo esc_attr(get_option('slsh_logo_in_header_shrink_height', 0.8)); ?>" min="0.4" max="1" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// --- CSS und JS im Frontend ausgeben ---
function slsh_sticky_header() {
    $shrink_height = intval(get_option('slsh_header_shrink_height', 80));
    $anim_duration = floatval(get_option('slsh_animation_duration', 0.6));
	$header_height = intval(get_option('slsh_heigth_header', 120));
	$logo_shrink_height = floatval(get_option('slsh_logo_in_header_shrink_height', 0.8));
    ?>
    <style>
    header.wp-block-template-part {
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: height <?php echo $anim_duration; ?>s cubic-bezier(.4,0,.2,1), background-color <?php echo $anim_duration; ?>s;
        height: <?php echo $header_height; ?>px; 
    }  
	
	header.wp-block-template-part.shrink {
        height: <?php echo $shrink_height; ?>px;
    }
	
	/* innere Gruppe auch animieren */
		header.wp-block-template-part .wp-block-group {
			height: 100%;
		}
	
	/* Logo-Animation */
	header.wp-block-template-part .wp-block-site-logo img {
		transition: transform <?php echo $anim_duration; ?>s cubic-bezier(0.4,0,0.2,1), height <?php echo $anim_duration; ?>s cubic-bezier(0.4,0,0.2,1);
		transform: scale(1);
	}
		
	/* Logo-Animation bei shrink*/
	header.wp-block-template-part.shrink .wp-block-site-logo img {
		transform: scale(<?php echo $logo_shrink_height; ?>);
	}

    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('header.wp-block-template-part');
        if (!header) return;
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                header.classList.add('shrink');
            } else {
                header.classList.remove('shrink');
            }
        });
    });
    </script>
    <?php
}
add_action('wp_head', 'slsh_sticky_header');
