<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Apace
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function apace_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( 'boxed-layout' === get_theme_mod( 'apace_site_layout', 'boxed-layout' ) ) {
		$classes[] = 'apace-boxed-layout';
	}

	return $classes;
}
add_filter( 'body_class', 'apace_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function apace_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'apace_pingback_header' );

/**
 * Add a custom excerpt length.
 */
function apace_excerpt_length( $length ) {
	if( is_admin() ) {
		return $length;
	}
	$custom_length = get_theme_mod( 'apace_excerpt_length', 30 );
	return absint( $custom_length );
}
add_filter( 'excerpt_length', 'apace_excerpt_length', 999 );

/**
 * Changes the excerpt more text.
 */
function apace_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	if ( true == get_theme_mod( 'apace_show_readmore', false ) ) {
		return sprintf( '&hellip; <a href="%1$s" class="apace-readmore-link">%2$s%3$s</a>',
			esc_url( get_permalink( get_the_ID() ) ),
			the_title( '<span class="screen-reader-text">', '</span>', false ),
			esc_html__( 'Read more', 'apace' )
		);
	}

	return '&hellip; ';
}
add_filter( 'excerpt_more', 'apace_excerpt_more' );

/**
 * Adds a Sub Nav Toggle to the Mobile Menu.
 *
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param WP_Post  $item  Menu item data object.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return stdClass An object of wp_nav_menu() arguments.
 * @since Apace 1.0.0
 */
function apace_add_dropdown_toggle_to_menu( $title, $item, $args, $depth ) {
	
	// Add sub menu toggles to the menu.
	if ( isset( $args->show_toggles ) && $args->show_toggles ) {

		$args->link_after = '';

		// Add a toggle to items with children.
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

			// Note: Implement mobile menu dropdown toggles later. 
			$toggle_target_string = '.main-navigation .menu-item-' . $item->ID . ' > .sub-menu';

			$svg_icon = apace_get_icon_svg('chevron-down');

			// Add the sub menu toggle.
			$args->link_after = '<span class="apa-menu-icon dropdown-toggle" data-toggle-target="' . $toggle_target_string . '" aria-expanded="false">'. $svg_icon .'<span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'apace' ) . '</span></span>';

		}

	} 

	return $title;

}

add_filter( 'nav_menu_item_title', 'apace_add_dropdown_toggle_to_menu', 10, 4 );