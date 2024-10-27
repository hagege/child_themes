<?php
/**
 * haurand-category-list
 *
 * @package       HAURANDCA
 * @author        Hans-Gerd Gerhards
 * @license       gplv2
 * @version       0.1
 *
 * @wordpress-plugin
 * Plugin Name:   haurand-category-list
 * Plugin URI:    https://haurand.com
 * Description:   shows the number of entries in a category
 * Version:       0.1
 * Author:        Hans-Gerd Gerhards
 * Author URI:    https://haurand.com
 * Text Domain:   haurand-category-list
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with haurand-category-list. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.


/*----------------------------------------------------------------*/
/* Start: Shortcode für Kategorienliste - Aufruf mit [haurand_catelist]
/* nicht mehr benötigt
/* Datum: 21.1.2023
/* Autor: hgg
/*----------------------------------------------------------------*/
function haurand_createGridCategories() {
  $list = wp_list_categories( array(
      'taxonomy'   => 'category',
      'hide_empty' => 1,
      'echo'       => 0,
      'title_li'   => '',
      'show_count' => 1,
      'exclude'    => array( 1486 ),
      // 1486: Kategorie: Keine Anzeige
      // other args here
) );

  return "<h3>Beitrags-Kategorien</h3><ul>$list</ul>";
}
add_shortcode('haurand_catelist', 'haurand_createGridCategories');

/*----------------------------------------------------------------*/
/* Start: Shortcode für Kategorienliste - Aufruf mit [my_category_list]
/* Datum: 04.2.2023
/* Autor: hgg
/*----------------------------------------------------------------*/

function my_category_list_shortcode() {
  $args = array(
      'orderby' => 'name',
      'hide_empty' => 1
  );
  $my_categories = get_categories($args);
  $my_output = '<p><ul>';
  foreach($my_categories as $my_category) {
      $my_output .= '<li><a class="my_category_list" href="' . get_category_link($my_category->term_id) . '">' . $my_category->name . ' (' . $my_category->count . ')</a></li>' . '   ';
  // $my_output .= '<a class="my_category_list" href="' . get_category_link($my_category->term_id) . '">' . $my_category->name . '</a>' . '   ';
  }
  $my_output .= '</p></ul>';
  return $my_output;
}
add_shortcode('my_category_list', 'my_category_list_shortcode');
