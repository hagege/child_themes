<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
			<footer id="site-footer" role="contentinfo" class="header-footer-group">
				<div class="section-inner">

					<div class="footer-credits">

						<p class="footer-copyright">&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://www.php.net/date */
								_x( 'Y', 'copyright date format', 'twentytwenty' )
							);
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</p><!-- .footer-copyright -->
						<!-- 3 Leerzeichen zur Abtrennung -->
						<span> &nbsp; &nbsp; &nbsp;</span>
						<p class="powered-by-wordpress">
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentytwenty' ) ); ?>">
								<?php _e( 'Powered by WordPress', 'twentytwenty' ); ?></a>
							<!-- 3 Leerzeichen zur Abtrennung -->
							<span> &nbsp; &nbsp; &nbsp;</span>
							<!-- Credit eingefügt -->
							<a href="https://haurand.com">Published by haurand.com</a>					
							
						</p><!-- .powered-by-wordpress -->

					</div><!-- .footer-credits -->

					<a class="to-the-top" href="#site-header">
						<span class="to-the-top-long">
						<!-- anderes Symbol verwenden -->
						<span class="arrow" aria-hidden="true">&#9650;</span>
							<?php
							/* translators: %s: HTML character for up arrow. */
							/* printf( __( 'To the top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' ); */
							?>
						</span><!-- .to-the-top-long -->
						<span class="to-the-top-short">
							<!-- anderes Symbol verwenden -->
							<span class="arrow" aria-hidden="true">&#9650;</span>
							<?php
							/* translators: %s: HTML character for up arrow. */
							/* printf( __( 'Up %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' ); */
							?>
						</span><!-- .to-the-top-short -->
					</a><!-- .to-the-top -->

				</div><!-- .section-inner -->
                <div class="klein_zentriert">Icons erstellt von <a href="https://www.flaticon.com/de/autoren/prettycons" title="prettycons">prettycons</a> from <a href="https://www.flaticon.com/de/" title="Flaticon">www.flaticon.com</a></div>


			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>
