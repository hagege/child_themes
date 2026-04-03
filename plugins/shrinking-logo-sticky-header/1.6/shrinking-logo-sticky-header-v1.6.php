<?php
/**
 * Shrinking Logo Sticky Header
 *
 * @package       shrinkingLO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       1.6
 *
 * @wordpress-plugin
 * Plugin Name:   Dynamic Header & Navigation for Block Themes
 * Plugin URI:    https://haurand.com/plugin-shrinking-logo-sticky-header/
 * Description:   Animated shrinking header, responsive shrinking logo, custom breakpoints and off-canvas navigation – all-in-one navigation solution for most modern WordPress block themes.
 * Version:       1.6
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com/author/hgg/
 * Text Domain:   shrinking-logo-sticky-header
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.8
 * Requires PHP:  7.2
 *
 * You should have received a copy of the GNU General Public License
 * along with shrinking Logo Sticky Header. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ============================================
// Plugin Constants
// ============================================

/** Plugin version */
const SLSH_VERSION = '1.6';

/** Plugin directory path */
const SLSH_PLUGIN_DIR = __DIR__;

/** Plugin URL */
const SLSH_PLUGIN_URL = __DIR__ . '/';

/**
 * Load language files.
 *
 * @return void
 */
/* 
function slsh_load_textdomain(): void {
    load_plugin_textdomain(
        'shrinking-logo-sticky-header',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages/'
    );
}
add_action( 'init', 'slsh_load_textdomain' );
*/

// ============================================
// Configuration & Defaults
// ============================================

/**
 * Get all plugin option defaults
 * 
 * @since 1.6
 * @return array
 */
function slsh_get_option_defaults(): array {
	return array(
		'slsh_header_shrink_height'           => 80,
		'slsh_animation_duration'             => 0.8,
		'slsh_heigth_header'                  => 100,
		'slsh_logo_in_header_shrink_height'   => 0.8,
		'slsh_logo_in_header_shrink_left'     => 0,
		'slsh_nav_breakpoint'                 => 599,
		'slsh_enable_off_canvas'              => 'no',
		'slsh_off_canvas_speed'               => 0.5,
		'slsh_enable_background_color'        => 'no',
		'slsh_hide_header'                    => 'no',
		'slsh_disable_padding'                => 'no',
		'slsh_enable_text_menu'               => 'no',
		'slsh_text_menu'                      => 'Menu',
		'slsh_disable_sticky'                 => 'no',
	);
}

/**
 * Get single option with default value
 * 
 * @since 1.6
 * @param string $option_name Option name
 * @param mixed  $default Default value
 * @return mixed
 */
function slsh_get_option( string $option_name, $default = null ) {
	$defaults = slsh_get_option_defaults();
	
	if ( null === $default && isset( $defaults[ $option_name ] ) ) {
		$default = $defaults[ $option_name ];
	}
	
	return get_option( $option_name, $default );
}

// ============================================
// Registering settings
// ============================================

/**
 * Register plugin settings and options
 * 
 * @since 1.0
 * @return void
 */
function slsh_register_settings(): void {
	
	// Get defaults
	$defaults = slsh_get_option_defaults();
	
	// Initialize all options (will not overwrite existing values)
	foreach ( $defaults as $option_key => $default_value ) {
		add_option( $option_key, $default_value );
	}
	
	// Delete superfluous option (backward compatibility)
	delete_option( 'slsh_enable_nav_css' );
	
	// ============================================
	// Register settings for Settings API
	// ============================================
	
	register_setting(
		'slsh_options_group',
		'slsh_header_shrink_height',
		array(
			'type'              => 'integer',
			'sanitize_callback' => 'absint',
			'default'           => 80,
		)
	);

	register_setting(
		'slsh_options_group',
		'slsh_animation_duration',
		array(
			'type'              => 'number',
			'sanitize_callback' => function( $value ) {
				$float_val = (float) $value;
				// Clamp between 0.1 and 5 seconds
				return max( 0.1, min( 5, $float_val ) );
			},
			'default'           => 0.8,
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_heigth_header',
		array(
			'type'              => 'integer',
			'sanitize_callback' => 'absint',
			'default'           => 100,
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_logo_in_header_shrink_height',
		array(
			'type'              => 'number',
			'sanitize_callback' => function( $value ) {
				$float_val = (float) $value;
				// Clamp between 0.1 and 1.5
				return max( 0.1, min( 1.5, $float_val ) );
			},
			'default'           => 0.8,
		)
	);

	register_setting(
		'slsh_options_group',
		'slsh_logo_in_header_shrink_left',
		array(
			'type'              => 'number',
			'sanitize_callback' => function( $value ) {
				$float_val = (float) $value;
				return max( 0, min( 10, $float_val ) );
			},
			'default'           => 0,
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_nav_breakpoint',
		array(
			'type'              => 'integer',
			'sanitize_callback' => function( $value ) {
				$int_val = absint( $value );
				// Minimum 599, maximum 1920
				return max( 599, min( 1920, $int_val ) );
			},
			'default'           => 599,
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_enable_off_canvas',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $value ) {
				return 'yes' === $value ? 'yes' : 'no';
			},
			'default'           => 'no',
		)
	);

	register_setting(
		'slsh_options_group',
		'slsh_off_canvas_speed',
		array(
			'type'              => 'number',
			'sanitize_callback' => function( $value ) {
				$float_val = (float) $value;
				return max( 0.1, min( 2, $float_val ) );
			},
			'default'           => 0.5,
		)
	);

	register_setting(
		'slsh_options_group',
		'slsh_enable_background_color',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $value ) {
				return 'yes' === $value ? 'yes' : 'no';
			},
			'default'           => 'no',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_hide_header',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $value ) {
				return 'yes' === $value ? 'yes' : 'no';
			},
			'default'           => 'no',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_disable_padding',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $value ) {
				return 'yes' === $value ? 'yes' : 'no';
			},
			'default'           => 'no',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_enable_text_menu',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $value ) {
				return 'yes' === $value ? 'yes' : 'no';
			},
			'default'           => 'no',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_text_menu',
		array(
			'type'              => 'string',
			'sanitize_callback' => function( $value ) {
				$value = sanitize_text_field( $value );
				return mb_substr( $value, 0, 6 );
			},
			'default'           => 'Menu',
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_disable_sticky',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $value ) {
				return 'yes' === $value ? 'yes' : 'no';
			},
			'default'           => 'no',
		)
	);

}
add_action( 'admin_init', 'slsh_register_settings' );

// ============================================
// Settings page in admin menu
// ============================================

/**
 * Register options page
 * 
 * @since 1.0
 * @return void
 */
function slsh_register_options_page(): void {
	add_options_page(
		'Dynamic Header & Navigation for Block Themes',
		'Dynamic Header & Navigation for Block Themes',
		'manage_options',
		'slsh',
		'slsh_options_page'
	);
}
add_action( 'admin_menu', 'slsh_register_options_page' );

/**
 * Show options page
 *
 * @since 1.0
 * @return void
 */
function slsh_options_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'shrinking-logo-sticky-header' ) );
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Dynamic Header & Navigation for Block Themes', 'shrinking-logo-sticky-header' ); ?></h1>

		<form method="post" action="options.php">
			<?php
			settings_fields( 'slsh_options_group' );
			do_settings_sections( 'slsh_options_group' );
			?>
			<table class="form-table">
				<!-- Header sizing section -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:0; padding-top: 0; padding-bottom: 10px; border-bottom: 2px solid #333;"><?php esc_html_e( 'Header Sizing', 'shrinking-logo-sticky-header' ); ?></h3></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_heigth_header"><?php esc_html_e( 'Header Height (px) - Standard: 100:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" id="slsh_heigth_header" name="slsh_heigth_header" value="<?php echo esc_attr( slsh_get_option( 'slsh_heigth_header', 100 ) ); ?>" min="50" max="300" />
						<p class="description"><?php esc_html_e( 'The height of the header in normal state.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_header_shrink_height"><?php esc_html_e( 'Shrink Header Height (px) - Standard: 80:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" id="slsh_header_shrink_height" name="slsh_header_shrink_height" value="<?php echo esc_attr( slsh_get_option( 'slsh_header_shrink_height', 80 ) ); ?>" min="30" max="250" />
						<p class="description"><?php esc_html_e( 'The height of the header when scrolled down.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_animation_duration"><?php esc_html_e( 'Animation Speed (seconds) - Standard: 0.8:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" step="0.1" id="slsh_animation_duration" name="slsh_animation_duration" value="<?php echo esc_attr( slsh_get_option( 'slsh_animation_duration', 0.8 ) ); ?>" min="0.1" max="5" />
						<p class="description"><?php esc_html_e( 'Duration of the shrinking animation in seconds.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>

				<!-- Logo sizing section -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;"><?php esc_html_e( 'Logo Sizing', 'shrinking-logo-sticky-header' ); ?></h3></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_logo_in_header_shrink_height"><?php esc_html_e( 'Logo Scale on Shrink - Standard: 0.8:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" step="0.05" id="slsh_logo_in_header_shrink_height" name="slsh_logo_in_header_shrink_height" value="<?php echo esc_attr( slsh_get_option( 'slsh_logo_in_header_shrink_height', 0.8 ) ); ?>" min="0.1" max="1.5" />
						<p class="description"><?php esc_html_e( 'Scale factor for the logo when header shrinks (e.g. 0.8 = 80% of original size).', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_logo_in_header_shrink_left"><?php esc_html_e( 'Logo Left Offset on Shrink (rem) - Standard: 0:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" step="0.1" id="slsh_logo_in_header_shrink_left" name="slsh_logo_in_header_shrink_left" value="<?php echo esc_attr( slsh_get_option( 'slsh_logo_in_header_shrink_left', 0 ) ); ?>" min="0" max="10" />
						<p class="description"><?php esc_html_e( 'Move the logo to the left when header shrinks (in rem units).', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_disable_padding"><?php esc_html_e( 'Disable Header Padding when shrunk:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_disable_padding" name="slsh_disable_padding" value="yes" <?php checked( 'yes', slsh_get_option( 'slsh_disable_padding', 'no' ) ); ?> />
						<p class="description"><?php esc_html_e( 'Remove padding from header when in shrunk state.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>

				<!-- Navigation section -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;"><?php esc_html_e( 'Breakpoint and Accessibility', 'shrinking-logo-sticky-header' ); ?></h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left; font-size: 0.8rem;"><?php esc_html_e( 'A breakpoint is a screen width where the website layout changes to adapt for different devices like mobiles or desktops. If the breakpoint remains set at 599px, then the breakpoint will be adopted by the theme without change.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_nav_breakpoint"><?php esc_html_e( 'Breakpoint Navigation (px) - Standard: 599:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" id="slsh_nav_breakpoint" name="slsh_nav_breakpoint" value="<?php echo esc_attr( slsh_get_option( 'slsh_nav_breakpoint', 599 ) ); ?>" min="599" max="1920" />
						<p class="description"><?php esc_html_e( 'Screen width at which mobile navigation appears.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_enable_text_menu"><?php esc_html_e( 'Enable Text <Menu> below mobile Icon and display larger mobile menu Icon (Hamburger) - better for accessibility reasons:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_enable_text_menu" name="slsh_enable_text_menu" value="yes" <?php checked( 'yes', slsh_get_option( 'slsh_enable_text_menu', 'no' ) ); ?> />
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_text_menu"><?php esc_html_e( 'Label Text <Menu> (max. 6 characters): ', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="text" id="slsh_text_menu" name="slsh_text_menu" value="<?php echo esc_attr( slsh_get_option( 'slsh_text_menu', 'Menu' ) ); ?>" maxlength="6" />
						<p class="description"><?php esc_html_e( 'Text label for the mobile menu button.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>

				<!-- Off-Canvas section -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;"><?php esc_html_e( 'Off-Canvas-Menu', 'shrinking-logo-sticky-header' ); ?></h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left; font-size: 0.8rem;"><?php esc_html_e( 'Off-canvas is a hidden navigation panel that slides in from the side of the screen, providing a space-saving way to access menu options without cluttering the main content area.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_enable_off_canvas"><?php esc_html_e( 'Activate Off-Canvas (CSS Rules):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_enable_off_canvas" name="slsh_enable_off_canvas" value="yes" <?php checked( 'yes', slsh_get_option( 'slsh_enable_off_canvas', 'no' ) ); ?> />
						<p class="description"><?php esc_html_e( 'Enable off-canvas menu sliding from the side.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_off_canvas_speed"><?php esc_html_e( 'Option for the speed of the Off-Canvas fade-in (Value in 0.1 steps - The smaller the value, the faster the fade-in):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" step="0.1" id="slsh_off_canvas_speed" name="slsh_off_canvas_speed" value="<?php echo esc_attr( slsh_get_option( 'slsh_off_canvas_speed', 0.5 ) ); ?>" min="0.1" max="1" />
						<p class="description"><?php esc_html_e( 'Duration of the off-canvas slide-in animation.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>

				<!-- Background Color section -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;"><?php esc_html_e( 'Background Color for Header', 'shrinking-logo-sticky-header' ); ?></h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left; font-size: 0.8rem;"><?php esc_html_e( 'The header is normally transparent. However, you can set the background color for the header in the template part of your block theme (recommended). The background color for the header can also be set automatically using the following settings.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_enable_background_color"><?php esc_html_e( 'Activate Background Color for Header (CSS Rules):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_enable_background_color" name="slsh_enable_background_color" value="yes" <?php checked( 'yes', slsh_get_option( 'slsh_enable_background_color', 'no' ) ); ?> />
						<p class="description"><?php esc_html_e( 'Add background color to header using theme default color.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>

				<!-- Sticky disable section -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;"><?php esc_html_e( 'Mobile Options', 'shrinking-logo-sticky-header' ); ?></h3></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_disable_sticky"><?php esc_html_e( 'Disable sticky header on mobile devices:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_disable_sticky" name="slsh_disable_sticky" value="yes" <?php checked( 'yes', slsh_get_option( 'slsh_disable_sticky', 'no' ) ); ?> />
						<p class="description"><?php esc_html_e( 'Header will be normal (not sticky) on mobile screens.', 'shrinking-logo-sticky-header' ); ?></p>
					</td>
				</tr>

			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

// ============================================
// Load Dynamic CSS for Plugin
// ============================================

/**
 * Generate and enqueue dynamic CSS
 *
 * @since 1.0
 * @return void
 */
function slsh_dynamic_css(): void {
	
	// ============================================
	// Enqueue base stylesheet
	// ============================================
	
	wp_enqueue_style(
		'slsh_style',
		plugins_url( 'assets/css/shrinking-logo-sticky-header-style.css', __FILE__ ),
		array(),
		SLSH_VERSION
	);
	
	// ============================================
	// Get all options with defaults
	// ============================================
	
	$shrink_height      = absint( slsh_get_option( 'slsh_header_shrink_height', 80 ) );
	$anim_duration      = (float) slsh_get_option( 'slsh_animation_duration', 0.8 );
	$header_height      = absint( slsh_get_option( 'slsh_heigth_header', 100 ) );
	$logo_shrink_height = (float) slsh_get_option( 'slsh_logo_in_header_shrink_height', 0.8 );
	$logo_shrink_left   = (float) slsh_get_option( 'slsh_logo_in_header_shrink_left', 0 );
	$nav_breakpoint     = absint( slsh_get_option( 'slsh_nav_breakpoint', 599 ) );
	$enable_off_canvas  = slsh_get_option( 'slsh_enable_off_canvas', 'no' );
	$off_canvas_speed   = (float) slsh_get_option( 'slsh_off_canvas_speed', 0.5 );
	$enable_bg_color    = slsh_get_option( 'slsh_enable_background_color', 'no' );
	$disable_padding    = slsh_get_option( 'slsh_disable_padding', 'no' );
	$enable_text_menu   = slsh_get_option( 'slsh_enable_text_menu', 'no' );
	$text_menu          = sanitize_text_field( slsh_get_option( 'slsh_text_menu', 'Menu' ) );
	$disable_sticky     = slsh_get_option( 'slsh_disable_sticky', 'no' );
	
	// ============================================
	// Validate and clamp values
	// ============================================
	
	$shrink_height  = max( 30, min( 250, $shrink_height ) );
	$header_height  = max( 50, min( 300, $header_height ) );
	$anim_duration  = max( 0.1, min( 5, $anim_duration ) );
	$logo_shrink_height = max( 0.1, min( 1.5, $logo_shrink_height ) );
	$logo_shrink_left   = max( 0, min( 10, $logo_shrink_left ) );
	$nav_breakpoint = max( 599, min( 1920, $nav_breakpoint ) );
	
	// ============================================
	// Build CSS with CSS Variables
	// ============================================
	
	$custom_css = "
		:root {
			--header-height: {$header_height}px;
			--header-height-shrink: {$shrink_height}px;
			--animation-speed: {$anim_duration}s;
			--logo-scale: {$logo_shrink_height};
			--logo-offset: {$logo_shrink_left}rem;
			--nav-breakpoint: {$nav_breakpoint}px;
			--off-canvas-speed: {$off_canvas_speed}s;
		}
		
		/* Override CSS variables in stylesheet */
		header.wp-block-template-part {
			height: var(--header-height);
			transition: height var(--animation-speed) cubic-bezier(0.4, 0, 0.2, 1), background-color var(--animation-speed) cubic-bezier(0.4, 0, 0.2, 1);
			will-change: height, background-color;
		}
		
		header.wp-block-template-part.shrink {
			height: var(--header-height-shrink);
		}
		
		header.wp-block-template-part .wp-block-site-logo img {
			transition: transform var(--animation-speed) cubic-bezier(0.4, 0, 0.2, 1);
			will-change: transform;
		}
		
		header.wp-block-template-part.shrink .wp-block-site-logo img {
			transform: scale(var(--logo-scale)) translateX(-var(--logo-offset));
		}
		
		html {
			scroll-padding-top: {$header_height}px;
		}
	";

	// ============================================
	// Conditional CSS - Disable Padding
	// ============================================
	
	if ( 'yes' === $disable_padding ) {
		$custom_css .= "
			header.wp-block-template-part.shrink .wp-block-group {
				padding-top: 0px !important;
				padding-bottom: 0px !important;
			}
		";
	}
	
	// ============================================
	// Conditional CSS - Enable Text Menu
	// ============================================

	if ( 'yes' === $enable_text_menu ) {
		$safe_text = esc_html( sanitize_text_field( $text_menu ) );
		$custom_css .= "
			.wp-block-navigation__responsive-container-open::after {
				content: '{$safe_text}';
				font-size: 15px;
				padding-top: 4px;
				text-align: center;
			}
			
			.wp-block-navigation__responsive-container-open svg,
			.wp-block-navigation__responsive-container-close svg {
				height: 44px;
				width: 44px;
			}
		";
	}

	// ============================================
	// Conditional CSS - Custom Breakpoint
	// ============================================

	if ( $nav_breakpoint > 599 ) {
		$custom_css .= "
			@media screen and (max-width: {$nav_breakpoint}px) {
				.wp-block-navigation__responsive-container-open {
					display: block !important;
				}
				.wp-block-navigation__responsive-container:not(.is-menu-open.has-modal-open) {
					display: none !important;
				}
			}
		";
	}

	// ============================================
	// Conditional CSS - Off Canvas Menu
	// ============================================

	if ( 'yes' === $enable_off_canvas ) {
		$custom_css .= "
			@media (max-width: {$nav_breakpoint}px) {
				.wp-block-navigation__responsive-container {
					right: -70vw;
					left: auto;
					width: 70vw;
					transition: none;
					border-radius: 0;
				}
				
				.wp-block-navigation__responsive-container.is-menu-open {
					animation: slideInMenu var(--off-canvas-speed) linear forwards;
				}
				
				@keyframes slideInMenu {
					from {
						right: -70vw;
					}
					to {
						right: 0vw;
					}
				}
			}
		";
	}

	// ============================================
	// Conditional CSS - Background Color
	// ============================================

	if ( 'yes' === $enable_bg_color ) {
		$custom_css .= "
			header.wp-block-template-part {
				background-color: var(--wp--preset--color--base);
			}
		";	
	}
	
	// ============================================
	// Conditional CSS - Disable Sticky on Mobile
	// ============================================
	
	if ( 'yes' === $disable_sticky ) {
		$custom_css .= "
			@media screen and (max-width: {$nav_breakpoint}px) {
				header.wp-block-template-part {
					position: inherit;
				}
			}
		";	
	}

	// ============================================
	// Add inline styles
	// ============================================
	
	wp_add_inline_style( 'slsh_style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'slsh_dynamic_css' );

// ============================================
// Enqueue script
// ============================================

/**
 * Enqueue frontend script
 *
 * @since 1.0
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
	
	// Pass settings to JavaScript
	$js_settings = array(
		'headerHeight'    => absint( slsh_get_option( 'slsh_heigth_header', 100 ) ),
		'shrinkHeight'    => absint( slsh_get_option( 'slsh_header_shrink_height', 80 ) ),
		'animationSpeed'  => (float) slsh_get_option( 'slsh_animation_duration', 0.8 ),
		'navBreakpoint'   => absint( slsh_get_option( 'slsh_nav_breakpoint', 599 ) ),
	);
	
	wp_localize_script( 'slsh_js', 'slshSettings', $js_settings );
}
add_action( 'wp_enqueue_scripts', 'slsh_enqueue' );

// ============================================
// Plugin activation/deactivation hooks
// ============================================

/**
 * Plugin activation hook
 * 
 * @since 1.6
 * @return void
 */
function slsh_plugin_activation(): void {
	// Initialize default options on activation
	$defaults = slsh_get_option_defaults();
	foreach ( $defaults as $option_key => $default_value ) {
		if ( false === get_option( $option_key ) ) {
			add_option( $option_key, $default_value );
		}
	}
	
	// Flush rewrite rules
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'slsh_plugin_activation' );

/**
 * Plugin deactivation hook
 * 
 * @since 1.6
 * @return void
 */
function slsh_plugin_deactivation(): void {
	// Clean up - optional: delete options on deactivation
	// Uncomment if you want to delete all plugin options when deactivating
	/*
	$defaults = slsh_get_option_defaults();
	foreach ( array_keys( $defaults ) as $option_key ) {
		delete_option( $option_key );
	}
	*/
	
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'slsh_plugin_deactivation' );
