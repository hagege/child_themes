<?php
	/**
		* Title: Banner as example for a landing page
		* Slug: circles/landing-page-example
		* Categories: circles, banner, call-to-action
	*/
?>
<!-- wp:group {"tagName":"main","align":"wide","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignwide"><!-- wp:spacer {"height":"30px"} -->
	<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
	
	<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull"><!-- wp:cover {"overlayColor":"contrast-2","isUserOverlayColor":true,"minHeight":500,"isDark":false,"align":"full","layout":{"type":"default"}} -->
		<div class="wp-block-cover alignfull is-light" style="min-height:500px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-2-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","style":{"typography":{"fontSize":"10rem"}}} -->
			<p class="has-text-align-center" style="font-size:10rem">Our new Start Page</p>
		<!-- /wp:paragraph --></div></div>
	<!-- /wp:cover --></div>
	<!-- /wp:group -->
	
	<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull"><!-- wp:cover {"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/wordcamp_images_1920_023.webp","dimRatio":0,"customOverlayColor":"#667fa6","isUserOverlayColor":true,"align":"full","layout":{"type":"constrained"}} -->
		<div class="wp-block-cover alignfull"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim" style="background-color:#667fa6"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/wordcamp_images_1920_023.webp" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}},"color":{"background":"#2626266e"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-background" style="background-color:#2626266e;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"x-large"} -->
				<h2 class="wp-block-heading has-text-align-center has-x-large-font-size" style="font-style:normal;font-weight:500">Wonderful Image</h2>
				<!-- /wp:heading -->
				
				<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
				<div class="wp-block-buttons"><!-- wp:button {"textAlign":"left"} -->
					<div class="wp-block-button"><a class="wp-block-button__link has-text-align-left wp-element-button" href="#">Read more</a></div>
				<!-- /wp:button --></div>
			<!-- /wp:buttons --></div>
		<!-- /wp:group --></div></div>
	<!-- /wp:cover --></div>
	<!-- /wp:group -->
	
	<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull"><!-- wp:cover {"overlayColor":"contrast-3","isUserOverlayColor":true,"minHeight":500,"isDark":false,"align":"full","layout":{"type":"default"}} -->
		<div class="wp-block-cover alignfull is-light" style="min-height:500px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-3-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"left","placeholder":"Write title…","style":{"typography":{"fontSize":"6rem"}}} -->
			<p class="has-text-align-left" style="font-size:6rem">Second Cover</p>
		<!-- /wp:paragraph --></div></div>
	<!-- /wp:cover --></div>
	<!-- /wp:group -->
	
	<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull"><!-- wp:cover {"overlayColor":"contrast","isUserOverlayColor":true,"minHeight":500,"isDark":false,"align":"full","layout":{"type":"default"}} -->
		<div class="wp-block-cover alignfull is-light" style="min-height:500px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"right","placeholder":"Write title…","style":{"typography":{"fontSize":"6rem"}}} -->
			<p class="has-text-align-right" style="font-size:6rem">Third Cover</p>
		<!-- /wp:paragraph --></div></div>
	<!-- /wp:cover --></div>
	<!-- /wp:group -->
	
	<!-- wp:group {"layout":{"type":"constrained","contentSize":""}} -->
	<div class="wp-block-group"><!-- wp:separator -->
		<hr class="wp-block-separator has-alpha-channel-opacity"/>
		<!-- /wp:separator -->
		
		<!-- wp:spacer {"height":"30px"} -->
		<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->
		
		<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide"><!-- wp:heading {"align":"wide"} -->
			<h2 class="wp-block-heading alignwide">Posts</h2>
			<!-- /wp:heading -->
			
			<!-- wp:query {"queryId":9,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"enhancedPagination":true,"metadata":{"categories":["posts"],"patternName":"core/query-standard-posts","name":"Standard"},"align":"wide"} -->
			<div class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":"2"}} -->
				<!-- wp:post-title {"isLink":true} /-->
				
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","align":"wide"} /-->
				
				<!-- wp:post-excerpt /-->
				
				<!-- wp:separator {"opacity":"css"} -->
				<hr class="wp-block-separator has-css-opacity"/>
				<!-- /wp:separator -->
				
				<!-- wp:post-date /-->
				
				<!-- wp:spacer -->
				<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->
				<!-- /wp:post-template -->
				
				<!-- wp:query-pagination -->
				<!-- wp:query-pagination-previous /-->
				
				<!-- wp:query-pagination-numbers /-->
				
				<!-- wp:query-pagination-next /-->
			<!-- /wp:query-pagination --></div>
		<!-- /wp:query --></div>
	<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->