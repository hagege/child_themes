<?php
/*
Plugin Name: Custom PDF File Upload to Folder
Plugin URI: http://haurand.com
Description: A plugin to upload PDF-Files to a custom folder and post automatic per shortcode PDF-Files as link
Version: 0.3.4
Author: Hans-Gerd Gerhards
Author URI: http://haurand.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Securing against unauthorized access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin constants
define( 'CUSTOM_FILE_UPLOAD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CUSTOM_FILE_UPLOAD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CUSTOM_FILE_UPLOAD_VERSION', '0.3.3' );

// Add the custom menu option in the dashboard menu
add_action( 'admin_menu', 'custom_file_upload_add_menu' );
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
add_action( 'admin_init', 'custom_file_upload_settings' );
function custom_file_upload_settings() {
	register_setting(
		'custom_file_upload_options',
		'custom_file_upload_folder_name',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'custom_file_upload_sanitize_folder_name',
			'show_in_rest'      => false,
		)
	);
}

// Sanitize folder name
function custom_file_upload_sanitize_folder_name( $input ) {
	// Only allow lowercase letters, numbers, underscores, and hyphens
	return preg_replace( '/[^a-z0-9_-]/', '', $input );
}

// Render the custom file upload page
function custom_file_upload_page() {
	// Check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Unauthorized' );
	}

	// Process form submission
	if ( isset( $_POST['custom_file_upload_submit'] ) ) {
		// Verify nonce for security
		if ( ! isset( $_POST['custom_file_upload_nonce'] ) || 
		     ! wp_verify_nonce( $_POST['custom_file_upload_nonce'], 'custom_file_upload_action' ) ) {
			wp_die( 'Security check failed' );
		}

		$folder_name = sanitize_text_field( $_POST['custom_file_upload_folder_name'] );
		
		// Validate folder name
		if ( ! preg_match( '/^[a-z0-9_-]{4,12}$/', $folder_name ) ) {
			echo '<div class="notice notice-error"><p>Invalid folder name format.</p></div>';
			return;
		}

		update_option( 'custom_file_upload_folder_name', $folder_name );

		// Get the default upload directory
		$upload_dir = wp_upload_dir();
		
		// Check for upload directory errors
		if ( false !== $upload_dir['error'] ) {
			echo '<div class="notice notice-error"><p>Upload directory error: ' . esc_html( $upload_dir['error'] ) . '</p></div>';
			return;
		}

		$target_dir = $upload_dir['basedir'] . '/' . $folder_name . '/';

		// Create the custom folder if it doesn't exist
		if ( ! file_exists( $target_dir ) ) {
			if ( ! wp_mkdir_p( $target_dir ) ) {
				echo '<div class="notice notice-error"><p>Failed to create upload directory.</p></div>';
				return;
			}
		}

		// Check if file was uploaded
		if ( ! isset( $_FILES['custom_file'] ) || empty( $_FILES['custom_file']['name'] ) ) {
			echo '<div class="notice notice-error"><p>No file selected.</p></div>';
			return;
		}

		$file = $_FILES['custom_file'];
		
		// Validate file size (max 50MB)
		$max_file_size = 50 * 1024 * 1024; // 50MB
		if ( $file['size'] > $max_file_size ) {
			echo '<div class="notice notice-error"><p>File size exceeds maximum allowed size (50MB).</p></div>';
			return;
		}

		// Check file type
		$file_type = wp_check_filetype( basename( $file['name'] ), null );
		$allowed_types = array( 'pdf' );

		if ( ! in_array( $file_type['ext'], $allowed_types, true ) ) {
			echo '<div class="notice notice-error"><p>Invalid file type. Only PDF files are allowed.</p></div>';
			return;
		}

		// Additional MIME type check
		$allowed_mimes = array( 'pdf' => 'application/pdf' );
		if ( ! wp_match_mime_types( $allowed_mimes, $file['type'] ) ) {
			echo '<div class="notice notice-error"><p>Invalid file MIME type.</p></div>';
			return;
		}

		// Generate safe filename
		$filename = sanitize_file_name( basename( $file['name'] ) );
		$target_file = $target_dir . $filename;

		// Check if file already exists
		if ( file_exists( $target_file ) ) {
			// Generate unique filename
			$filename = wp_unique_filename( $target_dir, $filename );
			$target_file = $target_dir . $filename;
		}

		// Move the uploaded file
		if ( move_uploaded_file( $file['tmp_name'], $target_file ) ) {
			// Set proper file permissions
			chmod( $target_file, 0644 );
			echo '<div class="notice notice-success"><p>' . esc_html( $filename ) . ' uploaded successfully.</p></div>';
		} else {
			echo '<div class="notice notice-error"><p>Failed to upload the file.</p></div>';
		}
	}

	// Get the current custom folder name option
	$week_number = (int) date( 'W' );
	$week_number++;
	$upload_dir = wp_upload_dir();
	$current_folder_name = get_option( 'custom_file_upload_folder_name' );
	$pdf_file = $upload_dir['baseurl'] . '/' . $current_folder_name . '/' . 'KW_' . $week_number . '_Wochenplan_SeniorenSport.pdf';
	$pdf_file_name = 'KW_' . $week_number . '_Wochenplan_SeniorenSport.pdf';

	// Render the file upload form
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'PDF File Upload', 'custom-file-upload' ); ?></h1>
		<form enctype="multipart/form-data" method="post">
			<?php wp_nonce_field( 'custom_file_upload_action', 'custom_file_upload_nonce' ); ?>

			<table class="form-table">
				<tr>
					<th scope="row">
						<label for="custom_folder_name"><?php esc_html_e( 'Folder Name', 'custom-file-upload' ); ?></label>
					</th>
					<td>
						<input 
							type="text" 
							name="custom_file_upload_folder_name" 
							id="custom_folder_name" 
							pattern="[a-z0-9_-]{4,12}" 
							title="<?php esc_attr_e( 'Max 4-12 characters. Lowercase letters, numbers, underscores and hyphens only.', 'custom-file-upload' ); ?>" 
							value="<?php echo esc_attr( $current_folder_name ); ?>"
							required
						/>
						<p class="description"><?php esc_html_e( 'Expected file name:', 'custom-file-upload' ); ?> <strong><?php echo esc_html( $pdf_file_name ); ?></strong></p>
						<p class="description"><?php esc_html_e( 'Upload folder URL:', 'custom-file-upload' ); ?> <strong><?php echo esc_html( $upload_dir['baseurl'] . '/' . $current_folder_name ); ?></strong></p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="custom_file"><?php esc_html_e( 'Select PDF File', 'custom-file-upload' ); ?></label>
					</th>
					<td>
						<input 
							type="file" 
							name="custom_file" 
							id="custom_file"
							accept=".pdf"
							required
						/>
						
						<?php
						// Display the last 10 uploaded files
						$recent_files = custom_file_upload_get_recent_files( $upload_dir['basedir'] . '/' . $current_folder_name . '/', 10 );
						if ( ! empty( $recent_files ) ) {
							?>
							<div style="margin-top: 20px; padding: 15px; background: #f5f5f5; border: 1px solid #ddd; border-radius: 4px;">
								<h3 style="margin-top: 0;"><?php esc_html_e( 'Recently Uploaded Files (Last 10)', 'custom-file-upload' ); ?></h3>
								<table style="width: 100%; border-collapse: collapse;">
									<thead>
										<tr style="background: #fff; border-bottom: 2px solid #999;">
											<th style="text-align: left; padding: 8px; border-right: 1px solid #ddd;"><?php esc_html_e( 'File Name', 'custom-file-upload' ); ?></th>
											<th style="text-align: right; padding: 8px; border-right: 1px solid #ddd; width: 120px;"><?php esc_html_e( 'Size', 'custom-file-upload' ); ?></th>
											<th style="text-align: right; padding: 8px; width: 180px;"><?php esc_html_e( 'Upload Date', 'custom-file-upload' ); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ( $recent_files as $file_info ) : ?>
											<tr style="border-bottom: 1px solid #eee;">
												<td style="padding: 8px; border-right: 1px solid #ddd;">
													<code style="background: #fff; padding: 2px 6px; border-radius: 3px;">
														<?php echo esc_html( $file_info['name'] ); ?>
													</code>
												</td>
												<td style="padding: 8px; text-align: right; border-right: 1px solid #ddd; font-size: 12px; color: #666;">
													<?php echo esc_html( $file_info['size_formatted'] ); ?>
												</td>
												<td style="padding: 8px; text-align: right; font-size: 12px; color: #666;">
													<?php echo esc_html( $file_info['date_formatted'] ); ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<?php
						}
						?>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Get recently uploaded PDF files
 *
 * @param string $directory Directory path to scan
 * @param int    $limit Maximum number of files to return
 * @return array Array of file information
 */
function custom_file_upload_get_recent_files( $directory, $limit = 10 ) {
	if ( ! is_dir( $directory ) ) {
		return array();
	}

	$files = array();

	// Get all PDF files in the directory
	if ( $handle = opendir( $directory ) ) {
		while ( false !== ( $file = readdir( $handle ) ) ) {
			if ( '.' === $file || '..' === $file ) {
				continue;
			}

			$file_path = $directory . $file;

			// Only process PDF files
			if ( ! is_file( $file_path ) || ! preg_match( '/\.pdf$/i', $file ) ) {
				continue;
			}

			// Get file info
			$file_size = filesize( $file_path );
			$file_mtime = filemtime( $file_path );

			$files[] = array(
				'name'             => $file,
				'path'             => $file_path,
				'size'             => $file_size,
				'size_formatted'   => custom_file_upload_format_bytes( $file_size ),
				'mtime'            => $file_mtime,
				'date_formatted'   => wp_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $file_mtime ),
			);
		}
		closedir( $handle );
	}

	// Sort by modification time (newest first)
	usort( $files, function ( $a, $b ) {
		return $b['mtime'] - $a['mtime'];
	});

	// Return only the most recent files
	return array_slice( $files, 0, $limit );
}

/**
 * Format bytes to human-readable format
 *
 * @param int $bytes File size in bytes
 * @return string Formatted file size
 */
function custom_file_upload_format_bytes( $bytes ) {
	$units = array( 'B', 'KB', 'MB', 'GB' );
	$bytes = max( $bytes, 0 );
	$pow = floor( ( $bytes ? log( $bytes ) : 0 ) / log( 1024 ) );
	$pow = min( $pow, count( $units ) - 1 );
	$bytes /= ( 1 << ( 10 * $pow ) );

	return round( $bytes, 2 ) . ' ' . $units[ $pow ];
}

// Register shortcode
add_shortcode( 'wochenplan', 'wochenplan_shortcode' );

function wochenplan_shortcode() {
	$upload_dir = wp_upload_dir();
	$out = '';
	$week_number = (int) date( 'W' );

	// Check for upload directory errors
	if ( false !== $upload_dir['error'] ) {
		return '<p>Upload directory error.</p>';
	}

	$current_folder_name = get_option( 'custom_file_upload_folder_name' );
	
	if ( empty( $current_folder_name ) ) {
		return '<p>Upload folder not configured.</p>';
	}

	// Loop through current and next week
	for ( $i = $week_number; $i <= $week_number + 1; $i++ ) {
		$pdf_file = $upload_dir['baseurl'] . '/' . $current_folder_name . '/' . 'KW_' . $i . '_Wochenplan_SeniorenSport.pdf';
		$pdf_file_name = 'KW_' . $i . '_Wochenplan_SeniorenSport.pdf';

		// Use wp_remote_head for better performance
		if ( custom_file_upload_file_exists( $pdf_file ) ) {
			$out .= '<div class="pdf-button"><a href="' . esc_url( $pdf_file ) . '" download>' . esc_html( 'KW - ' . $i . ' - Hier klicken' ) . '</a></div>';
		} else {
			$out .= '<div class="pdf-button-not-found">' . esc_html( 'Die Datei ' ) . '<strong>' . esc_html( $pdf_file_name ) . '</strong> ' . esc_html( 'ist noch nicht oder nicht mehr vorhanden.' ) . '</div>';
		}
	}

	return $out;
}

/**
 * Check if a file exists using wp_remote_head
 * More efficient than get_headers()
 */
function custom_file_upload_file_exists( $url ) {
	// Use transient caching to avoid repeated requests
	$transient_key = 'cfu_file_exists_' . md5( $url );
	$cached = get_transient( $transient_key );

	if ( false !== $cached ) {
		return $cached;
	}

	$response = wp_remote_head( $url, array( 'sslverify' => false ) );

	if ( is_wp_error( $response ) ) {
		set_transient( $transient_key, false, HOUR_IN_SECONDS );
		return false;
	}

	$http_code = (int) wp_remote_retrieve_response_code( $response );
	$exists = ( 200 === $http_code );

	// Cache the result for 1 hour
	set_transient( $transient_key, $exists, HOUR_IN_SECONDS );

	return $exists;
}