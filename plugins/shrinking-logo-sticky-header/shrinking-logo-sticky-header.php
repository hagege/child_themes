<?php
/**
 * Shrinking Logo Sticky Header
 *
 * @package       shrinkingLO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       1.3.1
 *
 * @wordpress-plugin
 * Plugin Name:   Dynamic Header & Navigation for Block Themes
 * Plugin URI:    https://haurand.com/plugin-shrinking-logo-sticky-header/
 * Description:   Animated shrinking header, responsive shrinking logo, custom breakpoints and off-canvas navigation – all-in-one navigation solution for most modern WordPress block themes.
 * Version:       1.3.1
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
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// set version.
const SLSH_VERSION = '1.3.1';

/**
 * Load language files.
 *
 * @return void
 */
function slsh_load_textdomain(): void {
    load_plugin_textdomain(
        'shrinking-logo-sticky-header',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages/'
    );
}
add_action( 'init', 'slsh_load_textdomain' );


/**
 * Registering settings
 */
function slsh_register_settings(): void {
	add_option( 'slsh_header_shrink_height', 80 );
	add_option( 'slsh_animation_duration', 0.6 );
	add_option( 'slsh_heigth_header', 120 );
	add_option( 'slsh_logo_in_header_shrink_height', 0.8 );
	add_option( 'slsh_logo_in_header_shrink_left', 0);

	// Options for Breakpoint.
	add_option( 'slsh_nav_breakpoint', 782 );
	
	// Delete superfluous option 
	delete_option( 'slsh_enable_nav_css' );
	
	// Option for Off-Canvas-Menue
	add_option( 'slsh_enable_off_canvas', 'no' );
	
	// Option for Option for the speed of the Off-Canvas fade-in - Version 1.3.1 
	add_option( 'slsh_off_canvas_speed', 0.5 );
	
	// Option for Background Color
	add_option( 'slsh_enable_background_color', 'no' );
	

	register_setting(
		'slsh_options_group',
		'slsh_header_shrink_height',
		array(
			'type'              => 'integer',
			'sanitize_callback' => 'absint',
		)
	);

    register_setting(
		'slsh_options_group',
		'slsh_animation_duration',
		array(
			'type'              => 'float',
			'sanitize_callback' => 'floatval',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_heigth_header',
		array(
			'type'              => 'integer',
			'sanitize_callback' => 'absint',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_logo_in_header_shrink_height',
		array(
			'type'              => 'float',
			'sanitize_callback' => 'floatval',
		)
	);

	register_setting(
		'slsh_options_group',
		'slsh_logo_in_header_shrink_left',
		array(
			'type'              => 'float',
			'sanitize_callback' => 'floatval',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_nav_breakpoint',
		array(
			'type'              => 'integer',
			'sanitize_callback' => 'absint',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_enable_off_canvas',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $v ) {
				return 'yes' === $v ? 'yes' : 'no';
			},
		)
	);

	register_setting(
		'slsh_options_group',
		'slsh_off_canvas_speed',
		array(
			'type'              => 'float',
			'sanitize_callback' => 'floatval',
		)
	);

	register_setting(
		'slsh_options_group',
		'slsh_enable_background_color',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $v ) {
				return 'yes' === $v ? 'yes' : 'no';
			},
		)
	);
}
add_action( 'admin_init', 'slsh_register_settings' );

/**
 * Settings page in admin menu
 */
function slsh_register_options_page(): void {
	add_options_page( 'Dynamic Header & Navigation for Block Themes', 'Dynamic Header & Navigation for Block Themes', 'manage_options', 'slsh', 'slsh_options_page' );
}
add_action( 'admin_menu', 'slsh_register_options_page' );

/**
 * Show options page.
 *
 * @return void
 */
function slsh_options_page(): void {
	?>
	<div>
		<div class="notice notice-info">
			<p>
				<strong>Notice:</strong> 
				We would appreciate a review of the plugin <a href="https://de.wordpress.org/plugins/shrinking-logo-sticky-header/#reviews" target="_blank">Dynamic Header & Navigation for Block Themes</a> - thanks a lot :-) 
			</p>
		</div>
		<h2><?php esc_html_e( 'Dynamic Header & Navigation for Block Themes – Settings: Version ', 'shrinking-logo-sticky-header' ); ?><?php if (defined('SLSH_VERSION')) echo esc_html(SLSH_VERSION); ?></h2>
		<form method="post" action="<?php echo esc_url( get_admin_url() ); ?>options.php">
			<?php settings_fields( 'slsh_options_group' ); ?>

			<table>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_header_shrink_height"><?php esc_html_e( 'Height of the shrunk header (px):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" id="slsh_header_shrink_height" name="slsh_header_shrink_height" value="<?php echo esc_attr( get_option( 'slsh_header_shrink_height', 80 ) ); ?>" min="40" max="300" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_animation_duration"><?php esc_html_e( 'Animation duration (seconds):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" step="0.05" id="slsh_animation_duration" name="slsh_animation_duration" value="<?php echo esc_attr( get_option( 'slsh_animation_duration', 0.6 ) ); ?>" min="0.05" max="3" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_heigth_header"><?php esc_html_e( 'Normal height of header (px):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" id="slsh_heigth_header" name="slsh_heigth_header" value="<?php echo esc_attr( get_option( 'slsh_heigth_header', 120 ) ); ?>" min="40" max="300" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_logo_in_header_shrink_height"><?php esc_html_e( 'Logo shrinking factor (Value in 0.05 steps):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" step="0.05" id="slsh_logo_in_header_shrink_height" name="slsh_logo_in_header_shrink_height" value="<?php echo esc_attr( get_option( 'slsh_logo_in_header_shrink_height', 0.8 ) ); ?>" min="0.4" max="1" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_logo_in_header_shrink_left"><?php esc_html_e( 'Move the shrunk logo to the left (rem):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" step="0.1" id="slsh_logo_in_header_shrink_left" name="slsh_logo_in_header_shrink_left" value="<?php echo esc_attr( get_option( 'slsh_logo_in_header_shrink_left', 0 ) ); ?>" min="0" max="8" /></td>
				</tr>

				<!-- settings for breakpoint (CSS) -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px">Breakpoint</h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left;"><?php esc_html_e( 'A breakpoint is a screen width where the website layout changes to adapt for different devices like mobiles or desktops.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_nav_breakpoint"><?php esc_html_e( 'Breakpoint for Navigation (px):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" id="slsh_nav_breakpoint" name="slsh_nav_breakpoint" value="<?php echo esc_attr( get_option( 'slsh_nav_breakpoint', 782 ) ); ?>" min="782" max="1920" />
						<span><?php esc_html_e( 'Standard: 782', 'shrinking-logo-sticky-header' ); ?></span>
					</td>
				</tr>
				<!-- settings for Off-Canvas (CSS) -->
				<tr>
					<th scope="row"><h3 style="text-align: left;margin-top:30px">Off-Canvas-Menu</h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left;"><?php esc_html_e( 'Off-canvas is a hidden navigation panel that slides in from the side of the screen, providing a space-saving way to access menu options without cluttering the main content area.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_enable_off_canvas"><?php esc_html_e( 'Activate Off-Canvas (CSS Rules):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_enable_off_canvas" name="slsh_enable_off_canvas" value="yes" <?php checked( 'yes', get_option( 'slsh_enable_off_canvas', 'no' ) ); ?> />
						<span><?php esc_html_e( 'Activates special CSS rules for Off-Canvas in Block Themes.', 'shrinking-logo-sticky-header' ); ?></span>
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_off_canvas_speed"><?php esc_html_e( 'Option for the speed of the Off-Canvas fade-in (Value in 0.1 steps):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" step="0.1" id="slsh_off_canvas_speed" name="slsh_off_canvas_speed" value="<?php echo esc_attr( get_option( 'slsh_off_canvas_speed', 0.5 ) ); ?>" min="0.1" max="1" />
						<span><?php esc_html_e( 'The smaller the value, the faster the fade-in.', 'shrinking-logo-sticky-header' ); ?></span>
					</td>
				</tr>

				</tr>
				<!-- settings for Background Color (Header) -->
				<tr>
					<th scope="row"><h3 style="text-align: left;margin-top:30px">Background Color for Header</h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left;"><?php esc_html_e( 'The header is normally transparent. However, you can set the background color for the header in the template part of your block theme (recommended). The background color for the header can also be set automatically using the following settings.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_enable_background_color"><?php esc_html_e( 'Activate Background Color for Header (CSS Rules):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_enable_off_canvas" name="slsh_enable_background_color" value="yes" <?php checked( 'yes', get_option( 'slsh_enable_background_color', 'no' ) ); ?> />
						<span><?php esc_html_e( 'Activates special CSS rules for Background Color (Header) in Block Themes.', 'shrinking-logo-sticky-header' ); ?></span>
					</td>
				</tr>


			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Load Dynamic CSS for Plugin Shrinking Logo Sticky Header
 */
function slsh_dynamic_css(): void {
	// include css file.
	wp_enqueue_style(
		'slsh_style',
		plugins_url( 'assets/css/shrinking-logo-sticky-header-style.css', __FILE__ ),
		array(),
		SLSH_VERSION
	);
	// variables.
	$shrink_height      = (int) get_option( 'slsh_header_shrink_height', 80 );
	$anim_duration      = (float) get_option( 'slsh_animation_duration', 0.6 );
	$header_height      = (int) get_option( 'slsh_heigth_header', 120 );
	$logo_shrink_height = (float) get_option( 'slsh_logo_in_header_shrink_height', 0.8 );
	$logo_shrink_left   = (float) get_option( 'slsh_logo_in_header_shrink_left', 0 );
	$nav_breakpoint     = (int) get_option( 'slsh_nav_breakpoint', 782 );
	$enable_off_canvas  = get_option( 'slsh_enable_off_canvas', 'no' );
	$off_canvas_speed   = (float) get_option( 'slsh_off_canvas_speed', 0.5 );
	$enable_bg_color    = get_option( 'slsh_enable_background_color', 'no' );

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
            transform: translateX(-{$logo_shrink_left}rem) scale({$logo_shrink_height});
        }
    ";

	if ( $nav_breakpoint > 782 ) {
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
	
	if ( 'yes' === $enable_off_canvas ) {
		$custom_css .= "
		/* Off canvas */
		@media (max-width: {$nav_breakpoint}px) {
		  .wp-block-navigation__responsive-container {
			right: -70vw;
			left: auto;
			width: 70vw;
			transition: none; 
			border-radius: 0;
		}

		.wp-block-navigation__responsive-container.is-menu-open {
			animation: slideInMenu {$off_canvas_speed}s linear forwards;
		}
		@keyframes slideInMenu {
			from {
			  right: -70vw;
			}
			to {
			  right: 0vw;
			}
		  }
	    }";
	}
		
	if ( 'yes' === $enable_bg_color ) {
		$custom_css .= "
		/* Background Color */
		header.wp-block-template-part {
			background-color: var(--wp--preset--color--base);
		}";	
	}

	wp_add_inline_style( 'slsh_style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'slsh_dynamic_css' );

/**
 * Enqueue script.
 *
 * @return void
 */
function slsh_enqueue(): void {
	wp_enqueue_script(
		'slsh_js',
		plugins_url( 'assets/js/slsh.js', __FILE__ ),
		array(),
		SLSH_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'slsh_enqueue' );
