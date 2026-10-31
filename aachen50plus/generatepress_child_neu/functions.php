<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add custom PHP here. Only edit this file with direct access to the server.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Erzwingt die linke Sidebar für Eventward-Einzelansichten.
add_filter( 'generate_sidebar_layout', function ( $layout ) {
    if ( is_singular( 'eventward_event' ) || is_singular( 'event' ) ) {
        return 'left-sidebar';
    }

    return $layout;
} );

/** Shortcode [bild_copyright] für die Bildunterschrift des Beitragsbilds. */
add_shortcode( 'bild_copyright', 'bild_shortcode' );
function bild_shortcode() {
    $attachment = get_post( get_post_thumbnail_id() );

    if ( ! $attachment || '' === trim( $attachment->post_excerpt ) ) {
        return '';
    }

    return '<p class="em_bild">' . esc_html( $attachment->post_excerpt ) . '</p>';
}

/** Überschriften aus automatisch erzeugten Excerpts entfernen. */
function wp_strip_header_tags( $excerpt = '' ) {
    $raw_excerpt = $excerpt;

    if ( '' === $excerpt ) {
        $excerpt = get_the_content( '' );
        $excerpt = strip_shortcodes( $excerpt );
        $excerpt = apply_filters( 'the_content', $excerpt );
        $excerpt = str_replace( ']]>', ']]>', $excerpt );
    }

    $regex          = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(</h\2>)#';
    $excerpt        = preg_replace( $regex, '', $excerpt );
    $excerpt_length = apply_filters( 'excerpt_length', 55 );
    $excerpt_more   = apply_filters( 'excerpt_more', ' [...]' );
    $excerpt        = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );

    return apply_filters( 'wp_trim_excerpt', preg_replace( $regex, '', $excerpt ), $raw_excerpt );
}
add_filter( 'get_the_excerpt', 'wp_strip_header_tags', 9 );

/** Entfernt die WordPress-Versionsangabe aus dem Generator-Meta-Tag. */
function wpb_remove_version() {
    return '';
}
add_filter( 'the_generator', 'wpb_remove_version' );


/** Shortcode [published-posts-count] für veröffentlichte Beiträge. */
function customprefix_total_number_published_posts( $atts = array() ) {
    $counts = wp_count_posts( 'post' );

    return ( is_object( $counts ) && isset( $counts->publish ) ) ? (int) $counts->publish : 0;
}
add_shortcode( 'published-posts-count', 'customprefix_total_number_published_posts' );

/** Shortcode [published-events-count] für veröffentlichte Eventward-Veranstaltungen. */
function customprefix_total_number_published_events( $atts = array() ) {
    $post_type = post_type_exists( 'eventward_event' ) ? 'eventward_event' : 'event';
    $counts    = wp_count_posts( $post_type );

    return ( is_object( $counts ) && isset( $counts->publish ) ) ? (int) $counts->publish : 0;
}
add_shortcode( 'published-events-count', 'customprefix_total_number_published_events' );

// XML-RPC deaktivieren und den X-Pingback-Header entfernen.
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', 'AH_remove_x_pingback' );
function AH_remove_x_pingback( $headers ) {
    if ( is_array( $headers ) ) {
        unset( $headers['X-Pingback'] );
    }

    return $headers;
}
