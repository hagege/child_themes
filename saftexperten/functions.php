<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

 /*
 add_filter( 'upload_mimes', function( $mimes ) {
    $mimes['woff']  = 'application/x-font-woff';
    $mimes['woff2'] = 'application/x-font-woff2';
    $mimes['ttf']   = 'application/x-font-ttf';
    $mimes['svg']   = 'image/svg+xml';
    $mimes['eot']   = 'application/vnd.ms-fontobject';

    return $mimes;
} ); 
*/

add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'generate-child' );
}, 50 );

// GP - Activate local fonts in editor

add_filter( 'generate_editor_styles', function( $editor_styles ) {
    $editor_styles[] = 'style.css';

    return $editor_styles;
} );

add_filter( ‘generate_typography_default_fonts’, function( $fonts ) {
    $fonts[] = ‘carnas_bold’;
    return $fonts;
    } );

add_filter( 'generate_typography_default_fonts', function( $fonts ) {
    $fonts[] = 'carnas_bold';
    $fonts[] = 'carnas_light';
    $fonts[] = 'carnas_med';
    $fonts[] = 'carnas_xbol';
    return $fonts;
} );