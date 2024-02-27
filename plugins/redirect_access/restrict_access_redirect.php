<?php
/**
 * Restrict Access Redirect
 *
 * @package       RESTRICTAC
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Restrict Access Redirect
 * Plugin URI:    https://haurand.com
 * Description:   WordPress plugin that prevents non-logged-in users from accessing the website and redirects them to the login page with a message
 * Version:       0.1
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

// Function to check if the user is logged in
function restrict_access_redirect() {
    // Check if the user is not logged in
    if ( ! is_user_logged_in() ) {
        // Set the redirect URL to the login page with a message
        $login_url = wp_login_url( home_url( $_SERVER['REQUEST_URI'] ) );
        $login_url = add_query_arg( 'message', 'no_access', $login_url );

        // Redirect the user to the login page
        wp_redirect( $login_url );
        exit;
    }
}

// Hook the function to the 'template_redirect' action
add_action( 'template_redirect', 'restrict_access_redirect' );

// Function to display message on login page
function display_login_message( $message ) {
    if ( isset( $_REQUEST['message'] ) && $_REQUEST['message'] === 'no_access' ) {
        return '<p class="message">No access - please log in</p>';
    }
    return $message;
}

// Hook the function to the 'login_message' filter
add_filter( 'login_message', 'display_login_message' );