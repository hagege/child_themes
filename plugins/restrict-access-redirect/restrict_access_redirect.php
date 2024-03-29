<?php
/**
 * Restrict Access Redirect
 *
 * @package       RESTRICTAC
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.4
 *
 * @wordpress-plugin
 * Plugin Name:   Restrict Access Redirect
 * Plugin URI:    https://haurand.com
 * Description:   WordPress plugin that prevents non-logged-in users from accessing the website and redirects them to the login page with a message
 * Version:       0.4
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   restrict-access-redirect
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Restrict Access Redirect. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

// Add plugin settings page to the dashboard menu
function restrict_access_custom_login_message_menu() {
    add_options_page(
        'Restrict Access - Custom Login Message Settings',
        'Restrict Access',
        'manage_options',
        'restrict-access-custom-login-message',
        'restrict_access_custom_login_message_options_page'
    );
}
add_action('admin_menu', 'restrict_access_custom_login_message_menu');

// Register plugin settings
function restrict_access_custom_login_message_register_settings() {
    register_setting('restrict-access-custom-login-message-settings-group', 'restrict_access_custom_login_message');
	register_setting('restrict-access-custom-login-message-settings-group', 'restrict_access_disable_admin_bar_setting');
}
add_action('admin_init', 'restrict_access_custom_login_message_register_settings');

// Function to render the plugin settings page
function restrict_access_custom_login_message_options_page() {
    ?>
    <div class="wrap">
        <h2>Restrict Access - Custom Login Message Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('restrict-access-custom-login-message-settings-group'); ?>
            <?php do_settings_sections('restrict-access-custom-login-message-settings-group'); ?>
			<!-- <?php var_dump(esc_attr(get_option('restrict_access_custom_login_message'))); ?>
			<?php var_dump(esc_attr(get_option('restrict_access_disable_admin_bar_setting'))); ?> -->
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Login Message:</th>
                    <td><input type="text" name="restrict_access_custom_login_message" value="<?php echo esc_attr(get_option('restrict_access_custom_login_message', 'No access - please log in')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Disable Admin Bar for Non-Admin Users</th>
                    <td><input type="checkbox" name="restrict_access_disable_admin_bar_setting" <?php checked( get_option( 'restrict_access_disable_admin_bar_setting' ), 'on' ); ?> /></td>
                </tr>

            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


// Function to display custom message on login page and center the title
function restrict_access_custom_login_message_and_center_title($message) {
    if (isset($_REQUEST['message'])) {
        $custom_message = urldecode($_REQUEST['message']);
        $message .= '<h2 style="background-color: red; color: white; font-size: 2.5rem; text-align: center; margin-bottom: 1rem;">' . get_bloginfo( 'name' ) . '</h2>';
        $message .= '<p class="message">' . esc_html($custom_message) . '</p>';
    }

    return $message;
}
add_filter('login_message', 'restrict_access_custom_login_message_and_center_title');



// Function to disable admin bar for non-admin users
function restrict_access_disable_admin_bar() {
    // Check if user is not an administrator
    if ( ! current_user_can( 'manage_options' ) && get_option( 'restrict_access_disable_admin_bar_setting' ) == 'on' ) {
       show_admin_bar( false );
    }
}
add_action( 'after_setup_theme', 'restrict_access_disable_admin_bar' );



// Function to check if the user is logged in
function restrict_access_custom_login_redirect() {
    if (!is_user_logged_in()) {
        // Get custom login message from plugin settings
        $custom_message = get_option('restrict_access_custom_login_message', 'No access - please log in');

        // Set the redirect URL to the login page with the custom message
        $login_url = wp_login_url(home_url($_SERVER['REQUEST_URI']));
        $login_url = add_query_arg('message', urlencode($custom_message), $login_url);

        // Redirect the user to the login page
        wp_redirect($login_url);
        exit;
    }
}
add_action('template_redirect', 'restrict_access_custom_login_redirect');


// Function to sanitize checkbox
function sanitize_checkbox( $input ) {
    return ( isset( $input ) && $input == 1 ) ? 1 : 0;
}

