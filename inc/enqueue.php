<?php
/**
 * Workroom1128 enqueue scripts.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'workroom1128_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function workroom1128_scripts() {

		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		// Grab asset urls.
		$theme_styles  = '/dist/css/bundle.css';
		$theme_scripts = '/dist/js/bundle.js';
		$css_version   = $theme_version . '.' . filemtime( get_template_directory() . $theme_styles );
		wp_enqueue_style( 'workroom1128-styles', get_template_directory_uri() . $theme_styles, array(), $css_version );

		// Commented out code for now wp_enqueue_script( 'jquery' );.

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . $theme_scripts );
		wp_enqueue_script( 'workroom1128-scripts', get_template_directory_uri() . $theme_scripts, array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		global $wp_query;
		// works with inc/rest-api.php.
		wp_localize_script(
			'workroom1128-scripts',
			'coachingData',
			array(
				'root_url'  => esc_url( get_site_url() ),
				'api_url'   => esc_url( site_url() ) . '/wp-json/',
				'api_nonce' => wp_create_nonce( 'wp_rest' ),
				'page'      => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
				'bannerimg' => get_template_directory_uri() . '/dist/img/banner-book.jpg',
			),
		);
	}
} // End of if function_exists( 'workroom1128_scripts' ).

add_action( 'wp_enqueue_scripts', 'workroom1128_scripts' );


/**
 * Filter script tags.
 *
 * @param string $html html code.
 * @param string $handle the handle to use in script.
 */
function dd_filter_script_loader_tag( $html, $handle ) {
	if ( 'webfonts' === $handle || 'webfonts2' === $handle ) {
			return str_replace( "rel='stylesheet'", "rel='preload' as='font' type='font/woff2' crossorigin='anonymous'", $html );
	}
	return $html;
}
// phpcs:disable
// add_filter('style_loader_tag', 'dd_filter_script_loader_tag', 10, 4); // phpcs:ignore Squiz.PHP.CommentedOutCode.Found.
// phpcs:enable
add_action( 'wp_head', 'workroom1128_google_fonts' );
/**
 * Load Google Fonts from CDN.
 */
function workroom1128_google_fonts() {
	// phpcs:disable
	// Enter the URL of your Google Fonts generated from https://fonts.google.com/ here.
	$google_fonts_url = 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,400&display=swap';
	?>
	<link rel="preconnect"
		href="https://fonts.gstatic.com"
		crossorigin >

	<link rel="preload"
		as="style"
		href="<?php echo esc_url( $google_fonts_url ); ?>" >

	<link rel="stylesheet" 
		href="<?php echo esc_url( $google_fonts_url ); // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet. ?>"
		media="print" onload="this.media='all'" > 

	<noscript>
		<link rel="stylesheet"
			href="<?php echo esc_url( $google_fonts_url ); ?>" >
	</noscript>
	<?php
	// phpcs:enable
}
/**
 * Add sync attribute to enquequed scripts.
 *
 * @param string $tag Tag for script.
 * @param string $handle Handle for script.
 */
function add_async_attribute( $tag, $handle ) {
	// Add script handles to the array below.
	$scripts_to_async = array( 'workroom1128-scripts' );

	foreach ( $scripts_to_async as $async_script ) {
		if ( $async_script === $handle ) {
			return str_replace( ' src', ' async="async" src', $tag );
		}
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'add_async_attribute', 10, 2 );

/**
 * Add defer attribute to enquequed scripts.
 *
 * @param string $tag Tag for script.
 * @param string $handle Handle for script.
 */
function add_defer_attribute( $tag, $handle ) {
	// Add script handles to the array below.
	$scripts_to_defer = array(
		'admin',
		'customize-preview',
	);
	foreach ( $scripts_to_defer as $defer_script ) {
		if ( $defer_script === $handle ) {
			return str_replace( ' src', ' defer="defer" src', $tag );
		}
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );
/**
 * Script that import modules must use a script tag with type="module",
 * so let's set it for the script.
 */
// phpcs:disable
// add_filter( 'script_loader_tag', function ( $tag, $handle, $src ) {

// 	switch ( $handle ) {
// 		case 'workroom1128-scripts':
// 			return '<script type="module" src="' . esc_url( $src ) . '"></script>';
// 			break;

// 		default:
// 			return $tag;
// 			break;
// 	}

// }, 10, 3 );

// }, 10, 3 );
// phpcs:enable
/**
 * Enqueue block JavaScript and CSS for the editor.
 */
function workroom1128_block_plugin_editor_scripts() {
	// Enqueue block editor styles.
	wp_enqueue_style(
		'workroom1128-block-editor-css',
		get_template_directory_uri() . '/dist/css/block-editor.css',
		array(),
		filemtime( get_template_directory() . '/dist/css/block-editor.css' )
	);
}
// Hook the enqueue functions into the editor.
add_action( 'enqueue_block_editor_assets', 'workroom1128_block_plugin_editor_scripts' );
