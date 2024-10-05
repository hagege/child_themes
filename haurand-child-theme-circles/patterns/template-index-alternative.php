<?php
/**
 * Title: template-index-alternative
 * Slug: haurand-child-theme-circles/template-index-alternative
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"tagName":"main","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_blue.svg","id":6935,"source":"file","title":"circle_light_blue"},"backgroundPosition":"50% 0"},"spacing":{"padding":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group"><!-- wp:heading {"level":1,"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50"}}}} -->
		<h1 class="wp-block-heading alignwide" style="padding-top:var(--wp--preset--spacing--50)"><?php esc_html_e('Posts', 'haurand-child-theme-circles');?></h1>
	<!-- /wp:heading --></div>
	<!-- /wp:group -->
	
	<!-- wp:query {"queryId":4,"query":{"perPage":6,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"layout":{"type":"default"}} -->
	<div class="wp-block-query"><!-- wp:query-no-results -->
		<!-- wp:paragraph -->
		<p><?php esc_html_e('No posts were found.', 'haurand-child-theme-circles');?></p>
		<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
		
		<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:0;padding-bottom:var(--wp--preset--spacing--50);padding-left:0"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":"2"}} -->
			<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"spacing":{"margin":{"bottom":"0"}}}} /-->
			
			<!-- wp:group {"style":{"spacing":{"blockGap":"10px","margin":{"top":"var:preset|spacing|20"},"padding":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--20);padding-top:0;padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:post-title {"isLink":true,"style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}},"fontSize":"large"} /-->
				
				<!-- wp:post-excerpt {"moreText":"Read more","style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}}} /-->
				
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group"><!-- wp:post-date /-->
					
					<!-- wp:paragraph -->
					<p><?php esc_html_e('-', 'haurand-child-theme-circles');?></p>
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
		<!-- /wp:query --></main>
		<!-- /wp:group -->
		
		<!-- wp:separator {"className":"is-style-default"} -->
		<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
		<!-- /wp:separator -->
		
		<!-- wp:template-part {"slug":"footer","area":"footer"} /-->		