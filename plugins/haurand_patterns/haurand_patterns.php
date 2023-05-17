<?php
/**
 * @package Haurand Patterns
 * @version 0.6.7
 */
/*
Plugin Name: Category Vorlagen Haurand
Plugin URI: http://haurand.com
Description: Create new Categories "Patterns Haurand" and several "Custom Websites Haurand" for Block Patterns with our custom Block patterns
Author: Hans-Gerd Gerhards
Version: 0.6.7
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
 
 

/* custom category Haurand              */
function patterns_haurand_register_block_categories() {
if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
	register_block_pattern_category(
	 'Patterns Haurand', array( 'label' => _x( 'Patterns Haurand', 'Block pattern category' ) )
    );
  }
}
add_action( 'init', 'patterns_haurand_register_block_categories' );


/* custom category Haurand: section patterns haurand */
function section_patterns_haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
    register_block_pattern_category(
     'Section Patterns Haurand', array( 'label' => _x( 'Section Patterns Haurand', 'Block pattern category' ) )
      );
    }
  }
  add_action( 'init', 'section_patterns_haurand_register_block_categories' );

/* custom css with category Patterns Haurand */
add_action( 'wp_enqueue_scripts', 'hp_custom_styles' );
function hp_custom_styles() {
    wp_enqueue_style( 'custom-style', plugins_url( '/hp_custom.css' , __FILE__ ) );
}
   

/* custom category EKS Haurand */            
function custom_eks_haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
    register_block_pattern_category(
     'EKS Haurand', array( 'label' => _x( 'EKS Patterns Haurand', 'Block pattern category EKS' ) )
      );
    }
  }
  add_action( 'init', 'custom_eks_haurand_register_block_categories' );
 

/* custom category HA Haurand */            
function custom_ha_haurand_register_block_categories() {
  if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {
    register_block_pattern_category(
     'HA Haurand', array( 'label' => _x( 'HA Patterns Haurand', 'Block pattern category HA' ) )
      );
    }
  }
  add_action( 'init', 'custom_ha_haurand_register_block_categories' );


/* Beispiel Spaltenblock mit Bild (Query Loop - Abfrage Block) */
register_block_pattern(
  'spaltenblock_mit_bild',
    array(
    'title' => __( 'Spaltenblock mit einem schönen Bild (Abfrage Block)', 'spaltenblock_mit_bild' ),
    'description' => _x( 'Spaltenblock mit Bild (Query Loop - Abfrage Block)', 'columns-block with image (Query Loop)', 'spaltenblock_mit_bild' ),
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



/* Zwei Spalten mit Text links und Cover rechts */
register_block_pattern(
  'columns_text_left_cover_right',
    array(
    'title' => __( 'Zwei Spalten mit Text links und Cover rechts', 'columns_text_left_cover_right' ),
    'description' => _x( 'Zwei Spalten mit Text links und Cover rechts', 'Zwei Spalten mit Text links und Cover rechts', 'columns_text_left_cover_right' ),
    'categories'  => array('Patterns Haurand'),
    'content'     =>       
      '<!-- wp:columns {"align":"full"} -->
      <div class="wp-block-columns alignfull"><!-- wp:column {"style":{"color":{"background":"#051629"}}} -->
      <div class="wp-block-column has-background" style="background-color:#051629"><!-- wp:columns -->
      <div class="wp-block-columns"><!-- wp:column {"width":"40%","layout":{"type":"constrained"}} -->
      <div class="wp-block-column" style="flex-basis:40%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
      <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"left","style":{"spacing":{"margin":{"left":"6.8rem","top":"2.2rem"}}},"textColor":"white"} -->
      <h2 class="wp-block-heading has-text-align-left has-white-color has-text-color" style="margin-top:2.2rem;margin-left:6.8rem">Sorrent</h2>
      <!-- /wp:heading -->

      <!-- wp:paragraph {"textColor":"white","fontSize":"large"} -->
      <p class="has-white-color has-text-color has-large-font-size">Einfach <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-foreground-color">wohlfühlen</mark></p>
      <!-- /wp:paragraph -->

      <!-- wp:paragraph {"align":"left","style":{"spacing":{"margin":{"left":"6.8rem"}}},"textColor":"white"} -->
      <p class="has-text-align-left has-white-color has-text-color" style="margin-left:6.8rem">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
      <!-- /wp:paragraph -->

      <!-- wp:list -->
      <ul><!-- wp:list-item -->
      <li>First</li>
      <!-- /wp:list-item -->

      <!-- wp:list-item -->
      <li>Second</li>
      <!-- /wp:list-item -->

      <!-- wp:list-item -->
      <li>Third</li>
      <!-- /wp:list-item --></ul>
      <!-- /wp:list -->

      <!-- wp:buttons -->
      <div class="wp-block-buttons"><!-- wp:button {"textColor":"white","style":{"color":{"background":"#db341e"}}} -->
      <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color has-background wp-element-button" style="background-color:#db341e"><strong>READ MORE</strong></a></div>
      <!-- /wp:button --></div>
      <!-- /wp:buttons --></div>
      <!-- /wp:group --></div>
      <!-- /wp:column -->

      <!-- wp:column {"width":"60%","layout":{"type":"default"}} -->
      <div class="wp-block-column" style="flex-basis:60%"><!-- wp:group {"layout":{"type":"constrained","contentSize":"1920px"}} -->
      <div class="wp-block-group"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg","id":5723,"dimRatio":0,"minHeight":546,"minHeightUnit":"px","align":"full","style":{"color":{}}} -->
      <div class="wp-block-cover alignfull" style="min-height:546px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-5723" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","fontSize":"large"} -->
      <p class="has-text-align-center has-large-font-size"></p>
      <!-- /wp:paragraph --></div></div>
      <!-- /wp:cover --></div>
      <!-- /wp:group --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns --></div>
      <!-- /wp:column --></div>
      <!-- /wp:columns -->',
)
);


/* Image with duotone background */
register_block_pattern(
  'image_with_duotone_background',
    array(
    'title' => __( 'Bild mit duotone Hintergrund', 'image_with_duotone_background' ),
    'description' => _x( 'Bild mit duotone Hintergrund', 'Image with duotone background', 'image_with_duotone_background' ),
    'categories'  => array('Section Patterns Haurand'),
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


/* Image with three Colors background */
register_block_pattern(
  'image_with_three_colors_background',
    array(
    'title' => __( 'Bild mit three Colors HIntergrund', 'image_with_three_colors_background' ),
    'description' => _x( 'Bild mit dreifarbigen HIntergrund', 'Image three Colors background', 'image_with_three_colors_background' ),
    'categories'  => array('Section Patterns Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","style":{"color":{"gradient":"linear-gradient(180deg, rgb(0 111 200) 0%, rgb(0 111 200) 40%, rgb(6 147 227) 40%, rgb(6 147 227) 42%, rgb(255 255 255) 42%, rgb(255 255 255) 100%)"}},"layout":{"type":"constrained"}} -->
       <div class="wp-block-group alignfull has-background" style="background:linear-gradient(180deg, rgb(0 111 200) 0%, rgb(0 111 200) 40%, rgb(6 147 227) 40%, rgb(6 147 227) 42%, rgb(255 255 255) 42%, rgb(255 255 255) 100%)"><!-- wp:group {"layout":{"type":"constrained"}} -->
       <div class="wp-block-group"><!-- wp:spacer -->
       <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
       <!-- /wp:spacer -->
       
       <!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2023/04/kletterhalle_2-jpg.webp","id":7073,"dimRatio":60,"customGradient":"linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(0,0,0) 50%)","contentPosition":"bottom center","style":{"color":{}}} -->
       <div class="wp-block-cover has-custom-content-position is-position-bottom-center"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(0,0,0) 50%)"></span><img class="wp-block-cover__image-background wp-image-7073" alt="" src="https://test5.haurand.com/wp-content/uploads/2023/04/kletterhalle_2-jpg.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"left","textColor":"base","fontSize":"small"} -->
       <p class="has-text-align-left has-base-color has-text-color has-small-font-size">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
       <div class="wp-block-buttons"><!-- wp:button -->
       <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Read More</a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div></div>
       <!-- /wp:cover -->
       
       <!-- wp:spacer -->
       <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
       <!-- /wp:spacer --></div>
       <!-- /wp:group --></div>
       <!-- /wp:group -->',
       )
);


/* Image with two color background and text */
register_block_pattern(
  'Image_with_two_color_background_and_text',
    array(
    'title' => __( 'Bild mit zweifarbigen Hintergrund und Text', 'Image_with_two_color_background_and_text' ),
    'description' => _x( 'Bild mit zweifarbigen Hintergrund und Text', 'Image with two color background and text', 'Image_with_two_color_background_and_text' ),
    'categories'  => array('Patterns Haurand'),
    'content'     =>
       '<!-- wp:columns {"align":"full"} -->
       <div class="wp-block-columns alignfull"><!-- wp:column {"style":{"color":{"gradient":"linear-gradient(90deg,rgb(31,28,69) 76%,rgb(155,81,224) 76%)"}}} -->
       <div class="wp-block-column has-background" style="background:linear-gradient(90deg,rgb(31,28,69) 76%,rgb(155,81,224) 76%)"><!-- wp:columns -->
       <div class="wp-block-columns"><!-- wp:column {"width":"66.66%","layout":{"type":"constrained"}} -->
       <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
       <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"left","style":{"spacing":{"margin":{"left":"6.8rem","top":"2.2rem"}}},"textColor":"white"} -->
       <h2 class="wp-block-heading has-text-align-left has-white-color has-text-color" style="margin-top:2.2rem;margin-left:6.8rem">Sorrent</h2>
       <!-- /wp:heading -->
       
       <!-- wp:paragraph {"align":"left","style":{"spacing":{"margin":{"left":"6.8rem"}}},"textColor":"white"} -->
       <p class="has-text-align-left has-white-color has-text-color" style="margin-left:6.8rem">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons -->
       <div class="wp-block-buttons"><!-- wp:button {"textColor":"white","style":{"color":{"background":"#db341e"}}} -->
       <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-text-color has-background wp-element-button" style="background-color:#db341e"><strong>READ MORE</strong></a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div>
       <!-- /wp:group --></div>
       <!-- /wp:column -->
       
       <!-- wp:column {"width":"40%","layout":{"type":"default"}} -->
       <div class="wp-block-column" style="flex-basis:40%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0rem","bottom":"0rem","left":"1rem","right":"2rem"},"margin":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
       <div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--80);margin-bottom:var(--wp--preset--spacing--80);padding-top:0rem;padding-right:2rem;padding-bottom:0rem;padding-left:1rem"><!-- wp:image {"id":5723,"sizeSlug":"large","linkDestination":"none"} -->
       <figure class="wp-block-image size-large"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021-1024x768.jpg" alt="" class="wp-image-5723"/></figure>
       <!-- /wp:image --></div>
       <!-- /wp:group --></div>
       <!-- /wp:column --></div>
       <!-- /wp:columns --></div>
       <!-- /wp:column --></div>
       <!-- /wp:columns -->',
        )
);


/* split screen */
register_block_pattern(
  'split_screen',
    array(
    'title' => __( 'split screen', 'split_screen' ),
    'description' => _x( 'split screen', 'split screen', 'split_screen' ),
    'categories'  => array('Patterns Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px"},"border":{"width":"0px","style":"none"}},"layout":{"type":"constrained"}} -->
       <div class="wp-block-group alignfull" style="border-style:none;border-width:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:columns {"align":"full","style":{"border":{"width":"0px","style":"none"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","bottom":"0px"},"blockGap":{"top":"0px","left":"0px"}}}} -->
       <div class="wp-block-columns alignfull" style="border-style:none;border-width:0px;margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:column {"style":{"spacing":{"blockGap":"0","padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}}},"className":"links"} -->
       <div class="wp-block-column links" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"overlayColor":"contrast","minHeight":820,"minHeightUnit":"px"} -->
       <div class="wp-block-cover" style="min-height:820px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
       <div class="wp-block-group" style="padding-top:0;padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:site-logo /-->
       
       <!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase"}},"fontSize":"medium"} -->
       <p class="has-medium-font-size" style="text-transform:uppercase">●&nbsp;<strong>Haurand.com</strong></p>
       <!-- /wp:paragraph -->
       
       <!-- wp:paragraph {"align":"left","placeholder":"Schreibe einen Titel…","fontSize":"large"} -->
       <p class="has-text-align-left has-large-font-size"><strong>Kreatives Design.</strong> <br><strong>Ein etwas anderes Design mit FSE</strong></p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons -->
       <div class="wp-block-buttons"><!-- wp:button -->
       <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Projekt starten</a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div>
       <!-- /wp:group --></div></div>
       <!-- /wp:cover --></div>
       <!-- /wp:column -->
       
       <!-- wp:column {"verticalAlignment":"top","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0px"},"border":{"width":"0px","style":"none"}},"className":"rechts"} -->
       <div class="wp-block-column is-vertically-aligned-top rechts" style="border-style:none;border-width:0px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"http://localhost/space4/wp-content/uploads/2023/01/Waterfall-37088.mp4","id":135,"dimRatio":60,"backgroundType":"video","minHeight":820,"minHeightUnit":"px","contentPosition":"center center","style":{"spacing":{"margin":{"top":"0px"}}}} -->
       <div class="wp-block-cover" style="margin-top:0px;min-height:820px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim"></span><video class="wp-block-cover__video-background intrinsic-ignore" autoplay muted loop playsinline src="http://localhost/space4/wp-content/uploads/2023/01/Waterfall-37088.mp4" data-object-fit="cover"></video><div class="wp-block-cover__inner-container"><!-- wp:columns {"style":{"spacing":{"padding":{"top":"0"}}}} -->
       <div class="wp-block-columns" style="padding-top:0"><!-- wp:column {"style":{"spacing":{"padding":{"top":"0","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
       <div class="wp-block-column" style="padding-top:0;padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"2em","bottom":"4em"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
       <div class="wp-block-group alignfull" style="padding-top:2em;padding-bottom:4em"><!-- wp:navigation {"ref":137,"overlayMenu":"always","layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"center"}} /--></div>
       <!-- /wp:group --></div>
       <!-- /wp:column --></div>
       <!-- /wp:columns -->
       
       <!-- wp:spacer {"height":"345px"} -->
       <div style="height:345px" aria-hidden="true" class="wp-block-spacer"></div>
       <!-- /wp:spacer --></div></div>
       <!-- /wp:cover --></div>
       <!-- /wp:column --></div>
       <!-- /wp:columns --></div>
       <!-- /wp:group -->',
        )
);

/* columns with negative margin */
register_block_pattern(
  'columns_with_negative_margin',
    array(
    'title' => __( 'columns with negative margin', 'columns_with_negative_margin' ),
    'description' => _x( 'columns with negative margin', 'columns with negative margin', 'columns_with_negative_margin' ),
    'categories'  => array('Patterns Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
       <div class="wp-block-group alignfull"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2018/10/kristopher-roller-110203-unsplash-scaled-1.jpg","id":165,"dimRatio":20,"minHeight":600,"align":"full"} -->
       <div class="wp-block-cover alignfull" style="min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-20 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-165" alt="" src="https://test5.haurand.com/wp-content/uploads/2018/10/kristopher-roller-110203-unsplash-scaled-1.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
       <p class="has-text-align-center has-large-font-size"></p>
       <!-- /wp:paragraph --></div></div>
       <!-- /wp:cover -->
       
       <!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
       <div class="wp-block-group alignfull"><!-- wp:columns {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}},"border":{"width":"0px","style":"none"}},"className":"negativ_margin"} -->
       <div class="wp-block-columns alignfull negativ_margin" style="border-style:none;border-width:0px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30"}},"color":{"background":"#68a8ad"}}} -->
       <div class="wp-block-column has-background" style="background-color:#68a8ad;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"white","fontSize":"large"} -->
       <h3 class="wp-block-heading has-white-color has-text-color has-link-color has-large-font-size">Two</h3>
       <!-- /wp:heading -->
       
       <!-- wp:paragraph {"textColor":"white"} -->
       <p class="has-white-color has-text-color">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
       <!-- /wp:paragraph --></div>
       <!-- /wp:column -->
       
       <!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30"}},"color":{"background":"#6c8672"}}} -->
       <div class="wp-block-column has-background" style="background-color:#6c8672;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"white","fontSize":"large"} -->
       <h3 class="wp-block-heading has-white-color has-text-color has-link-color has-large-font-size">Three</h3>
       <!-- /wp:heading -->
       
       <!-- wp:paragraph {"textColor":"white"} -->
       <p class="has-white-color has-text-color">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
       <!-- /wp:paragraph --></div>
       <!-- /wp:column -->
       
       <!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30"}},"color":{"background":"#f17d80"}}} -->
       <div class="wp-block-column has-background" style="background-color:#f17d80;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"white","fontSize":"large"} -->
       <h3 class="wp-block-heading has-white-color has-text-color has-link-color has-large-font-size">Four</h3>
       <!-- /wp:heading -->
       
       <!-- wp:paragraph {"textColor":"white"} -->
       <p class="has-white-color has-text-color">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
       <!-- /wp:paragraph --></div>
       <!-- /wp:column --></div>
       <!-- /wp:columns --></div>
       <!-- /wp:group --></div>
       <!-- /wp:group -->',
       )
);


/* Beispiel für gruppierte Spalten mit Bildern und Text (abwechselnd vollflächig Bild und Text als Cover) */
register_block_pattern(
  'group_with_colunns_and_images',
    array(
    'title' => __( 'Group with colunns and images', 'group_with_colunns_and_images' ),
    'description' => _x( 'Group with colunns and images', 'Group with colunns and images', 'group_with_colunns_and_images' ),
    'categories'  => array('Section Patterns Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group alignfull" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:columns {"align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"width":"0px","style":"none"}}} -->
        <div class="wp-block-columns alignfull" style="border-style:none;border-width:0px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"style":{"border":{"width":"0px","style":"none"},"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
        <div class="wp-block-column" style="border-style:none;border-width:0px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/10/katzenkinder.jpg","id":6602,"dimRatio":0,"overlayColor":"pale-cyan-blue","isDark":false,"align":"full"} -->
        <div class="wp-block-cover alignfull is-light"><span aria-hidden="true" class="wp-block-cover__background has-pale-cyan-blue-background-color has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-6602" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/10/katzenkinder.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Schreibe einen Titel…","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size"></p>
        <!-- /wp:paragraph --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"backgroundColor":"tertiary"} -->
        <div class="wp-block-column has-tertiary-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"overlayColor":"tertiary"} -->
        <div class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-tertiary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Schreibe einen Titel…","textColor":"foreground","fontSize":"large"} -->
        <p class="has-text-align-center has-foreground-color has-text-color has-large-font-size">Das sind wirklich niedliche Katzen</p>
        <!-- /wp:paragraph --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->

        <!-- wp:columns {"isStackedOnMobile":false,"align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"width":"0px","style":"none"}},"className":"fly_right"} -->
        <div class="wp-block-columns alignfull is-not-stacked-on-mobile fly_right" style="border-style:none;border-width:0px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"style":{"border":{"width":"0px","style":"none"}},"backgroundColor":"foreground"} -->
        <div class="wp-block-column has-foreground-background-color has-background" style="border-style:none;border-width:0px"><!-- wp:cover {"dimRatio":20,"overlayColor":"pale-pink","isDark":false,"align":"full"} -->
        <div class="wp-block-cover alignfull is-light"><span aria-hidden="true" class="wp-block-cover__background has-pale-pink-background-color has-background-dim-20 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Schreibe einen Titel…","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size">Das ist ein wunderbares Foto</p>
        <!-- /wp:paragraph --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
        <div class="wp-block-column" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg","id":6516,"dimRatio":0,"overlayColor":"pale-pink"} -->
        <div class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-pale-pink-background-color has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-6516" alt="Attendorn" src="https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Schreibe einen Titel…","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size"></p>
        <!-- /wp:paragraph --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->

        <!-- wp:columns {"align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"width":"0px","style":"none"}}} -->
        <div class="wp-block-columns alignfull" style="border-style:none;border-width:0px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
        <div class="wp-block-column" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg","id":6516,"dimRatio":0,"overlayColor":"pale-pink"} -->
        <div class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-pale-pink-background-color has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-6516" alt="Attendorn" src="https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Schreibe einen Titel…","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size"></p>
        <!-- /wp:paragraph --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"border":{"width":"0px","style":"none"}},"backgroundColor":"pale-pink"} -->
        <div class="wp-block-column has-pale-pink-background-color has-background" style="border-style:none;border-width:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/10/katzenkinder.jpg","id":6602,"dimRatio":20,"overlayColor":"pale-pink","isDark":false,"align":"full"} -->
        <div class="wp-block-cover alignfull is-light"><span aria-hidden="true" class="wp-block-cover__background has-pale-pink-background-color has-background-dim-20 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-6602" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/10/katzenkinder.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Schreibe einen Titel…","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size"></p>
        <!-- /wp:paragraph --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->

        <!-- wp:columns {"align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"width":"0px","style":"none"}}} -->
        <div class="wp-block-columns alignfull" style="border-style:none;border-width:0px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
        <div class="wp-block-column" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"backgroundColor":"pale-pink","layout":{"type":"constrained"}} -->
        <div class="wp-block-group has-pale-pink-background-color has-background"><!-- wp:cover {"overlayColor":"pale-pink","isDark":false} -->
        <div class="wp-block-cover is-light"><span aria-hidden="true" class="wp-block-cover__background has-pale-pink-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Schreibe einen Titel…","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size">Das ist rot</p>
        <!-- /wp:paragraph --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:group --></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"backgroundColor":"pale-cyan-blue","layout":{"type":"constrained"}} -->
        <div class="wp-block-group has-pale-cyan-blue-background-color has-background"><!-- wp:cover {"overlayColor":"pale-cyan-blue","isDark":false} -->
        <div class="wp-block-cover is-light"><span aria-hidden="true" class="wp-block-cover__background has-pale-cyan-blue-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Schreibe einen Titel…","fontSize":"large"} -->
        <p class="has-text-align-center has-large-font-size">Das ist blau</p>
        <!-- /wp:paragraph --></div></div>
        <!-- /wp:cover --></div>
        <!-- /wp:group --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns --></div>
        <!-- /wp:group -->',
    )
);


/* Bild mit einem überlappenden Text */
register_block_pattern(
  'image_with_overlapping_text',
    array(
    'title' => __( 'Image with overlapping Text', 'image_with_overlapping_text' ),
    'description' => _x( 'Image with overlapping Text', 'Image with overlapping Text', 'image_with_overlapping_text' ),
    'categories'  => array('Section Patterns Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"wide","layout":{"inherit":false}} -->
        <div class="wp-block-group alignwide"><!-- wp:columns {"align":"wide","className":"ungerade"} -->
        <div class="wp-block-columns alignwide ungerade"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:image {"id":5705,"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/landschaft_mit_gras_800.jpg" alt="" class="wp-image-5705"/></figure>
        <!-- /wp:image --></div>
        <!-- /wp:column -->

        <!-- wp:column {"style":{"spacing":{"padding":{"top":"20px","right":"20px","bottom":"20px","left":"20px"}},"color":{"background":"#1a444780"}},"className":"spalte_links_ueberlappend"} -->
        <div class="wp-block-column spalte_links_ueberlappend has-background" style="background-color:#1a444780;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:heading {"className":"text_ueberlappend"} -->
        <h2 class="wp-block-heading text_ueberlappend" id="uberlappender-text">Überlappender Text</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"className":"text_ueberlappend"} -->
        <p class="text_ueberlappend">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. <br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns -->

        <!-- wp:spacer {"height":"26px"} -->
        <div style="height:26px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:columns {"align":"wide","className":"gerade"} -->
        <div class="wp-block-columns alignwide gerade"><!-- wp:column {"style":{"color":{"background":"#1a454880"},"spacing":{"padding":{"top":"20px","right":"20px","bottom":"20px","left":"20px"}}},"className":"spalte_rechts_ueberlappend"} -->
        <div class="wp-block-column spalte_rechts_ueberlappend has-background" style="background-color:#1a454880;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><!-- wp:heading {"className":"text_ueberlappend"} -->
        <h2 class="wp-block-heading text_ueberlappend" id="das-ist-eine-uberschrift">Das ist eine Überschrift</h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"className":"text_ueberlappend"} -->
        <p class="text_ueberlappend">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <!-- /wp:paragraph --></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:image {"id":5704,"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/diepenbenden_800.jpg" alt="" class="wp-image-5704"/></figure>
        <!-- /wp:image --></div>
        <!-- /wp:column --></div>
        <!-- /wp:columns --></div>
        <!-- /wp:group -->',
        )
  );

  /* Bilder-Galerie-Leiste  */
register_block_pattern(
  'bilder_Galerie-leiste',
    array(
    'title' => __( 'Bilder-Galerie-Leiste', 'bilder_Galerie-leiste' ),
    'description' => _x( 'Bilder-Galerie-Leiste', 'Bilder-Galerie-Leiste', 'bilder_Galerie-leiste' ),
    'categories'  => array('Patterns Haurand'),
    'content'     =>
       '<!-- wp:gallery {"columns":6,"linkTo":"none","align":"full","style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->
       <figure class="wp-block-gallery alignfull has-nested-images columns-6 is-cropped"><!-- wp:image {"id":5727,"sizeSlug":"large","linkDestination":"none"} -->
       <figure class="wp-block-image size-large"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/weg_mit_sonne_und_schatten.jpg" alt="" class="wp-image-5727"/></figure>
       <!-- /wp:image -->
       
       <!-- wp:image {"id":5726,"sizeSlug":"large","linkDestination":"none"} -->
       <figure class="wp-block-image size-large"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/weg_mit_sonne_800.jpg" alt="" class="wp-image-5726"/></figure>
       <!-- /wp:image -->
       
       <!-- wp:image {"id":5725,"sizeSlug":"large","linkDestination":"none"} -->
       <figure class="wp-block-image size-large"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/wald_im_herbst_800.jpg" alt="Alt Text: Wald im Herbst" class="wp-image-5725"/><figcaption class="wp-element-caption">Caption: Wald im Herbst</figcaption></figure>
       <!-- /wp:image -->
       
       <!-- wp:image {"id":5724,"sizeSlug":"large","linkDestination":"none"} -->
       <figure class="wp-block-image size-large"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/stausee_800.jpg" alt="" class="wp-image-5724"/></figure>
       <!-- /wp:image -->
       
       <!-- wp:image {"id":5723,"sizeSlug":"large","linkDestination":"none"} -->
       <figure class="wp-block-image size-large"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021-1024x768.jpg" alt="" class="wp-image-5723"/></figure>
       <!-- /wp:image -->
       
       <!-- wp:image {"id":5714,"sizeSlug":"large","linkDestination":"none"} -->
       <figure class="wp-block-image size-large"><img src="https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Kuehe-1024x768.jpg" alt="" class="wp-image-5714"/></figure>
       <!-- /wp:image --></figure>
       <!-- /wp:gallery -->',
        )
);

  /* Block-Pattern-Section  */
register_block_pattern(
  'block-pattern-section',
    array(
    'title' => __( 'Block-Pattern-Section', 'block-pattern-section' ),
    'description' => _x( 'Block-Pattern-Section', 'Block-Pattern-Section', 'block-pattern-section' ),
    'categories'  => array('Section Patterns Haurand'),
    'content'     =>
       '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"30px","left":"0px"},"margin":{"top":"0px","bottom":"0px"},"blockGap":"0px"}},"layout":{"type":"constrained","contentSize":"1280px"}} -->
       <div class="wp-block-group alignwide" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:30px;padding-left:0px"><!-- wp:columns {"align":"full","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","bottom":"0px"},"blockGap":{"top":"0px","left":"0px"}}}} -->
       <div class="wp-block-columns alignfull" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:column -->
       <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
       <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg","id":6516,"dimRatio":50,"minHeight":300,"customGradient":"linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(255,198,47) 50%)","contentPosition":"bottom center","style":{"color":[]}} -->
       <div class="wp-block-cover has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(255,198,47) 50%)"></span><img class="wp-block-cover__image-background wp-image-6516" alt="Attendorn" src="https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"large"} -->
       <p class="has-text-align-center has-base-color has-text-color has-large-font-size">Ansicht Wald</p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
       <div class="wp-block-buttons"><!-- wp:button {"textAlign":"center"} -->
       <div class="wp-block-button"><a class="wp-block-button__link has-text-align-center wp-element-button">Hier klicken</a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div></div>
       <!-- /wp:cover -->
       
       <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
       <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
       <!-- /wp:heading -->
       
       <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
       <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons -->
       <div class="wp-block-buttons"><!-- wp:button {"textColor":"black","style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"10px","right":"25px","bottom":"10px","left":"25px"}},"border":{"radius":"0px"},"color":{"background":"#ffc62f"}}} -->
       <div class="wp-block-button has-custom-font-size" style="font-size:16px"><a class="wp-block-button__link has-black-color has-text-color has-background wp-element-button" style="border-radius:0px;background-color:#ffc62f;padding-top:10px;padding-right:25px;padding-bottom:10px;padding-left:25px">Read More</a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div>
       <!-- /wp:group --></div>
       <!-- /wp:column -->
       
       <!-- wp:column -->
       <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
       <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg","id":5723,"dimRatio":50,"minHeight":300,"customGradient":"linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(255,198,47) 50%)","contentPosition":"bottom center","style":{"color":[]}} -->
       <div class="wp-block-cover has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(255,198,47) 50%)"></span><img class="wp-block-cover__image-background wp-image-5723" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"large"} -->
       <p class="has-text-align-center has-base-color has-text-color has-large-font-size">Ansicht Sorrent</p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
       <div class="wp-block-buttons"><!-- wp:button {"textAlign":"center"} -->
       <div class="wp-block-button"><a class="wp-block-button__link has-text-align-center wp-element-button">Hier klicken</a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div></div>
       <!-- /wp:cover -->
       
       <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
       <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
       <!-- /wp:heading -->
       
       <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
       <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons -->
       <div class="wp-block-buttons"><!-- wp:button {"textColor":"black","style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"10px","right":"25px","bottom":"10px","left":"25px"}},"border":{"radius":"0px"},"color":{"background":"#ffc62f"}}} -->
       <div class="wp-block-button has-custom-font-size" style="font-size:16px"><a class="wp-block-button__link has-black-color has-text-color has-background wp-element-button" style="border-radius:0px;background-color:#ffc62f;padding-top:10px;padding-right:25px;padding-bottom:10px;padding-left:25px">Read More</a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div>
       <!-- /wp:group --></div>
       <!-- /wp:column -->
       
       <!-- wp:column -->
       <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
       <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Spielplatz_2-scaled.jpg","id":5720,"dimRatio":50,"minHeight":300,"customGradient":"linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(255,198,47) 50%)","contentPosition":"bottom center","style":{"color":[]}} -->
       <div class="wp-block-cover has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(255,198,47) 50%)"></span><img class="wp-block-cover__image-background wp-image-5720" alt="Alternative Text: Spielgerät" src="https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Spielplatz_2-scaled.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"large"} -->
       <p class="has-text-align-center has-base-color has-text-color has-large-font-size">Ansicht Spielplatz</p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
       <div class="wp-block-buttons"><!-- wp:button {"textAlign":"center"} -->
       <div class="wp-block-button"><a class="wp-block-button__link has-text-align-center wp-element-button">Hier klicken</a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div></div>
       <!-- /wp:cover -->
       
       <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
       <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
       <!-- /wp:heading -->
       
       <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
       <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
       <!-- /wp:paragraph -->
       
       <!-- wp:buttons -->
       <div class="wp-block-buttons"><!-- wp:button {"textColor":"black","style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"10px","right":"25px","bottom":"10px","left":"25px"}},"border":{"radius":"0px"},"color":{"background":"#ffc62f"}}} -->
       <div class="wp-block-button has-custom-font-size" style="font-size:16px"><a class="wp-block-button__link has-black-color has-text-color has-background wp-element-button" style="border-radius:0px;background-color:#ffc62f;padding-top:10px;padding-right:25px;padding-bottom:10px;padding-left:25px">Read More</a></div>
       <!-- /wp:button --></div>
       <!-- /wp:buttons --></div>
       <!-- /wp:group --></div>
       <!-- /wp:column --></div>
       <!-- /wp:columns --></div>
       <!-- /wp:group -->',
        )
);


  /* Block-Pattern-Section 2  */
  register_block_pattern(
    'block-pattern-section-2',
      array(
      'title' => __( 'Block-Pattern-Section 2', 'block-pattern-section-2' ),
      'description' => _x( 'Block-Pattern-Section 2', 'Block-Pattern-Section-2', 'block-pattern-section-2' ),
      'categories'  => array('Section Patterns Haurand'),
      'content'     =>
         '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"30px","left":"0px"},"margin":{"top":"0px","bottom":"0px"},"blockGap":"0px"}},"layout":{"type":"constrained","contentSize":"1280px"}} -->
         <div class="wp-block-group alignwide" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:30px;padding-left:0px"><!-- wp:columns {"align":"full","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","bottom":"0px"},"blockGap":{"top":"0px","left":"0px"}}}} -->
         <div class="wp-block-columns alignfull" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:column -->
         <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
         <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg","id":6516,"dimRatio":50,"minHeight":300,"customGradient":"linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(0,0,0) 50%)","contentPosition":"bottom center","isDark":false,"style":{"color":[]}} -->
         <div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(0,0,0) 50%)"></span><img class="wp-block-cover__image-background wp-image-6516" alt="Attendorn" src="https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"textColor":"base","fontSize":"large"} -->
         <p class="has-text-align-center has-base-color has-text-color has-large-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Wald</p>
         <!-- /wp:paragraph -->
         
         <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
         <div class="wp-block-buttons"><!-- wp:button {"textAlign":"center","backgroundColor":"luminous-vivid-amber"} -->
         <div class="wp-block-button"><a class="wp-block-button__link has-luminous-vivid-amber-background-color has-background has-text-align-center wp-element-button">Hier klicken</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons --></div></div>
         <!-- /wp:cover -->
         
         <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
         <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
         <!-- /wp:heading -->
         
         <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
         <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
         <!-- /wp:paragraph --></div>
         <!-- /wp:group --></div>
         <!-- /wp:column -->
         
         <!-- wp:column -->
         <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
         <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg","id":5723,"dimRatio":50,"minHeight":300,"customGradient":"linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(0,0,0) 50%)","contentPosition":"bottom center","isDark":false,"style":{"color":[]}} -->
         <div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(0,0,0) 50%)"></span><img class="wp-block-cover__image-background wp-image-5723" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"textColor":"base","fontSize":"large"} -->
         <p class="has-text-align-center has-base-color has-text-color has-large-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem">Ansicht Sorrent</p>
         <!-- /wp:paragraph -->
         
         <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
         <div class="wp-block-buttons"><!-- wp:button {"textAlign":"center","backgroundColor":"luminous-vivid-amber"} -->
         <div class="wp-block-button"><a class="wp-block-button__link has-luminous-vivid-amber-background-color has-background has-text-align-center wp-element-button">Hier klicken</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons --></div></div>
         <!-- /wp:cover -->
         
         <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
         <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
         <!-- /wp:heading -->
         
         <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
         <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
         <!-- /wp:paragraph --></div>
         <!-- /wp:group --></div>
         <!-- /wp:column -->
         
         <!-- wp:column -->
         <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
         <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Spielplatz_2-scaled.jpg","id":5720,"dimRatio":50,"minHeight":300,"customGradient":"linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(0,0,0) 50%)","contentPosition":"bottom center","isDark":false,"style":{"color":[]}} -->
         <div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(255,255,255,0) 50%,rgb(0,0,0) 50%)"></span><img class="wp-block-cover__image-background wp-image-5720" alt="Alternative Text: Spielgerät" src="https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Spielplatz_2-scaled.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"textColor":"base","fontSize":"large"} -->
         <p class="has-text-align-center has-base-color has-text-color has-large-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem">Ansicht Spielplatz</p>
         <!-- /wp:paragraph -->
         
         <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
         <div class="wp-block-buttons"><!-- wp:button {"textAlign":"center","backgroundColor":"luminous-vivid-amber"} -->
         <div class="wp-block-button"><a class="wp-block-button__link has-luminous-vivid-amber-background-color has-background has-text-align-center wp-element-button">Hier klicken</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons --></div></div>
         <!-- /wp:cover -->
         
         <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
         <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
         <!-- /wp:heading -->
         
         <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
         <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
         <!-- /wp:paragraph --></div>
         <!-- /wp:group --></div>
         <!-- /wp:column --></div>
         <!-- /wp:columns --></div>
         <!-- /wp:group -->',
          )
  );

  /* Block-Pattern-Section 3  */
  register_block_pattern(
    'block-pattern-section-3',
      array(
      'title' => __( 'Block-Pattern-Section 3', 'block-pattern-section-3' ),
      'description' => _x( 'Block-Pattern-Section 3', 'Block-Pattern-Section-3', 'block-pattern-section-3' ),
      'categories'  => array('Section Patterns Haurand'),
      'content'     =>
         '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"30px","left":"0px"},"margin":{"top":"0px","bottom":"0px"},"blockGap":"0px"}},"layout":{"type":"constrained","contentSize":"1280px"}} -->
         <div class="wp-block-group alignwide" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:30px;padding-left:0px"><!-- wp:columns {"align":"full","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":{"top":"1rem","left":"1rem"}}}} -->
         <div class="wp-block-columns alignfull" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:column {"width":"25%"} -->
         <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
         <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg","id":6516,"dimRatio":50,"minHeight":250,"customGradient":"linear-gradient(180deg,rgb(0,0,0) 25%,rgba(255,255,255,0) 25%)","contentPosition":"top center","style":{"color":[],"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
         <div class="wp-block-cover has-custom-content-position is-position-top-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:250px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(0,0,0) 25%,rgba(255,255,255,0) 25%)"></span><img class="wp-block-cover__image-background wp-image-6516" alt="Attendorn" src="https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"className":"bps_fontsize","fontSize":"medium"} -->
         <p class="has-text-align-center bps_fontsize has-medium-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Wald</p>
         <!-- /wp:paragraph -->
         
         <!-- wp:spacer -->
         <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
         <!-- /wp:spacer -->
         
         <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
         <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"black","style":{"border":{"radius":"40px"}}} -->
         <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-primary-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:40px">Hier klicken</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons --></div></div>
         <!-- /wp:cover -->
         
         <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
         <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
         <!-- /wp:heading -->
         
         <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
         <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
         <!-- /wp:paragraph --></div>
         <!-- /wp:group --></div>
         <!-- /wp:column -->
         
         <!-- wp:column {"width":"25%"} -->
         <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
         <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg","id":5723,"dimRatio":50,"minHeight":250,"customGradient":"linear-gradient(180deg,rgb(0,0,0) 25%,rgba(255,255,255,0) 25%)","contentPosition":"top center","style":{"color":[],"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
         <div class="wp-block-cover has-custom-content-position is-position-top-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:250px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(0,0,0) 25%,rgba(255,255,255,0) 25%)"></span><img class="wp-block-cover__image-background wp-image-5723" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"className":"bps_fontsize","fontSize":"medium"} -->
         <p class="has-text-align-center bps_fontsize has-medium-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Sorrent</p>
         <!-- /wp:paragraph -->
         
         <!-- wp:spacer -->
         <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
         <!-- /wp:spacer -->
         
         <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
         <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"black","style":{"border":{"radius":"40px"}}} -->
         <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-primary-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:40px">Hier klicken</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons --></div></div>
         <!-- /wp:cover -->
         
         <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
         <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
         <!-- /wp:heading -->
         
         <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
         <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
         <!-- /wp:paragraph --></div>
         <!-- /wp:group --></div>
         <!-- /wp:column -->
         
         <!-- wp:column {"width":"25%"} -->
         <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
         <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Spielplatz_2-scaled.jpg","id":5720,"dimRatio":50,"minHeight":250,"customGradient":"linear-gradient(180deg,rgb(0,0,0) 25%,rgba(255,255,255,0) 25%)","contentPosition":"top center","style":{"color":[],"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
         <div class="wp-block-cover has-custom-content-position is-position-top-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:250px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(0,0,0) 25%,rgba(255,255,255,0) 25%)"></span><img class="wp-block-cover__image-background wp-image-5720" alt="Alternative Text: Spielgerät" src="https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Spielplatz_2-scaled.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"className":"bps_fontsize","fontSize":"medium"} -->
         <p class="has-text-align-center bps_fontsize has-medium-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Spielplatz</p>
         <!-- /wp:paragraph -->
         
         <!-- wp:spacer -->
         <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
         <!-- /wp:spacer -->
         
         <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
         <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"black","style":{"border":{"radius":"40px"}}} -->
         <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-primary-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:40px">Hier klicken</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons --></div></div>
         <!-- /wp:cover -->
         
         <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
         <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
         <!-- /wp:heading -->
         
         <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
         <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
         <!-- /wp:paragraph --></div>
         <!-- /wp:group --></div>
         <!-- /wp:column -->
         
         <!-- wp:column {"width":"25%"} -->
         <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
         <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/stausee_800.jpg","id":5724,"dimRatio":50,"minHeight":250,"customGradient":"linear-gradient(180deg,rgb(0,0,0) 25%,rgba(255,255,255,0) 25%)","contentPosition":"top center","style":{"color":[],"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
         <div class="wp-block-cover has-custom-content-position is-position-top-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:250px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(0,0,0) 25%,rgba(255,255,255,0) 25%)"></span><img class="wp-block-cover__image-background wp-image-5724" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/01/stausee_800.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"className":"bps_fontsize","fontSize":"medium"} -->
         <p class="has-text-align-center bps_fontsize has-medium-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Landschaft</p>
         <!-- /wp:paragraph -->
         
         <!-- wp:spacer -->
         <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
         <!-- /wp:spacer -->
         
         <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
         <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"black","style":{"border":{"radius":"40px"}}} -->
         <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-primary-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:40px">Hier klicken</a></div>
         <!-- /wp:button --></div>
         <!-- /wp:buttons --></div></div>
         <!-- /wp:cover -->
         
         <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
         <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
         <!-- /wp:heading -->
         
         <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
         <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
         <!-- /wp:paragraph --></div>
         <!-- /wp:group --></div>
         <!-- /wp:column --></div>
         <!-- /wp:columns --></div>
         <!-- /wp:group -->',
          )
  );


    /* Block-Pattern-Section 4  */
    register_block_pattern(
      'block-pattern-section-4',
        array(
        'title' => __( 'Block-Pattern-Section 4', 'block-pattern-section-4' ),
        'description' => _x( 'Block-Pattern-Section 4', 'Block-Pattern-Section-4', 'block-pattern-section-4' ),
        'categories'  => array('Section Patterns Haurand'),
        'content'     =>
           '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"30px","left":"0px"},"margin":{"top":"0px","bottom":"0px"},"blockGap":"0px"}},"layout":{"type":"constrained","contentSize":"1280px"}} -->
           <div class="wp-block-group alignwide" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:30px;padding-left:0px"><!-- wp:columns {"align":"full","style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":{"top":"1rem","left":"1rem"}}}} -->
           <div class="wp-block-columns alignfull" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:column {"width":"25%"} -->
           <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
           <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg","id":6516,"minHeight":250,"customGradient":"linear-gradient(180deg,rgb(165,16,16) 25%,rgba(0,0,0,0) 25%)","contentPosition":"top center","style":{"color":[],"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
           <div class="wp-block-cover has-custom-content-position is-position-top-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:250px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(165,16,16) 25%,rgba(0,0,0,0) 25%)"></span><img class="wp-block-cover__image-background wp-image-6516" alt="Attendorn" src="https://test5.haurand.com/wp-content/uploads/2022/07/attendorn_3.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"className":"bps_fontsize","fontSize":"medium"} -->
           <p class="has-text-align-center bps_fontsize has-medium-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Wald</p>
           <!-- /wp:paragraph -->
           
           <!-- wp:spacer -->
           <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
           <!-- /wp:spacer -->
           
           <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
           <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"black","style":{"border":{"radius":"40px"}}} -->
           <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-primary-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:40px">Hier klicken</a></div>
           <!-- /wp:button --></div>
           <!-- /wp:buttons --></div></div>
           <!-- /wp:cover -->
           
           <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
           <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
           <!-- /wp:heading -->
           
           <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
           <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
           <!-- /wp:paragraph --></div>
           <!-- /wp:group --></div>
           <!-- /wp:column -->
           
           <!-- wp:column {"width":"25%"} -->
           <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
           <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg","id":5723,"minHeight":250,"customGradient":"linear-gradient(180deg,rgb(165,16,16) 25%,rgba(0,0,0,0) 25%)","contentPosition":"top center","style":{"color":[],"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
           <div class="wp-block-cover has-custom-content-position is-position-top-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:250px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(165,16,16) 25%,rgba(0,0,0,0) 25%)"></span><img class="wp-block-cover__image-background wp-image-5723" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/01/sorrent_2021.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"className":"bps_fontsize","fontSize":"medium"} -->
           <p class="has-text-align-center bps_fontsize has-medium-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Sorrent</p>
           <!-- /wp:paragraph -->
           
           <!-- wp:spacer -->
           <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
           <!-- /wp:spacer -->
           
           <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
           <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"black","style":{"border":{"radius":"40px"}}} -->
           <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-primary-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:40px">Hier klicken</a></div>
           <!-- /wp:button --></div>
           <!-- /wp:buttons --></div></div>
           <!-- /wp:cover -->
           
           <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
           <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
           <!-- /wp:heading -->
           
           <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
           <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
           <!-- /wp:paragraph --></div>
           <!-- /wp:group --></div>
           <!-- /wp:column -->
           
           <!-- wp:column {"width":"25%"} -->
           <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
           <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Spielplatz_2-scaled.jpg","id":5720,"minHeight":250,"customGradient":"linear-gradient(180deg,rgb(165,16,16) 25%,rgba(255,255,255,0) 25%)","contentPosition":"top center","style":{"color":[],"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
           <div class="wp-block-cover has-custom-content-position is-position-top-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:250px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(165,16,16) 25%,rgba(255,255,255,0) 25%)"></span><img class="wp-block-cover__image-background wp-image-5720" alt="Alternative Text: Spielgerät" src="https://test5.haurand.com/wp-content/uploads/2022/01/Platzhalter_Spielplatz_2-scaled.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"className":"bps_fontsize","fontSize":"medium"} -->
           <p class="has-text-align-center bps_fontsize has-medium-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Spielplatz</p>
           <!-- /wp:paragraph -->
           
           <!-- wp:spacer -->
           <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
           <!-- /wp:spacer -->
           
           <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
           <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"black","style":{"border":{"radius":"40px"}}} -->
           <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-primary-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:40px">Hier klicken</a></div>
           <!-- /wp:button --></div>
           <!-- /wp:buttons --></div></div>
           <!-- /wp:cover -->
           
           <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
           <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
           <!-- /wp:heading -->
           
           <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
           <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
           <!-- /wp:paragraph --></div>
           <!-- /wp:group --></div>
           <!-- /wp:column -->
           
           <!-- wp:column {"width":"25%"} -->
           <div class="wp-block-column" style="flex-basis:25%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"blockGap":"0px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
           <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2022/01/stausee_800.jpg","id":5724,"minHeight":250,"customGradient":"linear-gradient(180deg,rgb(165,16,16) 25%,rgba(255,255,255,0) 25%)","contentPosition":"top center","style":{"color":[],"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
           <div class="wp-block-cover has-custom-content-position is-position-top-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30);padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:250px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(165,16,16) 25%,rgba(255,255,255,0) 25%)"></span><img class="wp-block-cover__image-background wp-image-5724" alt="" src="https://test5.haurand.com/wp-content/uploads/2022/01/stausee_800.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}}},"className":"bps_fontsize","fontSize":"medium"} -->
           <p class="has-text-align-center bps_fontsize has-medium-font-size" style="margin-top:1rem;margin-right:1rem;margin-bottom:1rem;margin-left:1rem;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">Ansicht Landschaft</p>
           <!-- /wp:paragraph -->
           
           <!-- wp:spacer -->
           <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
           <!-- /wp:spacer -->
           
           <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"0","margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
           <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:button {"textAlign":"center","backgroundColor":"primary","textColor":"black","style":{"border":{"radius":"40px"}}} -->
           <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-primary-background-color has-text-color has-background has-text-align-center wp-element-button" style="border-radius:40px">Hier klicken</a></div>
           <!-- /wp:button --></div>
           <!-- /wp:buttons --></div></div>
           <!-- /wp:cover -->
           
           <!-- wp:heading {"style":{"typography":{"fontSize":"26px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"20px","right":"0px","bottom":"20px","left":"0px"}}}} -->
           <h2 class="wp-block-heading" style="margin-top:20px;margin-right:0px;margin-bottom:20px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:26px;font-style:normal;font-weight:500">Lorem ipsum dolor</h2>
           <!-- /wp:heading -->
           
           <!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"},"margin":{"top":"0px","right":"0px","bottom":"30px","left":"0px"}}}} -->
           <p style="margin-top:0px;margin-right:0px;margin-bottom:30px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;font-size:16px">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text.</p>
           <!-- /wp:paragraph --></div>
           <!-- /wp:group --></div>
           <!-- /wp:column --></div>
           <!-- /wp:columns --></div>
           <!-- /wp:group -->',
            )
    );



    /* Block-Pattern-Section 5  */
    register_block_pattern(
      'block-pattern-section-5',
        array(
        'title' => __( 'Block-Pattern-Section 5', 'block-pattern-section-5' ),
        'description' => _x( 'Block-Pattern-Section 5', 'Block-Pattern-Section-5', 'block-pattern-section-5' ),
        'categories'  => array('Section Patterns Haurand'),
        'content'     =>
           '<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
           <div class="wp-block-group alignwide"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->
           <div class="wp-block-columns alignwide"><!-- wp:column -->
           <div class="wp-block-column"><!-- wp:cover {"url":"https://space2.yd-sgs.de/wp-content/uploads/2023/01/sorrent_2021.jpg","id":69,"dimRatio":0,"minHeight":300,"contentPosition":"bottom center"} -->
           <div class="wp-block-cover has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-69" alt="" src="https://space2.yd-sgs.de/wp-content/uploads/2023/01/sorrent_2021.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","style":{"color":{"background":"#00000073"},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"1.3rem"}}} -->
           <p class="has-text-align-center has-background" style="background-color:#00000073;font-size:1.3rem;font-style:normal;font-weight:600">Ansicht Sorrent</p>
           <!-- /wp:paragraph -->
           
           <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
           <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"luminous-vivid-amber","fontSize":"medium"} -->
           <div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-luminous-vivid-amber-background-color has-background wp-element-button">Read More</a></div>
           <!-- /wp:button --></div>
           <!-- /wp:buttons --></div></div>
           <!-- /wp:cover -->
           
           <!-- wp:heading {"style":{"spacing":{"padding":{"left":"5px"}}},"fontSize":"large"} -->
           <h2 class="wp-block-heading has-large-font-size" style="padding-left:5px">Sorrent</h2>
           <!-- /wp:heading -->
           
           <!-- wp:paragraph {"style":{"spacing":{"padding":{"right":"5px","left":"5px","bottom":"7rem"}}}} -->
           <p style="padding-right:5px;padding-bottom:7rem;padding-left:5px">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </p>
           <!-- /wp:paragraph --></div>
           <!-- /wp:column -->
           
           <!-- wp:column -->
           <div class="wp-block-column"><!-- wp:cover {"url":"https://space2.yd-sgs.de/wp-content/uploads/2023/01/sonnenaufgang_im_winter.jpg","id":66,"dimRatio":0,"minHeight":300,"contentPosition":"bottom center"} -->
           <div class="wp-block-cover has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-66" alt="" src="https://space2.yd-sgs.de/wp-content/uploads/2023/01/sonnenaufgang_im_winter.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","style":{"color":{"background":"#00000073"},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"1.3rem"}}} -->
           <p class="has-text-align-center has-background" style="background-color:#00000073;font-size:1.3rem;font-style:normal;font-weight:600">Ansicht Morgenstimmung</p>
           <!-- /wp:paragraph -->
           
           <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
           <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"luminous-vivid-amber","fontSize":"medium"} -->
           <div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-luminous-vivid-amber-background-color has-background wp-element-button">Read More</a></div>
           <!-- /wp:button --></div>
           <!-- /wp:buttons --></div></div>
           <!-- /wp:cover -->
           
           <!-- wp:heading {"style":{"spacing":{"padding":{"left":"5px"}}},"fontSize":"large"} -->
           <h2 class="wp-block-heading has-large-font-size" style="padding-left:5px">Morgenstimmung</h2>
           <!-- /wp:heading -->
           
           <!-- wp:paragraph {"style":{"spacing":{"padding":{"right":"5px","left":"5px","bottom":"7rem"}}}} -->
           <p style="padding-right:5px;padding-bottom:7rem;padding-left:5px">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </p>
           <!-- /wp:paragraph --></div>
           <!-- /wp:column -->
           
           <!-- wp:column -->
           <div class="wp-block-column"><!-- wp:cover {"url":"https://space2.yd-sgs.de/wp-content/uploads/2023/01/IMG_20200731_195912-scaled.jpg","id":31,"dimRatio":0,"minHeight":300,"contentPosition":"bottom center","isDark":false} -->
           <div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center" style="min-height:300px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-31" alt="" src="https://space2.yd-sgs.de/wp-content/uploads/2023/01/IMG_20200731_195912-scaled.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","style":{"color":{"background":"#00000073"},"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"1.3rem"}},"textColor":"base"} -->
           <p class="has-text-align-center has-base-color has-text-color has-background" style="background-color:#00000073;font-size:1.3rem;font-style:normal;font-weight:600">Ansicht Landschaft</p>
           <!-- /wp:paragraph -->
           
           <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
           <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"luminous-vivid-amber","fontSize":"medium"} -->
           <div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-luminous-vivid-amber-background-color has-background wp-element-button">Read More</a></div>
           <!-- /wp:button --></div>
           <!-- /wp:buttons --></div></div>
           <!-- /wp:cover -->
           
           <!-- wp:heading {"style":{"spacing":{"padding":{"left":"5px"}}},"fontSize":"large"} -->
           <h2 class="wp-block-heading has-large-font-size" style="padding-left:5px">Landschaft</h2>
           <!-- /wp:heading -->
           
           <!-- wp:paragraph {"style":{"spacing":{"padding":{"right":"5px","left":"5px","bottom":"7rem"}}}} -->
           <p style="padding-right:5px;padding-bottom:7rem;padding-left:5px">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. </p>
           <!-- /wp:paragraph --></div>
           <!-- /wp:column --></div>
           <!-- /wp:columns --></div>
           <!-- /wp:group -->',
            )
    );

    /* Block-Pattern-call-to-action  */
    register_block_pattern(
      'block-pattern-call-to-action',
        array(
        'title' => __( 'Block Pattern call to action', 'block-pattern-call-to-action' ),
        'description' => _x( 'Block Pattern call to action', 'Block Pattern call to action', 'block-pattern-call-to-action' ),
        'categories'  => array('Patterns Haurand'),
        'content'     =>
           '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"layout":{"type":"constrained"}} -->
           <div class="wp-block-group alignwide" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://test5.haurand.com/wp-content/uploads/2023/04/kletterhalle_2-jpg.webp","id":7073,"dimRatio":80,"minHeight":100,"minHeightUnit":"vh","customGradient":"linear-gradient(135deg,rgba(255,255,255,0) 50%,rgb(21,41,139) 50%)","contentPosition":"bottom right","align":"wide","className":"square_image","style":{"color":{}}} -->
           <div class="wp-block-cover alignwide has-custom-content-position is-position-bottom-right square_image" style="min-height:100vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-80 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(135deg,rgba(255,255,255,0) 50%,rgb(21,41,139) 50%)"></span><img class="wp-block-cover__image-background wp-image-7073" alt="" src="https://test5.haurand.com/wp-content/uploads/2023/04/kletterhalle_2-jpg.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:columns -->
           <div class="wp-block-columns"><!-- wp:column {"width":"66.66%"} -->
           <div class="wp-block-column" style="flex-basis:66.66%"></div>
           <!-- /wp:column -->
           
           <!-- wp:column {"width":"33.33%","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
           <div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);flex-basis:33.33%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"1rem","right":"1rem","bottom":"1rem","left":"1rem"}},"color":{"background":"#ffffffd4"}},"textColor":"background","layout":{"type":"constrained"}} -->
           <div class="wp-block-group has-background-color has-text-color has-background" style="background-color:#ffffffd4;padding-top:1rem;padding-right:1rem;padding-bottom:1rem;padding-left:1rem"><!-- wp:heading {"fontSize":"large"} -->
           <h2 class="wp-block-heading has-large-font-size">Eine Überschrift</h2>
           <!-- /wp:heading -->
           
           <!-- wp:paragraph {"align":"left","placeholder":"Schreibe einen Titel…","fontSize":"small"} -->
           <p class="has-text-align-left has-small-font-size">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.  </p>
           <!-- /wp:paragraph -->
           
           <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
           <div class="wp-block-buttons"><!-- wp:button {"textAlign":"center"} -->
           <div class="wp-block-button"><a class="wp-block-button__link has-text-align-center wp-element-button">Read More</a></div>
           <!-- /wp:button --></div>
           <!-- /wp:buttons --></div>
           <!-- /wp:group --></div>
           <!-- /wp:column --></div>
           <!-- /wp:columns --></div></div>
           <!-- /wp:cover --></div>
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

  

