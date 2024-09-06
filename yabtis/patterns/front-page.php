<?php
/**
 * Title: front-page
 * Slug: yabtis/front-page
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"neuer-header","area":"header"} /-->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:group {"tagName":"main","align":"wide","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignwide"><!-- wp:spacer {"height":"30px"} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:cover {"overlayColor":"base-2","isUserOverlayColor":true,"minHeight":500,"isDark":false,"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-cover alignfull is-light" style="min-height:500px"><span aria-hidden="true" class="wp-block-cover__background has-base-2-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","style":{"typography":{"fontSize":"10rem"}}} -->
<p class="has-text-align-center" style="font-size:10rem"><?php esc_html_e('Our new Start Page', 'yabtis');?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/sorrent_2021.jpg","id":5723,"source":"file","title":"sorrent_2021"},"backgroundPosition":"52% 47%"},"dimensions":{"minHeight":"500px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="min-height:500px"></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:cover {"overlayColor":"contrast-3","isUserOverlayColor":true,"minHeight":500,"isDark":false,"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-cover alignfull is-light" style="min-height:500px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-3-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"left","placeholder":"Write title…","style":{"typography":{"fontSize":"6rem"}}} -->
<p class="has-text-align-left" style="font-size:6rem"><?php esc_html_e('Second Cover', 'yabtis');?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:cover {"overlayColor":"contrast","isUserOverlayColor":true,"minHeight":500,"isDark":false,"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-cover alignfull is-light" style="min-height:500px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"right","placeholder":"Write title…","style":{"typography":{"fontSize":"6rem"}}} -->
<p class="has-text-align-right" style="font-size:6rem"><?php esc_html_e('Third Cover', 'yabtis');?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":""}} -->
<div class="wp-block-group"><!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"30px"} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"align":"wide"} -->
<h2 class="wp-block-heading alignwide"><?php esc_html_e('Posts', 'yabtis');?></h2>
<!-- /wp:heading -->

<!-- wp:query {"queryId":9,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"enhancedPagination":true,"metadata":{"categories":["posts"],"patternName":"core/query-standard-posts","name":"Standard"},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":"2"}} -->
<!-- wp:post-title {"isLink":true} /-->

<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","align":"wide"} /-->

<!-- wp:post-excerpt /-->

<!-- wp:separator {"opacity":"css"} -->
<hr class="wp-block-separator has-css-opacity"/>
<!-- /wp:separator -->

<!-- wp:post-date /-->

<!-- wp:spacer -->
<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- /wp:post-template -->

<!-- wp:query-pagination -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></main>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-default"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-default"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"neuer-footer","area":"footer"} /-->