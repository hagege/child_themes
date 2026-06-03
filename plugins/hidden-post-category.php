<?php
/**
 * Plugin Name: Hidden Post Category
 * Plugin URI: https://haurand.com
 * Description: Versteckt Posts ausgewählter Kategorien in Queries - nur via direktem Link sichtbar
 * Version: 1.0.0
 * Author: HGG
 * Author URI: https://haurand.com
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: hidden-post-category
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 *
 * @package HiddenPostCategory
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Konstanten
 */
define( 'HPC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'HPC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'HPC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'HPC_VERSION', '1.0.0' );

/**
 * Holt versteckte Kategorien aus Option mit statischem Cache
 *
 * @return array Array von Term IDs
 */
function hpc_get_hidden_categories() {
	static $hidden_ids = null;

	if ( $hidden_ids === null ) {
		$hidden_ids = get_option( 'hpc_hidden_categories', array() );

		// Fallback: Wenn keine Option gesetzt, "keine-anzeige" Kategorie suchen
		if ( empty( $hidden_ids ) ) {
			$cat = get_category_by_slug( 'keine-anzeige' );
			if ( $cat ) {
				$hidden_ids = array( $cat->term_id );
				update_option( 'hpc_hidden_categories', $hidden_ids );
			}
		}
	}

	return (array) $hidden_ids;
}

/**
 * Prüft ob Query gefiltert werden soll
 *
 * @param WP_Query $query Die Query
 * @return bool
 */
function hpc_should_filter_query( $query ) {
	// Nicht im Admin
	if ( is_admin() ) {
		return false;
	}

	// Nur Hauptquery
	if ( ! $query->is_main_query() ) {
		return false;
	}

	// Bei Single Posts: NICHT filtern (direkter Link erlaubt)
	if ( is_singular( 'post' ) || is_page() ) {
		return false;
	}

	// Bei Archives, Search, Home: FILTERN
	return is_archive() || is_search() || is_home();
}

/**
 * Filter 1: Allgemeine Queries (Pre Get Posts)
 */
add_action( 'pre_get_posts', function( $query ) {
	if ( ! hpc_should_filter_query( $query ) ) {
		return;
	}

	$hidden_ids = hpc_get_hidden_categories();
	if ( empty( $hidden_ids ) ) {
		return;
	}

	$tax_query = (array) $query->get( 'tax_query' );
	$tax_query[] = array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => $hidden_ids,
		'operator' => 'NOT IN',
	);

	$query->set( 'tax_query', $tax_query );
} );

/**
 * Filter 2: Query Loop Blocks
 */
add_filter( 'query_loop_block_query_vars', function( $query_vars, $block ) {
	// Bei Single Posts nicht filtern
	if ( is_singular( 'post' ) ) {
		return $query_vars;
	}

	$hidden_ids = hpc_get_hidden_categories();
	if ( empty( $hidden_ids ) ) {
		return $query_vars;
	}

	$tax_query = isset( $query_vars['tax_query'] ) ? (array) $query_vars['tax_query'] : array();
	$tax_query[] = array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => $hidden_ids,
		'operator' => 'NOT IN',
	);

	$query_vars['tax_query'] = $tax_query;
	return $query_vars;
}, 10, 2 );

/**
 * Filter 3: REST API
 */
add_filter( 'rest_post_query', function( $args, $request ) {
	if ( is_admin() ) {
		return $args;
	}

	$hidden_ids = hpc_get_hidden_categories();
	if ( empty( $hidden_ids ) ) {
		return $args;
	}

	// Check ob einzelner Post abgerufen wird
	$post_id = (int) $request->get_param( 'p' );
	if ( $post_id > 0 ) {
		return $args; // Einzelner Post: erlauben
	}

	$tax_query = isset( $args['tax_query'] ) ? (array) $args['tax_query'] : array();
	$tax_query[] = array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => $hidden_ids,
		'operator' => 'NOT IN',
	);

	$args['tax_query'] = $tax_query;
	return $args;
}, 10, 2 );

/**
 * Admin-Menü registrieren
 */
add_action( 'admin_menu', function() {
	add_options_page(
		__( 'Versteckte Kategorien', 'hidden-post-category' ),
		__( 'Versteckte Kategorien', 'hidden-post-category' ),
		'manage_options',
		'hidden-post-category',
		'hpc_render_settings_page'
	);
} );

/**
 * Settings-Seite rendern
 */
function hpc_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Speichern bei POST
	if ( isset( $_POST['hpc_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['hpc_nonce'] ) ), 'hpc_save_settings' ) ) {
		$hidden_categories = isset( $_POST['hpc_hidden_categories'] ) ? array_map( 'intval', (array) $_POST['hpc_hidden_categories'] ) : array();
		update_option( 'hpc_hidden_categories', $hidden_categories );

		// Cache invalidieren
		wp_cache_delete( 'hpc_hidden_categories' );

		echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Einstellungen gespeichert!', 'hidden-post-category' ) . '</p></div>';
	}

	$hidden_ids    = get_option( 'hpc_hidden_categories', array() );
	$all_categories = get_categories( array( 'hide_empty' => false ) );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Versteckte Post-Kategorien', 'hidden-post-category' ); ?></h1>
		<p><?php esc_html_e( 'Wählen Sie Kategorien aus, deren Posts in Queries und Archiven versteckt werden sollen. Sie sind nur via direktem Link sichtbar.', 'hidden-post-category' ); ?></p>

		<form method="post" action="">
			<?php wp_nonce_field( 'hpc_save_settings', 'hpc_nonce' ); ?>

			<table class="form-table">
				<tr>
					<th scope="row"><?php esc_html_e( 'Kategorien auswählen', 'hidden-post-category' ); ?></th>
					<td>
						<?php if ( ! empty( $all_categories ) ) : ?>
							<fieldset>
								<legend class="screen-reader-text">
									<?php esc_html_e( 'Versteckte Kategorien', 'hidden-post-category' ); ?>
								</legend>
								<?php foreach ( $all_categories as $category ) : ?>
									<label>
										<input 
											type="checkbox" 
											name="hpc_hidden_categories[]" 
											value="<?php echo intval( $category->term_id ); ?>"
											<?php checked( in_array( $category->term_id, $hidden_ids, true ) ); ?>
										/>
										<?php echo esc_html( $category->name ); ?>
										<?php if ( $category->description ) : ?>
											<small>(<?php echo esc_html( $category->description ); ?>)</small>
										<?php endif; ?>
									</label>
									<br />
								<?php endforeach; ?>
							</fieldset>
						<?php else : ?>
							<p><?php esc_html_e( 'Keine Kategorien verfügbar.', 'hidden-post-category' ); ?></p>
						<?php endif; ?>
					</td>
				</tr>

				<tr>
					<th scope="row"><?php esc_html_e( 'Info', 'hidden-post-category' ); ?></th>
					<td>
						<ul style="list-style-type: disc; margin-left: 20px;">
							<li><?php esc_html_e( 'Posts werden in Archiven und Suchergebnissen nicht angezeigt', 'hidden-post-category' ); ?></li>
							<li><?php esc_html_e( 'Posts sind sichtbar, wenn Sie direkt aufgerufen werden', 'hidden-post-category' ); ?></li>
							<li><?php esc_html_e( 'Gilt für Query Loops, REST API und normale Queries', 'hidden-post-category' ); ?></li>
						</ul>
					</td>
				</tr>
			</table>

			<?php submit_button( __( 'Einstellungen speichern', 'hidden-post-category' ) ); ?>
		</form>
	</div>
	<?php
}

/**
 * Plugin aktivieren
 */
register_activation_hook( __FILE__, function() {
	// Sicherstellen, dass die Option existiert
	if ( ! get_option( 'hpc_hidden_categories' ) ) {
		$cat = get_category_by_slug( 'keine-anzeige' );
		if ( $cat ) {
			update_option( 'hpc_hidden_categories', array( $cat->term_id ) );
		}
	}
} );

/**
 * Plugin deaktivieren
 */
register_deactivation_hook( __FILE__, function() {
	// Optional: Cache leeren
	wp_cache_flush();
} );

/**
 * Translations laden
 */
add_action( 'plugins_loaded', function() {
	load_plugin_textdomain( 'hidden-post-category', false, dirname( HPC_PLUGIN_BASENAME ) . '/languages' );
} );
