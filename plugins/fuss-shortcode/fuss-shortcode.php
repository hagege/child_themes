<?php
/**
 * Plugin Name: Fuss Shortcode
 * Description: Ersetzt den bisherigen [fuss]-Shortcode. Zeigt den Alt-Text des Beitragsbildes, einen optionalen externen Link, einen internen Link und einen Link zur Veranstaltungskategorie. Mit Metabox (wahlweise Seitenleiste oder unterhalb des Editors).
 * Version: 1.6.1
 * Author: HGG
 * Text Domain: fuss-shortcode
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Direkten Zugriff verhindern
}

/* ------------------------------------------------------------------------
 * KONFIGURATION
 * --------------------------------------------------------------------- */

// Standard-Position der Metabox: 'side' = Seitenleiste rechts, 'normal' = unterhalb des Editors.
// Jeder Benutzer kann das im Profil oder direkt in der Metabox ändern.
if ( ! defined( 'FUSS_METABOX_CONTEXT' ) ) {
    define( 'FUSS_METABOX_CONTEXT', 'side' );
}

// Gewählte Position der Metabox für den aktuellen Benutzer ermitteln
function fuss_get_metabox_context() {
    $default = in_array( FUSS_METABOX_CONTEXT, array( 'side', 'normal' ), true ) ? FUSS_METABOX_CONTEXT : 'side';
    $user_id = get_current_user_id();

    if ( ! $user_id ) {
        return $default;
    }

    $pref = get_user_meta( $user_id, 'fuss_metabox_context', true );

    return in_array( $pref, array( 'side', 'normal' ), true ) ? $pref : $default;
}

// Gespeicherte Box-Anordnung (Position, geschlossen, ausgeblendet) für unsere Metabox zurücksetzen
function fuss_reset_metabox_layout( $user_id ) {

    $post_types   = fuss_event_post_types();
    $post_types[] = 'post';

    foreach ( array_unique( $post_types ) as $pt ) {

        // 1. Gespeicherte Reihenfolge/Position bereinigen
        $order = get_user_meta( $user_id, 'meta-box-order_' . $pt, true );
        if ( is_array( $order ) ) {
            foreach ( $order as $ctx => $ids ) {
                if ( ! is_string( $ids ) || $ids === '' ) {
                    continue;
                }
                $list = array_filter(
                    array_map( 'trim', explode( ',', $ids ) ),
                    function ( $id ) {
                        return $id !== 'fuss_metabox';
                    }
                );
                $order[ $ctx ] = implode( ',', $list );
            }
            update_user_meta( $user_id, 'meta-box-order_' . $pt, $order );
        }

        // 2. Aus der Liste der geschlossenen Boxen entfernen
        $closed = get_user_meta( $user_id, 'closedpostboxes_' . $pt, true );
        if ( is_array( $closed ) ) {
            update_user_meta( $user_id, 'closedpostboxes_' . $pt, array_values( array_diff( $closed, array( 'fuss_metabox' ) ) ) );
        }

        // 3. Aus der Liste der ausgeblendeten Boxen entfernen
        $hidden = get_user_meta( $user_id, 'metaboxhidden_' . $pt, true );
        if ( is_array( $hidden ) ) {
            update_user_meta( $user_id, 'metaboxhidden_' . $pt, array_values( array_diff( $hidden, array( 'fuss_metabox' ) ) ) );
        }
    }
}

// Mögliche Post-Types für Veranstaltungen (alle vorhandenen werden verwendet)
function fuss_event_post_types() {
    $candidates = array( 'eventward_event', 'eventward', 'event', 'events', 'tribe_events' );
    $found      = array();
    foreach ( $candidates as $pt ) {
        if ( post_type_exists( $pt ) ) {
            $found[] = $pt;
        }
    }
    return $found;
}

// Taxonomie der Veranstaltungskategorien ermitteln
function fuss_event_taxonomy() {

    // 1. Bekannte/vermutete Namen
    $candidates = array(
        'eventward_category',
        'event_category',
        'event-category',
        'event_cat',
        'events_category',
        'tribe_events_cat',
    );
    foreach ( $candidates as $tax ) {
        if ( taxonomy_exists( $tax ) ) {
            return $tax;
        }
    }

    // 2. Fallback: Taxonomie suchen, die einem Event-Post-Type zugeordnet ist
    //    und "categ", "kateg" oder "cat" im Namen trägt
    foreach ( fuss_event_post_types() as $pt ) {
        $taxes = get_object_taxonomies( $pt, 'names' );
        foreach ( $taxes as $tax ) {
            if ( stripos( $tax, 'categ' ) !== false
                || stripos( $tax, 'kateg' ) !== false
                || stripos( $tax, 'cat' ) !== false ) {
                return $tax;
            }
        }
    }

    return '';
}

/* ------------------------------------------------------------------------
 * ALTES PLUGIN: SHORTCODE ÜBERNEHMEN
 * --------------------------------------------------------------------- */

// Shortcode erst spät registrieren, damit er den des alten Plugins überschreibt
function fuss_register_shortcode() {
    remove_shortcode( 'fuss' );
    add_shortcode( 'fuss', 'fuss_shortcode_handler' );
}
add_action( 'init', 'fuss_register_shortcode', 99 );

/* ------------------------------------------------------------------------
 * SHORTCODE-AUSGABE
 * --------------------------------------------------------------------- */

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

    $post_id = get_the_ID();

    // Werte aus der Metabox haben Vorrang vor den Shortcode-Attributen (falls vorhanden)
    $meta_link = $post_id ? get_post_meta( $post_id, '_fuss_link', true ) : '';
    $meta_il   = $post_id ? get_post_meta( $post_id, '_fuss_il', true ) : '';
    $meta_vl   = $post_id ? get_post_meta( $post_id, '_fuss_vl', true ) : '';

    $external_url = ! empty( $meta_link ) ? $meta_link : $atts['link'];
    $internal_raw = ! empty( $meta_il )   ? $meta_il   : $atts['il'];
    $vl_slug      = ! empty( $meta_vl )   ? $meta_vl   : $atts['vl'];

    $output = '';

    /* ---- a) Foto-Hinweis aus dem Alt-Text des Beitragsbildes ---- */

    $alt_text = '';
    if ( $post_id ) {
        $thumb_id = get_post_thumbnail_id( $post_id );
        if ( $thumb_id ) {
            $alt_text = trim( (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) );
        }
    }

    // Fehlt ein Hinweis wie "Foto:" oder "Copyright:", wird ein Standardtext ergänzt
    if ( $alt_text === '' ) {
        $alt_text = 'Foto: Veranstalter';
    } elseif ( ! preg_match( '/(foto|copyright|©|bild|credit)\s*:/iu', $alt_text ) ) {
        $alt_text .= ' | Foto: Veranstalter';
    }

    $output .= '<p class="fuss-foto-info">'
             . '<span class="fuss-mitteilung">'
             . esc_html( 'Mehr Informationen zum Foto:' )
             . '</span>'
             . '<br>'
             . esc_html( $alt_text )
             . '</p>';

    /* ---- b) Externer Link ---- */

    if ( ! empty( $external_url ) ) {
        $output .= '<p class="fuss-link"><a href="' . esc_url( $external_url ) . '" target="_blank" rel="noopener noreferrer">Mehr Infos auf der folgenden Website</a></p>';
    }

    /* ---- c) Interner Link (immer auf die aktuelle Domain, Slug-Pfad wird übernommen) ---- */

    if ( ! empty( $internal_raw ) ) {
        $internal_url = fuss_build_internal_url( $internal_raw );
        if ( $internal_url !== '' ) {
            $output .= '<p class="fuss-il"><a href="' . esc_url( $internal_url ) . '">Weitere Beiträge zu diesem Thema</a></p>';
        }
    }

    /* ---- d) Veranstaltungskategorie ---- */

    if ( ! empty( $vl_slug ) ) {
        $cat = fuss_get_category_data( $vl_slug );
        if ( ! empty( $cat['url'] ) ) {
            $output .= '<p class="fuss-vl"><a href="' . esc_url( $cat['url'] ) . '">Weitere Veranstaltungen: ' . esc_html( $cat['name'] ) . '</a></p>';
        }
    }

    return '<div class="fuss-bereich">' . $output . '</div>';
}

/* ------------------------------------------------------------------------
 * AUTOMATISCHE AUSGABE AUS DER METABOX (ohne Shortcode im Inhalt)
 * --------------------------------------------------------------------- */

/**
 * Hängt den Fußbereich automatisch an den Inhalt an, wenn
 * - in der Metabox Werte eingetragen sind und
 * - der Inhalt keinen [fuss]-Shortcode enthält.
 */
function fuss_auto_append( $content ) {

    // Nur im Frontend, im Hauptloop, bei Einzelansicht
    if ( is_admin() || ! is_singular() || ! in_the_loop() || ! is_main_query() ) {
        return $content;
    }

    $post_id = get_the_ID();
    if ( ! $post_id ) {
        return $content;
    }

    // Nur für Beiträge und Veranstaltungen
    $post_types   = fuss_event_post_types();
    $post_types[] = 'post';
    if ( ! in_array( get_post_type( $post_id ), $post_types, true ) ) {
        return $content;
    }

    // Wenn der Shortcode im Inhalt steht, kümmert sich dieser um die Ausgabe
    // (auch nach do_shortcode erkennbar an unserem Container)
    if ( strpos( $content, 'fuss-bereich' ) !== false ) {
        return $content;
    }

    // Nur ausgeben, wenn in der Metabox etwas eingetragen ist
    $has_meta = get_post_meta( $post_id, '_fuss_link', true )
             || get_post_meta( $post_id, '_fuss_il', true )
             || get_post_meta( $post_id, '_fuss_vl', true );

    if ( ! $has_meta ) {
        return $content;
    }

    // Doppelte Ausgabe auf derselben Seite verhindern
    static $already_done = array();
    if ( isset( $already_done[ $post_id ] ) ) {
        return $content;
    }
    $already_done[ $post_id ] = true;

    return $content . fuss_shortcode_handler( array() );
}
add_filter( 'the_content', 'fuss_auto_append', 99 );

/* ------------------------------------------------------------------------
 * HILFSFUNKTIONEN
 * --------------------------------------------------------------------- */

/**
 * Baut aus dem Wert von "il" eine interne URL.
 * Verlinkt immer auf den Slug-Pfad (z. B. tag/ausstellung/) der aktuellen Domain.
 */
function fuss_build_internal_url( $raw ) {

    $raw = trim( $raw );
    if ( $raw === '' ) {
        return '';
    }

    // Pfad extrahieren (Domain wird verworfen)
    $path = wp_parse_url( $raw, PHP_URL_PATH );
    if ( $path === null || $path === false || $path === '' ) {
        // Kein vollständiger URL, sondern z. B. "tag/ausstellung/" oder "tag/ausstellung"
        $path = $raw;
    }

    // Fehlerhafte Altwerte wie "http://aachenplus502.localtag/ausstellung/" abfangen:
    // Wenn "tag/" im Pfad vorkommt, ab dort übernehmen
    if ( preg_match( '#(tag/[^?\#]+)#i', $raw, $m ) ) {
        $path = $m[1];
    }

    $path = trim( $path, '/' );

    // Steht nur der Slug da (z. B. "ausstellung"), den Tag-Pfad voranstellen
    if ( $path !== '' && strpos( $path, '/' ) === false ) {
        $path = 'tag/' . $path;
    }

    if ( $path === '' ) {
        return '';
    }

    return home_url( '/' . $path . '/' );
}

/**
 * Liefert Name und URL der Veranstaltungskategorie zu einem Slug oder Namen.
 * Die URL zeigt auf die Veranstaltungsübersicht mit Kategorie-Filter,
 * z. B. /veranstaltungen/?ew_view=list&ew_cat=feiern-und-feste
 */
function fuss_get_category_data( $value ) {

    $result   = array( 'name' => '', 'url' => '' );
    $value    = trim( $value );
    $taxonomy = fuss_event_taxonomy();

    if ( $value === '' ) {
        return $result;
    }

    // Aus einem Pfad wie "/events/category/kunst-und-kultur/" den Slug herausholen
    if ( strpos( $value, '/' ) !== false ) {
        $value = basename( rtrim( $value, '/' ) );
    }

    $slug = sanitize_title( $value );
    $name = $value;

    // Begriff in der Taxonomie suchen, um den korrekten Slug und Namen zu erhalten
    if ( $taxonomy !== '' ) {
        $term = get_term_by( 'slug', $slug, $taxonomy );
        if ( ! $term ) {
            $term = get_term_by( 'name', $value, $taxonomy );
        }
        if ( $term && ! is_wp_error( $term ) ) {
            $slug = $term->slug;
            $name = $term->name;
        }
    }

    // Basis-Seite der Veranstaltungsübersicht (Slug der Seite, Standard: "veranstaltungen")
    $overview_path = apply_filters( 'fuss_events_overview_path', 'veranstaltungen' );

    $url = add_query_arg(
        array(
            'ew_view' => 'photo',
            'ew_cat'  => $slug,
        ),
        home_url( '/' . trim( $overview_path, '/' ) . '/' )
    );

    $result['name'] = $name;
    $result['url']  = $url;

    return $result;
}

/* ------------------------------------------------------------------------
 * METABOX
 * --------------------------------------------------------------------- */

function fuss_add_metabox() {
    $post_types = fuss_event_post_types();

    // Auch normale Beiträge bekommen die Box
    $post_types[] = 'post';

    $context = fuss_get_metabox_context();

    foreach ( array_unique( $post_types ) as $pt ) {
        add_meta_box(
            'fuss_metabox',
            'Fußbereich (Links & Kategorie)',
            'fuss_render_metabox',
            $pt,
            $context,
            'default'
        );
    }
}
add_action( 'add_meta_boxes', 'fuss_add_metabox' );

function fuss_render_metabox( $post ) {

    wp_nonce_field( 'fuss_save_metabox', 'fuss_metabox_nonce' );

    $link = get_post_meta( $post->ID, '_fuss_link', true );
    $il   = get_post_meta( $post->ID, '_fuss_il', true );
    $vl   = get_post_meta( $post->ID, '_fuss_vl', true );

    $taxonomy = fuss_event_taxonomy();
    $terms    = array();
    if ( $taxonomy !== '' ) {
        $terms = get_terms(
            array(
                'taxonomy'   => $taxonomy,
                'hide_empty' => false,
            )
        );
    }

    // Umschalt-Link für die Position der Box
    $current_context = fuss_get_metabox_context();
    $target_context  = ( $current_context === 'side' ) ? 'normal' : 'side';
    $switch_url      = wp_nonce_url(
        add_query_arg(
            array(
                'fuss_set_context' => $target_context,
                'post'             => $post->ID,
                'action'           => 'edit',
            ),
            admin_url( 'post.php' )
        ),
        'fuss_set_context'
    );
    $switch_label = ( $target_context === 'normal' )
        ? 'Box unter den Editor verschieben'
        : 'Box in die Seitenleiste verschieben';
    ?>
    <p style="text-align:right;margin:0 0 8px;">
        <a href="<?php echo esc_url( $switch_url ); ?>" class="button button-small"><?php echo esc_html( $switch_label ); ?></a>
    </p>

    <p>
        <label for="fuss_link"><strong>Externer Link</strong></label><br>
        <input type="url" id="fuss_link" name="fuss_link" value="<?php echo esc_attr( $link ); ?>" class="widefat" placeholder="https://www.beispiel.de">
        <span class="description" style="display:block;margin-top:4px;">Wird als "Mehr Infos auf der folgenden Website" angezeigt.</span>
    </p>

    <p>
        <label for="fuss_il"><strong>Interner Link</strong></label><br>
        <input type="text" id="fuss_il" name="fuss_il" value="<?php echo esc_attr( $il ); ?>" class="widefat" placeholder="tag/ausstellung/">
        <span class="description" style="display:block;margin-top:4px;">Pfad oder Adresse, z. B. <code>tag/ausstellung/</code>. Die Domain wird automatisch angepasst.</span>
    </p>

    <p>
        <label for="fuss_vl"><strong>Veranstaltungskategorie</strong></label><br>
        <?php if ( $taxonomy !== '' ) : ?>
            <select id="fuss_vl" name="fuss_vl" class="widefat">
                <option value="">– keine –</option>
                <?php if ( ! is_wp_error( $terms ) ) : ?>
                    <?php foreach ( $terms as $term ) : ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $vl, $term->slug ); ?>>
                            <?php echo esc_html( $term->name ); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <span class="description" style="display:block;margin-top:4px;">
                Taxonomie: <code><?php echo esc_html( $taxonomy ); ?></code>
            </span>
        <?php else : ?>
            <input type="text" id="fuss_vl" name="fuss_vl" value="<?php echo esc_attr( $vl ); ?>" class="widefat" placeholder="kunst-und-kultur">
            <span class="description" style="display:block;margin-top:4px;color:#b32d2e;">
                Keine Veranstaltungs-Taxonomie gefunden. Bitte den Slug manuell eintragen (z. B. <code>kunst-und-kultur</code>) oder <code>fuss_event_taxonomy()</code> anpassen.
            </span>
        <?php endif; ?>
    </p>
    <?php
}

function fuss_save_metabox( $post_id ) {

    // Nonce prüfen
    if ( ! isset( $_POST['fuss_metabox_nonce'] )
        || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fuss_metabox_nonce'] ) ), 'fuss_save_metabox' ) ) {
        return;
    }

    // Autosave und Revisionen ignorieren
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    // Berechtigung prüfen
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Felder speichern bzw. leere Felder löschen
    $fields = array(
        'fuss_link' => array( '_fuss_link', 'esc_url_raw' ),
        'fuss_il'   => array( '_fuss_il',   'sanitize_text_field' ),
        'fuss_vl'   => array( '_fuss_vl',   'sanitize_text_field' ),
    );

    foreach ( $fields as $field => $config ) {
        list( $meta_key, $sanitizer ) = $config;

        $value = isset( $_POST[ $field ] ) ? call_user_func( $sanitizer, wp_unslash( $_POST[ $field ] ) ) : '';

        if ( $value !== '' ) {
            update_post_meta( $post_id, $meta_key, $value );
        } else {
            delete_post_meta( $post_id, $meta_key );
        }
    }
}
add_action( 'save_post', 'fuss_save_metabox' );

/* ------------------------------------------------------------------------
 * POSITION DER METABOX UMSCHALTEN
 * --------------------------------------------------------------------- */

// Schnellwechsel über den Link in der Metabox
function fuss_handle_context_switch() {

    if ( ! isset( $_GET['fuss_set_context'], $_GET['post'] ) ) {
        return;
    }

    if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'fuss_set_context' ) ) {
        return;
    }

    $context = sanitize_text_field( wp_unslash( $_GET['fuss_set_context'] ) );
    $post_id = absint( $_GET['post'] );

    if ( ! in_array( $context, array( 'side', 'normal' ), true ) || ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $user_id = get_current_user_id();

    update_user_meta( $user_id, 'fuss_metabox_context', $context );

    // Gespeicherte Position/Zustand der Box zurücksetzen, damit die neue Position greift
    fuss_reset_metabox_layout( $user_id );

    // Zurück zum Editor ohne die Parameter
    wp_safe_redirect( get_edit_post_link( $post_id, 'raw' ) );
    exit;
}
add_action( 'admin_init', 'fuss_handle_context_switch' );

// Auswahlfeld im Benutzerprofil
function fuss_profile_field( $user ) {
    $current = get_user_meta( $user->ID, 'fuss_metabox_context', true );
    if ( ! in_array( $current, array( 'side', 'normal' ), true ) ) {
        $current = FUSS_METABOX_CONTEXT;
    }
    ?>
    <h2>Fußbereich-Plugin</h2>
    <table class="form-table" role="presentation">
        <tr>
            <th><label for="fuss_metabox_context">Position der Fußbereich-Metabox</label></th>
            <td>
                <select name="fuss_metabox_context" id="fuss_metabox_context">
                    <option value="side" <?php selected( $current, 'side' ); ?>>Rechts in der Seitenleiste</option>
                    <option value="normal" <?php selected( $current, 'normal' ); ?>>Unterhalb des Editors</option>
                </select>
                <p class="description">Gilt für Veranstaltungen und Beiträge.</p>
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'show_user_profile', 'fuss_profile_field' );
add_action( 'edit_user_profile', 'fuss_profile_field' );

function fuss_profile_field_save( $user_id ) {

    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return;
    }

    // Nonce des WordPress-Profilformulars prüfen
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'update-user_' . $user_id ) ) {
        return;
    }

    if ( isset( $_POST['fuss_metabox_context'] ) ) {
        $context = sanitize_text_field( wp_unslash( $_POST['fuss_metabox_context'] ) );
        if ( in_array( $context, array( 'side', 'normal' ), true ) ) {
            update_user_meta( $user_id, 'fuss_metabox_context', $context );

            // Gespeicherte Position/Zustand der Box zurücksetzen, damit die neue Position greift
            fuss_reset_metabox_layout( $user_id );
        }
    }
}
add_action( 'personal_options_update', 'fuss_profile_field_save' );
add_action( 'edit_user_profile_update', 'fuss_profile_field_save' );