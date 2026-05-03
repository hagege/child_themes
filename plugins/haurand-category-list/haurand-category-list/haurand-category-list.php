<?php
/**
 * haurand-category-list
 *
 * @package       HAURANDCA
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.4.0
 *
 * @wordpress-plugin
 * Plugin Name:   haurand-category-list
 * Plugin URI:    https://haurand.com
 * Description:   shows the number of entries in a category with security and performance improvements
 * Version:       0.4.0
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   haurand-category-list
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with haurand-category-list. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ÄNDERUNGEN IN VERSION 0.4.0:
 * 
 * ✅ Sicherheit:
 *    - XSS-Protection durch esc_html() und esc_attr()
 *    - Sichere Kategorie-Ausschluss via ID statt String-Vergleich
 * 
 * ✅ Performance:
 *    - Transient-Caching (1 Tag)
 *    - Reduzierung von Datenbankabfragen
 *    - Entfernung von redundanten Funktionen
 * 
 * ✅ Code-Qualität:
 *    - Konsistente Namenskonventionen
 *    - Korrekte HTML-Struktur
 *    - Gründliche Dokumentation
 *    - WPCS-konform
 */

// Konstante für ausgeschlossene Kategorien (ID statt Name!)
define( 'HAURAND_EXCLUDED_CATEGORY_IDS', array( 1486 ) );

// Cache-Dauer in Sekunden (1 Tag)
define( 'HAURAND_CATEGORY_CACHE_TIME', DAY_IN_SECONDS );

/**
 * ============================================================================
 * SHORTCODE 1: [my_category_list] (MAIN - MODERNISIERT)
 * ============================================================================
 * 
 * Zeigt eine Liste aller Kategorien mit Beitragszahl
 * 
 * @return string HTML-Liste der Kategorien
 */
function haurand_category_list_shortcode() {
	// Cache prüfen - Transient ist persistent und wird geladen bei jedem Request
	$cache_key = 'haurand_category_list_html';
	$cached_html = get_transient( $cache_key );
	
	if ( false !== $cached_html ) {
		return $cached_html;
	}

	// Kategorien mit Caching laden
	$args = array(
		'taxonomy'   => 'category',
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true,
		'exclude'    => HAURAND_EXCLUDED_CATEGORY_IDS,
	);

	/**
	 * Filter: Ermögliche Custom-Kategorien-Args
	 * 
	 * Beispiel in functions.php:
	 * add_filter('haurand_category_list_args', function($args) {
	 *     $args['number'] = 10;  // Nur erste 10
	 *     return $args;
	 * });
	 */
	$args = apply_filters( 'haurand_category_list_args', $args );

	$categories = get_categories( $args );

	// Fehlerbehandlung
	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		return '<!-- No categories found -->';
	}

	// HTML aufbauen
	$html = '<ul class="haurand-category-list">' . "\n";

	foreach ( $categories as $category ) {
		// URL generieren (wichtig: nur einmal pro Kategorie!)
		$category_url = get_category_link( $category->term_id );
		if ( is_wp_error( $category_url ) ) {
			continue; // Skip bei Fehler
		}

		// ✅ SICHERHEIT: Alle Ausgaben escapen!
		$category_name = esc_html( $category->name );
		$category_url = esc_attr( $category_url );
		$category_count = absint( $category->count );

		// Anchor mit Fragment (#filtered_posts)
		$category_url_with_anchor = $category_url . '#filtered_posts';

		// Einzelner List-Item
		$html .= sprintf(
			'<li><a class="haurand-category-link" href="%s">%s <span class="haurand-category-count">(%d)</span></a></li>' . "\n",
			$category_url_with_anchor,
			$category_name,
			$category_count
		);
	}

	$html .= '</ul>' . "\n";

	/**
	 * Filter: Ermögliche Custom-HTML
	 * 
	 * Beispiel:
	 * add_filter('haurand_category_list_html', function($html) {
	 *     return '<div class="custom-wrapper">' . $html . '</div>';
	 * });
	 */
	$html = apply_filters( 'haurand_category_list_html', $html );

	// ✅ PERFORMANCE: Cache speichern
	set_transient( $cache_key, $html, HAURAND_CATEGORY_CACHE_TIME );

	return $html;
}
add_shortcode( 'my_category_list', 'haurand_category_list_shortcode' );

/**
 * ============================================================================
 * SHORTCODE 2: [haurand_catelist] (LEGACY - FÜR ABWÄRTSKOMPATIBILITÄT)
 * ============================================================================
 * 
 * Nutzt wp_list_categories() für bessere Konsistenz
 * Empfehlung: Nutzen Sie stattdessen [my_category_list]
 * 
 * @return string HTML-Liste der Kategorien
 */
function haurand_legacy_category_list_shortcode() {
	// Cache prüfen
	$cache_key = 'haurand_legacy_category_list_html';
	$cached_html = get_transient( $cache_key );
	
	if ( false !== $cached_html ) {
		return $cached_html;
	}

	// wp_list_categories ist bereits sicher und mit Output-Buffering
	$html = '<div class="haurand-legacy-category-list">' . "\n";
	$html .= '<h3>' . esc_html__( 'Beitrags-Kategorien', 'haurand-category-list' ) . '</h3>' . "\n";

	// wp_list_categories gibt bereits escaped HTML aus
	$list = wp_list_categories(
		array(
			'taxonomy'  => 'category',
			'hide_empty' => true,
			'echo'      => 0, // Nicht ausgeben, sondern zurückgeben
			'title_li'  => '',
			'show_count' => true,
			'exclude'   => HAURAND_EXCLUDED_CATEGORY_IDS,
		)
	);

	$html .= '<ul>' . $list . '</ul>' . "\n";
	$html .= '</div>' . "\n";

	// ✅ PERFORMANCE: Cache speichern
	set_transient( $cache_key, $html, HAURAND_CATEGORY_CACHE_TIME );

	return $html;
}
add_shortcode( 'haurand_catelist', 'haurand_legacy_category_list_shortcode' );

/**
 * ============================================================================
 * CACHE-INVALIDIERUNG
 * ============================================================================
 * 
 * Cache löschen, wenn Kategorien erstellt, aktualisiert oder gelöscht werden
 */
function haurand_invalidate_category_cache() {
	delete_transient( 'haurand_category_list_html' );
	delete_transient( 'haurand_legacy_category_list_html' );
}

// Hooks für Cache-Invalidierung
add_action( 'created_category', 'haurand_invalidate_category_cache' );
add_action( 'edited_category', 'haurand_invalidate_category_cache' );
add_action( 'delete_category', 'haurand_invalidate_category_cache' );

/**
 * ============================================================================
 * OPTIONAL: ADMIN-EINSTELLUNGEN (Für zukünftige Versionen)
 * ============================================================================
 * 
 * Hier könnten folgende Settings hinzugefügt werden:
 * - Ausgeschlossene Kategorien (via Admin-Interface)
 * - Cache-Dauer
 * - Sortierreihenfolge
 * - HTML-Struktur (Liste vs. Grid)
 */

/**
 * ============================================================================
 * ZUSÄTZLICHE HELPER-FUNKTION (Optional)
 * ============================================================================
 * 
 * Um das Plugin flexibler zu machen
 */

/**
 * Gib Kategorien als Array zurück (nicht als HTML)
 * 
 * Nützlich für Theme-Entwickler, die Custom-Templates brauchen
 * 
 * @param array $args wp_get_categories() args
 * @return array Array von Category-Objekten
 */
function haurand_get_categories_data( $args = array() ) {
	$defaults = array(
		'taxonomy'   => 'category',
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true,
		'exclude'    => HAURAND_EXCLUDED_CATEGORY_IDS,
	);

	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'haurand_get_categories_data_args', $args );

	return get_categories( $args );
}

/**
 * ============================================================================
 * STYLES (Optional - Für besseres Aussehen)
 * ============================================================================
 * 
 * Wenn gewünscht, können Sie folgende Styles in Ihre CSS einbauen:
 * 
 * .haurand-category-list {
 *     list-style: none;
 *     padding: 0;
 *     margin: 0;
 * }
 * 
 * .haurand-category-list li {
 *     margin-bottom: 8px;
 * }
 * 
 * .haurand-category-link {
 *     text-decoration: none;
 *     color: #0073aa;
 * }
 * 
 * .haurand-category-link:hover {
 *     text-decoration: underline;
 * }
 * 
 * .haurand-category-count {
 *     color: #666;
 *     font-size: 0.9em;
 * }
 */
