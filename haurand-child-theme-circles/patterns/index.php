<?php
/**
 * Title: index
 * Slug: haurand-child-theme-circles-wp/index
 * Inserter: no
 */
?>
<!-- wp:group {"style":{"position":{"type":"sticky","top":"0px"}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-base-background-color has-background"><!-- wp:template-part {"slug":"header","area":"header","align":"full"} /--></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"20%","layout":{"type":"constrained"}} -->
<div class="wp-block-column" style="flex-basis:20%"><!-- wp:group {"align":"wide","className":"category_shortcode","style":{"position":{"type":"sticky","top":"0px"},"background":{"backgroundPosition":"50% 0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide category_shortcode"><!-- wp:spacer {"height":"80px"} -->
<div style="height:80px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e('Kategorien', 'haurand-child-theme-circles-wp');?></h3>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[my_category_list]
<!-- /wp:shortcode -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":3,"align":"wide"} -->
<h3 class="wp-block-heading alignwide"><?php esc_html_e('Schlagwörter', 'haurand-child-theme-circles-wp');?></h3>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"align":"wide"} /-->

<!-- wp:spacer {"height":"20px"} -->
<div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"80%"} -->
<div class="wp-block-column" style="flex-basis:80%"><!-- wp:group {"tagName":"main","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_blue.svg","id":11792,"source":"file","title":"circle_light_blue"},"backgroundSize":"cover"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:query-title {"type":"archive","align":"wide","style":{"typography":{"lineHeight":"1"}}} /-->

<!-- wp:query {"queryId":4,"query":{"perPage":10,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p><?php esc_html_e('No posts were found.', 'haurand-child-theme-circles-wp');?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|80"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"spacing":{"margin":{"bottom":"0"},"padding":{"bottom":"var:preset|spacing|20"}}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"10px","margin":{"top":"var:preset|spacing|40","bottom":"5em"},"padding":{"top":"0"}}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:5em;padding-top:0"><!-- wp:post-title {"isLink":true,"style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}}} /-->

<!-- wp:post-excerpt {"moreText":"Mehr lesen","style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}}} /-->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:post-date /-->

<!-- wp:paragraph -->
<p><?php esc_html_e('-', 'haurand-child-theme-circles-wp');?></p>
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
<!-- /wp:query -->

<!-- wp:spacer {"height":"30px","style":{"layout":[]}} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></main>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"footer","area":"footer"} /-->