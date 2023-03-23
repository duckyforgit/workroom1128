<?php
/**
 * Sorting custom field columns.
 *
 * @package workroom1128
 */

/**
 * Order videos by series group.
 *
 * @param  object $query QUery for posts.
 * @return void
 */
function elearning_videos_pre_get_posts( $query ) {
	// Your question pertains to admin use only.
	global $pagenow;
	if ( is_admin() && 'edit.php' === $pagenow ) {
		// Present the posts in your meta_key field's order in admin.
		if ( isset( $query->query_vars['post_type'] ) ) {
			if ( 'videos' === $query->query_vars['post_type'] ) {
				$meta_query = array(
					array(
						'series_clause' => array(
							'key'     => 'series_group',
							'compare' => 'EXISTS',
							'type'    => 'NUMERIC',
						),
					),
					array(
						'order_clause' => array(
							'key'     => 'order_in_series',
							'compare' => 'EXISTS',
							'type'    => 'NUMERIC',
						),
					),
				);
				$query->set( 'meta_query', $meta_query );
				$query->set(
					'orderby',
					array(
						'series_clause' => 'ASC',
						'order_clause'  => 'ASC',
					)
				);
			}
		}
	}
}
add_filter( 'pre_get_posts', 'elearning_videos_pre_get_posts' );
