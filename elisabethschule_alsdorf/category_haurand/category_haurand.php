<?php
/**
 * @package Category Vorlagen Haurand
 * @version 0.4
 */
/*
Plugin Name: Category Vorlagen Haurand
Plugin URI: http://haurand.com
Description: Create a new Category "Haurand" as "Vorlagen Haurand" for Block Patterns with my own custom Block patterns
Author: Hans-Gerd Gerhards
Version: 0.4
Author URI: http://haurand.com
*/

/*----------------------------------------------------------------*/
/* Start: Block Patterns von haurand.com "Vorlagen Haurand"
/* Datum: 31.10.2022
/* Autor: hgg
/*----------------------------------------------------------------*/

/* ------------------------------ */
/* eigene Kategorie               */
/* ------------------------------ */
if ( function_exists( 'register_block_pattern_category' ) ) {
    register_block_pattern_category(
      'haurand',
      array( 'label' => __( 'Forms', 'text-domain' ) )
   );
  }
  
  
  add_action('init', function() {
      remove_theme_support('core-block-patterns');
  });
  
 function prefix_unregister_category() {
    unregister_block_pattern_category( 'buttons');
    unregister_block_pattern_category( 'header');
    unregister_block_pattern_category( 'text');
    unregister_block_pattern_category( 'columns');
    unregister_block_pattern_category( 'gallery');
    unregister_block_pattern_category( 'query');
  }
  add_action( 'init', 'prefix_unregister_category' );
 
  
  function haurand_register_block_categories() {
    if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
    register_block_pattern_category(
     'Haurand',
     array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category', 'Haurand' ) )
     );
    }
   }
   add_action( 'init', 'haurand_register_block_categories' );
   
   
/* ---------------------------------- */
/* Eigener Button  */
/* ---------------------------------- */
register_block_pattern(
  'eigener_button',
    array(
    'title' => __( 'Eigener Button', 'eigener_button' ),
    'description' => _x( 'Eigener Button', 'Eigener Button', 'eigener_button' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<div class="wp-block-group"><!-- wp:generateblocks/button-container {"uniqueId":"7efb7c11","alignment":"center","isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/button {"uniqueId":"8f712787","hasUrl":false,"backgroundColor":"var(\u002d\u002dglobal-color-10)","backgroundColorHover":"var(\u002d\u002dglobal-color-11)","textColor":"#ffffff","textColorHover":"var(\u002d\u002daccent-semi-transparent)","borderColor":"","borderColorHover":"","paddingTop":"15","paddingRight":"20","paddingBottom":"15","paddingLeft":"20","blockVersion":2} -->
		<span class="gb-button gb-button-8f712787 gb-button-text"><strong>hier ist der Link</strong></span>
		<!-- /wp:generateblocks/button -->
		<!-- /wp:generateblocks/button-container -->

		<!-- wp:spacer {"height":"50px"} -->
		<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer --></div>
		<!-- /wp:group -->',
        )
);


/* ---------------------------------- */
/* H2 Petrol mit Icon  */
/* ---------------------------------- */
register_block_pattern(
  'H2_Petrol_mit_Icon',
    array(
    'title' => __( 'H2 Petrol mit Icon', 'H2_Petrol_mit_Icon' ),
    'description' => _x( 'H2 Petrol mit Icon', 'H2 Petrol mit Icon', 'H2_Petrol_mit_Icon' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:generateblocks/headline {"uniqueId":"f55e21fc","alignment":"center","marginBottom":"60","hasIcon":true,"iconColor":"var(\u002d\u002dglobal-color-10)","iconLocation":"above","iconPaddingRight":"","iconPaddingBottom":"0.4","iconSize":40,"iconSizeUnit":"px"} -->
		<h2 class="gb-headline gb-headline-f55e21fc"><span class="gb-icon"><svg viewBox="0 0 17 21.001" xmlns=""><path d="M15.5 21c-.307 0-.612-.094-.872-.279L8.5 16.344l-6.128 4.377A1.499 1.499 0 010 19.5v-16C0 1.57 1.57 0 3.5 0h10C15.43 0 17 1.57 17 3.5v16a1.502 1.502 0 01-1.5 1.5zm-7-8a1.5 1.5 0 01.872.279L14 16.585V3.5a.5.5 0 00-.5-.5h-10a.5.5 0 00-.5.5v13.085l4.628-3.306A1.5 1.5 0 018.5 13z"></path></svg></span><span class="gb-headline-text"><strong>Soziale Arbeit an Schulen und Schulsozialarbeit</strong></span></h2>
		<!-- /wp:generateblocks/headline -->',
        )
);


/* ---------------------------------- */
/* H2 Petrol */
/* ---------------------------------- */
register_block_pattern(
  'H2_Petrol',
    array(
    'title' => __( 'H2 Petrol', 'H2_Petrol' ),
    'description' => _x( 'H2 Petrol', 'H2 Petrol', 'H2_Petrol' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:generateblocks/headline {"uniqueId":"da450a80","alignment":"left","textColor":"","borderColor":"var(\u002d\u002dglobal-color-10)","highlightTextColor":"","paddingLeft":"20","borderSizeLeft":"6","iconColor":"var(\u002d\u002dglobal-color-10)","iconSize":34,"iconSizeUnit":"px"} -->
		<h2 class="gb-headline gb-headline-da450a80 gb-headline-text">The History of Donate</h2>
		<!-- /wp:generateblocks/headline -->',
        )
);


/* ---------------------------------- */
/* Liste Petrol */
/* ---------------------------------- */
register_block_pattern(
  'Liste_Petrol',
    array(
    'title' => __( 'Liste Petrol', 'Liste_Petrol' ),
    'description' => _x( 'Liste_Petrol', 'Liste Petrol', 'H2_Petrol' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:list {"className":"liste_gruener_punkt"} -->
		<ul class="liste_gruener_punkt">
		<li>Ist ein Kind erkrankt muss es von den Eltern/Erziehungsberechtigten zwischen 7 Uhr und 7:50 Uhr in der Schule telefonisch entschuldigt werden. In dieser Zeit ist die Schule immer telefonisch erreichbar. Die Erziehungsberechtigten teilen in der telefonischen Nachricht mit, wie lange der Schüler voraussichtlich fehlen wird. Eine mündliche Entschuldigung über Geschwisterkinder, Freunde und Bekannte ist nicht zulässig, die Abgabe einer von Ihnen erstellten schriftlichen Entschuldigung über diese Personen schon.</li>
		</ul>
		<!-- /wp:list -->',
        )
);



/* ---------------------------------- */
/* Text mit Überschrift H2 und 2 Bildern */
/* ---------------------------------- */
register_block_pattern(
  'text_mit_ueberschrift_h2_und_2_bildern',
    array(
    'title' => __( 'Text mit Überschrift H2 und 2 Bildern', 'text_mit_ueberschrift_h2_und_2_bildern' ),
    'description' => _x( 'Text mit Überschrift H2 und 2 Bildern', 'Text mit Überschrift H2 und 2 Bildern', 'text_mit_ueberschrift_h2_und_2_bildern' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group -->
		<div class="wp-block-group"><!-- wp:generateblocks/headline {"uniqueId":"357cc05f","alignment":"left","textColor":"","borderColor":"var(\u002d\u002dglobal-color-10)","highlightTextColor":"","paddingLeft":"20","borderSizeLeft":"6","iconColor":"var(\u002d\u002dglobal-color-10)","iconSize":34,"iconSizeUnit":"px"} -->
		<h2 class="gb-headline gb-headline-357cc05f gb-headline-text">Schulsozialarbeit</h2>
		<!-- /wp:generateblocks/headline -->

		<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"align":"center","id":4718,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image aligncenter size-full"><img src="https://elisabethschule-alsdorf.de/wp-content/uploads/2022/09/Krankmeldung.jpg" alt="" class="wp-image-4718"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"align":"center","id":4718,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image aligncenter size-full"><img src="https://elisabethschule-alsdorf.de/wp-content/uploads/2022/09/Krankmeldung.jpg" alt="" class="wp-image-4718"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);


/* ---------------------------------- */
/* Text mit Überschrift H2 und Bild 2-spaltig */
/* ---------------------------------- */
register_block_pattern(
  'text_mit_ueberschrift_h2_und_bild_2_spaltig',
    array(
    'title' => __( 'Text mit Überschrift H2 und Bild 2-spaltig', 'text_mit_ueberschrift_h2_und_bild_2_spaltig' ),
    'description' => _x( 'Text mit Überschrift H2 und Bild 2-spaltig', 'Text mit Überschrift H2 und Bild 2-spaltig', 'text_mit_ueberschrift_h2_und_bild_2_spaltig' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group -->
		<div class="wp-block-group"><!-- wp:generateblocks/headline {"uniqueId":"2e0f032a","alignment":"left","textColor":"","borderColor":"var(\u002d\u002dglobal-color-10)","highlightTextColor":"","paddingLeft":"20","borderSizeLeft":"6","iconColor":"var(\u002d\u002dglobal-color-10)","iconSize":34,"iconSizeUnit":"px"} -->
		<h2 class="gb-headline gb-headline-2e0f032a gb-headline-text">Schulsozialarbeit</h2>
		<!-- /wp:generateblocks/headline -->

		<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Suscipit taciti primis tempor sagittis euismod libero facilisi aptent elementum felis blandit cursus gravida sociis eleifend lectus nullam dapibus netus feugiat curae curabitur. Curae fringilla porttitor quam sollicitudin iaculis aptent leo ligula euismod dictumst penatibus.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Mauris eros etiam praesent volutpat posuere. Metus fringilla ullamcorper odio aliquam lacinia conubia mauris tempor etiam ultricies proin quisque lectus sociis tristique integer phasellus inceptos taciti pretium adipiscing praesent lobortis morbi cras magna vivamus per risus fermentum tortor sagittis ligula.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"align":"center","id":4718,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image aligncenter size-full"><img src="https://elisabethschule-alsdorf.de/wp-content/uploads/2022/09/Krankmeldung.jpg" alt="" class="wp-image-4718"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);


/* ---------------------------------- */
/* Überschrift H2 mit Text */
/* ---------------------------------- */
register_block_pattern(
  'ueberschrift_h2_mit_text',
    array(
    'title' => __( 'Überschrift H2 mit Text', 'ueberschrift_h2_mit_text' ),
    'description' => _x( 'Überschrift H2 mit Text', 'Überschrift H2 mit Text', 'ueberschrift_h2_mit_text' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group -->
		<div class="wp-block-group"><!-- wp:generateblocks/headline {"uniqueId":"dcce5854","alignment":"left","textColor":"","borderColor":"var(\u002d\u002dglobal-color-10)","highlightTextColor":"","paddingLeft":"20","borderSizeLeft":"6","iconColor":"var(\u002d\u002dglobal-color-10)","iconSize":34,"iconSizeUnit":"px"} -->
		<h2 class="gb-headline gb-headline-dcce5854 gb-headline-text">Was ist zu tun, wenn mein Kind krank ist</h2>
		<!-- /wp:generateblocks/headline -->

		<!-- wp:list {"className":"liste_gruener_punkt"} -->
		<ul class="liste_gruener_punkt"><li>Ist ein Kind erkrankt muss es von den Eltern/Erziehungsberechtigten zwischen 7 Uhr und 7:50 Uhr in der Schule telefonisch entschuldigt werden. In dieser Zeit ist die Schule immer telefonisch erreichbar. Die Erziehungsberechtigten teilen in der telefonischen Nachricht mit, wie lange der Schüler voraussichtlich fehlen wird. Eine mündliche Entschuldigung über Geschwisterkinder, Freunde und Bekannte ist nicht zulässig, die Abgabe einer von Ihnen erstellten schriftlichen Entschuldigung über diese Personen schon.</li><li>Der Schüler wird bei bis zu 2 Fehltagen durch einen Erziehungsberechtigten zusätzlich zur telefonischen Mitteilung (nachträglich) durch eine schriftliche Notiz entschuldigt.</li><li>Ab dem 3. Krankheitstag muss das Fehlen des Schülers in der Schule ärztlich attestiert werden.</li><li>Die schriftliche Entschuldigung der Erziehungsberechtigten oder die ärztliche Bescheinigung ist umgehend, d.h. am Tag der Rückkehr des Schülers beim Klassenlehrer abzugeben.</li></ul>
		<!-- /wp:list --></div>
		<!-- /wp:group -->',
        )
);



/* ---------------------------------- */
/* Zwei Spalten mit Texten und H2 */
/* ---------------------------------- */
register_block_pattern(
  'zwei_spalten_mit_texten_und_h2',
    array(
    'title' => __( 'Zwei Spalten mit Texten und H2', 'zwei_spalten_mit_texten_und_h2' ),
    'description' => _x( 'Zwei Spalten mit Texten und H2', 'Zwei Spalten mit Texten und H2', 'zwei_spalten_mit_texten_und_h2' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group -->
		<div class="wp-block-group"><!-- wp:generateblocks/headline {"uniqueId":"54b86bd7","alignment":"left","textColor":"","borderColor":"var(\u002d\u002dglobal-color-10)","highlightTextColor":"","paddingLeft":"20","borderSizeLeft":"6","iconColor":"var(\u002d\u002dglobal-color-10)","iconSize":34,"iconSizeUnit":"px"} -->
		<h2 class="gb-headline gb-headline-54b86bd7 gb-headline-text">Schulsozialarbeit</h2>
		<!-- /wp:generateblocks/headline -->

		<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Suscipit taciti primis tempor sagittis euismod libero facilisi aptent elementum felis blandit cursus gravida sociis eleifend lectus nullam dapibus netus feugiat curae curabitur. Curae fringilla porttitor quam sollicitudin iaculis aptent leo ligula euismod dictumst penatibus.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Mauris eros etiam praesent volutpat posuere. Metus fringilla ullamcorper odio aliquam lacinia conubia mauris tempor etiam ultricies proin quisque lectus sociis tristique integer phasellus inceptos taciti pretium adipiscing praesent lobortis morbi cras magna vivamus per risus fermentum tortor sagittis ligula.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:paragraph -->
		<p>Suscipit taciti primis tempor sagittis euismod libero facilisi aptent elementum felis blandit cursus gravida sociis eleifend lectus nullam dapibus netus feugiat curae curabitur. Curae fringilla porttitor quam sollicitudin iaculis aptent leo ligula euismod dictumst penatibus.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Mauris eros etiam praesent volutpat posuere. Metus fringilla ullamcorper odio aliquam lacinia conubia mauris tempor etiam ultricies proin quisque lectus sociis tristique integer phasellus inceptos taciti pretium adipiscing praesent lobortis morbi cras magna vivamus per risus fermentum tortor sagittis ligula.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);
  