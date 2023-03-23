<?php
/**
 * Load more by page number.
 *
 * @package 1.0
 */

/**
 * Get Colors.
 *
 * @param  [type] $request The returned request.
 * @return [type] $colors rest response colors.
 */
function prefix_get_current_page( $request ) {
	// In practice this function would fetch the desired data. Here we are just making stuff up.
	$data = array(
		'testimonials' => array(),
	);
	// if ( isset( $request['page'] ) ) {
	// 	$paged = $request['page'];
	// } else {
	// 	$paged = 4;
	// }
	// if ( isset( $request['per_page'] ) ) {
	// 	$per_page = $request['per_page'];
	// } else {
	// 	$per_page = 2;
	// }
	$testimonials = array(
		'post_type'      => 'testimonial',
		'post_status'    => 'publish',
		'posts_per_page' => 2,
		'paged'          => 3,
	);
	$meta_query   = new WP_Query( $testimonials );
	if ( $meta_query->have_posts() ) {
		while ( $meta_query->have_posts() ) {
			// $excerpt       = wp_trim_words( get_field( 'client_testimonial' ), 49 );
			// $excerptcount  = str_word_count( $excerpt );
			// $wordcountfull = str_word_count( wp_strip_all_tags( get_field( 'client_testimonial' ) ) );
			// $testimonial   = '<p>' . $excerpt;
			// if ( $wordcountfull > $excerptcount ) {
			// 	$addreadmore      = true;
			// 	$testimonial_link = get_field( 'testimonial_link' );
			// 	if ( $testimonial_link ) :
			// 		$link_url         = $testimonial_link['url'];
			// 		$link_title       = $testimonial_link['title'];
			// 		$link_target      = $testimonial_link['target'] ? $testimonial_link['target'] : '_self';
			// 		$testimonial_link = get_field( 'testimonial_link' );
			// 		$testimonial     .= '<a class="readmore" href="' . $link_url . '" target="' . esc_attr( $link_target ) . '" >[Read More]</a>';
			// 	endif;
			// 	$testimonial .= '</p>';
			// } else {
			// 	$addreadmore  = false;
			// 	$testimonial .= '</p>';
			// }
			array_push(
				$data['testimonials'],
				array(
					'clientFirstName'   => get_field( 'client_first_name' ),
					// 'clientTestimonial' => $testimonial,
				),
			);
		}
		return $data;
	} else {
		return 'no data';
	}
}

/**
 * We can use this function to contain our arguments for the example product endpoint.
 */
function prefix_get_page_arguments() {
	$args = array();
	// Here we are registering the schema for the filter argument.
	$args['page']     = array(
		// description should be a human readable description of the argument.
		'description' => esc_html__( 'Current Page', 'workroom1128' ),
		// type specifies the type of data that the argument should be.
		'type'        => 'integer',
	);
	$args['per_page'] = array(
		// description should be a human readable description of the argument.
		'description' => esc_html__( 'Items per page', 'workroom1128' ),
		// type specifies the type of data that the argument should be.
		'type'        => 'integer',
	);
	$args['page']     = 2;
	return $args;
}

/**
 *  Register the route.
 */
function prefix_register_review_routes() {
	
	register_rest_route(
		'coaching/v1',
		'testimonials',
		array(
			'methods'             => WP_REST_SERVER::READABLE,
			'callback'            => 'prefix_get_current_page',
			'permission_callback' => '__return_true',
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

add_action( 'rest_api_init', 'prefix_register_review_routes' );
