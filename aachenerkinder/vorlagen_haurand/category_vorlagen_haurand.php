<?php
/**
 * @package Category Vorlagen Haurand
 * @version 0.2
 */
/*
Plugin Name: Category Vorlagen Haurand
Plugin URI: http://haurand.com
Description: Create a new Category "Haurand" as "Vorlagen Haurand" for Block Patterns with my own custom Block patterns
Author: Hans-Gerd Gerhards
Version: 0.2
Author URI: http://haurand.com
*/

/*----------------------------------------------------------------*/
/* Start: Block Patterns von haurand.com "Vorlagen Haurand"
/* Datum: 26.11.2022
/* Autor: hgg
/*----------------------------------------------------------------*/

/* Allows a theme to de-register its support of a certain feature  
  add_action('init', function() {
      remove_theme_support('core-block-patterns');
  });
 
*/
  
/* Unregisters a pattern category  */
 function prefix_unregister_category() {
    unregister_block_pattern_category( 'buttons');
    unregister_block_pattern_category( 'header');
	unregister_block_pattern_category( 'hero');
    unregister_block_pattern_category( 'text');
    unregister_block_pattern_category( 'columns');
    unregister_block_pattern_category( 'gallery');
  }
  add_action( 'init', 'prefix_unregister_category' );
 


/* eigene Kategorie Haurand              */
function haurand_register_block_categories() {
if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
	register_block_pattern_category(
	 'Haurand',
	 array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category' ) )
    );
  }
}
add_action( 'init', 'haurand_register_block_categories' );
   
   

/* Block mit Neuigkeiten  */
register_block_pattern(
  'neuigkeiten',
    array(
    'title' => __( 'neuigkeiten', 'neuigkeiten' ),
    'description' => _x( 'Eine h2-Überschrift mit oranger Linie als Border-Bottom, eine h3-Überschrift und ein Text ', 'Ein Block Pattern mit Neuigkeiten', 'neuigkeiten' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"className":"neuigkeiten","layout":{"type":"constrained"}} -->
	   <div class="wp-block-group neuigkeiten"><!-- wp:heading {"style":{"color":{"background":"#fbf9eb"}},"className":"neuigkeiten"} -->
	   <h2 class="neuigkeiten has-background" style="background-color:#fbf9eb">Letzte Neuigkeiten</h2>
	   <!-- /wp:heading -->
	   
	   <!-- wp:heading {"level":3,"style":{"color":{"background":"#fbf9eb"}},"className":"neuigkeiten"} -->
	   <h3 class="neuigkeiten has-background" style="background-color:#fbf9eb">Vennbahnweg: Die Bauarbeiten werden am 23. Dezember abgeschlossen</h3>
	   <!-- /wp:heading -->
	   
	   <!-- wp:paragraph {"style":{"color":{"background":"#fbf9eb"}},"className":"neuigkeiten"} -->
	   <p class="neuigkeiten has-background" style="background-color:#fbf9eb"><strong>23.12.2022: </strong>Der Vennbahnweg ist auf auf einem rund 450 Meter langen Teilstück zwischen der Philipsstraße und einer kleinen Zufahrt am Eisenbahnweg verbreitert worden. Die Bauarbeiten können am 23. Dezember abgeschlossen werden, der Fuß- und Radweg wird dann wieder auf ganzer Strecke befahrbar sein. Begonnen hatten die Bauarbeiten Anfang November dieses Jahres. Der Frost der vorigen Woche hatte die Asphaltierungsarbeiten und damit den Abschluss der Bauarbeiten um etwa eine Woche verzögert.<br>Das ausgebaute Teilstück ist auf eine Breite von durchgängig 3,50 Meter ausgebaut worden und hat eine ganz neue Asphaltdecke erhalten. Zudem sind 30 neue Bäume zu beiden Seiten des Vennbahnwegs gepflanzt worden.<br>Die Gesamtkosten des Ausbaus und der Baumpflanzungen belaufen sich auf rund 320.000 Euro. Die Kosten der Maßnahme werden zu 80 Prozent gefördert.</p>
	   <!-- /wp:paragraph --></div>
	   <!-- /wp:group -->',
        )
);

