<?php
/**
 * Theme basic setup
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_action( 'after_setup_theme', 'workroom1128_setup' );

if ( ! function_exists( 'workroom1128_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function workroom1128_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on workroom1128, use a find and replace
		 * to change 'workroom1128' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'workroom1128', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'      => __( 'Primary Menu', 'workroom1128' ),
				'social-media' => __( 'Social Media Menu', 'workroom1128' ),
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
				'script',
				'style',
			)
		);

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'workroom1128_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		/*
		* Adds `async` and `defer` support for scripts registered or enqueued
		* by the theme.
		*/

		// Check and setup theme default settings.
		workroom1128_setup_theme_default_settings();

	}
}

/**
 * Responsive Images
 * Blog post image size (1200 x 630 pixels)
* Header image size (banner size 1048 x 250 pixels)
* Featured image size (landscape 1200 x 900 pixels)
* Featured image size (portrait 900 x 1200 pixels)
* WordPress background image size (1920 x 1080 pixels)
* Logo image size (300 x 169 pixels)
* Thumbnail image size (150 x 150 pixels)
 */
// Add featured image sizes
//
// Sizes are optimized and CROPPED for landscape aspect ratio
// and optimized for HiDPI displays on 'small' and 'medium' screen sizes.
add_image_size( 'sidebar-img', 65, 65, true );
add_image_size( 'thumbnail', 150, 150, true );
add_image_size( 'featured-video', 200, 130, true );
add_image_size( 'logo', 300, 169, true );
add_image_size( 'video', 150, 98, true );
add_image_size( 'blog-small', 300, 150, true );
add_image_size( 'featured-landscape', 1200, 900, true );
add_image_size( 'featured-portrait', 900, 1200, true ); /* name, width, height, crop */
add_image_size( 'blog', 400, 200, true );
add_image_size( 'featured-blog', 400, 200, true );
add_image_size( 'course-image', 500, 250, true );
add_image_size( 'background', 1920, 1080, true );
add_image_size( 'client', 252, 88, true );

add_image_size( 'banner', 1048, 250, true );
add_image_size( 'banner-xlarge', 1920, 400, true );
add_image_size( 'banner-large', 1440, 700, true );

/* Add additional image sizes without cropping */
add_image_size( 'dd-video', 640 );

add_image_size( 'blog-thumbnail', 226, 150, true );
