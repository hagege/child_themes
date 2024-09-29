<?php
	/**
		* Title: Header with Contact Row
		* Slug: circles/header-with-contact-row
		* Categories: header, circles
		* Block Types: core/template-part/header
		* Description: Header with Contact Row (Telephone and Mail)
		
	*/
?>
<!-- wp:group {"backgroundColor":"contrast","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group has-contrast-background-color has-background"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base"} -->
	<p class="has-base-color has-text-color has-link-color"><?php esc_html_e('Tel.: 012345-67889 | Mail: test@example.com', 'circles');?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:var(--wp--preset--spacing--40);padding-bottom:0;padding-left:var(--wp--preset--spacing--40)"><!-- wp:site-logo {"width":80,"shouldSyncIcon":false} /-->
		
	<!-- wp:navigation {"icon":"menu","templateLock":false,"style":{"layout":{"selfStretch":"fit","flexSize":null},"typography":{"lineHeight":"2.3"}},"layout":{"type":"flex","justifyContent":"center"}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->