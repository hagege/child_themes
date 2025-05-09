<?php
/**
 * Shrinking Logo Sticky Header
 *
 * @package       shrinkingLO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       1.1
 *
 * @wordpress-plugin
 * Plugin Name:   Shrinking Logo Sticky Header
 * Plugin URI:    https://haurand.com/plugin-shrinking-logo-sticky-header/
 * Description:   Adds a sticky header with animated logo shrink effect.
 * Version:       1.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com/author/hgg/
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

// set version.
const SLSH_VERSION = '1.1.0';

function slsh_load_textdomain() {
    load_plugin_textdomain('slsh', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'slsh_load_textdomain');

// --- Registering settings ---
function slsh_register_settings() {
    add_option('slsh_header_shrink_height', 80);
    add_option('slsh_animation_duration', 0.6);
    add_option('slsh_heigth_header', 120);
    add_option('slsh_logo_in_header_shrink_height', 0.8);

    // Options for Breakpoint
    add_option('slsh_enable_nav_css', 'no');
    add_option('slsh_nav_breakpoint', 782);

    register_setting('slsh_options_group', 'slsh_header_shrink_height', array('type' => 'integer', 'sanitize_callback' => 'absint'));
    register_setting('slsh_options_group', 'slsh_animation_duration', array('type' => 'float', 'sanitize_callback' => 'floatval'));
    register_setting('slsh_options_group', 'slsh_heigth_header', array('type' => 'integer', 'sanitize_callback' => 'absint'));
    register_setting('slsh_options_group', 'slsh_logo_in_header_shrink_height', array('type' => 'float', 'sanitize_callback' => 'floatval'));
    register_setting('slsh_options_group', 'slsh_enable_nav_css', array('type' => 'string', 'sanitize_callback' => function($v){ return $v === 'yes' ? 'yes' : 'no'; }));
    register_setting('slsh_options_group', 'slsh_nav_breakpoint', array('type' => 'integer', 'sanitize_callback' => 'absint'));
}
add_action('admin_init', 'slsh_register_settings');

// --- Settings page in admin menu ---
function slsh_register_options_page() {
    add_options_page('Shrinking Logo Sticky Header', 'Shrinking Logo Sticky Header', 'manage_options', 'slsh', 'slsh_options_page');
}
add_action('admin_menu', 'slsh_register_options_page');

function slsh_options_page() {
?>
    <div>
        <h2><?php esc_html_e('Shrinking Logo Sticky Header – Settings', 'shrinking-logo-sticky-header'); ?></h2>
        <form method="post" action="options.php">
            <?php settings_fields('slsh_options_group'); ?>
            <table>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_header_shrink_height"><?php esc_html_e('Height of the shrunk header (px):', 'shrinking-logo-sticky-header'); ?></label></th>
                    <td><input type="number" id="slsh_header_shrink_height" name="slsh_header_shrink_height" value="<?php echo esc_attr(get_option('slsh_header_shrink_height', 80)); ?>" min="40" max="300" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_animation_duration"><?php esc_html_e('Animation duration (seconds):', 'shrinking-logo-sticky-header'); ?></label></th>
                    <td><input type="number" step="0.05" id="slsh_animation_duration" name="slsh_animation_duration" value="<?php echo esc_attr(get_option('slsh_animation_duration', 0.6)); ?>" min="0.05" max="3" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_heigth_header"><?php esc_html_e('Normal height of header (px):', 'shrinking-logo-sticky-header'); ?></label></th>
                    <td><input type="number" id="slsh_heigth_header" name="slsh_heigth_header" value="<?php echo esc_attr(get_option('slsh_heigth_header', 120)); ?>" min="40" max="300" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_logo_in_header_shrink_height"><?php esc_html_e('Logo shrinking factor (Value in 0.05 steps):', 'shrinking-logo-sticky-header'); ?></label></th>
                    <td><input type="number" step="0.05" id="slsh_logo_in_header_shrink_height" name="slsh_logo_in_header_shrink_height" value="<?php echo esc_attr(get_option('slsh_logo_in_header_shrink_height', 0.8)); ?>" min="0.4" max="1" /></td>
                </tr>


                <!-- settings for breakpoint (CSS) -->
                <tr valign="top">
					<th scope="row"><h3 style="text-align: left;">Breakpoint</h3></th>		    
				</tr>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_enable_nav_css"><?php esc_html_e('Activate Breakpoint settings (CSS Rules):', 'shrinking-logo-sticky-header'); ?></label></th>
                    <td>
                        <input type="checkbox" id="slsh_enable_nav_css" name="slsh_enable_nav_css" value="yes" <?php checked('yes', get_option('slsh_enable_nav_css', 'no')); ?> />
                        <span><?php esc_html_e('Activates special CSS rules for the Breakpoint in Block Themes.', 'shrinking-logo-sticky-header'); ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_nav_breakpoint"><?php esc_html_e('Breakpoint for Navigation (px):', 'shrinking-logo-sticky-header'); ?></label></th>
                    <td>
                        <input type="number" id="slsh_nav_breakpoint" name="slsh_nav_breakpoint" value="<?php echo esc_attr(get_option('slsh_nav_breakpoint', 782)); ?>" min="320" max="1920" />
                        <span><?php esc_html_e('Standard: 782', 'shrinking-logo-sticky-header'); ?></span>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}


/* Load Dynamic CSS for Plugin Shrinking Logo Sticky Header */
function slsh_dynamic_css() {
	// include css file.
	wp_enqueue_style(
        'slsh_style',
        plugins_url('assets/css/shrinking-logo-sticky-header-style.css', __FILE__),
        array(),
        SLSH_VERSION
    );
	// variables
    $shrink_height      = intval(get_option('slsh_header_shrink_height', 80));
    $anim_duration      = floatval(get_option('slsh_animation_duration', 0.6));
    $header_height      = intval(get_option('slsh_heigth_header', 120));
    $logo_shrink_height = floatval(get_option('slsh_logo_in_header_shrink_height', 0.8));
    $enable_nav_css     = get_option('slsh_enable_nav_css', 'no');
    $nav_breakpoint     = intval(get_option('slsh_nav_breakpoint', 782));

    $custom_css = "
        header.wp-block-template-part {
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: height {$anim_duration}s cubic-bezier(.4,0,.2,1), background-color {$anim_duration}s;
            height: {$header_height}px; 
        }
        header.wp-block-template-part.shrink {
            height: {$shrink_height}px;
        }
        header.wp-block-template-part .wp-block-group {
            height: 100%;
        }
        header.wp-block-template-part .wp-block-site-logo img {
            transition: transform {$anim_duration}s cubic-bezier(0.4,0,0.2,1), height {$anim_duration}s cubic-bezier(0.4,0,0.2,1);
            transform: scale(1);
        }
        header.wp-block-template-part.shrink .wp-block-site-logo img {
            transform: scale({$logo_shrink_height});
        }
    ";

    if ($enable_nav_css === 'yes') {
        $custom_css .= "
        @media screen and (max-width: {$nav_breakpoint}px) {
            .wp-block-navigation__responsive-container-open {
                display: block !important;
            }
            .wp-block-navigation__responsive-container:not(.is-menu-open.has-modal-open) {
                display: none !important;
            }
        }";
    }

    wp_add_inline_style('slsh_style', $custom_css);
}
add_action('wp_enqueue_scripts', 'slsh_dynamic_css');


function slsh_enqueue(){
	wp_enqueue_script(
		'slsh_js',
		plugins_url( 'assets/js/slsh.js', __FILE__ ),
		array(),
		SLSH_VERSION,
		true
	);
}
add_action('wp_enqueue_scripts', 'slsh_enqueue');

