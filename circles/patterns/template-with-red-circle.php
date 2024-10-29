<?php
	/**
		* Title: template-with-red-circle
		* Slug: circles/template-with-red-circle
		* Inserter: no
	*/
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:group {"align":"full","style":{"background":{"backgroundPosition":"50% 0","backgroundImage":{"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/circle_red.svg","id":7594,"source":"file","title":"circle_red"}},"dimensions":{"minHeight":"100vh"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull" style="min-height:100vh"><!-- wp:post-featured-image {"height":"25em","align":"full"} /-->
		
		<!-- wp:group {"style":{"background":{"backgroundPosition":"35% 42%"},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30","top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-title {"level":1,"style":{"spacing":{"padding":{"top":"1em"},"margin":{"top":"1em"}}}} /-->
			
		<!-- wp:post-content /--></div>
	<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"footer","area":"footer"} /-->