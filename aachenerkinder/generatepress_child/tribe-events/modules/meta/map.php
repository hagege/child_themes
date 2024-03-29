<?php
/**
 * Single Event Meta (Map) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/map.php
 *
 * @package TribeEventsCalendar
 * @version 4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


$map = tribe_get_embedded_map();

if ( empty( $map ) ) {
	return;
}

?>

<div class="tribe-events-venue-map"> 
	<?php
	// Zeigt Openstreetmap:
  // zur Vermeidung von Fehlern auf der Website einfach die ID auf einen beliebigen Wert setzen
  $venue_id = get_the_ID();
  $address = tribe_get_address( $venue_id ).", ".tribe_get_zip( $venue_id )." ".tribe_get_city( $venue_id ).", ".tribe_get_country( $venue_id );
  $shortcode = '[leaflet-map zoomcontrol address="'.$address.'" zoom="14"]';
  /* $shortcode = '[leaflet-map zoomcontrol address="'.$address.'" zoom="16? fit_markers="1?]'; */
  $shortcode .= '[leaflet-marker address="'.$address.'"]';
  echo do_shortcode($shortcode); 
	do_action( 'tribe_events_single_meta_map_section_end' );
	?>
</div>
