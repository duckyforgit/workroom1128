<?php
/**
 * Search Route
 *
 * Route does not have to be a custom post type name. It is custom choice.
 * namespace: wp-json/wp/coaching/v2/
 * route: posts?search=
 *
 * @args:  Either an array of options for the endpoint,
 * or an array of arrays for multiple methods.
 * method: CRUD is Read here Use WP_REST_SERVER instead of Get to avoid any errors
 * Namespace must not start or end with a slash
 *  //http://localhost:3000/deliberatedoing/?rest_route=/wp/coaching/v2/posts?term="biology"
 * @param  [post type]   post?search=
 * @return [text]               'title'
 *         [text]               'permalink'
 * @package 1.0.0
 */

add_action( 'rest_api_init', 'coachingregistersearch' );
/**
 * Register the search feature.
 *
 * @return void
 */
function coachingregistersearch() {
	register_rest_route(
		'coaching/v1',
		'search',
		array(
			'methods'  => WP_REST_SERVER::READABLE,
			'callback' => 'coachingsearchresults',
		),
	);
}
/**
 * Searched results.
 *
 * @param  [type] $data Data from rest api search.
 * @return [type] $results The results from the query.
 */
function coachingsearchresults( $data ) {
	$mainquery = new WP_Query(
		array(
			'post_type' => array( 'post', 'page', 'videos', 'client', 'testimonial', 'event', 'freq_asked_questions' ),
			's'         => sanitize_text_field( $data['term'] ),
		)
	);

	$results = array(
		'generalinfo'  => array(),
		'clients'      => array(),
		'testimonials' => array(),
		'events'       => array(),
		'videos'       => array(),
	);

	while ( $mainquery->have_posts() ) {
		$mainquery->the_post();

		if ( get_post_type() === 'post' || get_post_type() === 'page' ) {
			array_push(
				$results['generalinfo'],
				array(
					'title'      => get_the_title(),
					'permalink'  => get_the_permalink(),
					'postType'   => get_post_type(),
					'authorName' => get_the_author(),
				),
			);
		}

		if ( get_post_type() === 'professor' ) {
			array_push(
				$results['professors'],
				array(
					'title'     => get_the_title(),
					'permalink' => get_the_permalink(),
					'image'     => get_the_post_thumbnail_url( 0, 'professorLandscape' ),
				),
			);
		}

		if ( get_post_type() === 'program' ) {
			$relatedcampuses = get_field( 'related_campus' );

			if ( $relatedcampuses ) {
				foreach ( $relatedcampuses as $campus ) {
					array_push(
						$results['campuses'],
						array(
							'title'     => get_the_title( $campus ),
							'permalink' => get_the_permalink( $campus ),
						),
					);
				}
			}

			array_push(
				$results['programs'],
				array(
					'title'     => get_the_title(),
					'permalink' => get_the_permalink(),
					'id'        => get_the_id(),
				),
			);
		}

		if ( get_post_type() === 'campus' ) {
			array_push(
				$results['campuses'],
				array(
					'title'     => get_the_title(),
					'permalink' => get_the_permalink(),
				),
			);
		}

		if ( get_post_type() === 'event' ) {
			$relatedprogram = get_field( 'related_campus' );

			if ( $relatedprogram ) {
				foreach ( $relatedprogram as $program ) {
					array_push(
						$results['campuses'],
						array(
							'title'     => get_the_title( $program ),
							'permalink' => get_the_permalink( $program ),
						),
					);
				}
			}

			$eventdate   = new DateTime( get_field( 'event_date' ) );
			$description = null;
			if ( has_excerpt() ) {
				$description = get_the_excerpt();
			} else {
				$description = wp_trim_words( get_the_content(), 18 );
			}

			array_push(
				$results['events'],
				array(
					'title'       => get_the_title(),
					'permalink'   => get_the_permalink(),
					'month'       => $eventdate->format( 'M' ),
					'day'         => $eventdate->format( 'd' ),
					'description' => $description,
				),
			);
		}
	}

	if ( $results['programs'] ) {
		$programsmetaquery = array( 'relation' => 'OR' );

		foreach ( $results['programs'] as $item ) {
			array_push(
				$programsmetaquery,
				array(
					'key'     => 'related_programs',
					'compare' => 'LIKE',
					'value'   => '"' . $item['id'] . '"',
				),
			);
		}

		$programrelationshipquery = new WP_Query(
			array(
				'post_type'  => array( 'professor', 'event' ),
				'meta_query' => $programsmetaquery, // phpcs:ignore WordPress.DB.SlowDBQuery.
			),
		);

		while ( $programrelationshipquery->have_posts() ) {
			$programrelationshipquery->the_post();

			if ( get_post_type() === 'event' ) {
				$eventdate   = new DateTime( get_field( 'event_date' ) );
				$description = null;
				if ( has_excerpt() ) {
					$description = get_the_excerpt();
				} else {
					$description = wp_trim_words( get_the_content(), 18 );
				}

				array_push(
					$results['events'],
					array(
						'title'       => get_the_title(),
						'permalink'   => get_the_permalink(),
						'month'       => $eventdate->format( 'M' ),
						'day'         => $eventdate->format( 'd' ),
						'description' => $description,
					),
				);
			}

			if ( get_post_type() === 'professor' ) {
				array_push(
					$results['professors'],
					array(
						'title'     => get_the_title(),
						'permalink' => get_the_permalink(),
						'image'     => get_the_post_thumbnail_url( 0, 'professorLandscape' ),
					),
				);
			}
		}

		$results['professors'] = array_values( array_unique( $results['professors'], SORT_REGULAR ) );
		$results['events']     = array_values( array_unique( $results['events'], SORT_REGULAR ) );
	}

	return $results;
}
