<?php
/**
 * Shrinking Logo Sticky Header
 *
 * @package       shrinkingLO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       1.6.0
 *
 * @wordpress-plugin
 * Plugin Name:   Dynamic Header & Navigation for Block Themes
 * Plugin URI:    https://haurand.com/plugin-shrinking-logo-sticky-header/
 * Description:   Animated shrinking header, responsive shrinking logo, custom breakpoints and off-canvas navigation – all-in-one navigation solution for most modern WordPress block themes.
 * Version:       1.6.0
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
define( 'SLSH_VERSION', '1.6.0' );

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
	add_option( 'slsh_nav_breakpoint', 599 );
	
	// Delete superfluous option 
	delete_option( 'slsh_enable_nav_css' );
	delete_option( 'slsh_base_opacity' );
	
	// Option for Off-Canvas-Menue
	add_option( 'slsh_enable_off_canvas', 'no' );
	
	// Option for Option for the speed of the Off-Canvas fade-in - Version 1.3.1 
	add_option( 'slsh_off_canvas_speed', 0.5 );
	
	// Option for Background Color
	add_option( 'slsh_enable_background_color', 'no' );
	
	// Option hide header if scroll down, show header if scroll up
	add_option( 'slsh_hide_header', 'no' );
	
	// Disable inner spacing (padding) in header?
	add_option( 'slsh_disable_padding', 'no' );
	
	// Activate text menu below the mobile menu (hamburger)
	add_option( 'slsh_enable_text_menu', 'no' );
	
	// Description for text menu below the mobile menu (hamburger)
	add_option( 'slsh_text_menu', 'Menu' );
	
	// Deactivate shrinking on mobile
	add_option( 'slsh_disable_sticky', 'no' );
	
	// Deactivate Margin Header top
	add_option( 'slsh_disable_margin_header', 'no' );
	
    // Frosted glass header
    add_option( 'slsh_enable_glass', 'no' );
    // Glass color is selected by the active block-theme preset slug.
    add_option( 'slsh_glass_color_slug', 'base' );
    add_option( 'slsh_glass_opacity', 25 );
    add_option( 'slsh_glass_blur', 12 );

    // Hide header: sensitivity and delay
    add_option( 'slsh_hide_sensitivity', 10 );
    add_option( 'slsh_hide_delay', 0 );	

    register_setting(
        'slsh_options_group',
        'slsh_header_shrink_height',
        array(
            'type'              => 'integer',
            'sanitize_callback' => function ( $v ) {
                return max( 40, min( 300, absint( $v ) ) );
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_animation_duration',
        array(
            'type'              => 'number',
            'sanitize_callback' => function ( $v ) {
                return max( 0.05, min( 3, (float) $v ) );
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_heigth_header',
        array(
            'type'              => 'integer',
            'sanitize_callback' => function ( $v ) {
                return max( 40, min( 300, absint( $v ) ) );
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_logo_in_header_shrink_height',
        array(
            'type'              => 'number',
            'sanitize_callback' => function ( $v ) {
                return max( 0.4, min( 1, (float) $v ) );
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_logo_in_header_shrink_left',
        array(
            'type'              => 'number',
            'sanitize_callback' => function ( $v ) {
                return max( 0, min( 8, (float) $v ) );
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_nav_breakpoint',
        array(
            'type'              => 'integer',
            'sanitize_callback' => function ( $v ) {
                return max( 599, min( 1920, absint( $v ) ) );
            },
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
            'type'              => 'number',
            'sanitize_callback' => function ( $v ) {
                return max( 0.1, min( 1, (float) $v ) );
            },
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
	
	register_setting(
		'slsh_options_group',
		'slsh_hide_header',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $v ) {
				return 'yes' === $v ? 'yes' : 'no';
			},
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_disable_padding',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $v ) {
				return 'yes' === $v ? 'yes' : 'no';
			},
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_enable_text_menu',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $v ) {
				return 'yes' === $v ? 'yes' : 'no';
			},
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_text_menu',
		array(
			'type'              => 'string',
			'sanitize_callback' => function( $value ) {
				$value = sanitize_text_field( $value );         // Securing
				return mb_substr( $value, 0, 6 );               // Limited to 6 characters
			},
			'default'           => 'Menu',                      // Default value if none set
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_disable_sticky',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $v ) {
				return 'yes' === $v ? 'yes' : 'no';
			},
		)
	);
	
	register_setting(
		'slsh_options_group',
		'slsh_disable_margin_header',
		array(
			'type'              => 'string',
			'sanitize_callback' => function ( $v ) {
				return 'yes' === $v ? 'yes' : 'no';
			},
		)
	);
	
    register_setting(
        'slsh_options_group',
        'slsh_enable_glass',
        array(
            'type'              => 'string',
            'sanitize_callback' => function ( $v ) {
                return 'yes' === $v ? 'yes' : 'no';
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_glass_color_slug',
        array(
            'type'              => 'string',
            'sanitize_callback' => function ( $v ) {
                $slug = sanitize_title( $v );
                return $slug ? $slug : 'base';
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_glass_opacity',
        array(
            'type'              => 'integer',
            'sanitize_callback' => function ( $v ) {
                return max( 0, min( 100, absint( $v ) ) );
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_glass_blur',
        array(
            'type'              => 'integer',
            'sanitize_callback' => function ( $v ) {
                return max( 0, min( 40, absint( $v ) ) );
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_hide_sensitivity',
        array(
            'type'              => 'integer',
            'sanitize_callback' => function ( $v ) {
                return max( 1, min( 100, absint( $v ) ) );
            },
        )
    );

    register_setting(
        'slsh_options_group',
        'slsh_hide_delay',
        array(
            'type'              => 'integer',
            'sanitize_callback' => function ( $v ) {
                return max( 0, min( 2000, absint( $v ) ) );
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
 * Add a settings link to the plugin list.
 *
 * @param array<string> $links Existing plugin action links.
 * @return array<string> Updated plugin action links.
 */
function slsh_plugin_action_links( array $links ): array {
	array_unshift(
		$links,
		'<a href="' . esc_url( admin_url( 'options-general.php?page=slsh' ) ) . '">' . esc_html__( 'Settings', 'shrinking-logo-sticky-header' ) . '</a>'
	);

	return $links;
}

if ( is_admin() ) {
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'slsh_plugin_action_links' );
}


/**
 * Show options page.
 *
 * @return void
 */
function slsh_options_page(): void {
	?>
	<div style="max-width:80%; margin-left: auto; margin-right:auto; font-size: 1rem;">
		<div class="notice notice-info">
		  <p style="font-size: larger; font-weight: bold;">Notice:</p>
		  <p>
			<?php esc_html_e( 'Thanks a lot for using our Plugin. We would appreciate a review of the Plugin', 'shrinking-logo-sticky-header' ); ?>
			<a href="https://wordpress.org/plugins/shrinking-logo-sticky-header/#reviews"
			   target="_blank"
			   rel="noopener noreferrer"
			   aria-label="Review Dynamic Header & Navigation for Block Themes on WordPress.org">
			  <?php esc_html_e( 'Dynamic Header & Navigation for Block Themes', 'shrinking-logo-sticky-header' ); ?>
			</a><br>
			<?php esc_html_e( 'Thanks a lot :-)', 'shrinking-logo-sticky-header' ); ?>
		  </p>
		</div>
		<h2 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;"><?php esc_html_e( 'Dynamic Header & Navigation for Block Themes – Settings: Version ', 'shrinking-logo-sticky-header' ); ?><?php if (defined('SLSH_VERSION')) echo esc_html(SLSH_VERSION); ?></h2>
		<form method="post" action="<?php echo esc_url( get_admin_url() ); ?>options.php">
			<?php settings_fields( 'slsh_options_group' ); ?>

			<table>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_header_shrink_height"><?php esc_html_e( 'Height of the shrunk header (40-300px):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" id="slsh_header_shrink_height" name="slsh_header_shrink_height" value="<?php echo esc_attr( get_option( 'slsh_header_shrink_height', 80 ) ); ?>" min="40" max="300" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_disable_padding"><?php esc_html_e( 'Disable inner spacing (padding) in header (may be helpful if the height of the shrinked header is very low)?', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_disable_padding" name="slsh_disable_padding" value="yes" <?php checked( 'yes', get_option( 'slsh_disable_padding', 'no' ) ); ?> />
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_animation_duration"><?php esc_html_e( 'Animation duration (0.05-3seconds):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" step="0.05" id="slsh_animation_duration" name="slsh_animation_duration" value="<?php echo esc_attr( get_option( 'slsh_animation_duration', 0.6 ) ); ?>" min="0.05" max="3" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_heigth_header"><?php esc_html_e( 'Normal height of header (40-300px):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" id="slsh_heigth_header" name="slsh_heigth_header" value="<?php echo esc_attr( get_option( 'slsh_heigth_header', 120 ) ); ?>" min="40" max="300" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_logo_in_header_shrink_height"><?php esc_html_e( 'Logo shrinking factor (Value in 0.05 steps: 0.4-1):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" step="0.05" id="slsh_logo_in_header_shrink_height" name="slsh_logo_in_header_shrink_height" value="<?php echo esc_attr( get_option( 'slsh_logo_in_header_shrink_height', 0.8 ) ); ?>" min="0.4" max="1" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_logo_in_header_shrink_left"><?php esc_html_e( 'Move the shrunk logo to the left (0-8rem):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td><input type="number" step="0.1" id="slsh_logo_in_header_shrink_left" name="slsh_logo_in_header_shrink_left" value="<?php echo esc_attr( get_option( 'slsh_logo_in_header_shrink_left', 0 ) ); ?>" min="0" max="8" /></td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_disable_sticky"><?php esc_html_e( 'Should the menu not be displayed as a sticky menu on mobile devices? – This can be helpful for accessibility reasons: ', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_disable_sticky" name="slsh_disable_sticky" value="yes" <?php checked( 'yes', get_option( 'slsh_disable_sticky', 'no' ) ); ?> />
					</td>
				</tr>
				<tr>
					<td colspan="2" style="font-weight: bold; text-align: left; font-size: 0.8rem; padding-top: 10px;">
						<?php esc_html_e( 'The following option is useful if you want to create a row above the header, for example, to display information:', 'shrinking-logo-sticky-header' ); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_disable_margin_header"><?php esc_html_e( 'Above the header, there may be a margin set by the theme. Should this margin be disabled? ', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_disable_margin_header" name="slsh_disable_margin_header" value="yes" <?php checked( 'yes', get_option( 'slsh_disable_margin_header', 'no' ) ); ?> />
					</td>
				</tr>		
                <!-- Hide header on scroll down, show header on scroll up -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;">Hide header on scroll down, show header on scroll up</h3></th>
				</tr>
                <tr>
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_hide_header"><?php esc_html_e( 'Hide header on scroll down, show header on scroll up:', 'shrinking-logo-sticky-header' ); ?></label></th>
                    <td>
                        <input type="checkbox" id="slsh_hide_header" name="slsh_hide_header" value="yes" <?php checked( 'yes', get_option( 'slsh_hide_header', 'no' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_hide_sensitivity"><?php esc_html_e( 'Sensitivity: scroll distance in px before the header reacts (1-100):', 'shrinking-logo-sticky-header' ); ?></label></th>
                    <td><input type="number" id="slsh_hide_sensitivity" name="slsh_hide_sensitivity" value="<?php echo esc_attr( get_option( 'slsh_hide_sensitivity', 10 ) ); ?>" min="1" max="100" /></td>
                </tr>
                <tr>
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_hide_delay"><?php esc_html_e( 'Delay before hiding in ms (0-2000ms):', 'shrinking-logo-sticky-header' ); ?></label></th>
                    <td><input type="number" id="slsh_hide_delay" name="slsh_hide_delay" step="50" value="<?php echo esc_attr( get_option( 'slsh_hide_delay', 0 ) ); ?>" min="0" max="2000" /></td>
                </tr>

				<!-- settings for breakpoint (CSS) -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;">Breakpoint and Accessibility</h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left; font-size: 0.8rem;"><?php esc_html_e( 'A breakpoint is a screen width where the website layout changes to adapt for different devices like mobiles or desktops. If the breakpoint remains set at 599px, then the breakpoint will be adopted by the theme without change.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_nav_breakpoint"><?php esc_html_e( 'Breakpoint Navigation (px) - Standard: 599 (599-1920px):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" id="slsh_nav_breakpoint" name="slsh_nav_breakpoint" value="<?php echo esc_attr( get_option( 'slsh_nav_breakpoint', 599 ) ); ?>" min="599" max="1920" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_enable_text_menu"><?php esc_html_e( 'Enable Text <Menu> below mobile Icon and display larger mobile menu Icon (Hamburger) - better for accessibility reasons:', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_enable_text_menu" name="slsh_enable_text_menu" value="yes" <?php checked( 'yes', get_option( 'slsh_enable_text_menu', 'no' ) ); ?> />
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_text_menu"><?php esc_html_e( 'Label Text <Menu> (max. 6 characters): ', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="text" id="slsh_text_menu" name="slsh_text_menu" value="<?php echo esc_attr( get_option( 'slsh_text_menu', 'Menu' ) ); ?>" maxlength="6" />
					</td>
				</tr>
				<!-- settings for Off-Canvas (CSS) -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;">Off-Canvas-Menu</h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left; font-size: 0.8rem;"><?php esc_html_e( 'Off-canvas is a hidden navigation panel that slides in from the side of the screen, providing a space-saving way to access menu options without cluttering the main content area.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_enable_off_canvas"><?php esc_html_e( 'Activate Off-Canvas (CSS Rules):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_enable_off_canvas" name="slsh_enable_off_canvas" value="yes" <?php checked( 'yes', get_option( 'slsh_enable_off_canvas', 'no' ) ); ?> />
					</td>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_off_canvas_speed"><?php esc_html_e( 'Option for the speed of the Off-Canvas fade-in (Value in 0.1, steps 0.1-1 - The smaller the value, the faster the fade-in):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="number" step="0.1" id="slsh_off_canvas_speed" name="slsh_off_canvas_speed" value="<?php echo esc_attr( get_option( 'slsh_off_canvas_speed', 0.5 ) ); ?>" min="0.1" max="1" />
					</td>
				</tr>

				<!-- settings for Background Color (Header) -->
				<tr>
					<th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;">Background Color for Header</h3></th>
				</tr>
				<tr>
					<th scope="row"><p style="text-align: left; font-size: 0.8rem;"><?php esc_html_e( 'The header is normally transparent. However, you can set the background color for the header in the template part of your block theme (recommended). The background color for the header can also be set automatically using the following settings.', 'shrinking-logo-sticky-header' ); ?></p></th>
				</tr>
				<tr>
					<th scope="row"><label style="display: block; text-align: left" for="slsh_enable_background_color"><?php esc_html_e( 'Activate Background Color for Header (CSS Rules):', 'shrinking-logo-sticky-header' ); ?></label></th>
					<td>
						<input type="checkbox" id="slsh_enable_background_color" name="slsh_enable_background_color" value="yes" <?php checked( 'yes', get_option( 'slsh_enable_background_color', 'no' ) ); ?> />
					</td>
				</tr>

                <!-- settings for Frosted Glass (Header) -->
                <tr>
                    <th scope="row"><h3 style="text-align: left; margin-top:30px; padding-top: 10px; padding-bottom: 10px; border-top: 2px solid #333; border-bottom: 2px solid #333;">Frosted Glass Header</h3></th>
                </tr>
                <tr>
                    <th scope="row"><p style="text-align: left; font-size: 0.8rem;"> <?php esc_html_e( 'A translucent, blurred header that lets the page show through. Colors are inherited from the active block theme if possible; opacity and blur can be adjusted below.', 'shrinking-logo-sticky-header' ); ?></p></th>
                </tr>
                <tr>
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_enable_glass"><?php esc_html_e( 'Activate frosted glass effect:', 'shrinking-logo-sticky-header' ); ?></label></th>
                    <td>
                        <input type="checkbox" id="slsh_enable_glass" name="slsh_enable_glass" value="yes" <?php checked( 'yes', get_option( 'slsh_enable_glass', 'no' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_glass_color_slug"><?php esc_html_e( 'Theme color slug:', 'shrinking-logo-sticky-header' ); ?></label></th>
                    <td><input type="text" id="slsh_glass_color_slug" name="slsh_glass_color_slug" value="<?php echo esc_attr( get_option( 'slsh_glass_color_slug', 'base' ) ); ?>" placeholder="base" /></td>
                </tr>
                <tr>
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_glass_opacity"><?php esc_html_e( 'Opacity of the color (0-100 %):', 'shrinking-logo-sticky-header' ); ?></label></th>
                    <td><input type="number" id="slsh_glass_opacity" name="slsh_glass_opacity" value="<?php echo esc_attr( get_option( 'slsh_glass_opacity', 25 ) ); ?>" min="0" max="100" /></td>
                </tr>
                <tr>
                    <th scope="row"><label style="display: block; text-align: left" for="slsh_glass_blur"><?php esc_html_e( 'Blur amount (0-40 px):', 'shrinking-logo-sticky-header' ); ?></label></th>
                    <td><input type="number" id="slsh_glass_blur" name="slsh_glass_blur" value="<?php echo esc_attr( get_option( 'slsh_glass_blur', 12 ) ); ?>" min="0" max="40" /></td>
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
	$shrink_height      		= max( 40,   min( 300,  (int) get_option( 'slsh_header_shrink_height', 80 ) ) );
	$anim_duration      		= max( 0.05, min( 3,    (float) get_option( 'slsh_animation_duration', 0.6 ) ) );
	$header_height      		= max( 40,   min( 300,  (int) get_option( 'slsh_heigth_header', 120 ) ) );
	$logo_shrink_height 		= max( 0.4,  min( 1,    (float) get_option( 'slsh_logo_in_header_shrink_height', 0.8 ) ) );
	$logo_shrink_left   		= max( 0,    min( 8,    (float) get_option( 'slsh_logo_in_header_shrink_left', 0 ) ) );
	$nav_breakpoint     		= max( 599,  min( 1920, (int) get_option( 'slsh_nav_breakpoint', 599 ) ) );
	$enable_off_canvas  		= get_option( 'slsh_enable_off_canvas', 'no' );
	$off_canvas_speed   		= max( 0.1,  min( 1,(float) get_option( 'slsh_off_canvas_speed', 0.5 ) ) );
	$enable_bg_color    		= get_option( 'slsh_enable_background_color', 'no' );
	$hide_header        		= get_option( 'slsh_hide_header', 'no' );
	$disable_padding    		= get_option( 'slsh_disable_padding', 'no' );
	$enable_text_menu   		= get_option( 'slsh_enable_text_menu', 'no' );
    $text_menu          		= sanitize_text_field( get_option( 'slsh_text_menu', 'Menu' ) );
	$disable_sticky     		= get_option( 'slsh_disable_sticky', 'no' );
	$disable_margin     		= get_option( 'slsh_disable_margin_header', 'no' );
	$enable_glass       		= get_option( 'slsh_enable_glass', 'no' );
    $glass_color_slug    		= sanitize_title( get_option( 'slsh_glass_color_slug', 'base' ) );
    $glass_color_slug    		= $glass_color_slug ? $glass_color_slug : 'base';
    $glass_opacity      		= max( 0, min( 100, (int) get_option( 'slsh_glass_opacity', 25 ) ) );
    $glass_blur         		= max( 0, min( 40,  (int) get_option( 'slsh_glass_blur', 12 ) ) );

	$custom_css = "
        header.wp-block-template-part {
            position: sticky;
            top: 0;
            z-index: 1000;
            --slsh-header-height: {$header_height}px;
            --slsh-hide-top: 0px;
            transition: height {$anim_duration}s cubic-bezier(.4,0,.2,1), background-color {$anim_duration}s;
            height: {$header_height}px; 
			backface-visibility: hidden; /* Should prevent flickering */
        }
        header.wp-block-template-part.shrink {
            height: {$shrink_height}px;
        }
        header.wp-block-template-part .wp-block-group {
            height: 100%;
			/* align-content: space-around; */
            align-items: center;
        }
        header.wp-block-template-part .wp-block-site-logo img {
            transition: transform {$anim_duration}s cubic-bezier(0.4,0,0.2,1);
        }
        header.wp-block-template-part.shrink .wp-block-site-logo img {
            transform: translateX(-{$logo_shrink_left}rem) scale({$logo_shrink_height});
        }
		html {
		  scroll-behavior: smooth;
		  scroll-padding-top: {$header_height}px;
		}
    ";


	if ( 'yes' === $disable_padding ) {
		$custom_css .= "
			/* Set padding to 0px in header */
			header.wp-block-template-part.shrink .wp-block-group {
				padding-top: 0px !important;
				padding-bottom: 0px !important;
		}";
	}
	

	if ( 'yes' === $enable_text_menu ) {
		// Save text before inserting into CSS:
		$safe_text = preg_replace( '/[^\p{L}\p{N} \-_]/u', '', sanitize_text_field( $text_menu ) );
		$safe_text = mb_substr( $safe_text, 0, 6 ); // Bereits in sanitize_callback, aber doppelt hält besser
		$custom_css .= "
		/* Enable Text Menu below mobile Icon */
		  .wp-block-navigation__responsive-container-open::after {
			content: '{$safe_text}';
			font-size: 15px;
			padding-top: 4px;
			text-align: center;
		}
		/* changed height and width for SVG close and open (mobile menu) */
		.wp-block-navigation__responsive-container-open svg,
		.wp-block-navigation__responsive-container-close svg{
			height: 44px;
			width: 44px;
		}";
	}



	if ( $nav_breakpoint > 599 ) {
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
	else
	{
		/* setting new breakpoint because of issues when enabling off canvas (ollie theme for example) */
	    $nav_breakpoint = 599;
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
	
    if ( 'yes' === $enable_glass ) {
        $glass_min = (int) $nav_breakpoint + 1;
        $custom_css .= "
        /* Frosted glass is painted on a pseudo-element so the header does not
           become a containing block for position: fixed off-canvas children. */
        @media (min-width: {$glass_min}px) {
            header.wp-block-template-part {
                isolation: isolate;
                background-color: transparent !important;
            }
            header.wp-block-template-part::before {
                content: \"\";
                position: absolute;
                inset: 0;
                z-index: -1;
                pointer-events: none;
				background-color: color-mix(in srgb, var(--wp--preset--color--{$glass_color_slug}, Canvas) {$glass_opacity}%, transparent);
				-webkit-backdrop-filter: blur({$glass_blur}px) saturate(150%);
				backdrop-filter: blur({$glass_blur}px) saturate(150%);
            }
            header.wp-block-template-part .wp-block-group.has-{$glass_color_slug}-background-color {
                background-color: transparent !important;
            }
            header.wp-block-template-part a {
                color: inherit;
            }
        }
        @media (max-width: {$nav_breakpoint}px) {
            header.wp-block-template-part {
                background-color: var(--wp--preset--color--{$glass_color_slug}, Canvas) !important;
            }
            header.wp-block-template-part::before {
                background-color: transparent;
                -webkit-backdrop-filter: none;
                backdrop-filter: none;
            }
        }
        @media (prefers-reduced-transparency: reduce) {
            header.wp-block-template-part {
                background-color: var(--wp--preset--color--{$glass_color_slug}, Canvas) !important;
            }
            header.wp-block-template-part::before {
                background-color: var(--wp--preset--color--{$glass_color_slug}, Canvas);
                -webkit-backdrop-filter: none;
                backdrop-filter: none;
            }
        }
        /* While the navigation modal is open, remove the glass layer and
           neutralize header effects that could interfere with fixed children. */
        html.has-modal-open header.wp-block-template-part,
        html:has(.wp-block-navigation__responsive-container.is-menu-open) header.wp-block-template-part {
            transform: none !important;
            filter: none !important;
            -webkit-filter: none !important;
            backface-visibility: visible !important;
        }
        html.has-modal-open header.wp-block-template-part::before,
        html:has(.wp-block-navigation__responsive-container.is-menu-open) header.wp-block-template-part::before {
            background-color: transparent !important;
            -webkit-backdrop-filter: none !important;
            backdrop-filter: none !important;
        }";
    }

    if ( 'yes' === $hide_header ) {
        $custom_css .= "
        /* Hide header on scroll down without transform: a transformed header
           becomes the containing block for position: fixed off-canvas children. */
        header.wp-block-template-part {
            --slsh-hide-top: calc(-1 * {$header_height}px);
            transition: height {$anim_duration}s cubic-bezier(.4,0,.2,1), background-color {$anim_duration}s, top 0.35s ease;
            will-change: top;
        }
        header.wp-block-template-part.shrink {
            --slsh-hide-top: calc(-1 * {$shrink_height}px);
        }
        header.wp-block-template-part.slsh-hidden {
            top: var(--slsh-hide-top);
        }
        /* Never move or promote the header while the navigation modal is open. */
        html.has-modal-open header.wp-block-template-part,
        html:has(.wp-block-navigation__responsive-container.is-menu-open) header.wp-block-template-part {
            top: 0 !important;
            transform: none !important;
            transition: none !important;
            will-change: auto !important;
            filter: none !important;
            -webkit-filter: none !important;
            backface-visibility: visible !important;
            perspective: none !important;
            contain: none !important;
        }
        @media (prefers-reduced-motion: reduce) {
            header.wp-block-template-part { transition: none; }
        }";
    }
	
	if ( 'yes' === $disable_sticky ) {
		$custom_css .= "
		/* Disable Sticky on mobile */
		@media screen and (max-width: {$nav_breakpoint}px) {
			header.wp-block-template-part {
				 position: inherit;
			}
		}";	
	}
	
	if ( 'yes' === $disable_margin ) {
		$custom_css .= "
		/* Disable Top Margin (Header) */
		header.wp-block-template-part {
			margin-top: 0px;
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
    wp_localize_script(
        'slsh_js',
        'slshConfig',
        array(
            'hide'        => 'yes' === get_option( 'slsh_hide_header', 'no' ),
            'sensitivity' => max( 1, (int) get_option( 'slsh_hide_sensitivity', 10 ) ),
            'delay'       => max( 0, (int) get_option( 'slsh_hide_delay', 0 ) ),
        )
    );
}
add_action( 'wp_enqueue_scripts', 'slsh_enqueue' );
