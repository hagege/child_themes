<?php
	/**
		* Title: Posts in two columns
		* Slug: wp-simple-fse/posts-in-two-columns
		* Categories: wp-simple-fse, query
		* Block Types: core/query
		* Description: Posts in one column. Can be inserted on pages. Do not use for posts.
	*/
?>
<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"center","align":"wide","style":{"typography":{"lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"elements":{"link":{"color":{"text":"var:preset|color|Dunkelblau"}}}},"textColor":"Dunkelblau","fontSize":"x-large"} -->
	<h2 class="wp-block-heading alignwide has-text-align-center has-dunkelblau-color has-text-color has-link-color has-x-large-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);line-height:1">Newest Posts</h2>
	<!-- /wp:heading -->
	
	<!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null},"enhancedPagination":true,"align":"full","layout":{"type":"constrained"}} -->
	<div class="wp-block-query alignfull"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
		<!-- wp:group {"style":{"spacing":{"blockGap":"0.3em","padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"dimensions":{"minHeight":"1em"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"top"}} -->
		<div class="wp-block-group" style="min-height:1em;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:post-featured-image {"aspectRatio":"4/3","width":"100%","height":"17em","style":{"spacing":{"margin":{"right":"0","left":"0"}},"border":{"radius":"0px"}}} /-->
			
			<!-- wp:post-title {"isLink":true,"style":{"typography":{"lineHeight":"1.1","fontSize":"1.8rem"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} /-->
			
			<!-- wp:group {"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:post-excerpt {"moreText":"Weiterlesen","excerptLength":30} /--></div>
			<!-- /wp:group -->
			
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:post-date {"format":"j.n.Y","isLink":true} /--></div>
			<!-- /wp:group -->
			
			<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
			<div class="wp-block-group"><!-- wp:post-terms {"term":"category","prefix":"Kategorie: "} /--></div>
		<!-- /wp:group --></div>
		<!-- /wp:group -->
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
		<!-- wp:pattern {"slug":"wp-simple-fse/hidden-no-results"} /-->
		<!-- /wp:query-no-results -->
	</div>
<!-- /wp:query --></div>
<!-- /wp:group -->