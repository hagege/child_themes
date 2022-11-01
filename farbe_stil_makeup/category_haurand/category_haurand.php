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
/* Vier Spalten Bilder mit blauem Hintergrund */
/* ---------------------------------- */
register_block_pattern(
  'vier_spalten_bilder_mit_blauem_hintergrund',
    array(
    'title' => __( 'Vier Spalten Bilder mit blauem Hintergrund', 'vier_spalten_bilder_mit_blauem_hintergrund' ),
    'description' => _x( 'Vier Spalten Bilder mit blauem Hintergrund', 'Vier Spalten Bilder mit blauem Hintergrund', 'vier_spalten_bilder_mit_blauem_hintergrund' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","backgroundColor":"global-color-12","className":"block_pattern_raender","layout":{"type":"default"}} -->
		<div class="wp-block-group alignfull block_pattern_raender has-global-color-12-background-color has-background"><!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"bottom"} -->
		<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:image {"id":94,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF0334.jpg" alt="" class="wp-image-94"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"bottom"} -->
		<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:image {"id":95,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF0371.jpg" alt="" class="wp-image-95"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"bottom"} -->
		<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:image {"id":91,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF2470.jpg" alt="" class="wp-image-91"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"bottom"} -->
		<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:image {"id":92,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF2591.jpg" alt="" class="wp-image-92"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);


/* ---------------------------------- */
/* Zwei Spalten Bild/Text mit blauem Hintergrund  */
/* ---------------------------------- */
register_block_pattern(
  'zwei_spalten_bild_text_mit_blauem_hintergrund',
    array(
    'title' => __( 'Zwei Spalten Bild/Text mit blauem Hintergrund', 'zwei_spalten_bild_text_mit_blauem_hintergrund' ),
    'description' => _x( 'Zwei Spalten Bild/Text mit blauem Hintergrund', 'Zwei Spalten Bild/Text mit blauem Hintergrund', 'zwei_spalten_bild_text_mit_blauem_hintergrund' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","backgroundColor":"global-color-12","className":"block_pattern_raender"} -->
		<div class="wp-block-group alignfull block_pattern_raender has-global-color-12-background-color has-background"><!-- wp:heading -->
		<h2>Die Typberatung (Farb- und Stilberatung)</h2>
		<!-- /wp:heading -->

		<!-- wp:spacer {"height":"20px"} -->
		<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"id":95,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF0371.jpg" alt="" class="wp-image-95"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"level":3} -->
		<h3>Schön sein bedeutet nicht, perfekt auszusehen</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Denn gutes Aussehen ist auch immer eine Frage der Harmonie zwischen dem Wesen eines Menschen und seiner äußeren Erscheinung. Das Bedürfnis attraktiv zu erscheinen und andere zu beeindrucken ist uns bereits angeboren. Sich besser darstellen, präsenter in Erscheinung zu treten, wer wünscht sich das nicht? Bei mir erfahren Sie wie Sie auf Andere wirken. Sie erfahren, von welchen Merkmalen Ihres Aussehens Ihr Gegenüber auf Fähigkeiten, Kompetenzen und Charaktereigenschaften schließt und sich sein Urteil bildet und zwar in Sekundenschnelle – und Sie erfahren wie Sie diese Tatsache für Ihre Ziele einsetzen.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Dazu biete ich Ihnen eine kompetente und professionelle</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3} -->
		<h3>Farb- und Stilberatung.</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Das Ergebnis ist Ihr persönlicher Auftritt, der Eindruck macht und der in Erinnerung bleibt. Eine sinnvolle Investition für Ihre Zukunft.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
				)
);


/* ---------------------------------- */
/* Zwei Spalten Bild/Text mit weißem Hintergrund */
/*--------------------------------- */
register_block_pattern(
  'zwei_spalten_bild_text_mit_weissem_hintergrund',
    array(
    'title' => __( 'Zwei Spalten Bild/Text mit weißem Hintergrund', 'zwei_spalten_bild_text_mit_weissem_hintergrund' ),
    'description' => _x( 'Zwei Spalten Bild/Text mit weißem Hintergrund', 'Zwei Spalten Bild/Text mit weißem Hintergrund', 'zwei_spalten_bild_text_mit_weissem_hintergrund' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","backgroundColor":"base-2","className":"block_pattern_raender"} -->
		<div class="wp-block-group alignfull block_pattern_raender has-base-2-background-color has-background"><!-- wp:heading -->
		<h2>Die Typberatung (Farb- und Stilberatung)</h2>
		<!-- /wp:heading -->

		<!-- wp:spacer {"height":"20px"} -->
		<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"id":95,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF0371.jpg" alt="" class="wp-image-95"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"level":3} -->
		<h3>Schön sein bedeutet nicht, perfekt auszusehen</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Denn gutes Aussehen ist auch immer eine Frage der Harmonie zwischen dem Wesen eines Menschen und seiner äußeren Erscheinung. Das Bedürfnis attraktiv zu erscheinen und andere zu beeindrucken ist uns bereits angeboren. Sich besser darstellen, präsenter in Erscheinung zu treten, wer wünscht sich das nicht? Bei mir erfahren Sie wie Sie auf Andere wirken. Sie erfahren, von welchen Merkmalen Ihres Aussehens Ihr Gegenüber auf Fähigkeiten, Kompetenzen und Charaktereigenschaften schließt und sich sein Urteil bildet und zwar in Sekundenschnelle – und Sie erfahren wie Sie diese Tatsache für Ihre Ziele einsetzen.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Dazu biete ich Ihnen eine kompetente und professionelle</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3} -->
		<h3>Farb- und Stilberatung.</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Das Ergebnis ist Ihr persönlicher Auftritt, der Eindruck macht und der in Erinnerung bleibt. Eine sinnvolle Investition für Ihre Zukunft.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);


/* ---------------------------------- */
/* Zwei Spalten Bilder mit blauem Hintergrund */
/* ---------------------------------- */
register_block_pattern(
  'zwei_spalten_bilder_mit_blauem_hintergrund',
    array(
    'title' => __( 'Zwei Spalten Bilder mit blauem Hintergrund', 'zwei_spalten_bilder_mit_blauem_hintergrund' ),
    'description' => _x( 'Zwei Spalten Bilder mit blauem Hintergrund', 'Zwei Spalten Bilder mit blauem Hintergrund', 'zwei_spalten_bilder_mit_blauem_hintergrund' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","backgroundColor":"global-color-12","className":"block_pattern_raender"} -->
		<div class="wp-block-group alignfull block_pattern_raender has-global-color-12-background-color has-background"><!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"id":94,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF0334.jpg" alt="" class="wp-image-94"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"id":95,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF0371.jpg" alt="" class="wp-image-95"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);



/* ---------------------------------- */
/* Zwei Spalten Bilder mit weißem Hintergrund */
/* ---------------------------------- */
register_block_pattern(
  'zwei_spalten_bilder_mit_weissem_hintergrund',
    array(
    'title' => __( 'Zwei Spalten Bilder mit weißem Hintergrund', 'zwei_spalten_bilder_mit_weissem_hintergrund' ),
    'description' => _x( 'Zwei Spalten Bilder mit weißem Hintergrund', 'Zwei Spalten Bilder mit weißem Hintergrund', 'zwei_spalten_bilder_mit_weissem_hintergrund' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","backgroundColor":"base-2","className":"block_pattern_raender"} -->
		<div class="wp-block-group alignfull block_pattern_raender has-base-2-background-color has-background"><!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"id":91,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF2470.jpg" alt="" class="wp-image-91"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"id":92,"sizeSlug":"full","linkDestination":"none"} -->
		<figure class="wp-block-image size-full"><img src="https://farbe-stil-makeup.com/wp-content/uploads/2022/08/DSCF2591.jpg" alt="" class="wp-image-92"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);


/* ---------------------------------- */
/* Zwei Spalten Text mit blauem Hintergrund */
/* ---------------------------------- */
register_block_pattern(
  'zwei_spalten_text_mit_blauem_hintergrund',
    array(
    'title' => __( 'Zwei Spalten Text mit blauem Hintergrund', 'zwei_spalten_text_mit_blauem_hintergrund' ),
    'description' => _x( 'Zwei Spalten Text mit blauem Hintergrund', 'Zwei Spalten Text mit blauem Hintergrund', 'zwei_spalten_text_mit_blauem_hintergrund' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","backgroundColor":"global-color-12","className":"block_pattern_raender"} -->
		<div class="wp-block-group alignfull block_pattern_raender has-global-color-12-background-color has-background"><!-- wp:heading -->
		<h2>Die Typberatung (Farb- und Stilberatung)</h2>
		<!-- /wp:heading -->

		<!-- wp:spacer {"height":"20px"} -->
		<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"level":3} -->
		<h3>Schön sein bedeutet nicht, perfekt auszusehen</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Denn gutes Aussehen ist auch immer eine Frage der Harmonie zwischen dem Wesen eines Menschen und seiner äußeren Erscheinung. Das Bedürfnis attraktiv zu erscheinen und andere zu beeindrucken ist uns bereits angeboren. Sich besser darstellen, präsenter in Erscheinung zu treten, wer wünscht sich das nicht? Bei mir erfahren Sie wie Sie auf Andere wirken. Sie erfahren, von welchen Merkmalen Ihres Aussehens Ihr Gegenüber auf Fähigkeiten, Kompetenzen und Charaktereigenschaften schließt und sich sein Urteil bildet und zwar in Sekundenschnelle – und Sie erfahren wie Sie diese Tatsache für Ihre Ziele einsetzen.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Dazu biete ich Ihnen eine kompetente und professionelle</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3} -->
		<h3>Farb- und Stilberatung.</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Das Ergebnis ist Ihr persönlicher Auftritt, der Eindruck macht und der in Erinnerung bleibt. Eine sinnvolle Investition für Ihre Zukunft.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"level":3} -->
		<h3>Schön sein bedeutet nicht, perfekt auszusehen</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Denn gutes Aussehen ist auch immer eine Frage der Harmonie zwischen dem Wesen eines Menschen und seiner äußeren Erscheinung. Das Bedürfnis attraktiv zu erscheinen und andere zu beeindrucken ist uns bereits angeboren. Sich besser darstellen, präsenter in Erscheinung zu treten, wer wünscht sich das nicht? Bei mir erfahren Sie wie Sie auf Andere wirken. Sie erfahren, von welchen Merkmalen Ihres Aussehens Ihr Gegenüber auf Fähigkeiten, Kompetenzen und Charaktereigenschaften schließt und sich sein Urteil bildet und zwar in Sekundenschnelle – und Sie erfahren wie Sie diese Tatsache für Ihre Ziele einsetzen.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Dazu biete ich Ihnen eine kompetente und professionelle</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3} -->
		<h3>Farb- und Stilberatung.</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Das Ergebnis ist Ihr persönlicher Auftritt, der Eindruck macht und der in Erinnerung bleibt. Eine sinnvolle Investition für Ihre Zukunft.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);


/* ---------------------------------- */
/* Zwei Spalten Text mit weißem Hintergrund */
/* ---------------------------------- */
register_block_pattern(
  'zwei_spalten_text_mit_weissem_hintergrund',
    array(
    'title' => __( 'Zwei Spalten Text mit weißem Hintergrund', 'zwei_spalten_text_mit_weissem_hintergrund' ),
    'description' => _x( 'Zwei Spalten Text mit weißem Hintergrund', 'Zwei Spalten Text mit weißem Hintergrund', 'zwei_spalten_text_mit_weissem_hintergrund' ),
    'categories'  => array('Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","backgroundColor":"base-2","className":"block_pattern_raender"} -->
		<div class="wp-block-group alignfull block_pattern_raender has-base-2-background-color has-background"><!-- wp:heading -->
		<h2>Die Typberatung (Farb- und Stilberatung)</h2>
		<!-- /wp:heading -->

		<!-- wp:spacer {"height":"20px"} -->
		<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:columns -->
		<div class="wp-block-columns"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"level":3} -->
		<h3>Schön sein bedeutet nicht, perfekt auszusehen</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Denn gutes Aussehen ist auch immer eine Frage der Harmonie zwischen dem Wesen eines Menschen und seiner äußeren Erscheinung. Das Bedürfnis attraktiv zu erscheinen und andere zu beeindrucken ist uns bereits angeboren. Sich besser darstellen, präsenter in Erscheinung zu treten, wer wünscht sich das nicht? Bei mir erfahren Sie wie Sie auf Andere wirken. Sie erfahren, von welchen Merkmalen Ihres Aussehens Ihr Gegenüber auf Fähigkeiten, Kompetenzen und Charaktereigenschaften schließt und sich sein Urteil bildet und zwar in Sekundenschnelle – und Sie erfahren wie Sie diese Tatsache für Ihre Ziele einsetzen.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Dazu biete ich Ihnen eine kompetente und professionelle</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3} -->
		<h3>Farb- und Stilberatung.</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Das Ergebnis ist Ihr persönlicher Auftritt, der Eindruck macht und der in Erinnerung bleibt. Eine sinnvolle Investition für Ihre Zukunft.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"level":3} -->
		<h3>Schön sein bedeutet nicht, perfekt auszusehen</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Denn gutes Aussehen ist auch immer eine Frage der Harmonie zwischen dem Wesen eines Menschen und seiner äußeren Erscheinung. Das Bedürfnis attraktiv zu erscheinen und andere zu beeindrucken ist uns bereits angeboren. Sich besser darstellen, präsenter in Erscheinung zu treten, wer wünscht sich das nicht? Bei mir erfahren Sie wie Sie auf Andere wirken. Sie erfahren, von welchen Merkmalen Ihres Aussehens Ihr Gegenüber auf Fähigkeiten, Kompetenzen und Charaktereigenschaften schließt und sich sein Urteil bildet und zwar in Sekundenschnelle – und Sie erfahren wie Sie diese Tatsache für Ihre Ziele einsetzen.</p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Dazu biete ich Ihnen eine kompetente und professionelle</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":3} -->
		<h3>Farb- und Stilberatung.</h3>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p>Das Ergebnis ist Ihr persönlicher Auftritt, der Eindruck macht und der in Erinnerung bleibt. Eine sinnvolle Investition für Ihre Zukunft.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></div>
		<!-- /wp:group -->',
        )
);
