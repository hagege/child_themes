<?php
	/**
		* Title: Page Alternative with One Circle
		* Slug: circles/page-alternative-one-circle
		* Template Types: front-page, home
		* Inserter: no
	*/
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:spacer {"height":"30px"} -->
	<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
	
	<!-- wp:group {"tagName":"main","align":"full","style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|10","right":"var:preset|spacing|10"}},"background":{"backgroundRepeat":"no-repeat","backgroundSize":"contain","backgroundPosition":"41% 64%"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
	<main class="wp-block-group alignfull" style="margin-top:0;padding-top:0;padding-right:var(--wp--preset--spacing--10);padding-bottom:0;padding-left:var(--wp--preset--spacing--10)"><!-- wp:group {"style":{"spacing":{"padding":{"bottom":"0"},"margin":{"top":"50px"}},"background":{"backgroundPosition":"35% 37%","backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_orange.svg","id":6935,"source":"file","title":"circle_light_orange"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="margin-top:50px;padding-bottom:0"><!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:post-title {"level":1,"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} /-->
				
			<!-- wp:post-content {"align":"wide","layout":{"type":"constrained"}} /--></div>
		<!-- /wp:group --></div>
	<!-- /wp:group --></main>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"footer","area":"footer"} /-->