<?php

// Register a block style for a clickable card
/*
add_action( 'init', 'themeslug_register_block_styles' );

function themeslug_register_block_styles() {
   register_block_style(
       'core/cover',
       array(
           'name'         => 'card--interactive',
           'label'        => __( 'Card (Interactive)', 'themeslug' ),
           'inline_style' => '
               .is-style-card--interactive {
                   position: relative;
               }
               .is-style-card--interactive :where(.wp-block-group.wp-block-group-is-layout-constrained) {
                   position: static;
               }
               .is-style-card--interactive :where(.wp-block-heading) a:after {
                   content: "";
                   inset: 0;
                   position: absolute;
                   z-index: 10;
               }
           ',
       )
   );
}
*/

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