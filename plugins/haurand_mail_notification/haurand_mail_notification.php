<?php
/*
Plugin Name: Haurand Mail Notification
Plugin URI: http://haurand.com
Description: Send Mail Notification to owner of a wordpress website
Version: 0.1
Author: Hans-Gerd Gerhards
Author URI: http://haurand.com
*/
function haurand_email_form_shortcode() {
    ob_start();
    
    if ( isset( $_POST['haurand-my-email-message'] ) && ! empty( $_POST['haurand-my-email-message'] ) ) {
        $message = sanitize_textarea_field( $_POST['haurand-my-email-message'] );
        $to = 'gerhards@haurand.com';
        $subject = 'Updates im Rahmen des Wartungsvertrags';

        $sent = wp_mail( $to, $subject, $message );

        if ( $sent ) {
            echo '<div class="haurand-my-email-success">Email sent successfully.</div>';
        } else {
            echo '<div class="haurand-my-email-error">Failed to send email.</div>';
        }
    }
    
    ?>
    <form id="haurand-email-form" method="post">
        <label for="haurand-my-email-message">Message:</label>
        <textarea name="haurand-my-email-message" id="haurand-my-email-message" rows="5" cols="30"></textarea>
        <button type="submit" id="haurand-my-email-button">Send Email</button>
    </form>
    <?php
    
    return ob_get_clean();
}
add_shortcode( 'haurand-email-form', 'haurand_email_form_shortcode' );