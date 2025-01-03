<?php
	/**
		* Title: 404
		* Slug: circles-wp/404
		* Inserter: no
	*/
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:spacer {"height":"30px"} -->
	<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
	
	<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull"><!-- wp:group {"align":"full","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/circle_light_orange.svg","id":6935,"source":"file","title":"circle_light_orange"},"backgroundPosition":"35% 42%"},"dimensions":{"minHeight":"100vh"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull" style="min-height:100vh"><!-- wp:heading -->
			<h2 class="wp-block-heading" id="h-404-fehler"><?php esc_html_e('404', 'circles-wp');?></h2>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p><?php esc_html_e('Sorry, unfortunately nothing found.', 'circles-wp');?></p>
			<!-- /wp:paragraph -->
			
		<!-- wp:search {"label":"Search","showLabel":false,"buttonText":"Search","buttonPosition":"button-inside"} /--></div>
	<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"footer","area":"footer"} /-->