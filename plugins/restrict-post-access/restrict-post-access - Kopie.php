<?php
/**
 * Restrict Post Access
 *
 * @package       RESTRICTPO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Restrict Post Access
 * Plugin URI:    https://haurand.com
 * Description:   Benutzerrolle, bei der Berechtigungen für bestimmte Beiträge zum Lesen eingerichtet werden können und ansonsten kein Zugriff auf die Website möglich sein soll..
 * Version:       0.1
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

// Menüeintrag für "Freigegeben"-Kategorie hinzufügen
function add_restricted_user_menu_item($items, $args) {
    if (current_user_can('restricted_user')) {
        $items = '<li class="menu-item"><a href="' . esc_url(home_url('/category/freigegeben/')) . '">Freigegeben</a></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_restricted_user_menu_item', 10, 2);

// Deaktivierung der Dashboard-Zugriffe für eingeschränkte Benutzer
function disable_dashboard_for_restricted_user() {
    if (current_user_can('restricted_user') && is_admin()) {
        wp_redirect(home_url('/category/freigegeben/'));
        exit();
    }
}
add_action('admin_init', 'disable_dashboard_for_restricted_user');
