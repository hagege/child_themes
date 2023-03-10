<?php
add_action( 'init', 'block_course_theme_register_patterns' );

function block_course_theme_register_patterns() {
    register_block_pattern( 'hgg_theme_2023/patterns/hero', array(
        'title'      => __( 'Hero', 'hgg_theme_2023' ),
        'categories' => array( 'featured' ),
        'content'    => '<!-- Block pattern goes here. -->'
    ) );
}

add_action( 'init', 'block_course_theme_register_pattern_categories' );

function block_course_theme_register_pattern_categories() {
    register_block_pattern_category( 'hgg_theme_2023', array( 
        'label' => __( 'HGG Theme 2023', 'hgg_theme_2023' )
    ) );
}


add_action( 'after_setup_theme', 'block_course_theme_setup_patterns' );

function block_course_theme_setup_patterns() {
    remove_theme_support( 'core-block-patterns' );
}