<?php
	/**
		* Title: Simple Footer
		* Slug: circles-wp/simple-footer
		* Categories: footer
		* Block Types: core/template-part/footer
		* Description: A footer section with three sections
	*/
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|20"}},"border":{"top":{"width":"0px","style":"none"},"right":[],"bottom":[],"left":[]}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-style:none;border-top-width:0px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--20)"><!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:column {"width":"20%"} -->
		<div class="wp-block-column" style="flex-basis:20%"><!-- wp:group {"style":{"dimensions":{"minHeight":""},"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group"><!-- wp:site-logo {"width":190,"shouldSyncIcon":false,"style":{"layout":{"selfStretch":"fit","flexSize":null}}} /--></div>
		<!-- /wp:group --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"width":"10%"} -->
		<div class="wp-block-column" style="flex-basis:10%"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
			<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:0"><!-- wp:paragraph {"fontSize":"small"} -->
				<p class="has-small-font-size">
				Gestaltet mit <a href="https://de.wordpress.org" rel="nofollow">WordPress</a>		</p>
			<!-- /wp:paragraph --></div>
		<!-- /wp:group --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"width":"70%","style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-column" style="padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);flex-basis:70%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"top":{"width":"2px"},"bottom":{"width":"2px"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="border-top-width:2px;border-bottom-width:2px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:heading {"className":"has-medium-font-size","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontFamily":"lexend"} -->
				<h2 class="wp-block-heading has-medium-font-size has-lexend-font-family" style="font-style:normal;font-weight:600"><?php esc_html_e('Über uns', 'circles-wp');?></h2>
				<!-- /wp:heading -->
				
			<!-- wp:navigation {"overlayMenu":"never","style":{"typography":{"fontStyle":"normal","fontWeight":"400"},"spacing":{"blockGap":"var:preset|spacing|20"}},"fontSize":"medium","layout":{"type":"flex","orientation":"horizontal"}} /--></div>
			<!-- /wp:group -->
			
			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
			<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"top":{"width":"2px"},"right":[],"bottom":{"width":"2px"},"left":[]}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group" style="border-top-width:2px;border-bottom-width:2px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:heading {"className":"has-medium-font-size","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontFamily":"lexend"} -->
					<h2 class="wp-block-heading has-medium-font-size has-lexend-font-family" style="font-style:normal;font-weight:600"><?php esc_html_e('Datenschutz', 'circles-wp');?></h2>
					<!-- /wp:heading -->
					
					<!-- wp:navigation {"overlayMenu":"never","style":{"typography":{"fontStyle":"normal","fontWeight":"400"},"spacing":{"blockGap":"var:preset|spacing|20"}},"fontSize":"medium","layout":{"type":"flex","orientation":"horizontal"}} -->
					<!-- wp:navigation-link {"label":"Datenschutzerklärung","url":"#"} /-->
					
					<!-- wp:navigation-link {"label":"Allgemeine Geschäftsbedingungen","url":"#"} /-->
					
					<!-- wp:navigation-link {"label":"Kontaktiere uns","url":"#"} /-->
				<!-- /wp:navigation --></div>
			<!-- /wp:group --></div>
			<!-- /wp:group -->
			
			<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
			<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"top":{"width":"2px"},"right":[],"bottom":{"width":"2px"},"left":[]}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group" style="border-top-width:2px;border-bottom-width:2px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:heading {"className":"has-medium-font-size","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontFamily":"lexend"} -->
				<h2 class="wp-block-heading has-medium-font-size has-lexend-font-family" style="font-style:normal;font-weight:600"><?php esc_html_e('Social', 'circles-wp');?></h2>
				<!-- /wp:heading -->
				
				<!-- wp:navigation {"overlayMenu":"never","style":{"typography":{"fontStyle":"normal","fontWeight":"400"},"spacing":{"blockGap":"var:preset|spacing|20"}},"fontSize":"medium","layout":{"type":"flex","orientation":"horizontal"}} -->
				<!-- wp:navigation-link {"label":"Facebook","url":"#"} /-->
				
				<!-- wp:navigation-link {"label":"Instagram","url":"#"} /-->
				
				<!-- wp:navigation-link {"label":"Twitter/X","url":"#"} /-->
				<!-- /wp:navigation --></div>
				<!-- /wp:group --></div>
				<!-- /wp:group --></div>
				<!-- /wp:column --></div>
				<!-- /wp:columns --></div>
				<!-- /wp:group -->				