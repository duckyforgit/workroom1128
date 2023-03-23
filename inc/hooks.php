<?php
/**
 * Custom Hooks
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'workroom1128_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function workroom1128_site_info() {
		do_action( 'workroom1128_site_info' );
	}
}

add_action( 'workroom1128_site_info', 'workroom1128_add_site_info' );

if ( ! function_exists( 'workroom1128_add_site_info' ) ) {
	/**
	 * Add site info content.
	 *  2019 - 2022 Deliberate Doing, LLC. All Rights Reserved
	 */
	function workroom1128_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info =
			sprintf(
				/* translators: WordPress */
				'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
				esc_url(
					__( 'https://wordpress.org/', 'workroom1128' ),
				),
			);
			sprintf(
				/* translators: WordPress */
				esc_html__( 'Proudly powered by %s', 'workroom1128' ),
				'WordPress'
			);
			sprintf( // WPCS: XSS ok.
				/* translators: 1: Theme name, 2: Theme author */
				esc_html__( 'Theme: %1$s by %2$s.', 'workroom1128' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'https://workroom1128.com', 'workroom1128' ) ) . '">workroom1128.com</a>'
			);
			sprintf( // WPCS: XSS ok.
				/* translators: Theme version */
				esc_html__( 'Version: %1$s', 'workroom1128' ),
				$the_theme->get( 'Version' ),
			);

		// Check if customizer site info has value.
		if ( get_theme_mod( 'workroom1128_site_info_override' ) ) {
			$site_info = get_theme_mod( 'workroom1128_site_info_override' );
		}

		echo esc_html( apply_filters( 'workroom1128_site_info_content', $site_info ) );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
	}
}

if ( ! function_exists( 'workroom1128_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function workroom1128_site_info() {
		do_action( 'workroom1128_site_info' );
	}
}

if ( ! function_exists( 'workroom1128_add_site_info' ) ) {
	/**
	 * Add site info content.
	 */
	function workroom1128_add_site_info() {
		// This code could be used to get the author linke $themeURI = esc_html__($the_theme->get( 'AuthorURI' ));.
		$the_theme        = wp_get_theme();
		$current_year     = gmdate( 'Y' );
		$startyear        = workroom1128_get_option( 'site_options_start_year' );
		$sitename         = get_bloginfo( 'name' );
		$contact_page_url = get_site_url( null, '/contact' );
		$contact_email    = workroom1128_get_option( 'site_options_email_address' );
		esc_html_e( 'Dear Guest, with your information we not find any room at the moment. ', 'workroom1128' );

		$text = sprintf(
			/* translators: 1: Start Year */
			__( 'Please contact us on our <a href="%1$s">contact page</a> or by email %2$s.', 'workroom1128' ),
			esc_url( $contact_page_url ),
			sprintf( '<a href="mailto:%1$s">%1$s</a>', antispambot( $contact_email ) ),
		);
		echo wp_kses( $text, array( 'a' => array( 'href' => array() ) ) );

		$site_info =
			sprintf(
				/* translators: 1: Start Year */
				'<div class="d-flex justify-content-between"><div class="flex-grow-1">
				<p><span>&copy;&nbsp;%1$s&#8211;%2$s</span><span class="sep"> | </span>%3$s</p></div><div class="">
				<a href="%4$s">Privacy Policy</a></div></div>',
				sprintf(
					/* translators: 1: Start Year */
					esc_html__( 'Theme %1$s', 'workroom1128' ),
					$startyear
				),
				sprintf(
					/* translators: 1: Start Year */
					esc_html__( 'Theme: %1$s by %2$s.', 'workroom1128' ),
					$the_theme->get( 'Name' ),
					'<a href="' . esc_url( __( 'https://workroom1128.com', 'workroom1128' ) ) . '">workroom1128.com</a>'
				),
				sprintf(
					/* translators: 1: Sitename */
					esc_html__( 'Site %s', 'workroom1128' ),
					$sitename
				),
				/* translators: WordPress */
				sprintf(
					/* translators: 1: Page title */
					esc_html__( 'Page %s', 'workroom1128' ),
					get_permalink( get_page_by_title( 'Privacy Policy' ) ),
				),
			);
		// Check if customizer site info has value.
		if ( get_theme_mod( 'workroom1128_site_info_override' ) ) {
			$site_info = get_theme_mod( 'workroom1128_site_info_override' );
		}

		echo esc_html( apply_filters( 'workroom1128_site_info_content', $site_info ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped.
	}
}
if ( ! function_exists( 'workroom1128_add_site_info_alternate' ) ) {
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	function workroom1128_add_site_info_alternate() {
		$the_theme = wp_get_theme();
		$author    = $the_theme->get( 'AuthorURI' );
		$startyear = workroom1128_get_option( 'site_options_start_year' );
		$copyright = '&copy;&nbsp;' . esc_html( $startyear ) . '-' . esc_html( gmdate( 'Y' ) );
		$siteurl   = esc_url( site_url( '/' ) );
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
			esc_url( __( 'https://wordpress.org/', 'workroom1128' ) ),
			sprintf(
				/* translators: WordPress */
				esc_html__( 'Proudly powered by %s', 'workroom1128' ),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: 1: Theme name, 2: Theme author */
				esc_html__( 'Theme: %1$s by %2$s.', 'workroom1128' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'https://1128workroom.com', 'workroom1128' ) ) . '">1128workroom.com</a>'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: Theme version */
				esc_html__( 'Version: %1$s', 'workroom1128' ),
				$the_theme->get( 'Version' )
			)
		);

		// Check if customizer site info has value.
		if ( get_theme_mod( 'understrap_site_info_override' ) ) {
			$site_info = get_theme_mod( 'understrap_site_info_override' );
		}

		echo apply_filters( 'understrap_site_info_content', $site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// customize LOGIN screen. Modify header link to be site URL.

if ( ! function_exists( 'workroom1128_headerurl' ) ) {
	/**
	 * Header URL
	 *
	 * @return string escaped url.
	 */
	function workroom1128_headerurl() {
		return esc_url( site_url( '/' ) );
	}
}

if ( ! function_exists( 'workroom1128_login_title' ) ) {

	/**
	 * Return the site name on login page by modifying the login title.
	 *
	 * @return string get_option of site name.
	 */
	function workroom1128_login_title() {
		return get_option( 'blogname' );
	}
}

if ( ! function_exists( 'workroom1128_login_css' ) ) {
	/**
	 * Add styles to login page by enqueing styles.
	 *
	 * @return void
	 */
	function workroom1128_login_css() {
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );
		$admin_styles  = '/dist/css/admin.css';
		$css_version   = $theme_version . '.' . filemtime( get_template_directory() . $admin_styles );
		if ( is_admin() ) {
			wp_enqueue_style(
				'_workroom1128-stylesheet',
				get_template_directory_uri() . '/dist/css/admin.css',
				array(),
				$css_version,
			);
		}
	}
}
add_action( 'admin_enqueue_scripts', 'workroom1128_login_css' );
// Commented out filter to be used to add avatar add_filter( 'wp_nav_menu_objects', 'my_dynamic_menu_items', 10 );.

/**
 * Display avatar in menu.
 *
 * @param  object $menu_items Current menu.
 * @return object $menu_items Menu listing.
 */
function my_dynamic_menu_items( $menu_items ) {
	foreach ( $menu_items as $menu_item ) {
		if ( strpos( $menu_item->title, '#profile_name#' ) !== false ) {
			$menu_item->title = str_replace(
				'#profile_name#',
				wp_get_current_user()->user_login . ' ' . get_avatar( wp_get_current_user()->user_email, 50 ),
				$menu_item->title,
			);
		}
	}
	return $menu_items;
}

if ( ! function_exists( 'workroom1128_entry_meta_categories' ) ) :
	/**
	 * Displays the categories of posts.
	 *
	 * @return void
	 */
	function workroom1128_entry_meta_categories() {
		$category = get_the_category();
		echo esc_html( 'Categories: ' );
		if ( $category ) {
			echo esc_html( the_category( ' | ' ) );
		}
	}
endif;
/**
 * Redirect non-admins to the homepage after logging into the site.
 *
 * @param  [type] $redirect_to The order of the questions.
 * @param  [type] $request The query being modified.
 * @param  [type] $user The user id.
 * @return string Query string.
 *
 * @since   1.0
 */
function workroom1128_login_redirect( $redirect_to, $request, $user ) {
	return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles, true ) ) ? admin_url() : site_url();
}
// Commented out filter of the login redirect add_filter( 'login_redirect', 'workroom1128_login_redirect', 99, 3 );.

/**
 * WordPress function for redirecting users on login based on user role
 *
 * @param  [type] $url The order of the questions.
 * @param  [type] $request The query being modified.
 * @param  [type] $user The user id.
 * @return string Query string.
 */
function user_login_redirect( $url, $request, $user ) {
	if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
		if ( $user->has_cap( 'manage_options' ) ) {
			$url = admin_url();
		} elseif ( $user->has_cap( 'student' ) ) {
			$url = home_url( '/elearning-dashboard/' );
		} else {
			$url = home_url();
		}
	}
	return $url;
}
add_filter( 'login_redirect', 'user_login_redirect', 10, 3 );

if ( ! function_exists( 'workroom1128_restrict_access_without_login' ) ) :
	/**
	 * Restricts user access if not subscribed.
	 *
	 * @return void
	 */
	function workroom1128_restrict_access_without_login() {
		// Get global post.
		global $post;
		// Get current page or post ID.
		$page_id = get_queried_object_id();
		// Add lists of page or post IDs for restriction development-courses, elearning-dashboard,.
		$behind_login_pages2 = array( 627, 656, 629, 401 );
		if ( ( ! empty( $behind_login_pages2 ) && in_array( $page_id, $behind_login_pages2, true ) ) && ! is_user_logged_in() ) {
			wp_safe_redirect( esc_url( home_url() ) );
			exit();
		}
		$behind_login_pages = array( 7062, 5369 ); // live site.
		if ( ( ! empty( $behind_login_pages ) && in_array( $page_id, $behind_login_pages, true ) ) && ! is_user_logged_in() ) {
			wp_safe_redirect( esc_url( home_url() ) );
			exit();
		}
	}
endif;
add_action( 'template_redirect', 'workroom1128_restrict_access_without_login' );


if ( ! function_exists( 'workroom1128_client_query_sorted_by_number' ) ) :
	/**
	 * Sort custom post type client by client_order field. Uses do_action in front_page client area.
	 *
	 * @param  [type] $query The query statement.
	 * @return void
	 */
	function workroom1128_client_query_sorted_by_number( $query ) {
		// phpcs:disable.
		$args = array(
			'post_type'     => array( 'client' ),
			'posts_per_page' => -1,
			'meta_key'      => 'client_order', // phpcs:ignore WordPress.DB.SlowDBQuery.
			'orderby'       => 'meta_value_num',
			'order'         => 'ASC',
		);
		// phpcs:enable.
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) :
			echo '<div class="row g-0 row-cols-4 clients-wrap" >';
			while ( $loop->have_posts() ) :
				$loop->the_post();
				if ( get_field( 'client_include_on_front' ) ) :
					?>
					<div class="col ">
						<div class="client-logo">
						<?php $client_logo = get_field( 'client_logo' ); ?>
						<?php if ( $client_logo ) : ?>
							<img width="252" height="88" class="img-fluid" src="<?php echo esc_url( $client_logo ); ?>" alt="Clients"  >
						<?php endif; ?>
						</div>
					</div>
					<?php
				endif;
			endwhile;
			echo '</div>';
		endif;
		wp_reset_postdata();
	}
endif;

add_action( 'client_after_entry', 'workroom1128_client_query_sorted_by_number' );
