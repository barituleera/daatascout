<?php
/**
 * Apace Theme Customizer
 *
 * @package Apace
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function apace_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'apace_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'apace_customize_partial_blogdescription',
			)
		);
	}

	// Main Theme Color.
	$wp_customize->add_setting(
		'apace_primary_color',
		array(
			'default'			=> '#49a8ff',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_hex_color'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'apace_primary_color',
			array(
				'settings'		=> 'apace_primary_color',
				'section'		=> 'colors',
				'label'			=> esc_html__( 'Primary Color', 'apace' ),
				'description'	=> esc_html__( 'Select the main color of your site.', 'apace' )
			)
		)
	);

	$wp_customize->add_panel(
		'apace_options_panel',
		array(
			'priority' 			=> 10,
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> esc_html__( 'Theme Settings', 'apace' ),
		)
	);

	/***************************
	 * Layout Settings Section
	 */
	$wp_customize->add_section(
		'apace_layout_options',
		array(
			'title'			=> esc_html__( 'Layout Options', 'apace' ),
		)
	);

	/**
	 * Site Layout
	 */
	$wp_customize->add_setting(
		'apace_site_layout',
		array(
			'default'			=> 'boxed-layout',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_select'
		)
	);
	$wp_customize->add_control(
		'apace_site_layout',
		array(
			'settings'		=> 'apace_site_layout',
			'section'		=> 'apace_layout_options',
			'type'			=> 'radio',
			'label'			=> esc_html__( 'Site Layout', 'apace' ),
			'choices'		=> array(
				'boxed-layout' => esc_html__( 'Boxed Layout', 'apace' ),
				'wide-layout' => esc_html__( 'Wide Layout', 'apace' )
			)
		)
	);

	/***************************
	 * Content Settings Panel
	 */
	$wp_customize->add_panel(
		'apace_content_options_panel',
		array(
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> esc_html__( 'Content Options', 'apace' ),
		)
	);

	/**
	 * Archive Post Meta Data.
	 */
	$wp_customize->add_section(
		'apace_arc_content_options',
		array(
			'title'			=> esc_html__( 'Blog / Archive Content', 'apace' ),
			'panel'			=> 'apace_content_options_panel'
		)
	);

	//Post author
	$wp_customize->add_setting(
		'apace_show_arc_author',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_arc_author',
		array(
			'settings'		=> 'apace_show_arc_author',
			'section'		=> 'apace_arc_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Author', 'apace' ),
		)
	);

	//Post Date
	$wp_customize->add_setting(
		'apace_show_arc_date',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_arc_date',
		array(
			'settings'		=> 'apace_show_arc_date',
			'section'		=> 'apace_arc_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Date', 'apace' ),
		)
	);

	//Post Comment Link
	$wp_customize->add_setting(
		'apace_show_arc_comment_link',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_arc_comment_link',
		array(
			'settings'		=> 'apace_show_arc_comment_link',
			'section'		=> 'apace_arc_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Comments Count', 'apace' ),
		)
	);

	// Read More linke
	$wp_customize->add_setting(
		'apace_show_readmore',
		array(
			'default'			=> false,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_readmore',
		array(
			'settings'		=> 'apace_show_readmore',
			'section'		=> 'apace_arc_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Read More Link.', 'apace' ),
		)
	);

	// Thumbnail.
	$wp_customize->add_setting(
		'apace_show_arc_thumb',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_arc_thumb',
		array(
			'settings'		=> 'apace_show_arc_thumb',
			'section'		=> 'apace_arc_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Featured Image.', 'apace' ),
		)
	);

	// Excerpt length.
	$wp_customize->add_setting(
		'apace_excerpt_length',
		array(
			'default'			=> 30,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_number_absint'
		)
	);
	$wp_customize->add_control(
		'apace_excerpt_length',
		array(
			'settings'		=> 'apace_excerpt_length',
			'section'		=> 'apace_arc_content_options',
			'type'			=> 'number',
			'label'			=> esc_html__( 'Excerpt Length', 'apace' ),
			'description'	=> esc_html__( 'Default is 30', 'apace' )
		)
	);

	/**
	 * Single Post Meta Data.
	 */
	$wp_customize->add_section(
		'apace_single_content_options',
		array(
			'title'			=> esc_html__( 'Single Post Content', 'apace' ),
			'panel'			=> 'apace_content_options_panel'
		)
	);

	//Post author
	$wp_customize->add_setting(
		'apace_show_post_author',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_post_author',
		array(
			'settings'		=> 'apace_show_post_author',
			'section'		=> 'apace_single_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Author', 'apace' ),
		)
	);

	//Post Date
	$wp_customize->add_setting(
		'apace_show_post_date',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_post_date',
		array(
			'settings'		=> 'apace_show_post_date',
			'section'		=> 'apace_single_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Date', 'apace' ),
		)
	);

	//Post Comment Link
	$wp_customize->add_setting(
		'apace_show_post_comment_link',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_post_comment_link',
		array(
			'settings'		=> 'apace_show_post_comment_link',
			'section'		=> 'apace_single_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Comments Count', 'apace' ),
		)
	);

	// Thumbnail.
	$wp_customize->add_setting(
		'apace_show_post_thumb',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_post_thumb',
		array(
			'settings'		=> 'apace_show_post_thumb',
			'section'		=> 'apace_single_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Featured Image.', 'apace' ),
		)
	);

	//Category List
	$wp_customize->add_setting(
		'apace_show_post_cat_list',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_post_cat_list',
		array(
			'settings'		=> 'apace_show_post_cat_list',
			'section'		=> 'apace_single_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Category List', 'apace' ),
		)
	);

	//Tag List
	$wp_customize->add_setting(
		'apace_show_post_tag_list',
		array(
			'default'			=> true,
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_checkbox'
		)
	);
	$wp_customize->add_control(
		'apace_show_post_tag_list',
		array(
			'settings'		=> 'apace_show_post_tag_list',
			'section'		=> 'apace_single_content_options',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Tag List', 'apace' ),
		)
	);

	/***************************
	 * Footer Section
	 */
	$wp_customize->add_section(
		'apace_footer_options',
		array(
			'title'			=> esc_html__( 'Footer Options', 'apace' ),
		)
	);

	$wp_customize->add_setting(
		'apace_copyright_text',
		array(
			'default'			=> '',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'apace_sanitize_html'
		)
	);

	$wp_customize->add_control(
		'apace_copyright_text',
		array(
			'settings'		=> 'apace_copyright_text',
			'section'		=> 'apace_footer_options',
			'type'			=> 'textarea',
			'label'			=> esc_html__( 'Footer Copyright Text', 'apace' ),
		)
	);

}
add_action( 'customize_register', 'apace_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function apace_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function apace_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * HTML sanitization.
 *
 * - Sanitization: html
 * - Control: text, textarea
 * 
 * Sanitization callback for 'html' type text inputs. This callback sanitizes `$html`
 * for HTML allowable in posts.
 * 
 * NOTE: wp_filter_post_kses() can be passed directly as `$wp_customize->add_setting()`
 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
 * 
 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 */
function apace_sanitize_html( $html ) {
	return wp_filter_post_kses( $html );
}

/**
 * Select sanitization.
 *
 * - Sanitization: select
 * - Control: select, radio
 * 
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 * 
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function apace_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Checkbox sanitization.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function apace_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * HEX Color sanitization.
 *
 * - Sanitization: hex_color
 * - Control: text, WP_Customize_Color_Control
 * 
 * Note: sanitize_hex_color_no_hash() can also be used here, depending on whether
 * or not the hash prefix should be stored/retrieved with the hex color value.
 * 
 * @see sanitize_hex_color() https://developer.wordpress.org/reference/functions/sanitize_hex_color/
 * @link sanitize_hex_color_no_hash() https://developer.wordpress.org/reference/functions/sanitize_hex_color_no_hash/
 *
 * @param string               $hex_color HEX color to sanitize.
 * @param WP_Customize_Setting $setting   Setting instance.
 * @return string The sanitized hex color if not null; otherwise, the setting default.
 */
function apace_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );
	
	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
}

/**
 * Number sanitization.
 *
 * - Sanitization: number_absint
 * - Control: number
 * 
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 * 
 * NOTE: absint() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function apace_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function apace_customize_preview_js() {
	wp_enqueue_script( 'apace-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), APACE_VERSION, true );
}
add_action( 'customize_preview_init', 'apace_customize_preview_js' );
