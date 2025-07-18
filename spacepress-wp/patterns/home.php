<?php
	/**
		* Title: home
		* Slug: spacepress-wp/home
		* Inserter: no
	*/
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"categories":["banner"],"patternName":"spacepress-wp/text-left-and-image-right","name":"Text left and Image right"},"className":"alignfull is-style-section-default has-custom-weiss-color has-custom-rostrot-background-color has-text-color has-background has-link-color"} -->
	<div class="wp-block-group alignfull is-style-section-default has-custom-weiss-color has-custom-rostrot-background-color has-text-color has-background has-link-color"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"base-2","textColor":"base"} -->
		<div class="wp-block-columns alignwide are-vertically-aligned-center has-base-color has-base-2-background-color has-text-color has-background has-link-color"><!-- wp:column {"verticalAlignment":"center","width":"50%","layout":{"type":"default"}} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|custom-weiss"}}}},"textColor":"custom-weiss","fontSize":"xx-large"} -->
				<h1 class="wp-block-heading has-custom-weiss-color has-text-color has-link-color has-xx-large-font-size"><?php esc_html_e('Welcome in this great town', 'spacepress-wp');?></h1>
				<!-- /wp:heading -->
				
				<!-- wp:paragraph -->
				<p><?php esc_html_e('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'spacepress-wp');?></p>
				<!-- /wp:paragraph -->
				
				<!-- wp:group {"layout":{"type":"constrained"}} -->
				<div class="wp-block-group"><!-- wp:paragraph {"className":"haurand-button-blau"} -->
					<p class="haurand-button-blau"><?php /* Translators: 1. is the start of a 'a' HTML element, 2. is the end of a 'a' HTML element */ 
					echo sprintf( esc_html__( '%1$sRead More%2$s', 'spacepress-wp' ), '<a href="' . esc_url( 'https://haurand.com' ) . '">', '</a>' ); ?></p>
				<!-- /wp:paragraph --></div>
			<!-- /wp:group --></div>
			<!-- /wp:column -->
			
			<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"lightbox":{"enabled":true},"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/attendorn_marktplatz_2022.webp" alt="" style="aspect-ratio:1;object-fit:cover"/></figure>
			<!-- /wp:image --></div>
		<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
	<!-- /wp:group -->
	
	<!-- wp:cover {"overlayColor":"base","isUserOverlayColor":true,"isDark":false,"metadata":{"categories":["spacepress-wp","call-to-action"],"patternName":"spacepress-wp/hero","name":"Hero"},"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|base-2"}}}},"textColor":"base-2"} -->
	<div class="wp-block-cover alignfull is-light has-base-2-color has-text-color has-link-color"><span aria-hidden="true" class="wp-block-cover__background has-base-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"2.5rem"}},"layout":{"type":"constrained","wideSize":"%","contentSize":"75%"}} -->
		<div class="wp-block-group"><!-- wp:heading {"textAlign":"center"} -->
			<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e('Welcome to My Site', 'spacepress-wp');?></h2>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"><?php esc_html_e('This is my little home away from home. Here, you will get to know me.  I\'ll share my likes, hobbies, and more.  Every now and then, I\'ll even have something interesting to say in a blog post.', 'spacepress-wp');?></p>
			<!-- /wp:paragraph -->
			
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e('See My Popular Posts →︎', 'spacepress-wp');?></a></div>
			<!-- /wp:button --></div>
		<!-- /wp:buttons --></div>
	<!-- /wp:group --></div></div>
	<!-- /wp:cover -->
	
	<!-- wp:group {"metadata":{"categories":["banner"],"patternName":"spacepress-wp/text-left-and-images-right","name":"Text left and Images right"},"className":"alignfull is-style-section-default has-base-color has-base-2-background-color has-text-color has-background has-link-color","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group alignfull is-style-section-default has-base-color has-base-2-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide"><!-- wp:column -->
			<div class="wp-block-column"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|custom-weiss"}}}},"textColor":"custom-weiss","fontSize":"x-large"} -->
				<h2 class="wp-block-heading has-custom-weiss-color has-text-color has-link-color has-x-large-font-size"><?php esc_html_e('Great landscape', 'spacepress-wp');?></h2>
				<!-- /wp:heading -->
				
				<!-- wp:paragraph -->
				<p><?php esc_html_e('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'spacepress-wp');?></p>
				<!-- /wp:paragraph -->
				
				<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
				<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->
				
				<!-- wp:image {"lightbox":{"enabled":true},"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/power_tour_06_2024_04.webp" alt="" style="aspect-ratio:1;object-fit:cover"/></figure>
			<!-- /wp:image --></div>
			<!-- /wp:column -->
			
			<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
			<div class="wp-block-column"><!-- wp:image {"lightbox":{"enabled":true},"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/power_tour_06_2024_17.webp" alt="" style="aspect-ratio:4/3;object-fit:cover"/></figure>
				<!-- /wp:image -->
				
				<!-- wp:image {"lightbox":{"enabled":true},"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/power_tour_06_2024_02.webp" alt="" style="aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image --></div>
		<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
	<!-- /wp:group -->
	
	<!-- wp:query-title {"type":"archive","align":"wide","style":{"typography":{"lineHeight":"1"}}} /-->
	
	<!-- wp:query {"queryId":4,"query":{"perPage":4,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"enhancedPagination":true,"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide"><!-- wp:query-no-results -->
		<!-- wp:paragraph -->
		<p><?php esc_html_e('No posts were found.', 'spacepress-wp');?></p>
		<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
		
		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:0;padding-bottom:var(--wp--preset--spacing--50);padding-left:0"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":2}} -->
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"spacing":{"margin":{"bottom":"0"},"padding":{"bottom":"var:preset|spacing|20"}}}} /-->
			
			<!-- wp:group {"style":{"spacing":{"blockGap":"10px","margin":{"top":"var:preset|spacing|40","bottom":"5em"},"padding":{"top":"0em"}}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap","verticalAlignment":"top"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:5em;padding-top:0em"><!-- wp:post-title {"isLink":true,"style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}},"fontSize":"large"} /-->
				
				<!-- wp:post-excerpt {"moreText":"Read more","excerptLength":40,"style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}}} /-->
				
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group"><!-- wp:post-date /-->
					
					<!-- wp:paragraph -->
					<p><?php esc_html_e('-', 'spacepress-wp');?></p>
					<!-- /wp:paragraph -->
					
				<!-- wp:post-author {"showAvatar":false} /--></div>
			<!-- /wp:group --></div>
			<!-- /wp:group -->
			<!-- /wp:post-template -->
			
			<!-- wp:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			
			<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
			<!-- wp:query-pagination-previous /-->
			
			<!-- wp:query-pagination-numbers /-->
			
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination --></div>
	<!-- /wp:group --></div>
	<!-- /wp:query -->
	
	<!-- wp:spacer {"height":"30px"} -->
	<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></main>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"footer","area":"footer"} /-->