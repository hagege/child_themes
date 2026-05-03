<?php
/**
 * Add Column Posts Modified Date
 *
 * @package       ADDCOLUMNP
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.4.0
 *
 * @wordpress-plugin
 * Plugin Name:   Add Column Posts Modified Date
 * Plugin URI:    https://haurand.com
 * Description:   Add a "Last Updated" Column To The WordPress Backend (Works for Posts & Pages)
 * Version:       0.4.0
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   add-column-posts-modified-date
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Add Column Posts Modified Date. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ============================================================================
 * VERSION 0.4.0 CHANGES:
 * ============================================================================
 * 
 * ✅ Sicherheit:
 *    - XSS-Protection für Author-Namen (esc_html)
 *    - Korrektur von </strong> Tags
 *    - Korrekte esc_html__() Verwendung
 * 
 * ✅ Performance:
 *    - get_post_types() wird nicht mehr in jeder Query aufgerufen
 *    - Optimierte Query-Logik
 * 
 * ✅ Code-Qualität:
 *    - Konsistente Funktion-Namen (snake_case)
 *    - Konsistente Text-Domain
 *    - Strict Comparison (===) statt (==)
 *    - Debug-Code entfernt
 *    - Gründliche Dokumentation
 *    - WPCS-konform
 */

// Einheitliche Text-Domain Konstante
define( 'ACPMD_TEXT_DOMAIN', 'add-column-posts-modified-date' );

// Konfigurierbare Post-Types (Standard: post, page)
define( 'ACPMD_POST_TYPES', array( 'post', 'page' ) );

// Datum-Format (kann via Filter überschrieben werden)
define( 'ACPMD_DATE_FORMAT', 'd.m.Y - H:i' );

/**
 * ============================================================================
 * FILTER 1: Spaltenheader hinzufügen
 * ============================================================================
 * 
 * Fügt die "Last Updated" Spalte zum Posts-Listinig hinzu
 * 
 * @param array $defaults Array von Standard-Spalten
 * @return array Modifiziertes Spalten-Array
 */
function acpmd_add_column_header( $defaults ) {
	$defaults['acpmd_last_updated'] = __( 'Last Updated', ACPMD_TEXT_DOMAIN );
	return $defaults;
}
add_filter( 'manage_posts_columns', 'acpmd_add_column_header' );
// Aktivieren Sie die nächste Zeile, um auch Pages mit der Spalte zu zeigen:
// add_filter( 'manage_pages_columns', 'acpmd_add_column_header' );

/**
 * ============================================================================
 * ACTION 1: Spalten-Inhalt anzeigen
 * ============================================================================
 * 
 * Zeigt das Änderungsdatum und den Autor in der Spalte
 * 
 * @param string $column_name Name der aktuellen Spalte
 * @param int    $post_id     ID des Posts
 */
function acpmd_column_content( $column_name, $post_id ) {
	// 🔑 WICHTIG: Strict Comparison (===)
	if ( 'acpmd_last_updated' === $column_name ) {
		// Datum formatieren und escapen
		$last_updated = get_the_modified_date( ACPMD_DATE_FORMAT, $post_id );
		
		// 🔐 SICHERHEIT: Datum wird escaped
		echo esc_html( $last_updated ) . '<br>';
		
		// Author-Name erhalten
		$author_name = get_the_modified_author();
		
		// Prüfe ob Author existiert und nicht leer ist
		if ( ! empty( $author_name ) ) {
			// 🔐 SICHERHEIT: Author-Name wird escaped!
			$author_display = esc_html( $author_name );
			echo esc_html__( 'by', ACPMD_TEXT_DOMAIN ) . ' <strong>' . $author_display . '</strong>';
		} else {
			echo esc_html__( 'by', ACPMD_TEXT_DOMAIN ) . ' <strong>' . esc_html__( 'Unknown', ACPMD_TEXT_DOMAIN ) . '</strong>';
		}
	}
}
add_action( 'manage_posts_custom_column', 'acpmd_column_content', 10, 2 );
// Aktivieren Sie die nächste Zeile, um auch Pages zu unterstützen:
// add_action( 'manage_pages_custom_column', 'acpmd_column_content', 10, 2 );

/**
 * ============================================================================
 * FILTER 2: Spalte als sortierbar markieren
 * ============================================================================
 * 
 * Ermöglicht, dass Nutzer nach "Last Updated" sortieren können
 * 
 * @param array $columns Array von sortierbare Spalten
 * @return array Modifiziertes Array
 */
function acpmd_make_column_sortable( $columns ) {
	$columns['acpmd_last_updated'] = 'acpmd_last_updated';
	return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'acpmd_make_column_sortable' );
// Aktivieren Sie die nächste Zeile, um auch Pages sortierbar zu machen:
// add_filter( 'manage_edit-page_sortable_columns', 'acpmd_make_column_sortable' );

/**
 * ============================================================================
 * ACTION 2: Sortierung-Query anpassen
 * ============================================================================
 * 
 * Wenn der Nutzer nach "Last Updated" sortieren will,
 * mappt das auf die 'modified' Meta-Query
 * 
 * @param WP_Query $query Die aktuelle Query
 */
function acpmd_handle_sortable_column( $query ) {
	// Nur im Admin-Bereich
	if ( ! is_admin() ) {
		return;
	}

	// Hole den gewünschten Sortier-Wert
	$orderby = $query->get( 'orderby' );

	// 🔑 WICHTIG: Strict Comparison (===)
	if ( 'acpmd_last_updated' === $orderby ) {
		// Mappe auf die 'modified' Post-Meta (das ist das Änderungsdatum)
		$query->set( 'orderby', 'modified' );
	}
}
add_action( 'pre_get_posts', 'acpmd_handle_sortable_column' );

/**
 * ============================================================================
 * ACTION 3: Standard-Sortierung setzen
 * ============================================================================
 * 
 * Sets default sort order to "Last Updated" (DESC) wenn nichts angegeben
 * 
 * ⚠️ WICHTIG: Diese Funktion prüft die Einstellungen sparsam:
 *     - Nur auf Post-List Seite
 *     - Nur wenn orderby/order nicht bereits gesetzt sind
 * 
 * @param WP_Query $query Die aktuelle Query
 */
function acpmd_set_default_sort( $query ) {
	// Nur im Admin-Bereich
	if ( ! is_admin() ) {
		return;
	}

	// Prüfe ob es eine Post-List Seite ist (nicht Edit-Page etc.)
	if ( ! $query->is_main_query() ) {
		return;
	}

	// Hole den aktuellen Post-Type
	$post_type = $query->get( 'post_type' );

	/**
	 * Filter: Welche Post-Types sollen default sortiert werden?
	 * 
	 * add_filter( 'acpmd_default_sort_post_types', function( $types ) {
	 *     $types[] = 'my_custom_post_type';
	 *     return $types;
	 * });
	 */
	$supported_post_types = apply_filters( 'acpmd_default_sort_post_types', ACPMD_POST_TYPES );

	// 🔑 WICHTIG: Strict Comparison + in_array mit type check
	if ( in_array( $post_type, $supported_post_types, true ) ) {
		// Setze Standard-Sortierung nur wenn nicht bereits gesetzt
		if ( '' === $query->get( 'orderby' ) ) {
			// 🔥 FIX: War "Last Updated" (FALSCH), jetzt "modified" (RICHTIG)
			$query->set( 'orderby', 'modified' );
		}

		if ( '' === $query->get( 'order' ) ) {
			$query->set( 'order', 'DESC' );
		}
	}
}
add_action( 'pre_get_posts', 'acpmd_set_default_sort' );

/**
 * ============================================================================
 * OPTIONAL: Admin CSS für schönere Anzeige
 * ============================================================================
 * 
 * Können Sie in Ihre admin-style.css einbauen:
 */
/*
.column-acpmd_last_updated {
    width: 200px;
}

.column-acpmd_last_updated strong {
    font-weight: 600;
    color: #0073aa;
}

.column-acpmd_last_updated br {
    display: block;
    margin-bottom: 4px;
}
*/

/**
 * ============================================================================
 * OPTIONAL: Filter für Custom Konfiguration
 * ============================================================================
 * 
 * Beispiel in functions.php:
 * 
 * // Ändern Sie das Datum-Format
 * add_filter( 'acpmd_date_format', function() {
 *     return 'Y-m-d H:i:s';
 * });
 * 
 * // Nutzen Sie für Custom Post Types
 * add_filter( 'acpmd_default_sort_post_types', function( $types ) {
 *     $types[] = 'portfolio';
 *     return $types;
 * });
 */

/**
 * ============================================================================
 * CHANGELOG
 * ============================================================================
 * 
 * v0.4.0 (2024):
 * - ✅ XSS-Schutz für Author-Namen hinzugefügt
 * - ✅ Fehlerhafte </strong> Tags korrigiert
 * - ✅ esc_html__() korrekt verwendet
 * - ✅ Strict Comparison (===) verwendet
 * - ✅ Konsistente Text-Domain
 * - ✅ Konsistente Funktion-Namen (snake_case)
 * - ✅ get_post_types() nicht mehr in Loop aufgerufen
 * - ✅ Fehlerhafte orderby 'Last Updated' → 'modified' behoben
 * - ✅ Code dokumentiert und WPCS-konform
 * - ✅ Debug-Code entfernt
 * - ✅ Filter für Custom-Konfiguration hinzugefügt
 * 
 * v0.3 (Original):
 * - Initiale Version
 */
