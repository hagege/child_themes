<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

add_theme_support( 'appearance-tools' );

// Link des Logos in der Hauptnavigation anpassen
add_filter( 'generate_logo_href', function() {
    return 'https://intern.bruecke-suedwestfalen.de/startseite/';
});

// Link des Logos in der Sticky Navigation anpassen
add_filter( 'generate_sticky_navigation_logo_output', function($output) {
    $url = 'https://intern.bruecke-suedwestfalen.de/startseite/';
    $logo = get_custom_logo();

    return sprintf(
        '<div class="sticky-navigation-logo"><a href="%1$s" rel="home">%2$s</a></div>',
        esc_url( $url ),
        $logo
    );
});




/* Bei Klick auf Logo nicht auf die definierte Startseite (Anmeldung), sondern auf die Startseite des intern-Bereichs - rausgenommen, weil nicht notwendig: 16.3.2025 */

/* add_filter( 'generate_logo_href', function() {
    return home_url('/startseite/');
});
*/

/*
add_action( 'init', 'themeslug_enqueue_block_styles' );

function themeslug_enqueue_block_styles() {
   wp_enqueue_block_style(
       'core/cover',
       array(
           'handle' => 'themeslug--card-interactive',
           'src'    => get_theme_file_uri( 'assets/css/blocks/core/cover-card-interactive.css' ),
           'path'   => get_theme_file_path( 'assets/css/blocks/core/cover-card-interactive.css' ),
       )
   );
}

add_action( 'init', 'themeslug_register_block_styles' );

function themeslug_register_block_styles() {
   register_block_style(
       'core/cover',
       array(
           'name'         => 'card--interactive',
           'label'        => __( 'Card (Interactive)', 'themeslug' ),
           'style_handle' => 'themeslug--card-interactive',
       )
   );
}
*/