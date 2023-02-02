<?php
/*
Plugin Name: All Used Category Names
Description: Displays a list of all used category names in your WordPress site
Version: 1.0
Author: Hans-Gerd Gerhards
*/

function my_category_list_shortcode() {
    $args = array(
        'orderby' => 'name',
        'hide_empty' => 0
    );
    $categories = get_categories($args);
    $output = '<div>';
    foreach($categories as $category) {
        // $output .= '<a href="' . get_category_link($category->term_id) . '">' . $category->name . ' (' . $category->count . ')</a>' . '   ';
		$output .= '<a class="my_category_list" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>' . '   ';
    }
    $output .= '</div>';
    return $output;
}
add_shortcode('my_category_list', 'my_category_list_shortcode');
