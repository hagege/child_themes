<?php
/*
Plugin Name: Custom PDF File Upload to Folder
Plugin URI: http://haurand.com
Description: A plugin to upload PDF-Files to a custom folder and post automatic per shortcode PDF-Files as link
Version: 0.2.3
Author: Hans-Gerd Gerhards
Author URI: http://haurand.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Securing against unauthorized access //
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add the custom menu option in the dashboard menu
add_action('admin_menu', 'custom_file_upload_add_menu');
function custom_file_upload_add_menu() {
    add_menu_page(
        'PDF Upload',
        'PDF Upload',
        'manage_options',
        'custom-file-upload',
        'custom_file_upload_page',
        'dashicons-upload',
        25
    );
}

// Register the custom folder name setting
add_action('admin_init', 'custom_file_upload_settings');
function custom_file_upload_settings() {
    register_setting('custom_file_upload_options', 'custom_file_upload_folder_name');
}


// Render the custom file upload page
function custom_file_upload_page() {
    if (isset($_POST['custom_file_upload_submit'])) {
        $folder_name = sanitize_text_field($_POST['custom_file_upload_folder_name']);
        update_option('custom_file_upload_folder_name', $folder_name);

        $upload_dir = wp_upload_dir(); // Get the default upload directory
        $target_dir = $upload_dir['basedir'] . '/' . $folder_name . '/'; // Custom folder path

        // Create the custom folder if it doesn't exist
        if (!file_exists($target_dir)) {
            wp_mkdir_p($target_dir);
        }

        $file = $_FILES['custom_file'];
        $target_file = $target_dir . basename($file['name']);
        $file_type = wp_check_filetype(basename($file['name']), null);

        // Check if the file is allowed
        /* $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'pdf'); */
		$allowed_types = array('pdf');
        if (!in_array($file_type['ext'], $allowed_types)) {
            echo 'Invalid file type. Only PDF files are allowed.';
            return;
        }

        // Move the uploaded file to the custom folder
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            echo $target_file .' - File uploaded successfully.';
        } else {
            echo $target_file . ' - Failed to upload the file.';
        }
    }

    // Get the current custom folder name option
    $current_folder_name = get_option('custom_file_upload_folder_name');

    // Render the file upload form with the current folder name
    ?>
    <div class="wrap">
        <h1>PDF File Upload</h1>
        <form enctype="multipart/form-data" method="post">
            <label for="custom_folder_name">Name für Ordner (Maximal 4-12 Zeichen. Zugelassen sind kleine Buchstaben, Ziffern, Unterstrich und Bindestrich):</label>
            <input 
				type="text" 
				name="custom_file_upload_folder_name" 
				id="custom_folder_name" 
				pattern="[a-z0-9_-]{4,12}" 
				title="Maximal 4-12 Zeichen. Zugelassen sind kleine Buchstaben, Ziffern, Unterstrich und Bindestrich" 
				value="<?php echo esc_attr($current_folder_name); ?>" 
			/>
            <p class="description">Gib den Namen für den Ordner ein, in den die PDF-Dateien hochgeladen werden sollen.</p>

            <input type="file" name="custom_file" />
            <input type="submit" name="custom_file_upload_submit" value="Upload" />
        </form>
    </div>
    <?php
}


add_shortcode( 'wochenplan' , 'wochenplan_shortcode' );
function wochenplan_shortcode(){
  $upload_dir = wp_upload_dir();
  $out = '';
  /* https://seniorensport-attendorn.de/wp-content/uploads/2023/05/KW_21_Wochenplan_SeniorenSport.pdf */ 
  $week_number = date("W");
  for ($i=$week_number-1; $i <= $week_number+1; $i++) { 
	  $upload_dir = wp_upload_dir(); // Get the default upload directory
	  $current_folder_name = get_option('custom_file_upload_folder_name');
      $pdf_file = $upload_dir['baseurl'] . '/' . $current_folder_name . '/' . 'KW_' . $i . '_Wochenplan_SeniorenSport.pdf'; // Custom folder path
	  $pdf_file_name = 'KW_' . $i . '_Wochenplan_SeniorenSport.pdf';
   	  if(UR_exists($pdf_file)){ 
		  $out .= '<div class="pdf-button"><a href="';
		  $out .= esc_url( $pdf_file) . '">';
		  $out .= 'KW - ' . $i . ' - Hier klicken';
		  $out .= '</a></div>';
	  } else {
		  $out .= '<div class="pdf-button-not-found">Die Datei <strong>' . $pdf_file_name . '</strong> ist noch nicht oder nicht mehr vorhanden.</div>';
	  }  
  }
  return $out;
}

function UR_exists($url){
	   $headers=get_headers($url);
	   return stripos($headers[0],"200 OK")?true:false;
}