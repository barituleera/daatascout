<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Apace
 */

?>
	</div><!-- #content -->
	
	<footer id="colophon" class="site-footer">

		<div class="footer-widget-area">
			<div class="apa-container apa-footer-widget-container">
				<div class="apa-footer-widget-column">
					<?php dynamic_sidebar( 'sidebar-apace-footer-left' ); ?>
				</div>
				<div class="apa-footer-widget-column">
					<?php dynamic_sidebar( 'sidebar-apace-footer-mid' ); ?>
				</div>
				<div class="apa-footer-widget-column">
					<?php dynamic_sidebar( 'sidebar-apace-footer-right' ); ?>
				</div>
			</div><!-- .apa-container -->
		</div><!-- .footer-widget-area -->

		<div class="apa-footer-site-info">
			<div class="apa-container">
				<div class="apa-footer-info-container">

					<div class="apa-owner-copyright">
						<?php
							$apace_copyright_text = get_theme_mod( 'apace_copyright_text', '' ); 

							if ( ! empty( $apace_copyright_text ) ) {
								echo wp_kses_post( $apace_copyright_text );
							} else {
								$apace_site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" >' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
								/* translators: 1: Year 2: Site URL. */
								printf( esc_html__( 'Copyright &#169; %1$s %2$s.', 'apace' ), date_i18n( 'Y' ), $apace_site_link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}	
						?>
					</div><!-- .apa-owner-copyright -->

					<div class="apa-designer-credit">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'apace' ) ); ?>">
							<?php
							/* translators: %s: CMS name, i.e. WordPress. */
							printf( esc_html__( 'Proudly powered by %s', 'apace' ), 'WordPress' );
							?>
						</a>
						<span class="sep"> | </span>
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme: %1$s by %2$s.', 'apace' ), 'Apace', '<a href="https://themezhut.com/themes/apace/">ThemezHut</a>' );
							?>
					</div><!-- .apa-designer-credit -->

				</div><!-- .apa-footer-info-container -->
			</div><!-- .apa-container -->
		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
