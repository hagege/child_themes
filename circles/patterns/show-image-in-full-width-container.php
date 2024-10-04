<?php
	/**
		* Title: Show Image in full width container
		* Slug: circles/show-image-in-full-width-container
		* Categories: circles, columns, media
	*/
?>
<!-- wp:group {"metadata":{"categories":[],"patternName":"core/block/11748","name":"Anzeige der Bilder im Blog"},"align":"full","className":"circles_show_image","style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull circles_show_image has-base-background-color has-background" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"full","className":"container_mit_bildern"} -->
	<div class="wp-block-columns alignfull container_mit_bildern"><!-- wp:column {"verticalAlignment":"center","width":"100%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:100%"><!-- wp:group {"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","metadata":{"bindings":{"__default":{"source":"core/pattern-overrides"}},"name":"Overwrite Image"},"align":"center","className":"bild_zentriert"} -->
				<figure class="wp-block-image aligncenter size-large bild_zentriert"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/wordcamp_images_1920_023.webp" alt="replace Image" class=""/></figure>
			<!-- /wp:image --></div>
		<!-- /wp:group --></div>
	<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->