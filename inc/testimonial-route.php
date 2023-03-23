<?php
/**
 * [workroom1128_register_testimonial description]
 *
 * Route does not have to be a custom post type name. It is custom choice.
 * namespace: wp-json/coaching/v1/
 * route: testimonial
 *
 * @args:  Either an array of options for the endpoint,
 * or an array of arrays for multiple methods.
 * method: CRUD is Read here Use WP_REST_SERVER instead of Get to avoid any errors
 * Namespace must not start or end with a slash
 *  //http://localhost:3000/deliberatedoing2020/?rest_route=/coaching/v1/testimonial
 * @param  [custom post type]   testimonial
 * @return [text]               'clientFirstName'
 *         [text]               'clientTestimonial'
 * @package 1.0.0
 * returns first 2 client testimonials
 * package 1.0.0
 */

add_action( 'rest_api_init', 'workroom1128_register_testimonial' );
/**
 * Register the testimonials. //'testimonials/(?<page_query_var>[\d]+)', 'testimonials/(?P<page_query_var>\d+)',
 *
 * @return void
 */
function workroom1128_register_testimonial() {
	register_rest_route(
		'coaching/v1',
		'/testimonials',
		array(
			'methods'             => WP_REST_SERVER::READABLE,
			'callback'            => 'query_posts_and_pages_with_params',
			'permission_callback' => '__return_true',
		),
	);
}

/**
 * Load more testimonials on page.
 *
 * @param  WP_REST_Request $request The content to load.
 * @return string $results The updated content.
 */
function query_posts_and_pages_with_params( $request ) {
	// Use this code to get request attributes print_r( $request->get_attributes() );.
	$per_page = isset( $request->get_params()['per_page'] ) ? $request->get_params()['per_page'] : 2;
	$paged    = isset( $request->get_params()['page'] ) ? $request->get_params()['page'] : 1;

	$args = array(
		'post_type'      => 'testimonial',
		'post_status'    => 'publish',
		'meta_key'       => 'testimonial_order', // phpcs:ignore WordPress.DB.SlowDBQuery.
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
		'posts_per_page' => $per_page,
		'paged'          => $paged,
	);
	// Run a custom query.
	$meta_query = new WP_Query( $args );

	if ( $meta_query->have_posts() ) {
		// $page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		// Define an empty array.
		$data             = array(
			'testimonials' => array(),
			'page'         => array(),
			'max_page'     => array(),
			'per_page'     => array(),
		);
		$data['page']     = (int) $paged;
		$data['max_page'] = $meta_query->max_num_pages;
		$data['per_page'] = $per_page;

		// $max_pages   = $meta_query->max_num_pages;
		// $total_posts = $meta_query->found_posts;
		// Store each post's data in the array.
		while ( $meta_query->have_posts() ) {
			$meta_query->the_post();
			$excerpt       = wp_trim_words( get_field( 'client_testimonial' ), 49 );
			$excerptcount  = str_word_count( $excerpt );
			$wordcountfull = str_word_count( wp_strip_all_tags( get_field( 'client_testimonial' ) ) );
			$testimonial   = '<p>' . $excerpt;
			if ( $wordcountfull > $excerptcount ) {
				$addreadmore      = true;
				$testimonial_link = get_field( 'testimonial_link' );
				if ( $testimonial_link ) :
					$link_url         = $testimonial_link['url'];
					$link_title       = $testimonial_link['title'];
					$link_target      = $testimonial_link['target'] ? $testimonial_link['target'] : '_self';
					$testimonial_link = get_field( 'testimonial_link' );
					$testimonial     .= '<a class="readmore" href="' . $link_url . '" target="' . esc_attr( $link_target ) . '" >[Read More]</a>';
				endif;
				$testimonial .= '</p>';
			} else {
				$addreadmore  = false;
				$testimonial .= '</p>';
			}
			array_push(
				$data['testimonials'],
				array(
					'clientFirstName'   => get_field( 'client_first_name' ),
					'clientTestimonial' => $testimonial,
				),
			);
		}

		// Return the data.
		return rest_ensure_response( $data );
	} else {
		// If there is no post.
		return rest_ensure_response( 'No post to show' );
	}
}

/**
 * Get current page.
 *
 * @param [type] $var Variable of string.
 */
function current_paged( $var = '' ) {
	if ( empty( $var ) ) {
		global $wp_query;
		if ( ! isset( $wp_query->max_num_pages ) ) {
			return 0;
		}
		$pages = $wp_query->max_num_pages;
	} else {
		global $$var;
		if ( ! is_a( $$var, 'WP_Query' ) ) {
			return 0;
		}
		if ( ! isset( $$var->max_num_pages ) || ! isset( $$var ) ) {
			return 0;
		}
		$pages = absint( $$var->max_num_pages );
	}
	if ( $pages < 1 ) {
		return 0;
	}
	$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	return $page;
}
/**
 * Undocumented function
 *
 * @param  [type] $route Registerd Route for testimonal.
 * @param [type] $post The current post object.
 * @param [type] $paged  THe current page.
 * @return object $route The modified route with pagination.
 */
function my_plugin_rest_queried_resource_route( $route, $post, $paged ) {
	if ( 'testimonial' === $post->post_type ) {
		$paged = $post->get_query_var( 'paged' );
		if ( $paged ) {
			$route = '/coaching/v1/testimonials/?page=' . $paged;
		} else {
			$route = '/coaching/v1/testimonials/?page=';
		}
	}

	return $route;
}
// Commented out code to filter the queried rest route add_filter( 'rest_route_for_post', 'my_plugin_rest_queried_resource_route' );.

