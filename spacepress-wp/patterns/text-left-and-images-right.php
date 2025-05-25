<?php
	/**
		* Title: Text left and Images right
		* Slug: spacepress-wp/text-left-and-images-right
		* Categories: spacepress-wp, call-to-action, banner
	*/
?>

<!-- wp:group {"className":"alignfull is-style-section-default has-base-color has-base-2-background-color has-text-color has-background has-link-color","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull is-style-section-default has-base-color has-base-2-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide"><!-- wp:column -->
		<div class="wp-block-column"><!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|custom-weiss"}}}},"textColor":"custom-weiss","fontSize":"x-large"} -->
			<h2 class="wp-block-heading has-custom-weiss-color has-text-color has-link-color has-x-large-font-size">Great landscape</h2>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
			<!-- /wp:paragraph -->
			
			<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
			<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			
			<!-- wp:image {"lightbox":{"enabled":true},"id":362,"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/power_tour_06_2024_04.jpg" alt="" class="wp-image-362" style="aspect-ratio:1;object-fit:cover"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column"><!-- wp:image {"lightbox":{"enabled":true},"id":358,"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/power_tour_06_2024_17.jpg" alt="" class="wp-image-358" style="aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
			
			<!-- wp:image {"lightbox":{"enabled":true},"id":356,"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/power_tour_06_2024_02.webp" alt="" class="wp-image-356" style="aspect-ratio:4/3;object-fit:cover"/></figure>
		<!-- /wp:image --></div>
	<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->