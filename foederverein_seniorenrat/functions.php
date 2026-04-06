<?php
function child_theme_register_image_styles() {
    // Variation 1: 20px Radius
    register_block_style(
        'core/image',
        array(
            'name'         => 'rounded-20',
            'label'        => 'Abgerundet (20px)',
            'inline_style' => '.is-style-rounded-20 img { border-radius: 20px; }',
        )
    );

    // Variation 2: Asymmetrischer Radius
    register_block_style(
        'core/image',
        array(
            'name'         => 'asymmetric-radius',
            'label'        => 'Blatt-Form (40px)',
            'inline_style' => '.is-style-asymmetric-radius img { border-radius: 40px 0 40px 0; }',
        )
    );
}
add_action('init', 'child_theme_register_image_styles');