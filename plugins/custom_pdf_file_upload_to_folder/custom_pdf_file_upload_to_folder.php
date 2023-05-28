<?php
/*
Plugin Name: Custom PDF-File Upload to Folder
Description: Allows users to upload PDF-files to a custom folder from the dashboard menu.
Version: 0.1
Author: Hans-Gerd Gerhards
Author URI: http://haurand.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Add the custom menu option in the dashboard menu
add_action('admin_menu', 'custom_file_upload_add_menu');
function custom_file_upload_add_menu() {
    add_menu_page(
        'Custom File Upload',
        'Custom File Upload',
        'manage_options',
        'custom-file-upload',
        'custom_file_upload_page',
        'dashicons-upload',
        25
    );
}

// Render the custom file upload page
function custom_file_upload_page() {
    if (isset($_POST['custom_file_upload_submit'])) {
        $upload_dir = wp_upload_dir(); // Get the default upload directory
        $target_dir = $upload_dir['basedir'] . '/wochenplan/'; // Custom folder path

        // Create the custom folder if it doesn't exist
        if (!file_exists($target_dir)) {
            wp_mkdir_p($target_dir);
        }

        $file = $_FILES['custom_file'];
        $target_file = $target_dir . basename($file['name']);
        $file_type = wp_check_filetype(basename($file['name']), null);

        // Check if the file is allowed
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        if (!in_array($file_type['ext'], $allowed_types)) {
            echo 'Invalid file type. Only JPG, JPEG, PNG, PDF and GIF files are allowed.';
            return;
        }

        // Move the uploaded file to the custom folder
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            echo 'File uploaded successfully.';
        } else {
            echo 'Failed to upload the file.';
        }
    }

    // Render the file upload form
    ?>
    <div class="wrap">
        <h1>Custom File Upload</h1>
        <form enctype="multipart/form-data" method="post">
            <input type="file" name="custom_file" />
            <input type="submit" name="custom_file_upload_submit" value="Upload" />
        </form>
    </div>
    <?php
}
