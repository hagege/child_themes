<?php
/**
 * Restrict Post Access
 *
 * @package       RESTRICTPO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.3
 *
 * @wordpress-plugin
 * Plugin Name:   Restrict Post Access
 * Plugin URI:    https://haurand.com
 * Description:   Benutzerrolle, bei der Berechtigungen für bestimmte Beiträge zum Lesen eingerichtet werden können und ansonsten kein Zugriff auf die Website möglich sein soll..
 * Version:       0.3
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   restrict-post-access
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Restrict Post Access. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

// Benutzerrolle "Eingeschränkter Benutzer" hinzufügen
function add_restricted_user_role() {
    add_role('restricted_user', 'Eingeschränkter Benutzer', array(
        'read' => true,
        'read_private_posts' => true,
    ));
}
register_activation_hook(__FILE__, 'add_restricted_user_role');

// Zugriff auf nur "Freigegeben"-Kategorie einschränken
function restrict_access_for_restricted_user($query) {
    if (!is_admin() && $query->is_main_query() && !current_user_can('administrator')) {
        if (current_user_can('restricted_user')) {
            // Beschränkung auf die Kategorie "Freigegeben"
            $query->set('category_name', 'freigegeben');
        } else {
            // Redirect für andere Benutzer ohne Rechte
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('pre_get_posts', 'restrict_access_for_restricted_user');

// Zugriff auf andere Seiten als die Kategorie "Freigegeben" blockieren
function block_other_pages_for_restricted_user() {
    if (current_user_can('restricted_user')) {
        if (!is_category('freigegeben') && !is_single() && !is_home()) {
            wp_redirect(home_url('/category/freigegeben/'));
            exit();
        }
    }
}
add_action('template_redirect', 'block_other_pages_for_restricted_user');


// Inhalt basierend auf der Berechtigung einschränken
// Damit kann das Problem z. B. für sticky posts umgangen werden.
function restrict_content_by_role_and_meta($content) {
	$restricted = 'yes';            // zunächst nicht freigegeben
	$post_id = get_the_ID();        // Hole die Post-ID
	$category_slug = 'freigegeben'; // Slug der Kategorie
	if (has_category($category_slug, $post_id)) {
		$restricted = 'no';         // freigegeben
	}
    if (is_single() && $restricted === 'yes') {
       return 'Dieser Inhalt ist für dich nicht verfügbar.';
    }
    return $content;
}
add_filter('the_content', 'restrict_content_by_role_and_meta');


// Deaktivierung der Dashboard-Zugriffe für eingeschränkte Benutzer
function disable_dashboard_for_restricted_user() {
    if (current_user_can('restricted_user') && is_admin()) {
        wp_redirect(home_url('/category/freigegeben/'));
        exit();
    }
}
add_action('admin_init', 'disable_dashboard_for_restricted_user');
