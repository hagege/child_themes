<?php
/*
Plugin Name: Custom Haurand Block Styles 2
Plugin URI: https://haurand.com
Description: Zusätzliche Block-Styles für den Block Editor
Author: Hans-Gerd Gerhards
Author URI: https://haurand.com (Quelle: Automattic: https://github.com/Automattic/gutenberg-block-styles/)
Version: 1.51



/**
 * 1. Register Custom Block Styles
 */
if ( function_exists( 'register_block_style' ) ) {
	function block_styles_register_block_styles() {
		/**
		 * Register stylesheet
		 */
		wp_register_style(
			'block-styles-stylesheet',
			plugins_url( 'style.css', __FILE__ ),
			array(),
			'1.2'
		);

		/**
		 * Register block style
		 */
		register_block_style(
			'core/paragraph',
			array(
				'name'         => 'blue-paragraph',
				'label'        => 'Absatz mit blauem Hintergrund',
				'style_handle' => 'block-styles-stylesheet',
			)
		);
        register_block_style( 
            'core/button', 
            array(
	           'name'          => 'fancy-button',
	           'label'         => 'Fancy Button',
  			   'style_handle'  => 'block-styles-stylesheet',
            )
        );
        
        register_block_style( 
            'core/list',
            array(
            	'name'         => '2col-list',
	            'label'        => '2-Spaltige Liste',
    			'style_handle' => 'block-styles-stylesheet',
            )
        );
		register_block_style(
			'core/paragraph',
			array(
				'name'         => 'full width Paragraph',
				'label'        => 'Absatz mit voller Breite',
				'style_handle' => 'block-styles-stylesheet',
			)
		);
        register_block_style(
			'core/heading',
			array(
	           'name'          => 'gradient-headline',
	           'label'         => 'Gradient Überschrift',
			   'style_handle'  => 'block-styles-stylesheet',
          	)
		);
      
        
        
	}
    

	add_action( 'init', 'block_styles_register_block_styles' );
}


/**
 * 2. Custom Block Patterns
 */

/* ---------------------------------------------------------------------------------------------------------------------------- */
/* 1. Block */
/* Block pattern: Vorlage mit 3 Kacheln, bestehend aus jeweils einer Überschrift, einem Bild mit kurzer Beschreibung*/
/* ---------------------------------------------------------------------------------------------------------------------------- */
register_block_pattern(
   'kacheln-card-pattern',
     array(
     'title' => __( 'Drei Spalten mit Bildern (Kacheln)', 'kacheln-block-pattern' ),
     'description' => _x( 'Drei Spalten mit Bildern (Kacheln)', 'Drei Spalten mit Bildern (Kacheln)', 'kacheln-block-pattern' ),
     'categories'  => array('columns'),
     'content'     => 
        " <!-- wp:columns -->
          <div class=\"wp-block-columns\"><!-- wp:column {\"className\":\"kacheln\"} -->
          <div class=\"wp-block-column kacheln\"><!-- wp:heading {\"align\":\"center\",\"level\":4} -->
          <h4 class=\"has-text-align-center\">Geschichte</h4>
          <!-- /wp:heading -->
          
          <!-- wp:image {\"id\":47830,\"sizeSlug\":\"large\"} -->
          <figure class=\"wp-block-image size-large\"><img src=\"https://haurand.com/wp-content/uploads/2020/11/sonnenuntergang_2.jpeg\" alt=\"\" class=\"wp-image-47830\"/><figcaption>Ein Foto vom Flötenspieler</figcaption></figure>
          <!-- /wp:image --></div>
          <!-- /wp:column -->
          
          <!-- wp:column {\"className\":\"kacheln\"} -->
          <div class=\"wp-block-column kacheln\"><!-- wp:heading {\"align\":\"center\",\"level\":4} -->
          <h4 class=\"has-text-align-center\">Landschaft</h4>
          <!-- /wp:heading -->
          
          <!-- wp:image {\"id\":47824,\"sizeSlug\":\"large\"} -->
          <figure class=\"wp-block-image size-large\"><img src=\"https://haurand.com/wp-content/uploads/2020/11/sauerland_3.jpg\" alt=\"\" class=\"wp-image-47824\"/><figcaption>Landschaft mit Sonnenuntergang</figcaption></figure>
          <!-- /wp:image --></div>
          <!-- /wp:column -->
          
          <!-- wp:column {\"className\":\"kacheln\"} -->
          <div class=\"wp-block-column kacheln\"><!-- wp:heading {\"align\":\"center\",\"level\":4} -->
          <h4 class=\"has-text-align-center\">Bevölkerung</h4>
          <!-- /wp:heading -->
          
          <!-- wp:image {\"id\":47827,\"sizeSlug\":\"large\"} -->
          <figure class=\"wp-block-image size-large\"><img src=\"https://haurand.com/wp-content/uploads/2020/11/sonnenuntergang_1.jpeg\" alt=\"\" class=\"wp-image-47827\"/><figcaption>Die Bevölkerung von Eilendorf (Foto: pixabay.com)</figcaption></figure>
          <!-- /wp:image --></div>
          <!-- /wp:column --></div>
          <!-- /wp:columns -->",
   )
 );


/* ---------------------------------------------------------------------------------------------------------------------------- */
/* 2. Block */
/* 3 Spalten mit runden Bildern */
/* ---------------------------------------------------------------------------------------------------------------------------- */
register_block_pattern(
'haurand-three-card-pattern',
array(
  'title' => __( '3 Columns with Cards', 'haurand-three-block-pattern' ),
  'description' => _x( 'Three Columns with Cards', 'Three Columns with Cards', 'haurand-three-block-pattern' ),
  'categories' => array('columns'),
  'content' => "<!-- wp:columns -->
        <div class=\"wp-block-columns\"><!-- wp:column {\"className\":\"kachel_spalte\"} -->
        <div class=\"wp-block-column kachel_spalte\"><!-- wp:heading {\"align\":\"center\"} -->
        <h2 class=\"has-text-align-center\" id=\"h-kontakt\">Kontakt</h2>
        <!-- /wp:heading -->
        
        <!-- wp:image {\"align\":\"center\",\"id\":2756,\"width\":200,\"height\":200,\"sizeSlug\":\"large\",\"className\":\"is-style-rounded\"} -->
        <div class=\"wp-block-image is-style-rounded\"><figure class=\"aligncenter size-large is-resized\"><img src=\"https://haurand.com/wp-content/uploads/2020/09/pexels-photo-4240498.jpeg\" alt=\"\" class=\"wp-image-2756\" width=\"200\" height=\"200\"/></figure></div>
        <!-- /wp:image -->
        
        <!-- wp:paragraph {\"align\":\"center\"} -->
        <p class=\"has-text-align-center\">Nehmen Sie jetzt Kontakt zu uns auf.</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons {\"align\":\"center\"} -->
        <div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#f60012\"}}} -->
        <div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background no-border-radius\" href=\"https://haurand.com/kontakt-2/\" style=\"background-color:#f60012\">Mehr Infos</a></div>
        <!-- /wp:button --></div>
        <!-- /wp:buttons --></div>
        <!-- /wp:column -->
        
        <!-- wp:column {\"className\":\"kachel_spalte\"} -->
        <div class=\"wp-block-column kachel_spalte\"><!-- wp:heading {\"align\":\"center\"} -->
        <h2 class=\"has-text-align-center\" id=\"h-ihre-webseite\">Ihre Webseite</h2>
        <!-- /wp:heading -->
        
        <!-- wp:image {\"align\":\"center\",\"id\":2755,\"width\":200,\"height\":200,\"sizeSlug\":\"large\",\"className\":\"is-style-rounded\"} -->
        <div class=\"wp-block-image is-style-rounded\"><figure class=\"aligncenter size-large is-resized\"><img src=\"https://haurand.com/wp-content/uploads/2020/09/ecommerce-2140603_640.jpg\" alt=\"\" class=\"wp-image-2755\" width=\"200\" height=\"200\"/></figure></div>
        <!-- /wp:image -->
        
        <!-- wp:paragraph {\"align\":\"center\"} -->
        <p class=\"has-text-align-center\">Einfach passende Webseiten.</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons {\"align\":\"center\"} -->
        <div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#f60012\"}}} -->
        <div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background no-border-radius\" href=\"https://haurand.com/ihre-neue-webseite-einfach-passend/\" style=\"background-color:#f60012\">Mehr Infos</a></div>
        <!-- /wp:button --></div>
        <!-- /wp:buttons --></div>
        <!-- /wp:column -->
        
        <!-- wp:column {\"className\":\"kachel_spalte\"} -->
        <div class=\"wp-block-column kachel_spalte\"><!-- wp:heading {\"align\":\"center\"} -->
        <h2 class=\"has-text-align-center\" id=\"h-zum-blog\">zum Blog</h2>
        <!-- /wp:heading -->
        
        <!-- wp:image {\"align\":\"center\",\"id\":2754,\"width\":200,\"height\":200,\"sizeSlug\":\"large\",\"className\":\"is-style-rounded\"} -->
        <div class=\"wp-block-image is-style-rounded\"><figure class=\"aligncenter size-large is-resized\"><img src=\"https://haurand.com/wp-content/uploads/2020/09/Blog.jpg\" alt=\"\" class=\"wp-image-2754\" width=\"200\" height=\"200\"/></figure></div>
        <!-- /wp:image -->
        
        <!-- wp:paragraph {\"align\":\"center\"} -->
        <p class=\"has-text-align-center\">Tipps zu WordPress und Entwicklung</p>
        <!-- /wp:paragraph -->
        
        <!-- wp:buttons {\"align\":\"center\"} -->
        <div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#f60012\"}}} -->
        <div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background no-border-radius\" href=\"https://haurand.com/category/allgemein/\" style=\"background-color:#f60012\">Mehr Infos</a></div>
        <!-- /wp:button --></div>
        <!-- /wp:buttons --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns --> ",
  ) 
);

/* ---------------------------------------------------------------------------------------------------------------------------- */
/* 3. Block */
/* 2 Spalten mit Bild oben Text darunter, blauer Hintergrund ohne Rahmen */ 
/* Die ID der Bilder muss in jedem Fall auf 324 bzw. 325 geändert werden (z. B. im Code-Editor), wenn der Zoomeffekt verwendet werden soll
/* und die Klasse muss ebenfalls angepasst werden (wp-image-324 oder wp-image-325) 
/* ---------------------------------------------------------------------------------------------------------------------------- */
register_block_pattern(
   'haurand-two-card-pattern',
     array(
     'title' => __( '2 Columns with Cards', 'haurand-two-block-pattern' ),
     'description' => _x( 'Two Columns with Cards', 'Two Columns with Cards', 'haurand-two-block-pattern' ),
     'categories'  => array('columns'),
     'content'     => "<!-- wp:columns -->
        <div class=\"wp-block-columns\"><!-- wp:column {\"className\":\"blue-background\"} -->
        <div class=\"wp-block-column blue-background\"><!-- wp:image {\"id\":324,\"sizeSlug\":\"large\",\"className\":\"zoomeffekt\"} -->
        <figure class=\"wp-block-image size-large zoomeffekt\"><img src=\"https://haurand.com/wp-content/uploads/2020/11/sonnenuntergang_2.jpeg\" alt=\"\" class=\"wp-image-324\"/></figure>
        <!-- /wp:image -->
        
        <!-- wp:paragraph {\"className\":\"blue-background\"} -->
        <p class=\"blue-background\">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column -->
        
        <!-- wp:column {\"className\":\"blue-background\"} -->
        <div class=\"wp-block-column blue-background\"><!-- wp:image {\"id\":325,\"sizeSlug\":\"large\",\"className\":\"zoomeffekt\"} -->
        <figure class=\"wp-block-image size-large zoomeffekt\"><img src=\"https://haurand.com/wp-content/uploads/2020/11/sauerland_3.jpg\" alt=\"\" class=\"wp-image-325\"/></figure>
        <!-- /wp:image -->
        
        <!-- wp:paragraph {\"className\":\"blue-background\"} -->
        <p class=\"blue-background\">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->",
   )
 );



 /* ---------------------------------------------------------------------------------------------------------------------------- */
/* 4. Block */
/* 2 Spalten mit Bild oben Text darunter, grüner Hintergrund ohne Rahmen mit Ken Burns Effekt*/ 
/* Die ID der Bilder muss in jedem Fall auf 326 bzw. 327 geändert werden (z. B. im Code-Editor), wenn der Zoomeffekt verwendet werden soll
/* und die Klasse muss ebenfalls angepasst werden (wp-image-326 oder wp-image-327) 
/* ---------------------------------------------------------------------------------------------------------------------------- */
register_block_pattern(
   'haurand-kb-two-card-pattern',
     array(
     'title' => __( '2 Columns with Cards - Ken Burns', 'haurand-kb-two-block-pattern' ),
     'description' => _x( 'Two Columns with Cards - Ken Burns', 'Two Columns with Cards - Ken Burns', 'haurand-kb-two-block-pattern' ),
     'categories'  => array('columns'),
     'content'     => "<!-- wp:columns -->
        <div class=\"wp-block-columns\"><!-- wp:column {\"className\":\"green-background\"} -->
        <div class=\"wp-block-column green-background\"><!-- wp:image {\"id\":326,\"sizeSlug\":\"large\",\"className\":\"ken_burns\"} -->
        <figure class=\"wp-block-image size-large ken_burns\"><img src=\"https://haurand.com/wp-content/uploads/2020/11/sonnenuntergang_2.jpeg\" alt=\"\" class=\"wp-image-326\"/></figure>
        <!-- /wp:image -->
        
        <!-- wp:paragraph {\"className\":\"green-background\"} -->
        <p class=\"green-background\">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column -->
        
        <!-- wp:column {\"className\":\"green-background\"} -->
        <div class=\"wp-block-column green-background\"><!-- wp:image {\"id\":327,\"sizeSlug\":\"large\",\"className\":\"ken_burns\"} -->
        <figure class=\"wp-block-image size-large ken_burns\"><img src=\"https://haurand.com/wp-content/uploads/2020/11/sauerland_3.jpg\" alt=\"\" class=\"wp-image-327\"/></figure>
        <!-- /wp:image -->
        
        <!-- wp:paragraph {\"className\":\"green-background\"} -->
        <p class=\"green-background\">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->",
   )
 );
 
 
  /* ---------------------------------------------------------------------------------------------------------------------------- */
/* 5. Block - ähnlich wie 2. Block, aber flexibler*/
/* 3 Spalten mit rechteckigen  Bildern und zoom-Effekt */ 
/* ---------------------------------------------------------------------------------------------------------------------------- */
register_block_pattern('haurand-three-card-pattern-v2',
     array(
     'title' => __( '3 Columns with Cards - v2', 'haurand-three-block-pattern-v2' ),
     'description' => _x( 'Three Columns with Cards', 'Three Columns with Cards - version 2', 'haurand-three-block-pattern-v2' ),
     'categories' => array('columns'),
     'content'     => "<!-- wp:columns {\"className\":\"kachel_spalten_v2\"} -->
      <div class=\"wp-block-columns kachel_spalten_v2\"><!-- wp:column {\"className\":\"kachel_spalte_v2\"} -->
      <div class=\"wp-block-column kachel_spalte_v2\"><!-- wp:heading {\"textAlign\":\"center\"} -->
      <h2 class=\"has-text-align-center\" id=\"h-kontakt\">Kontakt</h2>
      <!-- /wp:heading -->
      
      <!-- wp:image {\"id\":253,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"zoomeffekt\"} -->
      <figure class=\"wp-block-image size-large zoomeffekt\"><img src=\"http://leer.test/wp-content/uploads/2020/11/sonnenuntergang_3-1024x768.jpg\" alt=\"\" class=\"kachel_bild_v2\"/></figure>
      <!-- /wp:image -->
      
      <!-- wp:paragraph {\"align\":\"center\"} -->
      <p class=\"has-text-align-center\">Nehmen Sie jetzt Kontakt zu uns auf.</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:buttons {\"align\":\"center\"} -->
      <div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#f60012\"}}} -->
      <div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background no-border-radius\" href=\"https://haurand.com/kontakt-2/\" style=\"background-color:#f60012\">Mehr Infos</a></div>
      <!-- /wp:button --></div>
      <!-- /wp:buttons --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"className\":\"kachel_spalte_v2\"} -->
      <div class=\"wp-block-column kachel_spalte_v2\"><!-- wp:heading {\"textAlign\":\"center\"} -->
      <h2 class=\"has-text-align-center\" id=\"h-ihre-webseite\">Ihre Webseite</h2>
      <!-- /wp:heading -->
      
      <!-- wp:image {\"id\":252,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"zoomeffekt\"} -->
      <figure class=\"wp-block-image size-large zoomeffekt\"><img src=\"http://leer.test/wp-content/uploads/2020/11/sonnenuntergang_2-1024x768.jpeg\" alt=\"\" class=\"kachel_bild_v2\"/></figure>
      <!-- /wp:image -->
      
      <!-- wp:paragraph {\"align\":\"center\"} -->
      <p class=\"has-text-align-center\">Einfach passende Webseiten.</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:buttons {\"align\":\"center\"} -->
      <div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#f60012\"}}} -->
      <div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background no-border-radius\" href=\"https://haurand.com/ihre-neue-webseite-einfach-passend/\" style=\"background-color:#f60012\">Mehr Infos</a></div>
      <!-- /wp:button --></div>
      <!-- /wp:buttons --></div>
      <!-- /wp:column -->
      
      <!-- wp:column {\"className\":\"kachel_spalte_v2\"} -->
      <div class=\"wp-block-column kachel_spalte_v2\"><!-- wp:heading {\"textAlign\":\"center\"} -->
      <h2 class=\"has-text-align-center\" id=\"h-zum-blog\">zum Blog</h2>
      <!-- /wp:heading -->
      
      <!-- wp:image {\"id\":249,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"zoomeffekt\"} -->
      <figure class=\"wp-block-image size-large zoomeffekt\"><img src=\"http://leer.test/wp-content/uploads/2020/11/sauerland_2-1024x768.jpg\" alt=\"\" class=\"kachel_bild_v2\"/></figure>
      <!-- /wp:image -->
      
      <!-- wp:paragraph {\"align\":\"center\"} -->
      <p class=\"has-text-align-center\">Tipps zu WordPress und Entwicklung</p>
      <!-- /wp:paragraph -->
      
      <!-- wp:buttons {\"align\":\"center\"} -->
      <div class=\"wp-block-buttons aligncenter\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#f60012\"}}} -->
      <div class=\"wp-block-button\"><a class=\"wp-block-button__link has-background no-border-radius\" href=\"https://haurand.com/category/allgemein/\" style=\"background-color:#f60012\">Mehr Infos</a></div>
      <!-- /wp:button --></div>
      <!-- /wp:buttons --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->",
   )
 ); 
