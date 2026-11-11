<?php
/**
 * Add footer with infos
 *
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.5
 *
 * @wordpress-plugin
 * Plugin Name:   Add footer with infos
 * Plugin URI:    https://haurand.com/
 * Description: Adds a configurable footer with photo credit, external and internal links, and an event-category link. Includes a metabox with configurable placement.
 * Version:       0.5
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com/author/hgg/
 * Text Domain:   add-footer-with-infos
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with shrinking Logo Sticky Header. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Direct access is not allowed.
}

/*
add_action( 'init', 'fuss_load_textdomain', 0 );
function fuss_load_textdomain() {
    load_plugin_textdomain( 'add-footer-with-infos', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
*/

/* ------------------------------------------------------------------------
 * KONFIGURATION
 * --------------------------------------------------------------------- */

// Default metabox position: 'side' = right sidebar, 'normal' = below the editor.
// Users can change this in their profile or directly in the metabox.
if ( ! defined( 'FUSS_METABOX_CONTEXT' ) ) {
    define( 'FUSS_METABOX_CONTEXT', 'side' );
}

// Get the current user’s selected metabox position.
function fuss_get_metabox_context() {
    $default = in_array( FUSS_METABOX_CONTEXT, array( 'side', 'normal' ), true ) ? FUSS_METABOX_CONTEXT : 'side';
    $user_id = get_current_user_id();

    if ( ! $user_id ) {
        return $default;
    }

    $pref = get_user_meta( $user_id, 'fuss_metabox_context', true );

    return in_array( $pref, array( 'side', 'normal' ), true ) ? $pref : $default;
}

// Reset the saved metabox layout (position, closed state, and visibility).
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

// Candidate event post types; use all that exist.
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

// Event category taxonomy (Eventward).
function fuss_event_taxonomy() {
    return 'eventward_category';
}

/* ------------------------------------------------------------------------
 * LEGACY PLUGIN: OVERRIDE SHORTCODE
 * --------------------------------------------------------------------- */

// Register late so this shortcode overrides the one from the legacy plugin.
function fuss_register_shortcode() {
    remove_shortcode( 'fuss' );
    add_shortcode( 'fuss', 'fuss_shortcode_handler' );
}
add_action( 'init', 'fuss_register_shortcode', 99 );

/* ------------------------------------------------------------------------
 * SHORTCODE OUTPUT
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

    // Metabox values take precedence over shortcode attributes, when set.
    $meta_link = $post_id ? get_post_meta( $post_id, '_fuss_link', true ) : '';
    $meta_il   = $post_id ? get_post_meta( $post_id, '_fuss_il', true ) : '';
    $meta_vl   = $post_id ? get_post_meta( $post_id, '_fuss_vl', true ) : '';

    $external_url = ! empty( $meta_link ) ? $meta_link : $atts['link'];
    $internal_raw = ! empty( $meta_il )   ? $meta_il   : $atts['il'];
    $vl_slug      = ! empty( $meta_vl )   ? $meta_vl   : $atts['vl'];

    $output = '';

    /* ---- a) Photo credit from the featured image alt text ---- */

    $alt_text = '';
    if ( $post_id ) {
        $thumb_id = get_post_thumbnail_id( $post_id );
        if ( $thumb_id ) {
            $alt_text = trim( (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) );
        }
    }

    // Append a default credit when no photo-credit marker is present.
    if ( $alt_text === '' ) {
        $alt_text = __( 'Photo: event organizer', 'add-footer-with-infos' );
    } elseif ( ! preg_match( '/(photo|foto|copyright|©|image|bild|credit)\s*:/iu', $alt_text ) ) {
        $alt_text .= ' | ' . __( 'Photo: event organizer', 'add-footer-with-infos' );
    }

    $output .= '<p class="fuss-foto-info">'
             . '<span class="fuss-mitteilung">'
             . esc_html__( 'More information about the photo:', 'add-footer-with-infos' )
             . '</span>'
             . '<br>'
             . esc_html( $alt_text )
             . '</p>';

    /* ---- b) External link ---- */

    if ( ! empty( $external_url ) ) {
        $output .= '<p class="fuss-link"><a href="' . esc_url( $external_url ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'More information on the following website', 'add-footer-with-infos' ) . '</a></p>';
    }

    /* ---- c) Internal link (always on the current domain, retaining the slug path) ---- */

    if ( ! empty( $internal_raw ) ) {
        $internal_url = fuss_build_internal_url( $internal_raw );
        if ( $internal_url !== '' ) {
            $output .= '<p class="fuss-il"><a href="' . esc_url( $internal_url ) . '">' . esc_html__( 'More posts about this topic', 'add-footer-with-infos' ) . '</a></p>';
        }
    }

    /* ---- d) Event category ---- */

    if ( ! empty( $vl_slug ) ) {
        $cat = fuss_get_category_data( $vl_slug );
        if ( ! empty( $cat['url'] ) ) {
            /* translators: %s: event category name. */
            $output .= '<p class="fuss-vl"><a href="' . esc_url( $cat['url'] ) . '">' . esc_html( sprintf( __( 'More events: %s', 'add-footer-with-infos' ), $cat['name'] ) ) . '</a></p>';
        }
    }

    return '<div class="fuss-bereich">' . $output . '</div>';
}

/* ------------------------------------------------------------------------
 * AUTOMATIC OUTPUT FROM THE METABOX (when content has no shortcode)
 * --------------------------------------------------------------------- */

/**
 * Automatically append the footer to the content when
 * - metabox values have been entered, and
 * - the content does not contain the [fuss] shortcode.
 */
function fuss_auto_append( $content ) {

    // Only on the front end, in the main loop, on a singular view.
    if ( is_admin() || ! is_singular() || ! in_the_loop() || ! is_main_query() ) {
        return $content;
    }

    $post_id = get_the_ID();
    if ( ! $post_id ) {
        return $content;
    }

    // Only for posts and events.
    $post_types   = fuss_event_post_types();
    $post_types[] = 'post';
    if ( ! in_array( get_post_type( $post_id ), $post_types, true ) ) {
        return $content;
    }

    // If the shortcode is in the content, it handles the output.
    // (also identifiable after do_shortcode by our container).
    if ( strpos( $content, 'fuss-bereich' ) !== false ) {
        return $content;
    }

    // Only output when at least one metabox field is set.
    $has_meta = get_post_meta( $post_id, '_fuss_link', true )
             || get_post_meta( $post_id, '_fuss_il', true )
             || get_post_meta( $post_id, '_fuss_vl', true );

    if ( ! $has_meta ) {
        return $content;
    }

    // Prevent duplicate output on the same page.
    static $already_done = array();
    if ( isset( $already_done[ $post_id ] ) ) {
        return $content;
    }
    $already_done[ $post_id ] = true;

    return $content . fuss_shortcode_handler( array() );
}
add_filter( 'the_content', 'fuss_auto_append', 99 );

/* ------------------------------------------------------------------------
 * HELPER FUNCTIONS
 * --------------------------------------------------------------------- */

/**
 * Build an internal URL from the value of "il".
 * Always link to the slug path (e.g. tag/exhibition/) on the current domain.
 */
function fuss_build_internal_url( $raw ) {

    $raw = trim( $raw );
    if ( $raw === '' ) {
        return '';
    }

    // Extract the path (discard the domain).
    $path = wp_parse_url( $raw, PHP_URL_PATH );
    if ( $path === null || $path === false || $path === '' ) {
        // Not a complete URL; for example, "tag/exhibition/" or "tag/exhibition".
        $path = $raw;
    }

    // Handle malformed legacy values such as "http://example.localtag/exhibition/":
    // If "tag/" occurs in the path, use the path from that point.
    if ( preg_match( '#(tag/[^?\#]+)#i', $raw, $m ) ) {
        $path = $m[1];
    }

    $path = trim( $path, '/' );

    // If only a slug is provided (e.g. "exhibition"), prepend the tag path.
    if ( $path !== '' && strpos( $path, '/' ) === false ) {
        $path = 'tag/' . $path;
    }

    if ( $path === '' ) {
        return '';
    }

    return home_url( '/' . $path . '/' );
}

/**
 * Return the event category name and URL for a slug or name.
 * The URL points to the event overview with a category filter,
 * e.g. /events/?ew_view=list&ew_cat=celebrations.
 */
function fuss_get_category_data( $value ) {

    $result   = array( 'name' => '', 'url' => '' );
    $value    = trim( $value );
    $taxonomy = fuss_event_taxonomy();

    if ( $value === '' ) {
        return $result;
    }

    // Extract the slug from a path such as "/events/category/art-and-culture/".
    if ( strpos( $value, '/' ) !== false ) {
        $value = basename( rtrim( $value, '/' ) );
    }

    $slug = sanitize_title( $value );
    $name = $value;

    // Look up the term to get the correct slug and name.
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

    // Base event overview page (page slug; default: "events").
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

    // Also add the box to regular posts.
    $post_types[] = 'post';

    $context = fuss_get_metabox_context();

    foreach ( array_unique( $post_types ) as $pt ) {
        add_meta_box(
            'fuss_metabox',
            esc_html__( 'Footer links', 'add-footer-with-infos' ),
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

    // Tags for the "Tag - internal link (il)" selector.
    $tags = get_terms(
        array(
            'taxonomy'   => 'post_tag',
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        )
    );

    // Match the saved value to the corresponding tag slug.
    $il_slug = '';
    if ( $il !== '' ) {
        $il_clean = trim( $il );
        $il_path  = wp_parse_url( $il_clean, PHP_URL_PATH );
        if ( $il_path === null || $il_path === false || $il_path === '' ) {
            $il_path = $il_clean;
        }
        if ( preg_match( '#(tag/[^?\#]+)#i', $il_clean, $m ) ) {
            $il_path = $m[1];
        }
        $il_path = trim( $il_path, '/' );

        if ( preg_match( '#^tag/([^/]+)$#i', $il_path, $m ) ) {
            $il_slug = $m[1];
        } elseif ( $il_path !== '' && strpos( $il_path, '/' ) === false ) {
            $il_slug = $il_path;
        }
    }

    // Position-switch link for the box.
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
        ? __( 'Move box below the editor', 'add-footer-with-infos' )
        : __( 'Move box to the sidebar', 'add-footer-with-infos' );
    ?>
    <p style="text-align:right;margin:0 0 8px;">
        <a href="<?php echo esc_url( $switch_url ); ?>" class="button button-small"><?php echo esc_html( $switch_label ); ?></a>
    </p>

    <p>
        <label for="fuss_link"><strong><?php echo esc_html__( 'External link', 'add-footer-with-infos' ); ?></strong></label><br>
        <input type="url" id="fuss_link" name="fuss_link" value="<?php echo esc_attr( $link ); ?>" class="widefat" placeholder="<?php echo esc_attr__( 'https://www.example.com', 'add-footer-with-infos' ); ?>">
        <span class="description" style="display:block;margin-top:4px;"><?php echo esc_html__( 'Displayed as “More information on the following website”.', 'add-footer-with-infos' ); ?></span>
    </p>

    <p>
        <label for="fuss_il"><strong><?php echo esc_html__( 'Tag - internal link (il)', 'add-footer-with-infos' ); ?></strong></label><br>
        <select id="fuss_il" name="fuss_il" class="widefat">
            <option value=""><?php echo esc_html__( '— none —', 'add-footer-with-infos' ); ?></option>
            <?php if ( ! is_wp_error( $tags ) ) : ?>
                <?php foreach ( $tags as $tag ) : ?>
                    <option value="<?php echo esc_attr( $tag->slug ); ?>" <?php selected( $il_slug, $tag->slug ); ?>>
                        <?php echo esc_html( $tag->name ); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <span class="description" style="display:block;margin-top:4px;"><?php echo esc_html__( 'Links to the tag page, e.g. tag/exhibition/. The domain is adjusted automatically.', 'add-footer-with-infos' ); ?></span>
    </p>

    <p>
        <label for="fuss_vl"><strong><?php echo esc_html__( 'Event category (vl)', 'add-footer-with-infos' ); ?></strong></label><br>
        <?php if ( $taxonomy !== '' ) : ?>
            <select id="fuss_vl" name="fuss_vl" class="widefat">
                <option value=""><?php echo esc_html__( '— none —', 'add-footer-with-infos' ); ?></option>
                <?php if ( ! is_wp_error( $terms ) ) : ?>
                    <?php foreach ( $terms as $term ) : ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $vl, $term->slug ); ?>>
                            <?php echo esc_html( $term->name ); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <span class="description" style="display:block;margin-top:4px;">
                <?php echo esc_html__( 'Taxonomy:', 'add-footer-with-infos' ); ?> <code><?php echo esc_html( $taxonomy ); ?></code>
            </span>
        <?php else : ?>
            <input type="text" id="fuss_vl" name="fuss_vl" value="<?php echo esc_attr( $vl ); ?>" class="widefat" placeholder="<?php echo esc_attr__( 'art-and-culture', 'add-footer-with-infos' ); ?>">
            <span class="description" style="display:block;margin-top:4px;color:#b32d2e;">
                <?php echo esc_html__( 'No event taxonomy found. Please enter the slug manually (e.g. art-and-culture) or adjust fuss_event_taxonomy().', 'add-footer-with-infos' ); ?>
            </span>
        <?php endif; ?>
    </p>
    <?php
}

function fuss_save_metabox( $post_id ) {

    // Verify the nonce.
    if ( ! isset( $_POST['fuss_metabox_nonce'] )
        || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fuss_metabox_nonce'] ) ), 'fuss_save_metabox' ) ) {
        return;
    }

    // Ignore autosaves and revisions.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    // Check permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save fields or delete empty fields.
	$fields = array(
		'_fuss_link' => isset( $_POST['fuss_link'] ) ? esc_url_raw( wp_unslash( $_POST['fuss_link'] ) ) : '',
		'_fuss_vl'   => isset( $_POST['fuss_vl'] ) ? sanitize_text_field( wp_unslash( $_POST['fuss_vl'] ) ) : '',
	);

	foreach ( $fields as $meta_key => $value ) {
		if ( $value !== '' ) {
			update_post_meta( $post_id, $meta_key, $value );
		} else {
			delete_post_meta( $post_id, $meta_key );
		}
	}

    // Internal link (il): save the selected tag slug as "tag/<slug>/".
    $il_slug = isset( $_POST['fuss_il'] ) ? sanitize_title( wp_unslash( $_POST['fuss_il'] ) ) : '';

    if ( $il_slug !== '' && term_exists( $il_slug, 'post_tag' ) ) {
        update_post_meta( $post_id, '_fuss_il', 'tag/' . $il_slug . '/' );
    } else {
        delete_post_meta( $post_id, '_fuss_il' );
    }
}
add_action( 'save_post', 'fuss_save_metabox' );

/* ------------------------------------------------------------------------
 * SWITCH METABOX POSITION
 * --------------------------------------------------------------------- */

// Quick switch using the link in the metabox.
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

    // Reset the saved box position/state so the new position takes effect.
    fuss_reset_metabox_layout( $user_id );

    // Return to the editor without the parameters.
    wp_safe_redirect( get_edit_post_link( $post_id, 'raw' ) );
    exit;
}
add_action( 'admin_init', 'fuss_handle_context_switch' );

// Selection field in the user profile.
function fuss_profile_field( $user ) {
    $current = get_user_meta( $user->ID, 'fuss_metabox_context', true );
    if ( ! in_array( $current, array( 'side', 'normal' ), true ) ) {
        $current = FUSS_METABOX_CONTEXT;
    }
    ?>
    <h2><?php echo esc_html__( 'Footer plugin', 'add-footer-with-infos' ); ?></h2>
    <table class="form-table" role="presentation">
        <tr>
            <th><label for="fuss_metabox_context"><?php echo esc_html__( 'Footer metabox position', 'add-footer-with-infos' ); ?></label></th>
            <td>
                <select name="fuss_metabox_context" id="fuss_metabox_context">
                    <option value="side" <?php selected( $current, 'side' ); ?>><?php echo esc_html__( 'Right in the sidebar', 'add-footer-with-infos' ); ?></option>
                    <option value="normal" <?php selected( $current, 'normal' ); ?>><?php echo esc_html__( 'Below the editor', 'add-footer-with-infos' ); ?></option>
                </select>
                <p class="description"><?php echo esc_html__( 'Applies to events and posts.', 'add-footer-with-infos' ); ?></p>
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

    // Verify the WordPress profile form nonce.
    if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'update-user_' . $user_id ) ) {
        return;
    }

    if ( isset( $_POST['fuss_metabox_context'] ) ) {
        $context = sanitize_text_field( wp_unslash( $_POST['fuss_metabox_context'] ) );
        if ( in_array( $context, array( 'side', 'normal' ), true ) ) {
            update_user_meta( $user_id, 'fuss_metabox_context', $context );

            // Reset the saved box position/state so the new position takes effect.
            fuss_reset_metabox_layout( $user_id );
        }
    }
}
add_action( 'personal_options_update', 'fuss_profile_field_save' );
add_action( 'edit_user_profile_update', 'fuss_profile_field_save' );