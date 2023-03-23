<?php
/**
 * [workroom1128RegisterLesson description]
 *
 * @param  [type]   [description]
 * @return [type]       [description]
 * @package 1.0.0
 */

add_action( 'rest_api_init', 'workroom1128_register_video' );
/**
 * [workroom1128_register_video description]
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
function workroom1128_register_video() {
	register_rest_route(
		'coaching/v1',
		'lesson_video',
		array(
			'methods'             => WP_REST_SERVER::READABLE,
			'callback'            => 'workroom1128_video_results',
			'permission_callback' => '__return_true',
		),
	);

	register_rest_route(
		'coaching/v1',
		'lesson_video/(?P<id>\d+)',
		array(
			'methods'             => \WP_REST_Server::READABLE,
			'callback'            => 'workroom1128_video_results_id',
			'permission_callback' => '__return_true',
		),
	);
}
/**
 * Undocumented function
 *
 * @param  [type] $data Data returned from rest api call.
 * @return [type] $results The rest results.
 */
function workroom1128_video_results( $data ) {
	$videoquery = new WP_Query(
		array(
			'post_type'      => 'lesson_video',
			'posts_per_page' => -1,
		),
	);
	$results    = array(
		'video' => array(),
	);
		// Initialize the array that will receive the posts' data.
	while ( $videoquery->have_posts() ) {
		$videoquery->the_post();

		$file = get_field( 'video_file', get_the_ID() );

		if ( get_post_type() === 'lesson_video' ) {
			array_push(
				$results['video'],
				array(
					'id'         => get_the_ID(),
					'title'      => get_the_title(),
					'permalink'  => get_the_permalink( get_the_ID() ),
					'video_file' => $file,
					'video_url'  => $file['url'],
				),
			);
		}
	}
	wp_reset_postdata();
	return $results;
}
/**
 * [workroom1128RegisterLesson description]
 * WP will automatically convert JSON data in PHP
 *
 * @param [type] $data [description]
 *
 * // $data['id'] [description] will be used on url
 * http://localhost/deliberatedoing/wp-json/coaching/v1/lesson?id=meowsalot
 * May use //'posts_per_page' => 1,.
 *
 * @return [type] [description]
 */
function workroom1128_video_results_id( $data ) {
	$videoquery = new WP_Query(
		array(
			'post_type' => 'lesson_video',
			'p'         => $data['id'],
		),
	);
	$results    = array(
		'video' => array(),
	);
	// Initialize the array that will receive the posts' data.
	while ( $videoquery->have_posts() ) {
		$videoquery->the_post();

		$file = get_field( 'video_file', get_the_ID() );

		if ( get_post_type() === 'lesson_video' ) {
			array_push(
				$results['video'],
				array(
					'id'         => get_the_ID(),
					'title'      => get_the_title(),
					'permalink'  => get_the_permalink( get_the_ID() ),
					'video_file' => $file,
					'video_url'  => $file['url'],
				),
			);
		}
	}
	wp_reset_postdata();
	return $results;
}
