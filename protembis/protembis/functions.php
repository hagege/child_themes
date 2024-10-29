<?php
/*-----------------------------------------------------------------------------------*/
/*                             Protembis functions pack                              */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Import scripts and styles                                                         */
/*-----------------------------------------------------------------------------------*/

function prot_includes(){  
 if(!is_admin()){  
  wp_enqueue_script('protembis-js',get_theme_file_uri('/js/protembis-js.js'),array('jquery'),'1.0.0',true);
  wp_enqueue_style('dashicons');
  wp_enqueue_style('protembis-style',get_stylesheet_uri(),array(),'1.0.0','all');
 }  
}  
add_action('wp_enqueue_scripts','prot_includes');

/*-----------------------------------------------------------------------------------*/
/* Enable the theme navigation                                                       */
/*-----------------------------------------------------------------------------------*/

function prot_register_menus(){
 register_nav_menus(array(
  'navigation' => __('Navigation'),
  'header-rechts' => __('Rechte Header Navigation'),
 ));
}
add_action('init','prot_register_menus');

function my_theme_styles(){
 wp_enqueue_style('dashicons');
}

/*-----------------------------------------------------------------------------------*/
/* Hide the WordPress version number for security reasons                            */
/*-----------------------------------------------------------------------------------*/

function prot_remove_version(){
 return '';
}
add_filter('the_generator','prot_remove_version');

/*-----------------------------------------------------------------------------------*/
/* Enable thumbnails                                                                 */
/*-----------------------------------------------------------------------------------*/

if(function_exists('add_theme_support')){
 add_theme_support('post-thumbnails');
}
if(function_exists('add_image_size')){
 add_image_size('image-480',480);
 add_image_size('image-600',600);
 add_image_size('image-800',800);
 add_image_size('image-1200',1200);
 add_image_size('image-1600',1600);
 add_image_size('image-1920',1920);
}

/*-----------------------------------------------------------------------------------*/
/* Remove the emoji js and css                                                       */
/*-----------------------------------------------------------------------------------*/

remove_action('wp_head','print_emoji_detection_script',7);
remove_action('wp_print_styles','print_emoji_styles');

