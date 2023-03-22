<?php
/**
 * @package Haurand Patterns
 * @version 0.3.1
 */
/*
Plugin Name: Category Vorlagen Haurand
Plugin URI: http://haurand.com
Description: Create new Categories "Patterns Haurand" and "Custom Websites Haurand" for Block Patterns with our custom Block patterns
Author: Hans-Gerd Gerhards
Version: 0.2
Author URI: http://haurand.com
*/

/*----------------------------------------------------------------*/
/* Start: Block Patterns von haurand.com "Patterns Haurand"
/* Datum: 31.10.2022
/* Autor: hgg
/*----------------------------------------------------------------*/

/* Allows a theme to de-register its support of a certain feature */  
  add_action('init', function() {
      remove_theme_support('core-block-patterns');
  });
  
  
/* Unregisters a pattern category */  
 function prefix_unregister_category() {
    unregister_block_pattern_category( 'buttons');
    unregister_block_pattern_category( 'header');
    unregister_block_pattern_category( 'text');
    unregister_block_pattern_category( 'columns');
    unregister_block_pattern_category( 'gallery');
  }
  add_action( 'init', 'prefix_unregister_category' );
 
 

/* eigene Kategorie Haurand              */
function patterns_haurand_register_block_categories() {
if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
	register_block_pattern_category(
	 'Patterns Haurand', array( 'label' => _x( 'Patterns Haurand', 'Block pattern category' ) )
    );
  }
}
add_action( 'init', 'patterns_haurand_register_block_categories' );
   

/* eigene Kategorie Custom EKS Haurand */            
function custom_eks_haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
    register_block_pattern_category(
     'EKS Haurand', array( 'label' => _x( 'EKS Patterns Haurand', 'Block pattern category EKS' ) )
      );
    }
  }
  add_action( 'init', 'custom_eks_haurand_register_block_categories' );
 

/* eigene Kategorie Custom HA Haurand */            
function custom_ha_haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
    register_block_pattern_category(
     'HA Haurand', array( 'label' => _x( 'HA Patterns Haurand', 'Block pattern category HA' ) )
      );
    }
  }
  add_action( 'init', 'custom_ha_haurand_register_block_categories' );


/* Beispiel Spaltenblock mit Bild  */
register_block_pattern(
  'spaltenblock_mit_bild',
    array(
    'title' => __( 'Spaltenblock mit Bild', 'spaltenblock_mit_bild' ),
    'description' => _x( 'Spaltenblock mit Bild', 'Spaltenblock mit Bild', 'spaltenblock_mit_bild' ),
    'categories'  => array('Patterns Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","style":{"color":{"gradient":"linear-gradient(0deg,rgb(255,255,255) 48%,rgb(0,0,0) 48%)"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignfull has-background" style="background:linear-gradient(0deg,rgb(255,255,255) 48%,rgb(0,0,0) 48%)"><!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
        <div class="wp-block-columns alignwide" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:heading {"textColor":"luminous-vivid-amber"} -->
        <h2 class="has-luminous-vivid-amber-color has-text-color">Ein Text</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"style":{"color":{"text":"#e09f12"}}} -->
        <p class="has-text-color" style="color:#e09f12">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:spacer {"height":"200px"} -->
        <div style="height:200px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:image {"id":5723,"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"30px"}},"className":"is-style-rounded"} -->
        <figure class="wp-block-image size-large has-custom-border is-style-rounded"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021-1024x768.jpg" alt="" class="wp-image-5723" style="border-radius:30px"/></figure>
        <!-- /wp:image --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns --></div>
        <!-- /wp:group -->',
        )
);


/* Query Block mit Cover und enthaltenen Post excerpt, sowie categories und read more link */
register_block_pattern(
    'query_cover_text',
      array(
      'title' => __( 'Query mit Cover und Text', 'query_cover_text' ),
      'description' => _x( 'Query mit Cover und Text', 'Query mit Cover und Text', 'query_cover_text' ),
      'categories'  => array('Patterns Haurand'),
      'content'     =>
         '<!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"tagName":"main","displayLayout":{"type":"flex","columns":2},"align":"full","layout":{"inherit":false,"wideSize":"1800px","contentSize":"1800px","type":"constrained"}} -->
            <main class="wp-block-query alignfull"><!-- wp:post-template {"align":"wide"} -->
            <!-- wp:cover {"url":"https://test2.haurand.com/wp-content/uploads/2023/01/katzenkinder-1024x768.jpg","useFeaturedImage":true,"id":105,"dimRatio":20,"minHeight":100,"minHeightUnit":"vh","isDark":false} -->
            <div class="wp-block-cover is-light" style="min-height:100vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-20 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:post-date {"textColor":"white"} /-->

            <!-- wp:columns {"style":{"border":{"radius":"50px"}}} -->
            <div class="wp-block-columns" style="border-radius:50px"><!-- wp:column {"width":"33.33%","style":{"spacing":{"padding":{"top":"10px","right":"30px","bottom":"10px","left":"30px"}},"color":{"background":"#000000a1"}},"className":"linker_kasten","layout":{"contentSize":""}} -->
            <div class="wp-block-column linker_kasten has-background" style="background-color:#000000a1;padding-top:10px;padding-right:30px;padding-bottom:10px;padding-left:30px;flex-basis:33.33%"><!-- wp:post-title {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"luminous-vivid-orange","fontSize":"large"} /-->

            <!-- wp:post-excerpt {"textColor":"white"} /-->

            <!-- wp:read-more {"textColor":"white"} /--></div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"66.66%"} -->
            <div class="wp-block-column" style="flex-basis:66.66%"></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->

            <!-- wp:post-terms {"term":"category","style":{"color":{"background":"#26262633"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}}} /--></div></div>
            <!-- /wp:cover -->
            <!-- /wp:post-template -->

            <!-- wp:query-pagination {"paginationArrow":"arrow","align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
            <!-- wp:query-pagination-previous {"fontSize":"small"} /-->

            <!-- wp:query-pagination-numbers /-->

            <!-- wp:query-pagination-next {"fontSize":"small"} /-->
            <!-- /wp:query-pagination --></main>
            <!-- /wp:query -->',
            )
  );


/* Cover mit Text links */
register_block_pattern(
  'cover_text_left',
    array(
    'title' => __( 'Cover und Text links', 'cover_text_left' ),
    'description' => _x( 'Cover mit Text links', 'Cover mit Text links', 'cover_text_left' ),
    'categories'  => array('Patterns Haurand'),
    'content'     =>       
      ' <!-- wp:cover {"url":"https://test2.haurand.com/wp-content/uploads/2023/01/katzenkinder-1024x768.jpg","id":251,"dimRatio":10,"overlayColor":"primary","minHeight":200,"contentPosition":"center center","isDark":false,"align":"full","style":{"color":{},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}}} -->
        <div class="wp-block-cover alignfull is-light" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;min-height:200px"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-10 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-251" alt="" src="https://test2.haurand.com/wp-content/uploads/2023/01/katzenkinder-1024x768.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"inherit":true,"type":"constrained"}} -->
        <div class="wp-block-group"><!-- wp:columns {"align":"wide"} -->
        <div class="wp-block-columns alignwide"><!-- wp:column {"width":"50%","style":{"spacing":{"padding":{"top":"15%","right":"3rem","bottom":"15%","left":"3rem"}},"color":{"background":"#ffffff3d"}}} -->
        <div class="wp-block-column has-background" style="background-color:#ffffff3d;padding-top:15%;padding-right:3rem;padding-bottom:15%;padding-left:3rem;flex-basis:50%"><!-- wp:group {"align":"wide"} -->
        <div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"500","fontSize":"3rem"}},"className":"wp-block-heading","fontFamily":"system-font"} -->
        <h2 class="has-text-align-left wp-block-heading has-system-font-font-family" style="font-size:3rem;font-style:normal;font-weight:500">Welcome to <br>Builder Basics</h2>
        <!-- /wp:heading -->
        
        <!-- wp:paragraph {"fontSize":"medium"} -->
        <p class="has-medium-font-size">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at dictum mauris, cursus dapibus sapien. Nunc id felis sit amet lorem congue.</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons -->
        <div class="wp-block-buttons"><!-- wp:button {"textColor":"secondary","className":"is-style-outline"} -->
        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-secondary-color has-text-color wp-element-button">Start Exploring →</a></div>
        <!-- /wp:button --></div>
        <!-- /wp:buttons --></div>
        <!-- /wp:group --></div>
        <!-- /wp:column -->
        
        <!-- wp:column {"width":"50%"} -->
        <div class="wp-block-column" style="flex-basis:50%"></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns --></div>
        <!-- /wp:group --></div></div>
        <!-- /wp:cover -->',
        )
);


/* Image with duotone background */
register_block_pattern(
  'image_with_duotone_background',
    array(
    'title' => __( 'Image with duotone background', 'image_with_duotone_background' ),
    'description' => _x( 'Image with duotone background', 'Image with duotone background', 'image_with_duotone_background' ),
    'categories'  => array('Patterns Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"wide","style":{"color":{"gradient":"linear-gradient(180deg,rgb(0,0,0) 50%,rgb(255,255,255) 50%)"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignwide has-background" style="background:linear-gradient(180deg,rgb(0,0,0) 50%,rgb(255,255,255) 50%)"><!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group"><!-- wp:spacer {"height":"50px"} -->
        <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:image {"id":837,"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="https://test2.haurand.com/wp-content/uploads/2023/01/katzenkinder-1024x768.jpg" alt="" class="wp-image-837"/></figure>
        <!-- /wp:image -->

        <!-- wp:spacer {"height":"50px"} -->
        <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer --></div>
        <!-- /wp:group --></div>
        <!-- /wp:group -->',
        )
);

/* ---------------------------------- */
/* custom websites haurand */
/* ---------------------------------- */

/* EKS */

/* ---------------------------------- */
/* Eigener Button  */
/* ---------------------------------- */
register_block_pattern(
  'eigener_button',
    array(
    'title' => __( 'Eigener Button', 'eigener_button' ),
    'description' => _x( 'Eigener Button', 'Eigener Button', 'eigener_button' ),
    'categories'  => array('EKS Haurand'),
    'content'     =>
       '<!-- wp:group -->
       <div class="wp-block-group"><!-- wp:generateblocks/button-container {"uniqueId":"b6923a0f","alignment":"center","isDynamic":true,"blockVersion":2} -->
       <!-- wp:generateblocks/button {"uniqueId":"33d8e965","hasUrl":true,"backgroundColor":"var(\u002d\u002dglobal-color-10)","backgroundColorHover":"var(\u002d\u002dglobal-color-11)","textColor":"#ffffff","textColorHover":"var(\u002d\u002daccent-semi-transparent)","borderColor":"","borderColorHover":"","paddingTop":"15","paddingRight":"20","paddingBottom":"15","paddingLeft":"20","blockVersion":2} -->
       <a class="gb-button gb-button-33d8e965 gb-button-text" href="https://elisabethschule-alsdorf.de/wp-content/uploads/2022/09/Elternbroschuere_Leichte_Sprache_2019.pdf"><strong>Hier klicken</strong></a>
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
    'categories'  => array('EKS Haurand'),
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
    'categories'  => array('EKS Haurand'),
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
    'categories'  => array('EKS Haurand'),
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
    'categories'  => array('EKS Haurand'),
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
    'categories'  => array('EKS Haurand'),
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
    'categories'  => array('EKS Haurand'),
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
    'categories'  => array('EKS Haurand'),
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


/* HA Aachen */

/* Überschrift Text und Button  */
register_block_pattern(
  'ueberschrift_text_button',
    array(
    'title' => __( 'Überschrift Text und Button', 'ueberschrift_text_button' ),
    'description' => _x( 'Überschrift Text und Button', 'Überschrift Text und Button', 'ueberschrift_text_button' ),
    'categories'  => array('HA Haurand'),
    'content'     =>
       '<!-- wp:generateblocks/container {"uniqueId":"2de3d7d8","isDynamic":true,"blockVersion":2} -->
        <!-- wp:generateblocks/grid {"uniqueId":"23d7f96a","columns":4,"isDynamic":true,"blockVersion":2} -->
        <!-- wp:generateblocks/container {"uniqueId":"3d49d608","isGrid":true,"gridId":"23d7f96a","width":25,"widthMobile":100,"isDynamic":true,"blockVersion":2} -->
        <!-- wp:generateblocks/headline {"uniqueId":"5788d876","backgroundColor":"","textColor":"","linkColor":"","linkColorHover":"","borderColor":"var(\u002d\u002dglobal-color-15)","highlightTextColor":"","borderSizeBottom":"4","iconColor":""} -->
        <h2 class="gb-headline gb-headline-5788d876 gb-headline-text">Hausarztmedizin</h2>
        <!-- /wp:generateblocks/headline -->
        <!-- /wp:generateblocks/container -->

        <!-- wp:generateblocks/container {"uniqueId":"46e2e58f","isGrid":true,"gridId":"23d7f96a","width":5,"widthMobile":100,"isDynamic":true,"blockVersion":2} /-->

        <!-- wp:generateblocks/container {"uniqueId":"a810053a","isGrid":true,"gridId":"23d7f96a","width":60,"widthMobile":100,"isDynamic":true,"blockVersion":2} -->
        <!-- wp:paragraph -->
        <p>Als klassische Hausarztpraxis und Praxis für Allgemeinmedizin in Aachen – mit moderner Technik – sind wir für unsere Patienten mit Ihren Sorgen, Nöten und Krankheiten da. Ob Rückenschmerzen, Erkältung, Magen-Darm-Grippe, Hautausschlag, Kopfschmerzen, Husten, Herzbeschwerden oder seelische Beschwerden…. – als erster Ansprechpartner ist Ihre Hausärztin für nahezu alle Erkrankungen geeignet.</p>
        <!-- /wp:paragraph -->

        <!-- wp:generateblocks/button-container {"uniqueId":"d6486110","isDynamic":true,"blockVersion":2} -->
        <!-- wp:generateblocks/button {"uniqueId":"f21bdbed","hasUrl":true,"backgroundColor":"var(\u002d\u002dglobal-color-17)","backgroundColorHover":"var(\u002d\u002dglobal-color-17)","textColor":"#ffffff","textColorHover":"#ffffff","borderColor":"","borderColorHover":"","paddingTop":"15","paddingRight":"20","paddingBottom":"15","paddingLeft":"20","blockVersion":2} -->
        <a class="gb-button gb-button-f21bdbed gb-button-text" href="https://www.hausaerztin-aachen.de/hausarztmedizin-in-aachen/">Weiterlesen</a>
        <!-- /wp:generateblocks/button -->
        <!-- /wp:generateblocks/button-container -->
        <!-- /wp:generateblocks/container -->

        <!-- wp:generateblocks/container {"uniqueId":"01b407aa","isGrid":true,"gridId":"23d7f96a","width":10,"widthMobile":100,"isDynamic":true,"blockVersion":2} /-->
        <!-- /wp:generateblocks/grid -->

        <!-- wp:spacer {"height":"70px"} -->
        <div style="height:70px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->
        <!-- /wp:generateblocks/container -->',
        )
);

		
/* Überschrift Text Bild und Button  */
register_block_pattern(
  'ueberschrift_text_bild_button',
    array(
    'title' => __( 'Überschrift Text Bild und Button', 'ueberschrift_text_bild_button' ),
    'description' => _x( 'Überschrift Text Bild und Button', 'Überschrift Text Bild und Button', 'ueberschrift_text_bild_button' ),
    'categories'  => array('HA Haurand'),
    'content'     =>
       '<!-- wp:generateblocks/container {"uniqueId":"af27828c","isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/grid {"uniqueId":"cc2e4534","columns":4,"isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/container {"uniqueId":"c995eac6","isGrid":true,"gridId":"cc2e4534","width":25,"widthMobile":100,"isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/headline {"uniqueId":"62fe1605","backgroundColor":"","textColor":"","linkColor":"","linkColorHover":"","borderColor":"var(\u002d\u002dglobal-color-15)","highlightTextColor":"","borderSizeBottom":"4","iconColor":""} -->
		<h2 class="gb-headline gb-headline-62fe1605 gb-headline-text">Traditionelle Chinesische Medizin beim Hausarzt</h2>
		<!-- /wp:generateblocks/headline -->

		<!-- wp:image {"id":4781,"sizeSlug":"full","linkDestination":"media"} -->
		<figure class="wp-block-image size-full"><a href="https://test2.haurand.com/wp-content/uploads/2023/01/katzenkinder-1024x768.jpg"><img src="https://test2.haurand.com/wp-content/uploads/2023/01/katzenkinder-1024x768.jpg" alt="" class="wp-image-4781"/></a></figure>
		<!-- /wp:image -->
		<!-- /wp:generateblocks/container -->

		<!-- wp:generateblocks/container {"uniqueId":"15d66954","isGrid":true,"gridId":"cc2e4534","width":5,"widthMobile":100,"isDynamic":true,"blockVersion":2} /-->

		<!-- wp:generateblocks/container {"uniqueId":"390d7bb1","isGrid":true,"gridId":"cc2e4534","width":60,"widthMobile":100,"isDynamic":true,"blockVersion":2} -->
		<!-- wp:paragraph -->
		<p>Zu den Heilmethoden der Traditionellen Chinesischen Medizin (TCM) gehört neben der&nbsp; Akupunktur die Pflanzenheilkunde, die Moxibustion, die chinesische Massage und Körperübungen (Qi gong, Tai Chi).</p>
		<!-- /wp:paragraph -->

		<!-- wp:generateblocks/button-container {"uniqueId":"4c0ec9ef","isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/button {"uniqueId":"0ef0dcb2","hasUrl":true,"backgroundColor":"var(\u002d\u002dglobal-color-17)","backgroundColorHover":"var(\u002d\u002dglobal-color-17)","textColor":"#ffffff","textColorHover":"#ffffff","borderColor":"","borderColorHover":"","paddingTop":"15","paddingRight":"20","paddingBottom":"15","paddingLeft":"20","blockVersion":2} -->
		<a class="gb-button gb-button-0ef0dcb2 gb-button-text" href="https://www.hausaerztin-aachen.de/traditionelle-chinesische-medizin/">Weiterlesen</a>
		<!-- /wp:generateblocks/button -->
		<!-- /wp:generateblocks/button-container -->
		<!-- /wp:generateblocks/container -->

		<!-- wp:generateblocks/container {"uniqueId":"a05e77cf","isGrid":true,"gridId":"cc2e4534","width":10,"widthMobile":100,"isDynamic":true,"blockVersion":2} /-->
		<!-- /wp:generateblocks/grid -->

		<!-- wp:spacer {"height":"70px"} -->
		<div style="height:70px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->
		<!-- /wp:generateblocks/container -->',
        )
);


/* Urlaub  */
register_block_pattern(
	'urlaub',
	  array(
	  'title' => __( 'Urlaub', 'urlaub' ),
	  'description' => _x( 'Urlaub', 'Urlaub', 'urlaub' ),
	  'categories'  => array('HA Haurand'),
	  'content'     =>
        '<!-- wp:generateblocks/container {"uniqueId":"fc596d7b","isDynamic":true,"blockVersion":2} -->
        <!-- wp:generateblocks/grid {"uniqueId":"1a4dc702","columns":4,"isDynamic":true,"blockVersion":2} -->
        <!-- wp:generateblocks/container {"uniqueId":"3e83541c","isGrid":true,"gridId":"1a4dc702","width":25,"widthMobile":100,"isDynamic":true,"blockVersion":2} -->
        <!-- wp:generateblocks/headline {"uniqueId":"625d21d9","backgroundColor":"","textColor":"","linkColor":"","linkColorHover":"","borderColor":"var(\u002d\u002dglobal-color-15)","highlightTextColor":"","borderSizeBottom":"4","iconColor":""} -->
        <h2 class="gb-headline gb-headline-625d21d9 gb-headline-text">Urlaub</h2>
        <!-- /wp:generateblocks/headline -->
        <!-- /wp:generateblocks/container -->
        
        <!-- wp:generateblocks/container {"uniqueId":"a25c676b","isGrid":true,"gridId":"1a4dc702","width":5,"widthMobile":100,"isDynamic":true,"blockVersion":2} /-->
        
        <!-- wp:generateblocks/container {"uniqueId":"c91414b4","isGrid":true,"gridId":"1a4dc702","width":60,"widthMobile":100,"isDynamic":true,"blockVersion":2} -->
        <!-- wp:paragraph -->
        <p>Als klassische Hausarztpraxis und Praxis für Allgemeinmedizin in Aachen – mit moderner Technik – sind wir für unsere Patienten mit Ihren Sorgen, Nöten und Krankheiten da. Ob Rückenschmerzen, Erkältung, Magen-Darm-Grippe, Hautausschlag, Kopfschmerzen, Husten, Herzbeschwerden oder seelische Beschwerden…. – als erster Ansprechpartner ist Ihre Hausärztin für nahezu alle Erkrankungen geeignet.</p>
        <!-- /wp:paragraph -->
        <!-- /wp:generateblocks/container -->
        
        <!-- wp:generateblocks/container {"uniqueId":"71d927b0","isGrid":true,"gridId":"1a4dc702","width":10,"widthMobile":100,"isDynamic":true,"blockVersion":2} /-->
        <!-- /wp:generateblocks/grid -->
        
        <!-- wp:spacer {"height":"70px"} -->
        <div style="height:70px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->
        <!-- /wp:generateblocks/container -->',
		  )
);



/* Eigener Button  */
register_block_pattern(
  'eigener_button',
    array(
    'title' => __( 'Eigener Button', 'eigener_button' ),
    'description' => _x( 'Eigener Button', 'Eigener Button', 'eigener_button' ),
    'categories'  => array('HA Haurand'),
    'content'     =>
       '<!-- wp:generateblocks/button-container {"uniqueId":"4c0ec9ef","isDynamic":true,"blockVersion":2} -->
        <!-- wp:generateblocks/button {"uniqueId":"0ef0dcb2","hasUrl":true,"backgroundColor":"var(\u002d\u002dglobal-color-15)","backgroundColorHover":"var(\u002d\u002dglobal-color-17)","textColor":"#ffffff","textColorHover":"#ffffff","borderColor":"","borderColorHover":"","paddingTop":"15","paddingRight":"20","paddingBottom":"15","paddingLeft":"20","blockVersion":2} -->
        <a class="gb-button gb-button-0ef0dcb2 gb-button-text" href="http://www.hausaerztin-aachen.de/wp-content/uploads/2022/11/Aufklaerungsbogen_de.pdf">Hier klicken</a>
        <!-- /wp:generateblocks/button -->
        <!-- /wp:generateblocks/button-container -->',
        )
);

  

