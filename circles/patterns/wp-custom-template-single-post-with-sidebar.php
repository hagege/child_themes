<?php
/**
 * Title: wp-custom-template-single-post-with-sidebar
 * Slug: circles/wp-custom-template-single-post-with-sidebar
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:columns {"align":"full","style":{"spacing":{"blockGap":{"top":"1rem","left":"1rem"},"padding":{"top":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignfull" style="margin-bottom:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--50)"><!-- wp:column {"width":"10%"} -->
<div class="wp-block-column" style="flex-basis:10%"></div>
<!-- /wp:column -->

<!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:group {"align":"full","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_orange.svg","id":6935,"source":"file","title":"circle_light_orange"},"backgroundPosition":"50% 0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"style":{"background":{"backgroundPosition":"35% 42%"},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-featured-image {"style":{"spacing":{"padding":{"bottom":"2vh"}}}} /-->

<!-- wp:post-title /-->

<!-- wp:post-content /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:spacer {"height":"4rem"} -->
<div style="height:4rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:comments {"className":"wp-block-comments-query-loop"} -->
<div class="wp-block-comments wp-block-comments-query-loop"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e('Kommentare', 'circles');?></h2>
<!-- /wp:heading -->

<!-- wp:comments-title {"level":3} /-->

<!-- wp:comment-template -->
<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"0.5em"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:avatar {"size":40} /-->

<!-- wp:group -->
<div class="wp-block-group"><!-- wp:comment-author-name /-->

<!-- wp:comment-date /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:comment-content /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:comment-edit-link /-->

<!-- wp:comment-reply-link /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:comment-template -->

<!-- wp:comments-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:comments-pagination-previous /-->

<!-- wp:comments-pagination-next /-->
<!-- /wp:comments-pagination -->

<!-- wp:post-comments-form {"style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} /--></div>
<!-- /wp:comments -->

<!-- wp:spacer {"height":"4rem"} -->
<div style="height:4rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"tagName":"nav","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40","top":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<nav aria-label="Beiträge" class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:post-navigation-link {"type":"previous","label":"Vorherige: ","showTitle":true,"linkLabel":true,"arrow":"arrow"} /-->

<!-- wp:post-navigation-link {"label":"Nächste: ","showTitle":true,"linkLabel":true,"arrow":"arrow"} /--></nav>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"10%"} -->
<div class="wp-block-column" style="flex-basis:10%"></div>
<!-- /wp:column -->

<!-- wp:column {"width":"30%"} -->
<div class="wp-block-column" style="flex-basis:30%"><!-- wp:block {"ref":7396} /--></div>
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