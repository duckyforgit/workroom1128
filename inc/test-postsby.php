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

add_action( 'rest_api_init', 'workroom1128_register_postsby' );
/**
 * Register the testimonials. //'testimonials/(?<page_query_var>[\d]+)', 'testimonials/(?P<page_query_var>\d+)', 'testimonials/(?P<current_page>\d+)',
 *
 * @return void
 */
function workroom1128_register_postsby() {
	register_rest_route(
		'coaching/v1',
		'testimonials',
		array(
			'methods'  => 'GET',
			'callback' => 'query_posts_and_pages_with_params',
			'permission_callback' => '__return_true',
			// use for create / post.
			// 'args'                => 'create_args',
			// 'args'                => array(
			// 	'page'            => array(
			// 		'description' => 'Current page',
			// 		'type'        => 'integer',
			// 	),
			// 	'per_page'        => array(
			// 		'description' => 'Items per page',
			// 		'type'        => 'integer',
			// 	),
			// ),
		),
	);
}

/**
 * Undocumented function
 *
 * @param  WP_REST_Request $request The Rest Api Request sent to javascript.
 * @return [type] $pageno  Page number for pagination.
 */
function query_posts_and_pages_with_params( WP_REST_Request $request ) {
	$arg   = $request->get_param( 'page' );

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	return query_posts_and_pages( $arg );
}
/**
 * Undocumented function
 *
 * @param  [type] $page Page number for pagination.
 * @return [type] $args Arguments for fetching posts.
 */
function query_posts_and_pages( $page ) {
	global $_REQUEST;
	
	$page = wp_unslash( $_REQUEST['paged'] ) ? wp_unslash( $_REQUEST['paged'] ) : 1 );
	++$page;
	$args = array(
		'post_type'      => array( 'testimonial' ),
		'posts_per_page' => 2,
		'paged'          => $page,
		'meta_key'       => 'testimonial_order', // phpcs:ignore WordPress.DB.SlowDBQuery.
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
	);
	return fetchbyposttypeandtax( $args );
}
/**
 * Function fetchbyposttypeandtax returns posts.
 *
 * @param  [type] $args Args for fetching posts.
 * @return [type] $data
 */
function fetchbyposttypeandtax( $args ) {
	// Run a custom query.
	$meta_query = new WP_Query( $args );
	if ( $meta_query->have_posts() ) {
		// Define an empty array.
		$data = array();
		// Store each post's data in the array.
		while ( $meta_query->have_posts() ) {
			$meta_query->the_post();
			//$id                   = get_the_ID();
			//$post                 = get_post( $id );
			$data                 = array(
				'testimonials' => array(),
				'current_page' => array(),
				'max_page'     => array(),
				'id'           => array(),
			);
			// $data['current_page'] = $args->paged;
			$data['current_page'] = $args['paged'];
			$data['max_page']     = $meta_query->max_num_pages;
			//$data['id']           = $id;
			$excerpt              = wp_trim_words( get_field( 'client_testimonial' ), 49 );
			$excerptcount         = str_word_count( $excerpt );
			$wordcountfull        = str_word_count( wp_strip_all_tags( get_field( 'client_testimonial' ) ) );
			$testimonial          = '<p>' . $excerpt;
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
			// $link           = get_permalink( $id );
			// $featured_image = get_the_post_thumbnail_url( $id );
			// $post_object    = (object) array(
			// 	'id'               => $post->ID,
			// 	'title'            => (object) array( 'rendered' => $post->post_title ),
			// 	'date'             => $post->post_date,
			// 	'slug'             => $post->post_name,
			// 	'link'             => $link,
			// 	'featured_img_url' => $featured_image,
			// 	'image'            => get_the_post_thumbnail_url( $post->ID ),
			// 	'excerpt'          => (object) array( 'rendered' => get_the_excerpt() ),
			// );
			//$data[]         = $post_object;
		}
		// Return the data.
		return $data;
	} else {
		// If there is no post.
		return 'No post to show';
	}
}
