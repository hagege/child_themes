<?php
	/**
		* Title: Text left and Image right
		* Slug: spacepress-wp/text-left-and-image-right
		* Categories: spacepress-wp, call-to-action, banner
	*/
?>
<!-- wp:group {"className":"alignfull is-style-section-default has-custom-weiss-color has-custom-rostrot-background-color has-text-color has-background has-link-color"} -->
<div class="wp-block-group alignfull is-style-section-default has-custom-weiss-color has-custom-rostrot-background-color has-text-color has-background has-link-color"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"base-2","textColor":"base"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center has-base-color has-base-2-background-color has-text-color has-background has-link-color"><!-- wp:column {"verticalAlignment":"center","width":"50%","layout":{"type":"default"}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|custom-weiss"}}}},"textColor":"custom-weiss","fontSize":"xx-large"} -->
			<h1 class="wp-block-heading has-custom-weiss-color has-text-color has-link-color has-xx-large-font-size">Welcome in this great town</h1>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
			<!-- /wp:paragraph -->
			
			<!-- wp:group {"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:paragraph {"className":"haurand-button-blau"} -->
				<p class="haurand-button-blau"><a href="https://haurand.com">Read More</a></p>
			<!-- /wp:paragraph --></div>
		<!-- /wp:group --></div>
		<!-- /wp:column -->
		
		<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"lightbox":{"enabled":true},"id":357,"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/attendorn_marktplatz_2022.webp" alt="" class="wp-image-357" style="aspect-ratio:1;object-fit:cover"/></figure>
		<!-- /wp:image --></div>
	<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->