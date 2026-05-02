<?php
/**
 * Ollie functions and definitions.
 *
 */
// Copyright Shortcode: [copyright_notice]
add_shortcode( 'copyright_notice', 'copyright_notice_shortcode' );

function copyright_notice_shortcode() {
    return sprintf(
        '© %d %s | erstellt von <a href="https://haurand.com">haurand.com</a>',
        intval( current_time( 'Y' ) ),
        esc_html( get_bloginfo( 'name' ) )
    );
}