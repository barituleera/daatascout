<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Apace
 */

if ( ! function_exists( 'apace_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function apace_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		return sprintf( '<span class="posted-on"><a href="%1$s" rel="bookmark">%2$s</a></span>',
			esc_url( get_permalink() ),
			$time_string 
		);

	}
endif;

if ( ! function_exists( 'apace_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function apace_posted_by() {

		return sprintf( '<span class="byline"><span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);

	}
endif;

if ( ! function_exists( 'apace_category_list' ) ) :
	/**
	 * Displays the category list.
	 */
	function apace_category_list() {
		$categories_list = get_the_category_list( ' ' );

		if ( $categories_list ) {
			printf( '<div class="apa-category-list">%1$s</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

	}

endif;

if ( ! function_exists( 'apace_tag_list' ) ) :
	/**
	 * Displays the category list.
	 */
	function apace_tag_list() {
		$tag_list = get_the_tag_list( ' ' );

		if ( $tag_list ) {

			printf( '<div class="apa-tag-list"><span class="apa-tag-list-icon">%1$s</span>%2$s</div>', apace_get_icon_svg( 'tag' ), $tag_list );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		}
	}

endif;

if ( ! function_exists( 'apace_comments_link' ) ) :
	/**
	 * Displays the comments link.
	 */
	function apace_comments_link() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			
			$num_comments = get_comments_number();

			$svg_icon = apace_get_icon_svg( 'comments' );

			return sprintf( '<span class="comments-link"><span class="apa-comment-icon">%1$s</span><a href="%2$s">%3$s</a></span>',
				$svg_icon,
				esc_url( get_comments_link() ),
				esc_html( $num_comments )
			);
			
		}
	}

endif;

if ( ! function_exists( 'apace_entry_meta' ) ) :
	/**
	 * Displays entry meta.
	 */
	function apace_entry_meta() {

		$meta_data = array();

		if ( is_single() ) {
			if ( true == get_theme_mod( 'apace_show_post_author', true ) ) {
				$meta_data[] = apace_posted_by();
			}
	
			if ( true == get_theme_mod( 'apace_show_post_date', true ) ) {
				$meta_data[] = apace_posted_on();
			}
	
			if ( true == get_theme_mod( 'apace_show_post_comment_link', true ) ) {
				if ( ! empty( apace_comments_link() ) ) {
					$meta_data[] = apace_comments_link();
				}
			}
		} else {
			if ( true == get_theme_mod( 'apace_show_arc_author', true ) ) {
				$meta_data[] = apace_posted_by();
			}
	
			if ( true == get_theme_mod( 'apace_show_arc_date', true ) ) {
				$meta_data[] = apace_posted_on();
			}
	
			if ( true == get_theme_mod( 'apace_show_arc_comment_link', true ) ) {
				if ( ! empty( apace_comments_link() ) ) {
					$meta_data[] = apace_comments_link();
				}
			}
		}

		if ( ! empty( $meta_data ) ) {
			$svg_icon = apace_get_icon_svg( 'dash' );
			$separator = '<span class="apace-separator">'. $svg_icon .'</span>';
			$meta_string = implode( $separator, $meta_data );
			echo $meta_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

	}
	
endif;

if ( ! function_exists( 'apace_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function apace_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) : ?>

			<?php if ( true == get_theme_mod( 'apace_show_post_thumb', true ) ) : ?>

				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'apace-featured' ); ?>
				</div><!-- .post-thumbnail -->

			<?php endif; ?>

		<?php else : ?>
			
			<?php if ( true == get_theme_mod( 'apace_show_arc_thumb', true ) ) : ?>
			
				<div class="apa-archive-thumb">
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
						<?php
							the_post_thumbnail(
								'apace-grid',
								array(
									'alt' => the_title_attribute(
										array(
											'echo' => false,
										)
									),
								)
							);
						?>
					</a>
				</div><!-- .apa-archive-thumb -->

			<?php

			endif; // if archive thumbnail.
			
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'apace_get_icon_svg' ) ) :
	/**
	 * Get SVG Icons.
	 */
	function apace_get_icon_svg( $icon_name ) {

		$output = "";

		if ( 'chevron-down' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>';
		}

		if ( 'chevron-right' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>';
		}

		if ( 'arrow-right' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
		}

		if ( 'arrow-left' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>';
		}

		if ( 'menu-bars' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>';
		}

		if ( 'close' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
		}

		if ( 'tag' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>';
		}

		if ( 'comments' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>';
		}

		if ( 'dash' == $icon_name ) {
			$output = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="apa-svg-icon apace-dash"><line x1="10.5" y1="10.5" x2="15.5" y2="10.5"></line></svg>';
		}

		return $output;

	}

endif;

/**
 * Echo svg icon.
 */
function apace_the_icon_svg( $icon ) {
	echo apace_get_icon_svg( $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in function.
}


if ( ! function_exists( 'apace_posts_pagination' ) ) :
	/**
	 * Posts pagination
	 */
	function apace_posts_pagination() {
		the_posts_pagination(
			array(
				'class' => 'apace-pagination',
				'mid_size'  => 2,
				'prev_text' => sprintf(
					/* translators: left arrow */
					esc_html__( '%s Previous', 'apace' ),
					'<span aria-hidden="true">&larr;</span>'
				),
				'next_text' => sprintf(
					/* translators: right arrow */
					esc_html__( 'Next %s', 'apace' ),
					'<span aria-hidden="true">&rarr;</span>'
				),
			)
		);
	}
endif;
