<?php
	/**
		* Title: Show Image in full width container
		* Slug: spacepress-wp/show-image-in-full-width-container
		* Categories: spacepress-wp, columns, media
	*/
?>
<!-- wp:group {"align":"full","className":"spacepress_wp_show_image","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull spacepress_wp_show_image"><!-- wp:columns {"align":"full","backgroundColor":"contrast"} -->
	<div class="wp-block-columns alignfull has-contrast-background-color has-background"><!-- wp:column {"verticalAlignment":"center","width":"100%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:100%"><!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"backgroundColor":"contrast","layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-contrast-background-color has-background" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:image {"id":6602,"sizeSlug":"full","linkDestination":"media","align":"center","className":"spacepress_wp_show_image"} -->
				<figure class="wp-block-image aligncenter size-full spacepress_wp_show_image"><a href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/cats.webp"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/cats.webp" alt="Image" class="wp-image-6602"/></a><figcaption class="wp-element-caption">Example Caption</figcaption></figure>
			<!-- /wp:image --></div>
		<!-- /wp:group --></div>
	<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->