<?php
/*
Plugin Name: Mobile Submenu Toggle
Description: Macht Untermenüs im mobilen Menü aufklappbar und schließt das Menü bei Klicks.
Version: 1.0
*/


add_action('wp_enqueue_scripts', function() {
  // CSS nur für mobile Geräte
  wp_enqueue_style('mobile-menu-css', plugins_url('mobile-menu.css', __FILE__), [], filemtime(__DIR__.'/mobile-menu.css'));

  // JavaScript mit Modernem Ansatz
  wp_enqueue_script('mobile-menu-js', plugins_url('mobile-menu.js', __FILE__), [], filemtime(__DIR__.'/mobile-menu.js'), true);
});
