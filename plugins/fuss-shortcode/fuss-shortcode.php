<?php
/**
 * Plugin Name: Fuss Shortcode
 * Description: Ersetzt den bisherigen [fuss]-Shortcode. Zeigt den Alt-Text des Beitragsbildes ("Mehr Informationen zum Foto: ..."), einen optionalen externen Link ("Mehr Infos auf der folgenden Website") und einen optionalen internen Link zu einem Schlagwort bzw. einer Kategorie.
 * Version: 1.1.0
 * Author: HGG
 * Text Domain: fuss-shortcode
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Direkten Zugriff verhindern
}

/**
 * Shortcode-Handler für [fuss]
 *
 * Beispiel: [fuss link="http://www.jurakowaprojekt.de" il="https://aachen50plus.de/tag/ausstellung/" vl="Musik"]
 * - link: wird als externer Link ausgegeben
 * - il:   interner Link; die Domain wird durch die aktuelle Domain ersetzt
 * - alle weiteren Attribute (z. B. vl) werden ignoriert
 */
function fuss_shortcode_handler( $atts ) {

    // Nur "link" und "il" werden ausgewertet, alles andere wird ignoriert
    $atts = shortcode_atts(
        array(
            'link' => '',
            'il'   => '',
        ),
        $atts,
        'fuss'
    );

    $output = '';

    // a) Alt-Text des Featured Images (Beitragsbild) des aktuellen Beitrags / der Veranstaltung
    $post_id      = get_the_ID();
    $thumbnail_id = $post_id ? get_post_thumbnail_id( $post_id ) : 0;

    if ( $thumbnail_id ) {
        $alt_text = trim( get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ) );

        if ( $alt_text !== '' ) {
            // Schlüsselwörter, die einen Foto-/Urheberhinweis anzeigen (hier erweiterbar)
            $keywords = array( 'Foto:', 'Fotos:', 'Fotograf:', 'Copyright:', 'Bild:', 'Credit:', 'Quelle:', '©', 'Urheber:' );

            // Prüfen, ob eines der Schlüsselwörter im Alt-Text vorkommt
            $has_hint = false;
            foreach ( $keywords as $keyword ) {
                if ( mb_stripos( $alt_text, $keyword ) !== false ) {
                    $has_hint = true;
                    break;
                }
            }

            // Kein Hinweis vorhanden: Standardhinweis ergänzen
            if ( ! $has_hint ) {
                $alt_text = rtrim( $alt_text, " \t\n\r\0\x0B.," ) . '. Foto: Veranstalter / Rechteinhaber';
            }

            $output .= '<p class="fuss-foto-info">'
                     . '<span class="fuss-mitteilung">'
                     . esc_html( 'Mehr Informationen zum Foto:' )
                     . '</span>'
                     . '<br>'
                     . esc_html( $alt_text )
                     . '</p>';
        }
    }

    // b) Link zur angegebenen Website
    $link = trim( $atts['link'] );

    if ( $link !== '' ) {
        $url = esc_url( $link );

        if ( $url !== '' ) {
            $output .= '<p class="fuss-link"><a href="' . $url . '" target="_blank" rel="noopener noreferrer">'
                     . esc_html__( 'Mehr Infos auf der folgenden Website', 'fuss-shortcode' )
                     . '</a></p>';
        }
    }

    // c) Interner Link (Domain wird durch die aktuelle Domain ersetzt, verlinkt wird immer auf den Slug-Pfad, z. B. /tag/ausstellung/)
    $il = trim( $atts['il'] );

    if ( $il !== '' ) {
        $parts = wp_parse_url( $il );

        // Pfad ermitteln (auch wenn nur "tag/ausstellung" ohne Domain angegeben wurde)
        $path = '';
        if ( ! empty( $parts['path'] ) ) {
            $path = $parts['path'];
        }

        // Pfad bereinigen: führenden und abschließenden Slash vereinheitlichen
        $path = trim( $path, '/' );

        if ( $path !== '' ) {
            // Immer: /tag/ausstellung/
            // Fehlt "tag/" oder "category/" am Anfang, wird "tag/" ergänzt
			if ( strpos( $path, 'tag/' ) !== 0 && strpos( $path, 'category/' ) !== 0 ) {
				$path = 'tag/' . $path;
			}
			$url = home_url( '/' . $path . '/' );

            // Linktext aus dem letzten Pfadsegment (Slug) ableiten, z. B. "ausstellung" -> "Ausstellung"
            $segments = explode( '/', $path );
            $slug     = end( $segments );
            $label    = $slug !== '' ? ucfirst( str_replace( '-', ' ', rawurldecode( $slug ) ) ) : '';

            $link_text = $label !== ''
                ? 'Weitere Beiträge und Veranstaltungen zum Thema: ' . $label
                : 'Weitere Beiträge und Veranstaltungen zum Thema';

            $output .= '<p class="fuss-internal-link"><a href="' . esc_url( $url ) . '">'
                     . esc_html( $link_text )
                     . '</a></p>';
        }
    }
    if ( $output === '' ) {
        return '';
    }

    return '<div class="fuss-shortcode">' . $output . '</div>';
}
add_shortcode( 'fuss', 'fuss_shortcode_handler' );