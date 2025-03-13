<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

add_theme_support( 'appearance-tools' );


/* Bei Klick auf Logo nicht auf die definierte Startseite (Anmeldung), sondern auf die Startseite des intern-Bereichs */

add_filter( 'generate_logo_href', function() {
    return home_url('/startseite/');
});


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