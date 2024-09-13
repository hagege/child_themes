<?php
/**
 * Title: Template with red Circle
 * Slug: circles/template-with-red-circle
 * Categories: circles_page
 * Keywords: page
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Description: Template with red Circle
 */
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:group {"align":"full","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/rot.svg","id":6947,"source":"file","title":"rot"},"backgroundPosition":"50% 0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:post-featured-image {"height":"25em","align":"full"} /-->

<!-- wp:group {"style":{"background":{"backgroundPosition":"35% 42%"},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-title {"style":{"spacing":{"padding":{"top":"30px"}}}} /-->

<!-- wp:post-content /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"footer","area":"footer"} /-->