<?php
/**
 * Load more colors on page.
 *
 * @package 1.0
 */

/**
 * Get Colors.
 *
 * @param  [type] $request The returned request.
 * @return [type] $colors rest response colors.
 */
function prefix_get_colors( $request ) {
	// In practice this function would fetch the desired data. Here we are just making stuff up.
	$colors = array(
		'blue',
		'blue',
		'red',
		'red',
		'green',
		'green',
		'red',
	);

	if ( isset( $request['filter'] ) ) {
		$filtered_colors = array();
		foreach ( $colors as $color ) {
			if ( $request['filter'] === $color ) {
				$filtered_colors[] = $color;
			}
		}
		return rest_ensure_response( $filtered_colors );
	}
	return rest_ensure_response( $colors );
}

/**
 * We can use this function to contain our arguments for the example product endpoint.
 */
function prefix_get_color_arguments() {
	$args = array();
	// Here we are registering the schema for the filter argument.
	$args['filter'] = array(
		// description should be a human readable description of the argument.
		'description' => esc_html__( 'The filter parameter is used to filter the collection of colors', 'my-text-domain' ),
		// type specifies the type of data that the argument should be.
		'type'        => 'string',
		// enum specified what values filter can take on.
		'enum'        => array( 'red', 'green', 'blue' ),
	);
	return $args;
}

/**
 *  Register the route.
 */
function prefix_register_example_routes() {
	// register_rest_route() handles more arguments but we are going to stick to the basics for now.
	register_rest_route(
		'my-colors/v1',
		'/colors',
		array(
			// By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
			'methods'  => WP_REST_Server::READABLE,
			// Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
			'callback' => 'prefix_get_colors',
			// Here we register our permissions callback. The callback is fired before the main callback to check if the current user can access the endpoint.
			'args'     => prefix_get_color_arguments(),
		),
	);
}

add_action( 'rest_api_init', 'prefix_register_example_routes' );
