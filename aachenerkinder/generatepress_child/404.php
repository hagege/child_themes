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
            $ueberschrift_404 = utf8_encode("Sorry - leider war der Beitrag oder die Veranstaltung schon sehr alt und wir haben den Eintrag daher gel�scht");
            $meldung_404 = utf8_encode("Im Interesse der Aktualit�t macht es bei manchen Beitr�gen oder Veranstaltungen wenig Sinn, diese Beitr�ge oder Veranstaltungen ewig \"mitzuschleppen\".
                      Daher bist du jetzt auf dieser Seite gelandet.
                      Allerdings kannst du �ber die Suche ja mal einen Begriff eingeben, der mit der Thematik der gel�schten Seite zu tun hatte.
                      M�glicherweise erh�ltst du dann Treffer zu aktuelleren Beitr�gen oder Veranstaltungen zu diesem Thema.");
            ?>
            <div class="inside-article">
                 <div class="entry-content">
  
                    <p align="left"><img class="size-medium wp-image-66574" src="https://aachenerkinder.de/wp-content/uploads/2019/01/platzhalter_404_cow-30710_640-min_weiss.jpg" align="right" alt="404" width="200" />
                       <h1><?php echo $ueberschrift_404 ?></h1> 
                       <?php echo $meldung_404 ?>
                       <br>
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
