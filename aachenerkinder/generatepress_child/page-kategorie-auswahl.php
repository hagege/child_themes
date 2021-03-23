<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
            
			if ( generate_has_default_loop() ) {
				while ( have_posts() ) :

					the_post();

					generate_do_template_part( 'page' );
                    
				endwhile;
			}
            /* START: Teil mit den eigenen Inhalten: */
            $url_ordner = "https://aachenerkinder.de/veranstaltungen/kategorie/";
            $kategorienlink = array(
              array("Aktuell", $url_ordner . "aktuell/", "Aktuelle Veranstaltungen (meist relativ kurzfristig im Kalender)"),
              array("Baby", $url_ordner . "baby/", "Alle Veranstaltungen, die für Babys geeignet sind"),
              array("Bildung", $url_ordner . "bildung/","Veranstaltungen zur Bildung"),
              array("Caritative Kinderläden", $url_ordner . "caritative-kinderlaeden/","Veranstaltungen der caritativen Kinderläden"),
              array("Diverses", $url_ordner . "diverses/","Veranstaltungen, die sonst in keine Kategorie passen"),
              array("Eltern-Lehrer-Erzieher", $url_ordner . "eltern-lehrer-erzieher/","Veranstaltungen, die speziell für Eltern, Lehrer und/oder Erzieher vorgesehen sind"),
              array("Eltern und Kind", $url_ordner . "eltern-und-kind/","Veranstaltungen für Eltern mit ihren Kindern"),
              array("Familie", $url_ordner . "familie/","Veranstaltungen für die ganze Familie"),
              array("Feiern und Feste", $url_ordner . "feiern-und-feste","Veranstaltungen zu Feiern und Festen"),
              array("Ferien", $url_ordner . "ferien/","Ferienveranstaltungen"),
              array("Flohmarkt", $url_ordner . "flohmarkt/","Flohmarktveranstaltungen"),
              array("Jugendliche", $url_ordner . "jugendliche/","Veranstaltungen für Jugendliche"),
              array("Kinder bis 6", $url_ordner . "kinder-bis-6/","Veranstaltungen für Kinder bis 6 Jahre (meistens ohne Eltern)"),
              array("Kinderbetreuung", $url_ordner . "kinderbetreuung/","Veranstaltungen zur Kinderbetreuung"),
              array("Kindertheater", $url_ordner . "kindertheater/","Veranstaltungen zu Kindertheater, oder Puppentheater"),
              array("Kochen und Backen", $url_ordner . "kochen-und-backen/","Veranstaltungen zum Kochen und/oder Backen für Kinder"),
              array("Kunst und Kultur", $url_ordner . "kunst-und-kultur/","Veranstaltungen zur Kunst oder Kultur"),
              array("Laufend", $url_ordner . "laufend/","Laufende Veranstaltungen (in der Regel Veranstaltungen, die über einen längeren Zeitraum laufen, z. B. auch mehrere Tage oder Wochen)"),
              array("Medien", $url_ordner . "medien/","Veranstaltungen zu verschiedenen Medien (Film, Computer, Foto)"),
              array("Musik", $url_ordner . "musik/","Musik - Veranstaltungen"),
              array("Natur", $url_ordner . "natur/","Veranstaltungen in der Natur"),
              array("Online", $url_ordner . "online/","Online-Veranstaltungen"),
              array("Programme", $url_ordner . "programme/","Veranstaltungsprogramme (Mehrere Veranstaltungen eines Veranstalters z. B. während des Monats"),
              array("Schulkinder", $url_ordner . "schulkinder/","Veranstaltungen für Schulkinder (in der Regel ohne Eltern)"),
              array("Spiele", $url_ordner . "spiele/","Veranstaltungen zu Spielen"),
              array("Ständig", $url_ordner . "staendig/","Ständige Veranstaltungen, die z. B. über einen längeren Zeitraum in der Woche immer zu einem bestimmten Zeitpunkt (z. B. montags um 16 bis 17 Uhr) stattfinden"),
              array("Werken", $url_ordner . "werken/","Veranstaltungen mit Bastelangeboten, etc."),
              array("XXL", $url_ordner . "xxl/","Besonders interessante Veranstaltungen"),
              array("XXL Mitglied", $url_ordner . "premium/","Besonders interessante Veranstaltungen von Veranstaltern, die Mitglied bei aachenerkinder.de sind"),
            );
            /* nach Zuweisung das Array nach Bezeichung sortieren*/
            /* ist bereits sortiert, daher nicht nötig */
            /* sort($kategorienlink); */

            /* Daten ausgeben */
            $anzahl_array = count ( $kategorienlink );
            ?>
            <div class="inside-article">
              <h4> <?php echo $anzahl_array; ?> Kategorien: </h4>
              <table class="ackids_tabelle"><tbody>
              <tr>
                <th>Kategorie</th>
                <th>Beschreibung</th>
              </tr>
              <?php
              for($v=0; $v < $anzahl_array; $v++) {
              ?>
                <tr><td>
                <a href=<?php echo $kategorienlink[$v][1];?> rel="noopener"><?php echo $kategorienlink[$v][0];?></a><br>
                </td><td>
                <?php echo $kategorienlink[$v][2];?>
                </td></tr>
              <?php
              }
              ?>
              </tbody></table>
            </div>
            <br><br>
            <!--
            <a href=<?php echo $kategorienlink[1][1];?> target="_blank" rel="noopener"><?php echo $kategorienlink[1][0];?></a><br>
            <a href=<?php echo $kategorienlink[2][1];?> target="_blank" rel="noopener"><?php echo $kategorienlink[2][0];?></a><br>
            /* ENDE: Teil mit den eigenen Inhalten: */
            -->
            <?php
			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
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
