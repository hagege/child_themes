<?php
/**
 * Title: page
 * Slug: yabtis/page
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"neuer-header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:spacer {"height":"30px"} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"align":"full","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_orange.svg","id":6935,"source":"file","title":"circle_light_orange"},"backgroundPosition":"50% 0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"style":{"background":{"backgroundPosition":"35% 42%"},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-title /-->

<!-- wp:post-content /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"neuer-footer","area":"footer"} /-->