<?php
/**
 * Shrinked Logo Sticky Header
 *
 * @package       SHRINKEDLO
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.3
 *
 * @wordpress-plugin
 * Plugin Name:   Shrinked Logo Sticky Header
 * Plugin URI:    https://haurand.com
 * Description:   Adds a sticky header with animated logo shrink effect.
 * Version:       0.3
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   shrinked-logo-sticky-header
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Shrinked Logo Sticky Header. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.

function slsh_sticky_header() {
    ?>
    <style>
		/* Sticky Header */
		header.wp-block-template-part {
			position: sticky;
			top: 0;
			z-index: 1000;
			background: rgba(255,255,255,0.95);
			transition: height 0.4s cubic-bezier(.4,0,.2,1), background-color 0.4s;
			height: 120px;
		}
		
		header.wp-block-template-part.shrink {
			height: 90px;
		}

		/* Optional: Wenn du eine innere Gruppe hast, diese auch animieren */
		header.wp-block-template-part .wp-block-group {
			transition: height 0.4s cubic-bezier(.4,0,.2,1), padding 0.4s cubic-bezier(.4,0,.2,1);
			height: 100%;
		}
		
		/* Logo-Animation */
		header.wp-block-template-part .wp-block-site-logo img {
			transition: transform 1s cubic-bezier(.4,0,.2,1);
			transform: scale(1);
		}
			
		header.wp-block-template-part.shrink .wp-block-site-logo img {
			transition: transform 1s cubic-bezier(.4,0,.2,1);
			transform: scale(0.6);
		}

	</style>

    <script>
		document.addEventListener('DOMContentLoaded', function() {
			const header = document.querySelector('header.wp-block-template-part');
			let ticking = false;

			function updateHeader() {
				if (window.scrollY > 100) {
					header.classList.add('shrink');
				} else {
					header.classList.remove('shrink');
				}
				ticking = false;
			}

			window.addEventListener('scroll', function() {
				if (!ticking) {
					window.requestAnimationFrame(updateHeader);
					ticking = true;
				}
			});
		});
    </script>
    <?php
}
add_action('wp_head', 'slsh_sticky_header');
