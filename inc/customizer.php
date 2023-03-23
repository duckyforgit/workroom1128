<?php
/**
 * Workroom1128 Theme Customizer
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'workroom1128_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function workroom1128_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'workroom1128_customize_register' );

if ( ! function_exists( 'workroom1128_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function workroom1128_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'workroom1128_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'workroom1128' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'workroom1128' ),
				'priority'    => apply_filters( 'workroom1128_theme_layout_options_priority', 160 ),
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function workroom1128_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'workroom1128_bootstrap_version',
			array(
				'default'           => 'bootstrap4',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'workroom1128_bootstrap_version',
				array(
					'label'       => __( 'Bootstrap Version', 'workroom1128' ),
					'description' => __( 'Choose between Bootstrap 4 or Bootstrap 5', 'workroom1128' ),
					'section'     => 'workroom1128_theme_layout_options',
					'settings'    => 'workroom1128_bootstrap_version',
					'type'        => 'select',
					'choices'     => array(
						'bootstrap4' => __( 'Bootstrap 4', 'workroom1128' ),
						'bootstrap5' => __( 'Bootstrap 5', 'workroom1128' ),
					),
					'priority'    => apply_filters( 'workroom1128_bootstrap_version_priority', 10 ),
				)
			)
		);

		$wp_customize->add_setting(
			'workroom1128_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'workroom1128_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'workroom1128_container_type',
				array(
					'label'       => __( 'Container Width', 'workroom1128' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'workroom1128' ),
					'section'     => 'workroom1128_theme_layout_options',
					'settings'    => 'workroom1128_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'workroom1128' ),
						'container-fluid' => __( 'Full width container', 'workroom1128' ),
					),
					'priority'    => apply_filters( 'workroom1128_container_type_priority', 10 ),
				)
			)
		);

		$wp_customize->add_setting(
			'workroom1128_navbar_type',
			array(
				'default'           => 'collapse',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'workroom1128_navbar_type',
				array(
					'label'             => __( 'Responsive Navigation Type', 'workroom1128' ),
					'description'       => __(
						'Choose between an expanding and collapsing navbar or an offcanvas drawer.',
						'workroom1128'
					),
					'section'           => 'workroom1128_theme_layout_options',
					'settings'          => 'workroom1128_navbar_type',
					'type'              => 'select',
					'sanitize_callback' => 'workroom1128_theme_slug_sanitize_select',
					'choices'           => array(
						'collapse'  => __( 'Collapse', 'workroom1128' ),
						'offcanvas' => __( 'Offcanvas', 'workroom1128' ),
					),
					'priority'          => apply_filters( 'workroom1128_navbar_type_priority', 20 ),
				)
			)
		);

		$wp_customize->add_setting(
			'workroom1128_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'workroom1128_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'workroom1128' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'workroom1128'
					),
					'section'           => 'workroom1128_theme_layout_options',
					'settings'          => 'workroom1128_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'workroom1128_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'workroom1128' ),
						'left'  => __( 'Left sidebar', 'workroom1128' ),
						'both'  => __( 'Left & Right sidebars', 'workroom1128' ),
						'none'  => __( 'No sidebar', 'workroom1128' ),
					),
					'priority'          => apply_filters( 'workroom1128_sidebar_position_priority', 20 ),
				)
			)
		);

		$wp_customize->add_setting(
			'workroom1128_site_info_override',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_kses_post',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'workroom1128_site_info_override',
				array(
					'label'       => __( 'Footer Site Info', 'workroom1128' ),
					'description' => __( 'Override workroom1128\'s site info located at the footer of the page.', 'workroom1128' ),
					'section'     => 'workroom1128_theme_layout_options',
					'settings'    => 'workroom1128_site_info_override',
					'type'        => 'textarea',
					'priority'    => 20,
				)
			)
		);
		/**
		* Section Customizer Options.
		*/
		$wp_customize->add_section(
			'site_options_section',
			array(
				'title'      => __( ' Business Options Section', 'workroom1128' ),
				'priority'   => 70,
				'capability' => 'edit_theme_options',
			),
		);

		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[site_options_start_year]',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			),
		);

		$wp_customize->add_control(
			'theme_options[site_options_start_year]',
			array(
				'label'   => __( 'Business Start Year ', 'workroom1128' ),
				'section' => 'site_options_section',
				'type'    => 'text',
			),
		);

		// About title setting and control.
		$wp_customize->add_setting(
			'theme_options[site_options_phone_number]',
			array(
				'default'           => 'Please enter valid phone',
				'sanitize_callback' => 'workroom1128_sanitize_phone_number',
			),
		);
		$wp_customize->add_control(
			'theme_options[site_options_phone_number]',
			array(
				'label'   => __( 'Business Phone Number ', 'workroom1128' ),
				'section' => 'site_options_section',
				'type'    => 'text',
			),
		);

		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[site_options_street_address]',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			),
		);
		$wp_customize->add_control(
			'theme_options[site_options_street_address]',
			array(
				'label'   => __( 'Business Street Address ', 'workroom1128' ),
				'section' => 'site_options_section',
				'type'    => 'text',
			),
		);

		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[site_options_city_address]',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			),
		);

		$wp_customize->add_control(
			'theme_options[site_options_city_address]',
			array(
				'label'   => __( 'Business City', 'workroom1128' ),
				'section' => 'site_options_section',
				'type'    => 'text',
			),
		);

		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[site_options_state_address]',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			),
		);

		$wp_customize->add_control(
			'theme_options[site_options_state_address]',
			array(
				'label'   => __( 'Business State', 'workroom1128' ),
				'section' => 'site_options_section',
				'type'    => 'text',
			),
		);

		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[site_options_zip_address]',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			),
		);
		$wp_customize->add_control(
			'theme_options[site_options_zip_address]',
			array(
				'label'   => __( 'Business Zip Code', 'workroom1128' ),
				'section' => 'site_options_section',
				'type'    => 'text',
			),
		);

		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[site_options_email_address]',
			array(
				'default'           => 'Please use valid email',
				'sanitize_callback' => 'workroom1128_sanitize_email',
			),
		);
		$wp_customize->add_control(
			'theme_options[site_options_email_address]',
			array(
				'label'   => __( 'Business Email Address', 'workroom1128' ),
				'section' => 'site_options_section',
				'type'    => 'text',
			),
		);
		/**
		* Social Media Customizer Options.
		*/
		$wp_customize->add_section(
			'social_media_section',
			array(
				'title'      => __( ' Social Media Section', 'workroom1128' ),
				'priority'   => 70,
				'capability' => 'edit_theme_options',
			),
		);

		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[social_media_facebook_url]',
			array(
				'sanitize_callback' => 'workroom1128_sanitize_url',
			),
		);

		$wp_customize->add_control(
			'theme_options[social_media_facebook_url]',
			array(
				'label'   => __( 'Business Facebook URL', 'workroom1128' ),
				'section' => 'social_media_section',
				'type'    => 'url',
			),
		);

		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[social_media_twitter_url]',
			array(
				'sanitize_callback' => 'workroom1128_sanitize_url',
			),
		);
		$wp_customize->add_control(
			'theme_options[social_media_twitter_url]',
			array(
				'label'   => __( 'Business Twitter URL', 'workroom1128' ),
				'section' => 'social_media_section',
				'type'    => 'url',
			),
		);
		// about title setting and control.
		$wp_customize->add_setting(
			'theme_options[social_media_instagram_url]',
			array(
				'sanitize_callback' => 'workroom1128_sanitize_url',
			),
		);
		$wp_customize->add_control(
			'theme_options[social_media_instagram_url]',
			array(
				'label'   => __( 'Business Instagram URL', 'workroom1128' ),
				'section' => 'social_media_section',
				'type'    => 'url',
			),
		);

	}
} // End of if function_exists( 'workroom1128_theme_customize_register' ).
add_action( 'customize_register', 'workroom1128_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'workroom1128_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function workroom1128_customize_preview_js() {
		wp_enqueue_script(
			'workroom1128_customizer',
			get_template_directory_uri() . '/dist/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
// Commented out code not using js custom preview at this time add_action( 'customize_preview_init', 'workroom1128_customize_preview_js' );.

/**
 * Loads javascript for conditionally showing customizer controls.
 */
if ( ! function_exists( 'workroom1128_customize_controls_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function workroom1128_customize_controls_js() {
		wp_enqueue_script(
			'workroom1128_customizer',
			get_template_directory_uri() . '/dist/js/customizer-controls.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
// Commented out code not using js custom preview at this time add_action( 'customize_controls_enqueue_scripts', 'workroom1128_customize_controls_js' );.



if ( ! function_exists( 'workroom1128_default_navbar_type' ) ) {
	/**
	 * Overrides the responsive navbar type for Bootstrap 4
	 *
	 * @param string $current_mod Modification value.
	 * @return string
	 */
	function workroom1128_default_navbar_type( $current_mod ) {

		if ( 'bootstrap5' !== get_theme_mod( 'workroom1128_bootstrap_version' ) ) {
			$current_mod = 'collapse';
		}

		return $current_mod;
	}
}
add_filter( 'theme_mod_workroom1128_navbar_type', 'workroom1128_default_navbar_type', 20 );


if ( ! function_exists( 'workroom1128_get_option' ) ) :
	/**
	 * Get options from customizer.
	 *
	 * @param string $key Modification key.
	 * @return string
	 */
	function workroom1128_get_option( $key ) {

		$default_options = workroom1128_get_default_theme_options();
		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array) get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}
endif;

if ( ! function_exists( 'workroom1128_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function workroom1128_get_default_theme_options() {

		$defaults = array();
		// Pass through filter.
		$defaults = apply_filters( 'workroom1128_default_theme_options', $defaults );
		return $defaults;
	}

endif;


if ( ! function_exists( 'workroom1128_sanitize_phone_number' ) ) :
	/**
	 * Get default theme phone number.
	 *
	 * @since 1.0.0
	 * @param string               $phonenumber The options phonenumber.
	 * @param WP_Customize_Setting $setting Setting instance.
	 *
	 * @return array Default theme options.
	 */
	function workroom1128_sanitize_phone_number( $phonenumber, $setting ) {
		$error = '';
		if ( empty( $phonenumber ) ) {
			return $setting->default;
		} elseif ( ! preg_match( '/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phonenumber ) ) {
			$error = 'Invalid Number!';
			return $setting->default;
		} else {
			$phone = sanitize_text_field( $phonenumber );
			return $phone;
		}
	}
endif;

/**
 * Customizer: Sanitization Callbacks
 *
 * This file demonstrates how to define sanitization callback functions for various data types.
 *
 * @package   code-examples
 * @copyright Copyright (c) 2015, WordPress Theme Review Team
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */


/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either true or false.
 *
 * @param  bool                 $checked Whether the checkbox is checked.
 * @param  WP_Customize_Setting $setting Setting instance.
 * @return bool Whether the checkbox is checked.
 */
function workroom1128_sanitize_checkbox( $checked, $setting ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
/**
 * CSS sanitization callback example.
 *
 * - Sanitization: css
 * - Control: text, textarea
 *
 * Sanitization callback for 'css' type textarea inputs. This callback sanitizes
 * `$css` for valid CSS.
 *
 * NOTE: wp_strip_all_tags() can be passed directly as `$wp_customize->add_setting()`
 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
 *
 * @see wp_strip_all_tags() https://developer.wordpress.org/reference/functions/wp_strip_all_tags/
 *
 * @param string               $css CSS to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized CSS.
 */
function workroom1128_sanitize_css( $css, $setting ) {
	return wp_strip_all_tags( $css );
}
/**
 * Drop-down Pages sanitization callback example.
 *
 * - Sanitization: dropdown-pages
 * - Control: dropdown-pages
 *
 * Sanitization callback for 'dropdown-pages' type controls. This callback sanitizes `$page_id`
 * as an absolute integer, and then validates that $input is the ID of a published page.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 * @see get_post_status() https://developer.wordpress.org/reference/functions/get_post_status/
 *
 * @param int                  $page_id    Page ID.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string Page ID if the page is published; otherwise, the setting default.
 */
function workroom1128_sanitize_dropdown_pages( $page_id, $setting ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $page_id );

	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );
}
/**
 * Email sanitization callback example.
 *
 * - Sanitization: email
 * - Control: text
 *
 * Sanitization callback for 'email' type text controls. This callback sanitizes `$email`
 * as a valid email address.
 *
 * @see sanitize_email() https://developer.wordpress.org/reference/functions/sanitize_key/
 * @link sanitize_email() https://codex.wordpress.org/Function_Reference/sanitize_email
 *
 * @param string               $email   Email address to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The sanitized email if not null; otherwise, the setting default.
 */
function workroom1128_sanitize_email( $email, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$email = sanitize_email( $email );
	// If $email is a valid email, return it; otherwise, return the default.
	if ( $email ) {
		return $email;
	} else {
		return $setting->default;
	}
	// Note for another instrance to check for not null return ( ! null( $email ) ? $email : $setting->default );.
}
/**
 * HEX Color sanitization callback example.
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
function workroom1128_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );

	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
}
/**
 * HTML sanitization callback example.
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
 * @param string               $html HTML to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized HTML.
 */
function workroom1128_sanitize_html( $html, $setting ) {
	return wp_filter_post_kses( $html );
}
/**
 * Image sanitization callback example.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function workroom1128_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon',
	);
	// Return an array with file extension and mime_type.
	$file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
	return ( $file['ext'] ? $image : $setting->default );
}
/**
 * No-HTML sanitization callback example.
 *
 * - Sanitization: nohtml
 * - Control: text, textarea, password
 *
 * Sanitization callback for 'nohtml' type text inputs. This callback sanitizes `$nohtml`
 * to remove all HTML.
 *
 * NOTE: wp_filter_nohtml_kses() can be passed directly as `$wp_customize->add_setting()`
 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
 *
 * @see wp_filter_nohtml_kses() https://developer.wordpress.org/reference/functions/wp_filter_nohtml_kses/
 *
 * @param string               $nohtml The no-HTML content to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized no-HTML content.
 */
function workroom1128_sanitize_nohtml( $nohtml, $setting ) {
	return wp_filter_nohtml_kses( $nohtml );
}
/**
 * Number sanitization callback example.
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
function workroom1128_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default.
	return ( $number ? $number : $setting->default );
}
/**
 * Number Range sanitization callback example.
 *
 * - Sanitization: number_range
 * - Control: number, tel
 *
 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
 * `$number` as an absolute integer within a defined min-max range.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise,
 *                    the setting default.
 */
function workroom1128_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default.
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
/**
 * Select sanitization callback example.
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
function workroom1128_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
/**
 * URL sanitization callback example.
 *
 * - Sanitization: url
 * - Control: text, url
 *
 * Sanitization callback for 'url' type text inputs. This callback sanitizes `$url` as a valid URL.
 *
 * NOTE: esc_url_raw() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 *
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string               $url URL to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized URL.
 */
function workroom1128_sanitize_url( $url, $setting ) {
	return esc_url_raw( $url );
}
