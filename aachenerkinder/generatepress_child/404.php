<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
		<main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );
            ?>
            <div class="inside-article">
                 <div class="entry-content">
  
                    <p align="left"><img class="size-medium wp-image-66574" src="https://aachenerkinder.de/wp-content/uploads/2019/01/platzhalter_404_cow-30710_640-min_weiss.jpg" align="right" alt="404" width="200" />
                       <h2>Au weia - leider war der Beitrag oder die Veranstaltung evtl. schon sehr alt und wir haben den Eintrag daher möglicherweise gelöscht</h2> 
                       <p>Im Interesse der Aktualität macht es bei manchen Beiträgen oder Veranstaltungen wenig Sinn, diese Beiträge oder Veranstaltungen ewig "mitzuschleppen".<br>
                          Daher bist du jetzt auf dieser Seite gelandet.<br>
						  Allerdings kannst du über die Suche ja mal einen Begriff eingeben, der mit der gewünschten Thematik zu tun hat.<br>
                          Möglicherweise erhältst du dann Treffer zu aktuelleren Beiträgen oder Veranstaltungen zu diesem Thema.</p>
                       <em>Grafik: pixabay.com </em>
                    </p>
                 </div>
                <?php get_search_form() ?>
            </div>
		</main>
	</div>

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

	get_footer();
