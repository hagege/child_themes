<?php
/**
 * Title: Posts in one column
 * Slug: circles/posts-in-one-column
 * Categories: circles, posts, query, blog
 * Block Types: core/query
 */
?>
<!-- wp:group {"metadata":{"categories":["posts"],"patternName":"circles/posts-in-two-columns","name":"Posts in one column"},"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:heading {"textAlign":"center","align":"wide","style":{"typography":{"lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"elements":{"link":{"color":{"text":"var:preset|color|Dunkelblau"}}}},"textColor":"Dunkelblau","fontSize":"x-large"} -->
<h2 class="wp-block-heading alignwide has-text-align-center has-dunkelblau-color has-text-color has-link-color has-x-large-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);line-height:1">Newest Posts</h2>
<!-- /wp:heading -->

<!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null},"enhancedPagination":true,"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-query alignfull"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default","columnCount":1,"minimumColumnWidth":null}} -->
<!-- wp:post-title {"isLink":true,"style":{"typography":{"lineHeight":"1.1","fontSize":"1.8rem"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} /-->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"auto","width":"","height":"","style":{"spacing":{"margin":{"right":"0","left":"0"}},"border":{"radius":"0px"}}} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:post-excerpt {"moreText":"Weiterlesen","excerptLength":30} /-->

<!-- wp:post-date {"format":"j.n.Y","isLink":true} /-->

<!-- wp:post-terms {"term":"category","prefix":"Kategorie: "} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template -->

<!-- wp:spacer {"height":"var:preset|spacing|30"} -->
<div style="height:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->


<!-- wp:query-no-results -->
<!-- wp:pattern {"slug":"circles/hidden-no-results"} /-->
<!-- /wp:query-no-results -->
</div>
<!-- /wp:query --></div>
<!-- /wp:group -->