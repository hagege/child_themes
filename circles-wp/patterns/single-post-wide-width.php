<?php
	/**
		* Title: single-post-wide-width
		* Slug: circles-wp/single-post-wide-width
		* Inserter: no
	*/
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull"><!-- wp:group {"align":"full","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/circle_light_orange.svg","id":6935,"source":"file","title":"circle_light_orange"},"backgroundPosition":"35% 42%"},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30","top":"0","bottom":"0"}},"dimensions":{"minHeight":"100vh"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull" style="min-height:100vh;padding-top:0;padding-right:var(--wp--preset--spacing--30);padding-bottom:0;padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-featured-image {"height":"25em","align":"full"} /-->
			
			<!-- wp:post-title {"level":1,"align":"wide","style":{"spacing":{"padding":{"top":"1em"},"margin":{"top":"1em"}}}} /-->
			
		<!-- wp:post-content {"align":"wide"} /--></div>
	<!-- /wp:group --></div>
	<!-- /wp:group -->
	
	<!-- wp:group {"tagName":"main","align":"full","style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}},"background":{"backgroundRepeat":"no-repeat","backgroundSize":"contain","backgroundPosition":"41% 64%","backgroundImage":{"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/circle_light_orange.svg","id":6935,"source":"file","title":"circle_light_orange"}}},"layout":{"type":"constrained","contentSize":""}} -->
	<main class="wp-block-group alignfull" style="margin-top:0;padding-top:0;padding-right:var(--wp--preset--spacing--10);padding-bottom:0;padding-left:var(--wp--preset--spacing--10)"><!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide"><!-- wp:comments {"align":"full"} -->
			<div class="wp-block-comments alignfull"><!-- wp:comments-title /-->
				
				<!-- wp:comment-template -->
				<!-- wp:columns -->
				<div class="wp-block-columns"><!-- wp:column {"width":"40px"} -->
					<div class="wp-block-column" style="flex-basis:40px"><!-- wp:avatar {"size":40,"style":{"border":{"radius":"20px"}}} /--></div>
					<!-- /wp:column -->
					
					<!-- wp:column -->
					<div class="wp-block-column"><!-- wp:comment-author-name {"fontSize":"small"} /-->
						
						<!-- wp:group {"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"flex"}} -->
						<div class="wp-block-group" style="margin-top:0px;margin-bottom:0px"><!-- wp:comment-date {"fontSize":"small"} /-->
							
						<!-- wp:comment-edit-link {"fontSize":"small"} /--></div>
						<!-- /wp:group -->
						
						<!-- wp:comment-content /-->
						
					<!-- wp:comment-reply-link {"fontSize":"small"} /--></div>
				<!-- /wp:column --></div>
				<!-- /wp:columns -->
				<!-- /wp:comment-template -->
				
				<!-- wp:comments-pagination -->
				<!-- wp:comments-pagination-previous /-->
				
				<!-- wp:comments-pagination-numbers /-->
				
				<!-- wp:comments-pagination-next /-->
				<!-- /wp:comments-pagination -->
				
			<!-- wp:post-comments-form /--></div>
		<!-- /wp:comments --></div>
	<!-- /wp:group --></main>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"footer","area":"footer"} /-->