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
    $my_categories = get_categories($args);
    $my_output = '<div>';
    foreach($my_categories as $my_category) {
        // $output .= '<a href="' . get_category_link($my_category->term_id) . '">' . $my_category->name . ' (' . $my_category->count . ')</a>' . '   ';
		$my_output .= '<a class="my_category_list" href="' . get_category_link($my_category->term_id) . '">' . $my_category->name . '</a>' . '   ';
    }
    $my_output .= '</div>';
    return $my_output;
}
add_shortcode('my_category_list', 'my_category_list_shortcode');
