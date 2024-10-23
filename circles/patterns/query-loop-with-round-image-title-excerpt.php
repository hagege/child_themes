<?php
	/**
		* Title: Query loop with round image, title and text excerpt
		* Slug: circles/query-loop-with-round-image-title-excerpt
		* Categories: circles, posts
	*/
?>
<!-- wp:query {"queryId":19,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"metadata":{"categories":["posts"],"patternName":"core/query-small-posts","name":"Abfrage Loop mit rundem Bild, Titel und Textauszug"},"layout":{"type":"constrained"}} -->
<div class="wp-block-query"><!-- wp:post-template -->
	<!-- wp:columns {"verticalAlignment":"center"} -->
	<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","style":{"border":{"radius":"360px"}}} /--></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"verticalAlignment":"center","width":"75%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:75%"><!-- wp:post-title {"isLink":true} /-->
			
		<!-- wp:post-excerpt {"moreText":"Hier geht es weiter"} /--></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->