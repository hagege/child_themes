<?php
/**
 * Plugin Name: Fuss Shortcode
 * Description: Ersetzt den bisherigen [fuss]-Shortcode. Zeigt den Alt-Text des Beitragsbildes ("Mehr Informationen zum Foto: ..."), einen optionalen externen Link, einen optionalen internen Link zu einem Schlagwort bzw. einer Kategorie sowie einen Link zur Veranstaltungskategorie.
 * Version: 1.3.0
 * Author: HGG
 * Text Domain: fuss-shortcode
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Direkten Zugriff verhindern
}

/**
 * Shortcode-Handler für [fuss]
 *
 * Beispiel: [fuss link="http://www.jurakowaprojekt.de" il="https://aachen50plus.de/tag/ausstellung/" vl="Kunst und Kultur"]
 * - link: wird als externer Link ausgegeben
 * - il:   interner Link; die Domain wird durch die aktuelle Domain ersetzt
 * - vl:   Veranstaltungskategorie; Link zu /events/category/<slug>/
 * - alle weiteren Attribute werden ignoriert
 */
function fuss_shortcode_handler( $atts ) {

    $atts = shortcode_atts(
        array(
            'link' => '',
            'il'   => '',
            'vl'   => '',
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

        $path = '';
        if ( ! empty( $parts['path'] ) ) {
            $path = $parts['path'];
        }

        $path = trim( $path, '/' );

        if ( $path !== '' ) {
            // Fehlt "tag/" oder "category/" am Anfang, wird "tag/" ergänzt
            if ( strpos( $path, 'tag/' ) !== 0 && strpos( $path, 'category/' ) !== 0 ) {
                $path = 'tag/' . $path;
            }
            $internal_url = home_url( '/' . $path . '/' );

            // Linktext aus dem letzten Pfadsegment (Slug) ableiten
            $segments = explode( '/', $path );
            $slug     = end( $segments );
            $label    = $slug !== '' ? ucfirst( str_replace( '-', ' ', rawurldecode( $slug ) ) ) : '';

            $link_text = $label !== ''
                ? 'Weitere Beiträge zum Thema: ' . $label
                : 'Weitere Beiträge zum Thema';

            $output .= '<p class="fuss-internal-link"><a href="' . esc_url( $internal_url ) . '">'
                     . esc_html( $link_text )
                     . '</a></p>';
        }
    }

    // d) Veranstaltungskategorie (vl): Link zur Kategorieseite /events/category/<slug>/
    $vl = trim( $atts['vl'] );

    if ( $vl !== '' ) {
        $vl_slug  = sanitize_title( $vl ); // "Kunst und Kultur" -> "kunst-und-kultur"
        $cat_link = home_url( '/events/category/' . $vl_slug . '/' );

        $output .= '<p class="fuss-event-category">'
                 . 'Weitere Veranstaltungen in der Kategorie: '
                 . '<a href="' . esc_url( $cat_link ) . '">' . esc_html( $vl ) . '</a>'
                 . '</p>';
    }

    if ( $output === '' ) {
        return '';
    }

    return '<div class="fuss-shortcode">' . $output . '</div>';
}
add_shortcode( 'fuss', 'fuss_shortcode_handler' );