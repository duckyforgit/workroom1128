<?php
/**
 * Check and setup theme's default settings
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'workroom1128_setup_theme_default_settings' ) ) {
	/**
	 * Store default theme settings in database.
	 */
	function workroom1128_setup_theme_default_settings() {
		$defaults = workroom1128_get_theme_default_settings();
		$settings = get_theme_mods();
		foreach ( $defaults as $setting_id => $default_value ) {
			// Check if setting is set, if not set it to its default value.
			if ( ! isset( $settings[ $setting_id ] ) ) {
				set_theme_mod( $setting_id, $default_value );
			}
		}
	}
}

if ( ! function_exists( 'workroom1128_get_theme_default_settings' ) ) {
	/**
	 * Retrieve default theme settings.
	 *
	 * @return array
	 */
	function workroom1128_get_theme_default_settings() {
		$defaults = array(
			'workroom1128_posts_index_style' => 'default',   // Latest blog posts style.
			'workroom1128_sidebar_position'  => 'right',     // Sidebar position.
			'workroom1128_container_type'    => 'container', // Container width.
		);

		/**
		 * Filters the default theme settings.
		 *
		 * @param array $defaults Array of default theme settings.
		 */
		return apply_filters( 'workroom1128_theme_default_settings', $defaults );
	}
}


/* sort custom post type offers by offer_category */
/**
 * Customize Event Query using Post Meta
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data.
 */
function workroom1128_adjust_queries( $query ) {
	// phpcs:disable.
// $query->set( 'orderby','meta_value_num');
// $query->set( 'meta_key','_offer_category');
// }
// if (!is_admin() and $query->is_main_query() and is_post_type_archive('offer') ) {
// $query->set( 'orderby', 'meta_value' );
// $query->set( 'order', 'ASC' );
// $query->set( 'meta_key', 'offer_category' );
// $query->set('posts_per_page', -1);
// $taxquery = array(
// array(
// 'taxonomy' => 'offer_category',
// 'orderby'    => 'slug',
// 'order'    =>  'ASC',
// ),
// );
// $query->set('tax_query', array(
// array(
//' taxonomy' => 'series',
// 'field'    => 'slug',
// 'terms'    => $term_slug,
// )
// ));
// }
// phpcs:enable.

	if ( ! is_admin() && is_post_type_archive( 'event' ) && $query->is_main_query() ) {
		$today = gmdate( 'Ymd' );
		$query->set( 'posts_per_page', -1 );
		$query->set( 'meta_key', 'event_date' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'ASC' );
		$query->set(
			'meta_query',
			array(
				array(
					'key'     => 'event_date',
					'compare' => '>=',
					'value'   => $today,
					'type'    => 'numeric',
				),
			),
		);
	}
// phpcs:disable.
	// if ( ! is_admin() && $query->is_main_query() &&.
	// is_post_type_archive( 'event' ).
	// ) {.
	// $query->set( 'offset_start', 2 );.
	// $query->set( 'posts_per_page', 10 );.
	// }.

	// if ( $offset = $query->get( 'offset_start' ) ) {.
	// $per_page = absint( $query->get( 'posts_per_page' ) );.
	// $per_page = $per_page ? $per_page : max( 1, get_option( 'posts_per_page' ) );.

	// $paged = max( 1, get_query_var( 'paged' ) );.
	// $query->set( 'offset', ( $paged - 1 ) * $per_page + $offset );.
	// }.
	return $query;
}
add_action( 'pre_get_posts', 'workroom1128_adjust_queries' );
/**
 * Filter archive.
 *
 * @param  object $query
 * @return void
 */
// phpcs:disable.
function justread_filter_archive( $query ) {
	if ( is_admin() ) {
		return;
	}
	if ( is_archive() ) {
	// Commented out code for the time being if ( 'cat' === $_GET['getby'] ) {.
		$taxquery = array(
			array(
				'taxonomy' => 'offer_category',
				'field' => 'slug',
				// Commented out code for the time being 'terms' => $_GET['cat'],.
			),
		);
		$query->set( 'tax_query', $taxquery );
	}
	return $query;
}
// add_action( 'pre_get_posts', 'justread_filter_archive');


// add_action( 'save_post_offer', 'prefix_save_date_as_meta', 10 );
function prefix_save_date_as_meta($post_id)
{
	$years = get_the_terms($post_id, 'offer_category');

	if (empty($years)) {
		return;
	}
	$years_list = wp_list_pluck($years, 'name');

	update_post_meta($post_id, '_offer_category', $years_list[0]);

	return;
}
// phpcs:enable.
/**
 * Undocumented function
 *
 * @param  object $query Query from DB.
 * @return object $query Object from DB modified.
 */
function search_filter_tax_query( $query ) {
	if ( $query->is_search ) {
		$taxquery = array(
			array(
				'taxonomy' => 'series',
				'terms'    => array( 12 ),
				'operator' => 'IN',
			),
		);
		$query->set( 'tax_query', $taxquery );
	}
	return $query;
}
// Commented out code for now - yes    add_action( 'pre_get_posts', 'search_filter_tax_query' );.
/**
 * Get the number of found post for data query.
 *
 * @param  string $found_posts Number of post found in query.
 * @param  object $query data.
 * @return string $found_posts Number of posts.
 */
function my_found_posts( $found_posts, $query ) {
	$offset = $query->get( 'offset_start' );
	if ( $offset ) {
		$found_posts = max( 0, $found_posts - $offset );
	}

	return $found_posts;
}
// phpcs:disable.
// add_filter( 'found_post//s', 'my_found_posts', 10, 2 );
/**
 * Filter Archive Titles to remove Archive: etc
 *
 */

// add_filter('get_the_archive_title', function ($title) {
//     if (is_category()) {
//         $title = single_cat_title('', false);
//     } elseif (is_tag()) {
//         $title = single_tag_title('', false);
//     } elseif (is_author()) {
//         $title = '<span class="vcard">' . get_the_author() . '</span>';
//     } elseif (is_tax()) { //for custom post types
//         $title = sprintf(__('%1$s'), single_term_title('', false));
//     } elseif (is_post_type_archive()) {
//         $title = post_type_archive_title('', false);
//     }
//     return $title;
// });
// phpcs:enable.

/**
 * Sets excerpt length.
 *
 * @param string $length Length of custom excerpt in characters.
 * @return string length of excerpt.
 */
function workroom1128_custom_excerpt( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'workroom1128_custom_excerpt', 999 );
/**
 * Function workroom1128_add_excerpt_support_for_cpt.
 *
 * @return void
 */
function workroom1128_add_excerpt_support_for_cpt() {
	add_post_type_support( 'post-type-course', 'excerpt' );
}

add_action( 'init', 'workroom1128_add_excerpt_support_for_cpt' );
// phpcs disable.
// Squiz.PHP.CommentedOutCode.Found.
/**
 * Modify member account tabs
 */
// phpcs disable. Squiz.PHP.CommentedOutCode.Found.
// add_filter('pms_account_get_tab_url', 'pmsc_get_tab_url', 20, 2);.
// function pmsc_get_tab_url($url, $tab).
// {.
// if ($tab == 'subscriptions') {.
// return home_url('personal-development-courses');.
// }.
// return $url;.
// }.

// add_filter( 'pms_member_account_tabs', 'pmsc_change_member_account_tabs', 20, 2 );. Squiz.PHP.CommentedOutCode.Found.
/**
 * Change the number of tabs on member account.
 *
 * @param  string $tabs Number of tabs.
 * @param  array  $args WHat goes on the tabs.
 * @return string $tabs The tabs.
 */
function pmsc_change_member_account_tabs( $tabs, $args ) {
	// Commented out code for now $tabs['courses'] = __( 'My Courses', 'paid-member-subscriptions' );. Squiz.PHP.CommentedOutCode.Found.
	$tabs['subscriptions'] = __( 'My Courses', 'paid-member-subscriptions' );
	// Commented oiut code for now unset( $tabs['payments'] );. Squiz.PHP.CommentedOutCode.Found.
	// Coimmented oiut code for now unset( $tabs['subscriptions'] );.
	return $tabs;
}

// Commented out code for now add_filter( 'pms_account_shortcode_content', 'pmsc_custom_tab_content', 20, 2 );.

/**
 * Add content to the active tab.
 *
 * @param  string $output The conente to be added to the tabbed area.
 * @param  object $active_tab The active tab.
 * @return string $output  The new content.
 */
function pmsc_custom_tab_content( $output, $active_tab ) {
	if ( 'subscriptions' === $active_tab ) {
		$output .= '<h3>My Courses</h3>';
		$output .= '<p>Aliquam vel dolor ac nisl laoreet faucibus ut nec sem.<p>';
		$output .= '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>';
	}

	return $output;
}
