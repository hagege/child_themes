<?php
/**
 * Shrinked Logo Sticky Header
 *
 * @package       SHRINKEDLO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.4.1
 *
 * @wordpress-plugin
 * Plugin Name:   Shrinked Logo Sticky Header
 * Plugin URI:    https://haurand.com
 * Description:   Adds a sticky header with animated logo shrink effect.
 * Version:       0.4.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   shrinked-logo-sticky-header
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Shrinked Logo Sticky Header. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// --- Einstellungen registrieren ---
function slsh_register_settings() {
    add_option('slsh_logo_shrink_height', 60);
    add_option('slsh_animation_duration', 0.4);
    register_setting('slsh_options_group', 'slsh_logo_shrink_height', array('type' => 'integer', 'sanitize_callback' => 'absint'));
    register_setting('slsh_options_group', 'slsh_animation_duration', array('type' => 'float', 'sanitize_callback' => 'floatval'));
}
add_action('admin_init', 'slsh_register_settings');

// --- Einstellungsseite im Admin-Menü ---
function slsh_register_options_page() {
    add_options_page('Shrinked Logo Sticky Header', 'Sticky Header Settings', 'manage_options', 'slsh', 'slsh_options_page');
}
add_action('admin_menu', 'slsh_register_options_page');

function slsh_options_page() {
?>
    <div>
        <h2>Shrinked Logo Sticky Header – Einstellungen</h2>
        <form method="post" action="options.php">
            <?php settings_fields('slsh_options_group'); ?>
            <table>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_logo_shrink_height">Höhe des geschrumpften Headers und Logos (px):</label></th>
                    <td><input type="number" id="slsh_logo_shrink_height" name="slsh_logo_shrink_height" value="<?php echo esc_attr(get_option('slsh_logo_shrink_height', 60)); ?>" min="10" max="300" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_animation_duration">Animationsdauer (Sekunden):</label></th>
                    <td><input type="number" step="0.05" id="slsh_animation_duration" name="slsh_animation_duration" value="<?php echo esc_attr(get_option('slsh_animation_duration', 0.4)); ?>" min="0.05" max="3" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// --- CSS und JS im Frontend ausgeben ---
function slsh_sticky_header() {
    $shrink_height = intval(get_option('slsh_logo_shrink_height', 60));
    $anim_duration = floatval(get_option('slsh_animation_duration', 0.4));
    ?>
    <style>
    header.wp-block-template-part {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: rgba(255,255,255,0.95);
        transition: height <?php echo $anim_duration; ?>s cubic-bezier(.4,0,.2,1), background <?php echo $anim_duration; ?>s;
        height: 120px; 
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
		transform: scale(0.6);
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
