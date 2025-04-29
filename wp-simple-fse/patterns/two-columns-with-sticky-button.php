<?php
	/**
		* Title: Two Columns with sticky button in the right Column
		* Slug: wp-simple-fse/two-columns-with-sticky-button
		* Categories: wp-simple-fse, call-to-action
	*/
?>
<!-- wp:columns {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:column {"width":"80%"} -->
	<div class="wp-block-column" style="flex-basis:80%"><!-- wp:group -->
		<div class="wp-block-group"><!-- wp:spacer {"height":"30px"} -->
			<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			
			<!-- wp:heading {"textAlign":"center","metadata":{"name":"First Header"}} -->
			<h2 class="wp-block-heading has-text-align-center">My Header</h2>
			<!-- /wp:heading -->
			
			<!-- wp:spacer {"height":"30px"} -->
			<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			
			<!-- wp:paragraph {"align":"left"} -->
			<p class="has-text-align-left">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
			<!-- /wp:paragraph -->
			
			<!-- wp:heading {"textAlign":"center"} -->
			<h2 class="wp-block-heading has-text-align-center">Second Header</h2>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph {"align":"left"} -->
			<p class="has-text-align-left">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:group -->
		
		<!-- wp:spacer {"height":"70px","className":"spacer_vor_grauem_kasten"} -->
		<div style="height:70px" aria-hidden="true" class="wp-block-spacer spacer_vor_grauem_kasten"></div>
	<!-- /wp:spacer --></div>
	<!-- /wp:column -->
	
	<!-- wp:column {"width":"20%"} -->
	<div class="wp-block-column" style="flex-basis:20%"><!-- wp:group {"style":{"position":{"type":"sticky","top":"0px"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group"><!-- wp:spacer -->
			<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			
			<!-- wp:buttons {"className":"sticky_button","style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-buttons sticky_button" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:button {"textAlign":"center","fontSize":"medium"} -->
				<div class="wp-block-button has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-text-align-center wp-element-button" href="https://localhost/haurand/wordpress-webseiten-referenzen/">Erstberatung</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
			
			<!-- wp:spacer -->
			<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer --></div>
	<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->