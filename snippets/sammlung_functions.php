<?php
// Änderung der Schriftart, etc. im Adminbereich 
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    body, h1, h2, td, textarea, input, select {
      font-family: "Lucida Grande";
      font-size: 12px;
	  color: red;
	  background-color: lightgrey;
    } 
  </style>';
}


// Änderung im Adminbereich - Quelle: https://kulturbanause.de/blog/eigene-css-styles-bzw-stylesheets-im-wordpress-admin-bereich-verwenden/
function kb_admin_style() {
   wp_enqueue_style('admin-styles', get_template_directory_uri().'/style-admin.css');
}

add_action('admin_enqueue_scripts', 'kb_admin_style');

/* Zusätzlich noch eine CSS-Datei:
#wpadminbar {
   background: deeppink;
 }
*/

// Beispiel für die Idee, Styles im Dashboard genauso aussehen zu lassen wie im Frontend. Hat aber nicht funktioniert
function haurand_dashboard_admin_style() {
   wp_enqueue_style('admin-styles', plugin_dir_path( __FILE__ ) . '/style.css');
}

add_action('admin_enqueue_scripts', 'haurand_dashboard_admin_style');
