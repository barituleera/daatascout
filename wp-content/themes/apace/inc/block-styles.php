<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage Apace
 * @since  Apace 1.0.0
 */
if ( function_exists( 'register_block_style' ) ) {

	/**
	 * Register block styles.
	 */
    function apace_register_block_styles() {
        register_block_style(
			'core/heading',
			array(
				'name'  => 'apace-widget-title',
				'label' => esc_html__( 'Widget title style', 'apace' ),
			)
		);
    }
    add_action( 'init', 'apace_register_block_styles' );

}