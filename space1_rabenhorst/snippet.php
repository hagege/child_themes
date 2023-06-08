<?php
add_image_size('custom-image-square', 1200, 1200, true); //Bildformat 1:1
add_image_size('custom-image-medium', 200, 133, true); //Bildformat 3:2
add_image_size('open-graph', 1200, 630, true); //Facebook-Bildformat
add_image_size('twitter-card', 1024, 512, true); //Twitter-Bildformat
add_image_size('image-square-600', 600, 600, true); //Twitter-Bildformat

add_filter('image_size_names_choose', 'custom_image_sizes_choose');
function custom_image_sizes_choose($sizes) {
	$custom_sizes = array(
		'custom-image-square' => __('Bild-Quadrat 1200'),
		'custom-image-medium' => __('Bild 200x133'),
		'open-graph' => __('Open-Graph 1200x630'),
		'twitter-card' => __('Twitter-Card 1024x512'),
		'image-square-600' => __('Bild-Quadrat 600x600')		
	);
	return array_merge($sizes, $custom_sizes);
}