<?php
/**
 * [workroom1128registerpdf description]
 *
 * @param  [type]   [description]
 * @return [type]       [description]
 * @package 1.0.0
 */

add_action( 'rest_api_init', 'workroom1128registerpdf' );
/**
 * [workroom1128registerpdf description]
 * Route does not have to be a custom post type name. It is custom choice.
 * namespace: wp-json/coaching/v1/
 * route: search
 *
 * @args:  Either an array of options for the endpoint,
 * or an array of arrays for multiple methods.
 * method: CRUD is Read here Use WP_REST_SERVER instead of Get to avoid any errors
 * Namespace must not start or end with a slash
 * This does NOT substitute for search.js module.
 * This adds custom post types to search in a custom rest route.
 * @return void [description]
 */
function workroom1128registerpdf() {
	register_rest_route(
		'coaching/v1',
		'lesson_pdf',
		array(
			'methods'             => WP_REST_SERVER::READABLE,
			'callback'            => 'workroom1128pdfresults',
			'permission_callback' => '__return_true',
		),
	);

	register_rest_route(
		'coaching/v1',
		'lesson_pdf/(?P<id>\d+)',
		array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => 'workroom1128pdfresultsid',
			'permission_callback' => '__return_true',
		),
	);
}

/**
 * [workroom1128registerpdf description]
 * WP will automatically convert JSON data in PHP.
 * $data['id'] [description] will be used on url.
 * http://localhost/deliberatedoing/wp-json/coaching/v1/lesson?id=522.
 *
 * @param [type] $data [description].
 * @return [type] [description]
 */
function workroom1128pdfresultsid( $data ) {
	$pdfquery = new WP_Query(
		array(
			'post_type' => 'lesson_pdf',
			'p'         => $data['id'],
		)
	);
	$results  = array(
		'pdf' => array(),
	);
	// Initialize the array that will receive the posts' data.
	while ( $pdfquery->have_posts() ) {
		$pdfquery->the_post();
		$file = get_field( 'pdf_file', get_the_ID() );

		if ( get_post_type() === 'lesson_pdf' ) {
			array_push(
				$results['pdf'],
				array(
					'id'        => get_the_ID(),
					'title'     => get_the_title(),
					'permalink' => get_the_permalink( get_the_ID() ),
					'pdf_file'  => $file,
					'pdf_url'   => $file['url'],
				),
			);
		}
	}
	wp_reset_postdata();
	return $results;
}
/**
 * Undocumented function
 *
 * @param  [type] $request The data from the rest request.
 * @return [type] $pdfresults  The new data.
 */
function workroom1128pdfresults( $request ) {
	$pdfquery   = new WP_Query(
		array(
			'post_type'      => 'lesson_pdf',
			'posts_per_page' => -1,
		)
	);
	$pdfresults = array(
		'pdf' => array(),
	);

	while ( $pdfquery->have_posts() ) {
		$pdfquery->the_post();
		$file = get_field( 'pdf_file', get_the_ID() );
		array_push(
			$pdfresults['pdf'],
			array(
				'id'        => get_the_ID(),
				'title'     => get_the_title(),
				'permalink' => get_the_permalink( get_the_ID() ),
				'pdf_file'  => $file,
				'pdf_url'   => $file['url'],
			),
		);

	} // end of while loop

	wp_reset_postdata();

	return $pdfresults;
	// Commented out code for now return rest_ensure_response( $results );.
}
