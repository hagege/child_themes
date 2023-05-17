<?php
/**
 * @package Send Mail Notification
 * @version 0.2
 */
/*
Plugin Name: Send Mail Notification
Plugin URI: http://haurand.com
Description: Send Mail Notification to owner of a wordpress website
Author: Hans-Gerd Gerhards
Version: 0.2
Author URI: http://haurand.com
*/
add_action('admin_menu', 'custom_mail_menu');
function custom_mail_menu() {

    //create new top-level menu
    add_options_page('Custom Mail Settings', 'Custom Mail Settings', 'administrator', __FILE__, 'custom_mail_settings_page');

    //call register settings function
    add_action( 'admin_init', 'custom_mail_settings' );
}

//register our settings
function custom_mail_settings() {
    register_setting( 'custom-mail-settings-group-15167', 'custom_mail_to' );
    register_setting( 'custom-mail-settings-group-15167', 'custom_mail_from' );
    register_setting( 'custom-mail-settings-group-15167', 'custom_mail_sub' );
    register_setting( 'custom-mail-settings-group-15167', 'custom_mail_message' );
}

function sendMail() {
        if($_POST["send"]){
            $to =  esc_attr($_POST["name"]);
            $subject =  esc_attr($_POST["subject"]);
            $message = esc_attr($_POST["message"]);
            $headers = esc_attr($_POST["email"]);
            wp_mail($to, $subject, $message, $headers);
            echo "<script> alert('email is sent!');</script>";
        }
        else{
            echo "<script> alert('something wrong!');</script>";
        }
}

function custom_mail_settings_page() {

    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient pilchards to access this page.')    );
	}

	?>
	<div class="wrap">
	<h2>Custom Mail Settings</h2>

	<form method="post" action="">
		<?php settings_fields( 'custom-mail-settings-group-15167' ); ?>
		<?php do_settings_sections( 'custom-mail-settings-group-15167' ); ?>
		<table class="form-table" style="width: 50%">
			<tr valign="top">
				<th scope="row">To</th>
				<td>
					<input style="width: 100%" type="text" name="custom_mail_to" value="<?php echo esc_attr( get_option('custom_mail_to') ); ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">From</th>
				<td>
					<input style="width: 100%" type="text" name="custom_mail_from" value="<?php echo esc_attr( get_option('custom_mail_from') ); ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">Subject</th>
				<td>
					<input style="width: 100%" type="text" name="custom_mail_sub" value="<?php echo esc_attr( get_option('custom_mail_sub') ); ?>" />
				</td>
			</tr>
			<tr valign="top">
			<th scope="row">Message</th>
				<!-- <td><input type="text" name="custom_mail_message" value="?php echo esc_attr( get_option('custom_mail_message') ); ?>" /></td> /-->
			<td>
				<textarea style="text-align: left;" name="custom_mail_message" rows="10" cols="62"><?php echo esc_attr( get_option('custom_mail_message') ); ?></textarea>
			</td>
			</tr>
			<tr>
				<td></td>
				<td><?php submit_button('Save'); ?><td><?php submit_button('Send', 'primary', 'send'); ?></td></td>

			</tr>
		</table>
	  </form>
	</div>
	<?php
} 
