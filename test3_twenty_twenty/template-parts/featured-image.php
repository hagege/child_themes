<?php
/**
 * Displays the featured image
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

if ( has_post_thumbnail() && ! post_password_required() ) {

	$featured_media_inner_classes = '';

	// Make the featured media thinner on archive pages.
	if ( ! is_singular() ) {
		$featured_media_inner_classes .= ' medium';
	}
	?>

	<figure class="featured-media">

		<div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
        
            <!-- Link only on archive pages. -->
        	<?php if ( ! is_singular() ) { ?>
                <p>Einzelner Beitrag</p>
                <a class="post-thumbnail" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'post-thumbnail' ); ?>
                </a>
    			<?php
    			// the_post_thumbnail();
        	}
            else
            {
                the_post_thumbnail( 'full' );       
            }

			$caption = get_the_post_thumbnail_caption();

			if ( $caption ) {
				?>

				<figcaption class="wp-caption-text"><?php echo esc_html( $caption ); ?></figcaption>

				<?php
			}
			?>

		</div><!-- .featured-media-inner -->

	</figure><!-- .featured-media -->

	<?php
}
