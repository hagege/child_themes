<?php
/**
 * Restrict Access
 *
 * @package       RESTRICTAC
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.2
 *
 * @wordpress-plugin
 * Plugin Name:   Restrict Access
 * Plugin URI:    https://haurand.com
 * Description:   Benutzerrolle, bei der Berechtigungen für bestimmte Beiträge zum Lesen eingerichtet werden kann.
 * Version:       0.2
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   restrict-access
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Restrict Access. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

// Benutzerdefinierte Rolle erstellen
function hgg_add_custom_role() {
    add_role(
        'restricted_user',   // Rollenbezeichnung
        'Eingeschränkter Benutzer', // Anzeigename der Rolle
        array(
            'read' => true,              // Grundlegender Zugriff auf das Dashboard, aber...
            'read_custom_posts' => false // Keine Leseberechtigung für Beiträge
        )
    );
}
add_action('init', 'hgg_add_custom_role');

// Inhalt basierend auf der Berechtigung einschränken
function restrict_content_by_role_and_meta($content) {
    if (is_single()) {
        $post_id = get_the_ID(); // Hole die Post-ID
		$restricted = get_post_meta($post_id, '_restrict_access', true);
		// echo('post id: ') . $post_id . '<br>';
		// echo('restricted: ') . $restricted . '<br>';
		if ($restricted === '') {
			$restricted = 'yes'; // Standardwert setzen
		}
		// echo('restricted: ') . $restricted . '<br>';
        if ($restricted === 'yes' && !current_user_can('read_custom_posts')) {
            return 'Dieser Inhalt ist für dich nicht verfügbar.';
        }
    }
    return $content;
}
add_filter('the_content', 'restrict_content_by_role_and_meta');

// Custom Meta Box hinzufügen
function add_custom_meta_box() {
    add_meta_box(
        'restrict_access_meta_box',
        'Zugriff einschränken',
        'restrict_access_meta_box_callback',
        'post',
        'side'
    );
}
add_action('add_meta_boxes', 'add_custom_meta_box');

// Callback-Funktion für die Meta Box
function restrict_access_meta_box_callback($post) {
    wp_nonce_field('save_restrict_access_meta_box_data', 'restrict_access_meta_box_nonce');
    $value = get_post_meta($post->ID, '_restrict_access', true);
    if ($value === '') {
        $value = 'yes';  // Standardmäßig auf "yes" setzen, wenn nicht vorhanden
    }
    echo '<label for="restrict_access">Beitrag einschränken</label>';
    echo '<select name="restrict_access" id="restrict_access">';
    echo '<option value="yes"' . selected($value, 'yes', false) . '>Ja</option>';
    echo '<option value="no"' . selected($value, 'no', false) . '>Nein</option>';
    echo '</select>';
}

// Speichern der Meta-Box-Werte
function save_restrict_access_meta_box_data($post_id) {
    if (!isset($_POST['restrict_access_meta_box_nonce']) || !wp_verify_nonce($_POST['restrict_access_meta_box_nonce'], 'save_restrict_access_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (array_key_exists('restrict_access', $_POST)) {
        update_post_meta(
            $post_id,
            '_restrict_access',
            sanitize_text_field($_POST['restrict_access'])
        );
    }
}
add_action('save_post', 'save_restrict_access_meta_box_data');

/* Standardmäßig alle Beiträge einschränken
// Problem war dabei, dass die Funktion dazu führte, dass der Wert für _restrict_access immer auf "yes" gesetzt wurde, obwohl "no" im Beitrag gesetzt war.
function set_default_restriction($post_id, $post, $update) {
    if (!$update && get_post_meta($post_id, '_restrict_access', true) === '') {
        update_post_meta($post_id, '_restrict_access', 'yes');
    }
}
add_action('wp_insert_post', 'set_default_restriction', 10, 3);
*/

// Benutzerrolle mit Lesezugriff auf bestimmte Beiträge aktualisieren
function allow_reading_for_restricted_user($post_id) {
    $post = get_post($post_id);
    $restricted = get_post_meta($post_id, '_restrict_access', true);

    if ($restricted === 'no') {
        $user = wp_get_current_user();
        $user->add_cap('read_custom_posts');
    }
}
add_action('save_post', 'allow_reading_for_restricted_user');
