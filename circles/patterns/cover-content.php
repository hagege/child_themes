<?php
/**
 * Title: Cover Content
 * Slug: circles/cover-content
 * Categories: circles
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_orange.svg","dimRatio":0,"isUserOverlayColor":true,"isDark":false,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="margin-top:0;margin-bottom:0"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background" alt="<?php esc_attr_e('', 'circles');?>" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_orange.svg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"><?php esc_html_e('', 'circles');?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->