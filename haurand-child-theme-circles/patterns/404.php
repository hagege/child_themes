<?php
/**
 * Title: 404
 * Slug: haurand-child-theme-circles-wp/404
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
	<div class="wp-block-group alignfull"><!-- wp:group {"align":"full","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_blue.svg","id":6935,"source":"file","title":"circle_light_blue"},"backgroundPosition":"35% 42%"},"dimensions":{"minHeight":"100vh"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull" style="min-height:100vh"><!-- wp:heading -->
			<h2 class="wp-block-heading"><?php esc_html_e('404 - Fehler', 'haurand-child-theme-circles-wp');?></h2>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p><?php esc_html_e('Sorry, leider nichts gefunden', 'haurand-child-theme-circles-wp');?></p>
		<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"footer","area":"footer"} /-->