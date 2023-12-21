<?php
/**
 * Contact Form 7 Redirect
 *
 * @package       CONTACTFOR
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   Contact Form 7 Redirect
 * Plugin URI:    https://haurand.com
 * Description:   Redirect to a special page after sending a form from contact form 7
 * Version:       0.2
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   contact-form-7-redirect
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Contact Form 7 Redirect. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.
// Javascript fuer CF7 im Footer der Webseite
function cf7_footer_script(){ ?>
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
	 if ( '8374ebc' == event.detail.contactFormId ) {
        location = 'https://test3.haurand.com/antwort-krankmeldung/';
     }
}, false );
</script>
<?php }
add_action('wp_footer', 'cf7_footer_script');
