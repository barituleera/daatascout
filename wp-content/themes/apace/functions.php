<?php
/**
 * Apace functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Apace
 */

if ( ! defined( 'APACE_VERSION' ) ) {
	define( 'APACE_VERSION', '1.0.4' );
}

if ( ! function_exists( 'apace_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function apace_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Apace, use a find and replace
		 * to change 'apace' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'apace', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'apace-grid', 744, 420, true );
		add_image_size( 'apace-featured', 1250, 700, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Main Menu', 'apace' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'apace_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Enqueue editor styles.
		add_editor_style( 'editor-style.css' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'apace_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function apace_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'apace_content_width', 779 );
}
add_action( 'after_setup_theme', 'apace_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function apace_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'apace' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to display in the main sidebar.', 'apace' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Widget Area', 'apace' ),
			'id'            => 'sidebar-apace-header',
			'description'   => esc_html__( 'Add widgets that you want to display next to site title.', 'apace' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Left Sidebar', 'apace' ),
			'id'            => 'sidebar-apace-footer-left',
			'description'   => esc_html__( 'Add widgets to the left side of the footer widget area.', 'apace' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Mid Sidebar', 'apace' ),
			'id'            => 'sidebar-apace-footer-mid',
			'description'   => esc_html__( 'Add widgets to the middle of the footer widget area.', 'apace' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Right Sidebar', 'apace' ),
			'id'            => 'sidebar-apace-footer-right',
			'description'   => esc_html__( 'Add widgets to the right side of the footer widget area.', 'apace' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'apace_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function apace_scripts() {
	wp_enqueue_style( 'apace-style', get_stylesheet_uri(), array(), APACE_VERSION );
	wp_style_add_data( 'apace-style', 'rtl', 'replace' );

	wp_enqueue_script( 'apace-navigation', get_template_directory_uri() . '/js/navigation.js', array(), APACE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'apace_scripts' );

/**
 * Theme custom color styles.
 */
function apace_custom_styles() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && '#49a8ff' === get_theme_mod( 'apace_primary_color', '#49a8ff' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/custom-styles.php' );

	?>

	<style type="text/css" id="custom-theme-colors">
		<?php 
			$custom_css = apace_generate_custom_css();
			echo wp_strip_all_tags( $custom_css ); // phpcs:ignore WordPress.Security.EscapeOutput 
		?>
	</style>
	<?php
}
add_action( 'wp_head', 'apace_custom_styles' );

/**
 * Enqueue block editor styles.
 */
function apace_block_editor_styles() {
	// Enqueue the editor styles.
	wp_enqueue_style( 'apace-block-editor-styles', get_theme_file_uri( 'block-editor.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
}
add_action( 'enqueue_block_editor_assets', 'apace_block_editor_styles', 1, 1 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Nav Walker.
 */
require get_template_directory() . '/inc/class-apace-nav-walker.php';

/**
 * Block styles.
 */
require get_template_directory() . '/inc/block-styles.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
