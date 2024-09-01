<?php
/**
 * Title: 404
 * Slug: hgg-block-theme/404
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"neuer-header","area":"header"} /-->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:spacer {"height":"30px"} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:group {"style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/circle_light_orange.svg","id":6935,"source":"file","title":"circle_light_orange"},"backgroundPosition":"50% 0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"background":{"backgroundPosition":"50% 0"}}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e('404 - Fehler', 'hgg-block-theme');?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e('Sorry, leider nichts gefunden', 'hgg-block-theme');?></p>
<!-- /wp:paragraph --></main>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:template-part {"slug":"neuer-footer","area":"footer"} /-->