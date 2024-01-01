<?php
/**
 * Show Random Text
 *
 * @package       SHOWRANDOM
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Show Random Text
 * Plugin URI:    https://haurand.com
 * Description:   Zeigt wöchentlich einen zufälligen Text auf einer Seite an.
 * Version:       0.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   show-random-text
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Show Random Text. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


// Hinzufügen des Shortcodes [weekly_random_text]
add_shortcode('weekly_random_text', 'display_weekly_random_text');

// Funktion zur Anzeige des wöchentlichen zufälligen Texts
function display_weekly_random_text() {
    // Holen der gespeicherten Texte aus der Datenbank
    $texts = get_option('weekly_random_texts', array());

    // Überprüfen, ob es Texte gibt
    if (empty($texts)) {
        return 'Keine Texte verfügbar.';
    }
	// var_dump($texts);

    // Überprüfen, ob es Zeit für einen Wechsel ist (einmal pro Woche)
    $last_updated = get_option('weekly_random_last_updated', 0);
    $current_time = current_time('timestamp');
    $one_week = 7 * 24 * 60 * 60; // Eine Woche in Sekunden
	

	// String in Array umwandeln
	$text_array = explode(";", $texts);
	// var_dump($text_array);
	// letztes Element ist leer. Daher letztes Element löschen.
	array_pop($text_array);
	// print_r($text_array);
    // Zufälligen Text auswählen
    $random_text = $text_array[array_rand($text_array)];

	$neuer_text = "Das ist alt: ";	
	// var_dump($random_text);
	
	// Der Wechsel nach einer Woche klappt noch nicht richtig:
    if ($current_time - $last_updated >= $one_week) {
		// String in Array umwandeln
		$text_array = explode(";", $texts);
		// var_dump($text_array);
		// letztes Element ist leer. Daher letztes Element löschen.
		array_pop($text_array);
		// Zufälligen Text auswählen
		$random_text = $text_array[array_rand($text_array)];
		
		// var_dump($random_text);

        // Speichern des aktuellen Zeitpunkts als letzten Aktualisierungszeitpunkt
        update_option('weekly_random_last_updated', $current_time);
		$neuer_text = "Das ist neu: ";

    }
	
    // Rückgabe des ausgewählten Texts
    return '<p>' . $neuer_text . esc_html($random_text) . '</p>';

    // Wenn es nicht Zeit für einen Wechsel ist, zeige den letzten ausgewählten Text an
    $last_text = get_option('weekly_random_last_text', '');
    return '<p>' . esc_html($last_text) . '</p>';
}

// Funktion zum Hinzufügen von Einstellungen für die Plugin-Seite
function weekly_random_text_settings() {
    add_options_page('Weekly Random Text Settings', 'Weekly Random Text', 'manage_options', 'weekly-random-text-settings', 'weekly_random_text_settings_page');
}

add_action('admin_menu', 'weekly_random_text_settings');

// Funktion zur Anzeige der Einstellungsseite
function weekly_random_text_settings_page() {
    ?>
    <div class="wrap">
        <h1>Weekly Random Text Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('weekly_random_text_settings_group'); ?>
            <?php do_settings_sections('weekly-random-text-settings'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Funktion zur Initialisierung der Einstellungen
function weekly_random_text_settings_init() {
    register_setting('weekly_random_text_settings_group', 'weekly_random_texts', 'sanitize_textarea_field');
}

add_action('admin_init', 'weekly_random_text_settings_init');

// Funktion zum Hinzufügen von Einstellungen auf der Seite
function weekly_random_text_textarea() {
    $texts = get_option('weekly_random_texts', '');
    echo '<textarea name="weekly_random_texts" rows="5" cols="50">' . esc_textarea($texts) . '</textarea>';
}

function weekly_random_text_settings_section() {
    echo '<p>Geben Sie hier eine Liste von Texten ein. Der Text muss jeweils durch ; ohne Leerzeichen abgetrennt werden.</p>';
}

function weekly_random_text_settings_page_content() {
    ?>
    <div class="wrap">
        <h2>Weekly Random Text Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('weekly_random_text_settings_group'); ?>
            <?php do_settings_sections('weekly-random-text-settings'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Hinzufügen von Einstellungen
function weekly_random_text_add_settings() {
    add_settings_section('weekly_random_text_section', 'Texteinstellungen', 'weekly_random_text_settings_section', 'weekly-random-text-settings');
    add_settings_field('weekly_random_text_texts', 'Texte', 'weekly_random_text_textarea', 'weekly-random-text-settings', 'weekly_random_text_section');
}

add_action('admin_init', 'weekly_random_text_add_settings');

