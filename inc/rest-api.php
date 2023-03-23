<?php

/**
 * Undocumented function
 *
 * @param  [type]           $result Pages requested.
 * @param  \WP_REST_Server  $srv   Using Rest API.
 * @param  \WP_REST_Request $request The Request to be processed.
 * @return void
 */
function access_to_users( $result, \WP_REST_Server $srv, \WP_REST_Request $request ) {
	global $current_user;
	if ( ! current_user_can( 'edit_posts', $current_user->id ) ) {
		return;
	}
	$method  = $request->get_method();
	$varpath = $request->get_route();
	if ( ! isset( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}
	if ( ! is_user_logged_in() && true !== stripos( wp_unslash( $_SERVER['REQUEST_URI'], 'wp/v2/users' ) ) ) {
		if ( ! ( current_user_can( 'edit_posts' ) ) || false !=== stripos(  wp_unslash( $_SERVER['REQUEST_URI'] ), 'wp/v2/pages' ) ) {
			return new \WP_Error( 'rest_user_cannot_view', 'Sorry, you are not allowed to use this API.', array( 'status' => rest_authorization_required_code() ) );
		}
		if ( ( 'GET' === $method || 'HEAD' === $method ) && preg_match( '!^/wp/v2/users(?:$|/)!', $varpath ) ) {
			if ( ( 'GET' === $method || 'HEAD' === $method ) && preg_match( '!^/wp/v2/users(?:$|/)!', $varpath ) ) {
				if ( ! ( current_user_can( 'edit_posts' ) ) ) {
					return new \WP_Error( 'rest_user_cannot_view', 'Sorry, you are not allowed to use this API.', array( 'status' => rest_authorization_required_code() ) );
				}
			}
		}
	}
	return $request;
}

// Commented out code for now add_filter( 'rest_pre_dispatch', 'access_to_users', 10, 3);.
