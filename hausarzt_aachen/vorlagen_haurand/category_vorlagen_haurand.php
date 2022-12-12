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
function haurand_register_block_categories() {
if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
	register_block_pattern_category(
	 'Haurand',
	 array( 'label' => _x( 'Vorlagen Haurand', 'Block pattern category' ) )
    );
  }
}
add_action( 'init', 'haurand_register_block_categories' );
   
   

/* Überschrift Text und Button  */
register_block_pattern(
  'ueberschrift_text_button',
    array(
    'title' => __( 'Überschrift Text und Button', 'ueberschrift_text_button' ),
    'description' => _x( 'Überschrift Text und Button', 'Überschrift Text und Button', 'ueberschrift_text_button' ),
    'categories'  => array('Haurand'),
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
		<!-- wp:generateblocks/button {"uniqueId":"f21bdbed","hasUrl":true,"backgroundColor":"#0366d6","backgroundColorHover":"var(\u002d\u002dglobal-color-17)","textColor":"#ffffff","textColorHover":"#ffffff","borderColor":"","borderColorHover":"","paddingTop":"15","paddingRight":"20","paddingBottom":"15","paddingLeft":"20","blockVersion":2} -->
		<a class="gb-button gb-button-f21bdbed gb-button-text" href="http://www2.hausaerztin-aachen.de/hausarztmedizin-in-aachen/">Weiterlesen</a>
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
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:generateblocks/container {"uniqueId":"af27828c","isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/grid {"uniqueId":"cc2e4534","columns":4,"isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/container {"uniqueId":"c995eac6","isGrid":true,"gridId":"cc2e4534","width":25,"widthMobile":100,"isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/headline {"uniqueId":"62fe1605","backgroundColor":"","textColor":"","linkColor":"","linkColorHover":"","borderColor":"var(\u002d\u002dglobal-color-15)","highlightTextColor":"","borderSizeBottom":"4","iconColor":""} -->
		<h2 class="gb-headline gb-headline-62fe1605 gb-headline-text">Traditionelle Chinesische Medizin beim Hausarzt</h2>
		<!-- /wp:generateblocks/headline -->

		<!-- wp:image {"id":4781,"sizeSlug":"full","linkDestination":"media"} -->
		<figure class="wp-block-image size-full"><a href="http://www2.hausaerztin-aachen.de/wp-content/uploads/2022/11/Foto_1000_780.jpg"><img src="http://www2.hausaerztin-aachen.de/wp-content/uploads/2022/11/Foto_1000_780.jpg" alt="" class="wp-image-4781"/></a></figure>
		<!-- /wp:image -->
		<!-- /wp:generateblocks/container -->

		<!-- wp:generateblocks/container {"uniqueId":"15d66954","isGrid":true,"gridId":"cc2e4534","width":5,"widthMobile":100,"isDynamic":true,"blockVersion":2} /-->

		<!-- wp:generateblocks/container {"uniqueId":"390d7bb1","isGrid":true,"gridId":"cc2e4534","width":60,"widthMobile":100,"isDynamic":true,"blockVersion":2} -->
		<!-- wp:paragraph -->
		<p>Zu den Heilmethoden der Traditionellen Chinesischen Medizin (TCM) gehört neben der&nbsp; Akupunktur die Pflanzenheilkunde, die Moxibustion, die chinesische Massage und Körperübungen (Qi gong, Tai Chi).</p>
		<!-- /wp:paragraph -->

		<!-- wp:generateblocks/button-container {"uniqueId":"4c0ec9ef","isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/button {"uniqueId":"0ef0dcb2","hasUrl":true,"backgroundColor":"#0366d6","backgroundColorHover":"var(\u002d\u002dglobal-color-17)","textColor":"#ffffff","textColorHover":"#ffffff","borderColor":"","borderColorHover":"","paddingTop":"15","paddingRight":"20","paddingBottom":"15","paddingLeft":"20","blockVersion":2} -->
		<a class="gb-button gb-button-0ef0dcb2 gb-button-text" href="http://www2.hausaerztin-aachen.de/traditionelle-chinesische-medizin/">Weiterlesen</a>
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
	  'categories'  => array('Haurand'),
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
		 <!-- /wp:generateblocks/container -->
		 ',
		  )
);



/* Eigener Button  */
register_block_pattern(
  'eigener_button',
    array(
    'title' => __( 'Eigener Button', 'eigener_button' ),
    'description' => _x( 'Eigener Button', 'Eigener Button', 'eigener_button' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:generateblocks/button-container {"uniqueId":"4c0ec9ef","isDynamic":true,"blockVersion":2} -->
		<!-- wp:generateblocks/button {"uniqueId":"0ef0dcb2","hasUrl":true,"backgroundColor":"#0366d6","backgroundColorHover":"var(\u002d\u002dglobal-color-17)","textColor":"#ffffff","textColorHover":"#ffffff","borderColor":"","borderColorHover":"","paddingTop":"15","paddingRight":"20","paddingBottom":"15","paddingLeft":"20","blockVersion":2} -->
		<a class="gb-button gb-button-0ef0dcb2 gb-button-text" href="http://www2.hausaerztin-aachen.de/traditionelle-chinesische-medizin/">Weiterlesen</a>
		<!-- /wp:generateblocks/button -->
		<!-- /wp:generateblocks/button-container -->',
        )
);




