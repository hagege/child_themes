<?php
/*
Plugin Name: All Used Category Names
Description: Displays a list of all used category names in your WordPress site
Version: 1.1.1
Author: Hans-Gerd Gerhards
*/

/*----------------------------------------------------------------*/
/* Start: Shortcode für Kategorienliste - Aufruf mit [my_category_list]
/* Datum: 04.2.2023
/* Autor: hgg
/*----------------------------------------------------------------*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

function my_category_list_shortcode() {
    $args = array(
        'orderby' => 'name',
        'hide_empty' => 1
    );
    $my_categories = get_categories($args);
    $my_output = '<p class="beitrags_kategorien">';
    foreach($my_categories as $my_category) {
        // $my_output .= '<a class="my_category_list" href="' . get_category_link($my_category->term_id) . '">' . $my_category->name . ' (' . $my_category->count . ')</a>' . '   ';
        $my_output .= '<a class="my_category_list" href="' . get_category_link($my_category->term_id) . '">' . $my_category->name . '</a>' . '   ';
    }
    $my_output .= '</p>';
    return "<h3>Beitrags-Kategorien</h3>$my_output";
  }
  add_shortcode('my_category_list', 'my_category_list_shortcode');