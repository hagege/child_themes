<?php
	/**
		* Title: page-with-sidebar
		* Slug: circles-wp/page-with-sidebar
		* Template Types: page, home
		* Inserter: no
	*/
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_orange.svg","id":6935,"source":"file","title":"circle_light_orange"},"backgroundPosition":"50% 0"},"dimensions":{"minHeight":"100vh"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="min-height:100vh"><!-- wp:columns {"align":"full","style":{"spacing":{"blockGap":{"top":"1rem","left":"1rem"},"padding":{"top":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignfull" style="margin-bottom:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--50)"><!-- wp:column {"width":"10%"} -->
		<div class="wp-block-column" style="flex-basis:10%"></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"width":"60%"} -->
		<div class="wp-block-column" style="flex-basis:60%"><!-- wp:group {"align":"full","style":{"background":{"backgroundPosition":"50% 0"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group alignfull"><!-- wp:group {"style":{"background":{"backgroundPosition":"35% 42%"},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-featured-image /-->
					
					<!-- wp:post-title {"level":1,"style":{"spacing":{"padding":{"top":"30px"}}}} /-->
					
				<!-- wp:post-content /--></div>
			<!-- /wp:group --></div>
		<!-- /wp:group --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"width":"10%"} -->
		<div class="wp-block-column" style="flex-basis:10%"></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"width":"30%"} -->
		<div class="wp-block-column" style="flex-basis:30%"><!-- wp:group {"style":{"spacing":{"blockGap":"36px","padding":{"right":"0","left":"0"}}},"layout":{"type":"default"}} -->
			<div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:separator {"className":"is-style-wide","backgroundColor":"contrast"} -->
				<hr class="wp-block-separator has-text-color has-contrast-color has-alpha-channel-opacity has-contrast-background-color has-background is-style-wide"/>
				<!-- /wp:separator -->
				
				<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"fontSize":"1.6rem"}}} -->
					<h2 class="wp-block-heading" style="font-size:1.6rem"><?php esc_html_e('Beliebte Kategorien', 'circles-wp');?></h2>
					<!-- /wp:heading -->
					
				<!-- wp:categories {"showHierarchy":true,"showPostCounts":true,"fontSize":"medium"} /--></div>
				<!-- /wp:group -->
				
				<!-- wp:separator {"className":"is-style-wide","backgroundColor":"contrast"} -->
				<hr class="wp-block-separator has-text-color has-contrast-color has-alpha-channel-opacity has-contrast-background-color has-background is-style-wide"/>
				<!-- /wp:separator -->
			
			<!-- wp:group {"style":{"spacing":{"blockGap":"26px"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
			<div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"fontSize":"1.6rem"}}} -->
			<h2 class="wp-block-heading" style="font-size:1.6rem"><?php esc_html_e('Nützliche Links', 'circles-wp');?></h2>
			<!-- /wp:heading -->
			
			<!-- wp:list -->
			<ul class="wp-block-list"><!-- wp:list-item -->
			<li><?php esc_html_e('Ein erster Link', 'circles-wp');?></li>
			<!-- /wp:list-item -->
			
			<!-- wp:list-item -->
			<li><?php esc_html_e('Ein zweiter Link', 'circles-wp');?></li>
			<!-- /wp:list-item -->
			
			<!-- wp:list-item -->
			<li><?php esc_html_e('Ein dritter Link', 'circles-wp');?></li>
			<!-- /wp:list-item --></ul>
			<!-- /wp:list --></div>
			<!-- /wp:group --></div>
			<!-- /wp:group -->
			
			<!-- wp:separator {"className":"is-style-wide","backgroundColor":"contrast"} -->
			<hr class="wp-block-separator has-text-color has-contrast-color has-alpha-channel-opacity has-contrast-background-color has-background is-style-wide"/>
			<!-- /wp:separator -->
			
			<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
			<div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"fontSize":"1.6rem"}}} -->
			<h2 class="wp-block-heading" style="font-size:1.6rem"><?php esc_html_e('Die Website durchsuchen', 'circles-wp');?></h2>
			<!-- /wp:heading -->
			
			<!-- wp:search {"label":"Suchen","showLabel":false,"placeholder":"Suchen …","width":100,"widthUnit":"%","buttonText":"Suchen"} /--></div>
			<!-- /wp:group -->
			
			<!-- wp:spacer {"height":"var:preset|spacing|10"} -->
			<div style="height:var(--wp--preset--spacing--10)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer --></div>
			<!-- /wp:group --></div>
			<!-- /wp:column -->
			
			<!-- wp:column {"width":"10%"} -->
			<div class="wp-block-column" style="flex-basis:10%"></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns --></div>
			<!-- /wp:group -->
			
			<!-- wp:separator {"className":"is-style-default"} -->
			<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
			<!-- /wp:separator -->
			
			<!-- wp:template-part {"slug":"footer","area":"footer"} /-->			