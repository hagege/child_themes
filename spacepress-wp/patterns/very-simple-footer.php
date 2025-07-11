<?php
	/**
		* Title: Very simple Footer
		* Slug: spacepress-wp/very-simple-footer
		* Categories: footer
		* Block Types: core/template-part/footer
		* Description: A footer in one row
	*/
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|20"}},"border":{"top":{"width":"0px","style":"none"},"right":[],"bottom":[],"left":[]}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-style:none;border-top-width:0px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--20)"><!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-columns alignwide" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:column {"verticalAlignment":"center","width":"10%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:10%"><!-- wp:site-logo {"width":80,"shouldSyncIcon":false,"style":{"layout":{"selfStretch":"fit","flexSize":null}}} /--></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"verticalAlignment":"center","width":"70%","style":{"spacing":{"padding":{"right":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="padding-right:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);flex-basis:70%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"top":{"width":"2px"},"right":[],"bottom":{"width":"2px"},"left":[]}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"center"}} -->
			<div class="wp-block-group" style="border-top-width:2px;border-bottom-width:2px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:navigation {"overlayMenu":"never","style":{"typography":{"fontStyle":"normal","fontWeight":"400"},"spacing":{"blockGap":"var:preset|spacing|20"}},"fontSize":"medium","layout":{"type":"flex","orientation":"horizontal"}} -->
				<!-- wp:navigation-link {"label":"Datenschutzerklärung","url":"#"} /-->
				
				<!-- wp:navigation-link {"label":"Allgemeine Geschäftsbedingungen","url":"#"} /-->
				
				<!-- wp:navigation-link {"label":"Kontaktiere uns","url":"#"} /-->
			<!-- /wp:navigation --></div>
		<!-- /wp:group --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"verticalAlignment":"center","width":"20%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:20%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}},"border":{"top":{"width":"2px"},"right":[],"bottom":{"width":"2px"},"left":[]}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group" style="border-top-width:2px;border-bottom-width:2px;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"fontSize":"small"} -->
				<p class="has-small-font-size">
				Gestaltet mit <a href="https://de.wordpress.org" rel="nofollow">WordPress</a>		</p>
			<!-- /wp:paragraph --></div>
		<!-- /wp:group --></div>
	<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->