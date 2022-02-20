<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Apace
 */

get_header();
?>
<div id="primary" class="content-area">

	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			// Previous/next post navigation.
			$apace_next = is_rtl() ? apace_get_icon_svg( 'arrow-left' ) : apace_get_icon_svg( 'arrow-right' );
			$apace_prev = is_rtl() ? apace_get_icon_svg( 'arrow-right' ) : apace_get_icon_svg( 'arrow-left' );

			the_post_navigation(
				array(
					'prev_text' => '<div class="apa-post-nav-prev-icon">' . $apace_prev . '</div> <span class="nav-title">%title</span>',
					'next_text' => '<div class="apa-post-nav-next-icon">' . $apace_next . '</div> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

</div><!-- #content -->

<?php
get_sidebar();
get_footer();
