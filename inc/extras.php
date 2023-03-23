<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'body_class', 'workroom1128_body_classes' );

if ( ! function_exists( 'workroom1128_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function workroom1128_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a body class based on the presence of a sidebar.
		$sidebar_pos = get_theme_mod( 'workroom1128_sidebar_position' );
		if ( is_page_template( 'page-templates/fullwidthpage.php' ) ) {
			$classes[] = 'workroom1128-no-sidebar';
		} elseif (
			is_page_template(
				array(
					'page-templates/both-sidebarspage.php',
					'page-templates/left-sidebarpage.php',
					'page-templates/right-sidebarpage.php',
				)
			)
		) {
			$classes[] = 'workroom1128-has-sidebar';
		} elseif ( 'none' !== $sidebar_pos ) {
			$classes[] = 'workroom1128-has-sidebar';
		} else {
			$classes[] = 'workroom1128-no-sidebar';
		}

		return $classes;
	}
}

if ( function_exists( 'workroom1128_adjust_body_class' ) ) {
	/*
	 * workroom1128_adjust_body_class() deprecated in v0.9.4. We keep adding the
	 * filter for child themes which use their own workroom1128_adjust_body_class.
	 */
	add_filter( 'body_class', 'workroom1128_adjust_body_class' );
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'workroom1128_change_logo_class' );

if ( ! function_exists( 'workroom1128_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return string
	 */
	function workroom1128_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

if ( ! function_exists( 'workroom1128_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function workroom1128_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
		}
	}
}
add_action( 'wp_head', 'workroom1128_pingback' );

// Escapes all occurances of 'the_title()' and 'get_the_title()'.
add_filter( 'the_title', 'workroom1128_kses_title' );

// Escapes all occurances of 'the_archive_title' and 'get_the_archive_title()'.
add_filter( 'get_the_archive_title', 'workroom1128_kses_title' );

if ( ! function_exists( 'workroom1128_kses_title' ) ) {
	/**
	 * Sanitizes data for allowed HTML tags for post title.
	 *
	 * @param string $data Post title to filter.
	 * @return string Filtered post title with allowed HTML tags and attributes intact.
	 */
	function workroom1128_kses_title( $data ) {
		// Tags not supported in HTML5 are not allowed.
		$allowed_tags = array(
			'abbr'             => array(),
			'aria-describedby' => true,
			'aria-details'     => true,
			'aria-label'       => true,
			'aria-labelledby'  => true,
			'aria-hidden'      => true,
			'b'                => array(),
			'bdo'              => array(
				'dir' => true,
			),
			'blockquote'       => array(
				'cite'     => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'cite'             => array(
				'dir'  => true,
				'lang' => true,
			),
			'dfn'              => array(),
			'em'               => array(),
			'i'                => array(
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
			),
			'code'             => array(),
			'del'              => array(
				'datetime' => true,
			),
			'img'              => array(
				'src'    => true,
				'alt'    => true,
				'width'  => true,
				'height' => true,
				'class'  => true,
				'style'  => true,
			),
			'ins'              => array(
				'datetime' => true,
				'cite'     => true,
			),
			'kbd'              => array(),
			'mark'             => array(),
			'pre'              => array(
				'width' => true,
			),
			'q'                => array(
				'cite' => true,
			),
			's'                => array(),
			'samp'             => array(),
			'span'             => array(
				'dir'      => true,
				'align'    => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'small'            => array(),
			'strong'           => array(),
			'sub'              => array(),
			'sup'              => array(),
			'u'                => array(),
			'var'              => array(),
		);
		$allowed_tags = apply_filters( 'workroom1128_kses_title', $allowed_tags );

		return wp_kses( $data, $allowed_tags );
	}
} // End of if function_exists( 'workroom1128_kses_title' ).

if ( ! function_exists( 'workroom1128_hide_posted_by' ) ) {
	/**
	 * Hides the posted by markup in `workroom1128_posted_on()`.
	 *
	 * @param string $byline Posted by HTML markup.
	 * @return string Maybe filtered posted by HTML markup.
	 */
	function workroom1128_hide_posted_by( $byline ) {
		if ( is_author() ) {
			return '';
		}
		return $byline;
	}
}
add_filter( 'workroom1128_posted_by', 'workroom1128_hide_posted_by' );


// This is commented code add_filter( 'excerpt_more', 'workroom1128_custom_excerpt_more' );.

if ( ! function_exists( 'workroom1128_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function workroom1128_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'workroom1128_all_excerpts_get_more_link' );

if ( ! function_exists( 'workroom1128_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function workroom1128_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . ' <p><a class="btn btn-primary workroom1128-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __(
				'Read More',
				'workroom1128'
			) . '<span class="screen-reader-text"> from ' . get_the_title( get_the_ID() ) . '</span></a></p>';
		}
		return $post_excerpt;
	}
}


/**
 * Replace "[...]" in the Read More link with an ellipsis.
 *
 * The "[...]" is appended to automatically generated excerpts.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @param string $more The Read More text.
 *
 * @return The filtered Read More text.
 */
function workroom1128_excerpt_more( $more ) {
	if ( ! is_admin() ) {
		return ' &hellip;';
	}
	return $more;
}
add_filter( 'excerpt_more', 'workroom1128_excerpt_more' );

/**
 * To add copyright date to footer
 */
add_action( 'workroom1128_after_copyright', 'workroom1128_get_date', 999, 1 );

/**
 * Get date for footer copyright year.
 *
 * @param string $year The year business is started.
 */
function workroom1128_get_date( $year ) {
	if ( intval( $year ) === 'auto' ) {
		$year = gmdate( 'Y' );
	}
	if ( intval( $year ) === gmdate( 'Y' ) ) {
		$year = intval( $year );
	}
	if ( intval( $year ) < gmdate( 'Y' ) ) {
		$year = intval( $year ) . ' - ' . gmdate( 'Y' );
	}
	if ( intval( $year ) > gmdate( 'Y' ) ) {
		$year = gmdate( 'Y' );
	}
	echo "<i class='far fa-copyright'></i>&nbsp;" . esc_html( $year ) . "<span class='business-name'>&nbsp;";
	echo esc_html( bloginfo( 'name' ) ) . ',  &nbsp; All Rights Reserved</span>';
}

/* disable XMLRPC code for security */

add_filter( 'xmlrpc_enabled', '__return_false' );

add_filter( 'wp_headers', 'disable_x_pingback' );
if ( ! function_exists( 'disable_x_pingback' ) ) {
	/**
	 * Get Post Navigation.
	 *
	 * @param $string $headers Theme headers.
	 *
	 * @return string $headers Headers with pingback.
	 */
	function disable_x_pingback( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}
}

if ( ! function_exists( 'workroom1128_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function workroom1128_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation">
			<div class="post-navigation" role="navigation" aria-label="Continue Reading">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'workroom1128' ); ?></h2>

			<div class="d-flex p0 nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<div class="nav-previous">%link</div>', _x( '<i class="fa-solid fa-angle-left" aria-hidden="true" ></i>&nbsp;%title', 'Previous article', 'workroom1128' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<div class="nav-next">%link</div>', _x( '%title&nbsp;<i class="fa-solid fa-angle-right" aria-hidden="true" ></i>', 'Next article', 'workroom1128' ) );
				}
				?>
			</div><!-- .nav-links -->
		</div>
		</nav><!-- .navigation -->
		<?php
	}
}
if ( ! function_exists( 'workroom1128_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function workroom1128_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'workroom1128_mobile_web_app_meta' );


if ( ! function_exists( 'workroom1128_default_body_attributes' ) ) {
	/**
	 * Adds schema markup to the body element.
	 *
	 * @param array $atts An associative array of attributes.
	 * @return array
	 */
	function workroom1128_default_body_attributes( $atts ) {
		$atts['itemscope'] = '';
		$atts['itemtype']  = 'http://schema.org/WebSite';
		return $atts;
	}
}
add_filter( 'workroom1128_body_attributes', 'workroom1128_default_body_attributes' );

// Escapes all occurances of 'the_archive_description'.
add_filter( 'get_the_archive_description', 'workroom1128_escape_the_archive_description' );

if ( ! function_exists( 'workroom1128_escape_the_archive_description' ) ) {
	/**
	 * Escapes the description for an author or post type archive.
	 *
	 * @param string $description Archive description.
	 * @return string Maybe escaped $description.
	 */
	function workroom1128_escape_the_archive_description( $description ) {
		if ( is_author() || is_post_type_archive() ) {
			return wp_kses_post( $description );
		}

		/*
		 * All other descriptions are retrieved via term_description() which returns
		 * a sanitized description.
		 */
		return $description;
	}
} // End of if function_exists( 'workroom1128_escape_the_archive_description' ).

/**
 * Remove wpautop helper Function by removing p tags and add line breaks. *
 */
function acf_wysiwyg_remove_wpautop() {
	// remove p tags.
	remove_filter( 'acf_the_content', 'wpautop' );
	// add line breaks before all newlines.
	add_filter( 'acf_the_content', 'nl2br' );
}
add_action( 'acf/init', 'acf_wysiwyg_remove_wpautop' );
/**
 * Sorting custom field columns.
 *
 * @param object $query QUery for posts.
 **/
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


if ( ! function_exists( 'elearning_get_the_archive_title' ) ) {
	/**
	 * Removing archive name from title.
	 *
	 * @param object $title for archive posts.
	 **/
	function elearning_get_the_archive_title( $title ) {

		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_tax() ) { // for custom post types.
			$title = esc_html( single_term_title( '', false ) );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}
		return $title;
	}
}
// Commented out code for now add_filter( 'get_the_archive_title', 'elearning_get_the_archive_title' );.

if ( ! function_exists( 'workroom1128_body_classes' ) ) {
	/**
	 * Add body classes for custom post types.
	 *
	 * @param object $classes for body class.
	 **/
	function workroom1128_body_classes( $classes ) {
		global $post;
		if ( is_singular( 'offer' ) ) {
			$classes[] = 'single-offer-' . $post->post_name;
		}
		return $classes;
	}
}
add_filter( 'body_class', 'workroom1128_body_classes' );


// Breadcrumbs.
if ( ! function_exists( 'workroom1128_custom_breadcrumbs' ) ) :
	/**
	 * Add breadcrumbs to pages.
	 **/
	function workroom1128_custom_breadcrumbs() {

		// Settings.
		$separator         = '&#47;';
		$breadcrumbs_id    = 'breadcrumbs';
		$breadcrumbs_class = 'breadcrumbs';
		$home_title        = 'HOME';
		$prefix            = ''; // Display this before the title.
		$custom_taxonomy   = '';
		// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)  $custom_taxonomy = 'tribe_events'.

		// Get the query & post information.
		global $post;
		global $wp_query;

		// Do not display on the homepage.
		if ( ! is_front_page() ) {

			// Build the breadcrumbs.
			echo '<ul id="' . esc_attr( $breadcrumbs_id ) . '" class="' . esc_attr( $breadcrumbs_class ) . '">';
			// Home page.
			echo '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url( get_home_url() ) . '" title="' . esc_html( $home_title ) . '">' . esc_html( $home_title ) . '</a></li>';
			echo '<li class="separator separator-home"> ' . esc_html( $separator ) . ' </li>';

			if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() ) {
				echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . post_type_archive_title( $prefix, false ) . '</span></li>';
			} elseif ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {
				// If post is a custom post type.
				$post_type = get_post_type();

				// If it is a custom post type display name and link.
				if ( 'post' !== $post_type ) {

					$post_type_object  = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );

					echo '<li class="item-cat item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_html( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_html( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';
					echo '<li class="separator"> ' . esc_html( $separator ) . ' </li>';

				}

				$custom_tax_name = get_queried_object()->name;
				echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html( $custom_tax_name ) . '</span></li>';
			} elseif ( is_single() ) {
				// If post is a custom post type.
				$post_type = get_post_type();

				// If it is a custom post type display name and link.
				if ( 'post' !== $post_type ) {
					$post_type_object  = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );
					echo '<li class="item-cat item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_html( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_html( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';
					echo '<li class="separator"> ' . esc_html( $separator ) . ' </li>';

				}

				// Get post category info.
				$category = get_the_category();

				if ( ! empty( $category ) ) {

					// Get last category post is in.
					$last_category = end( array_values( $category ) );

					// Get parent any categories and create array.
					$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
					$cat_parents     = explode( ',', $get_cat_parents );

					// Loop through parent categories and store in variable $cat_display.
					$cat_display = '';
					foreach ( $cat_parents as $parents ) {
						$cat_display .= '<li class="item-cat">' . $parents . '</li>';
						$cat_display .= '<li class="separator"> ' . $separator . ' </li>';
					}
				}
				// If it's a custom post type within a custom taxonomy.
				$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
				if ( empty( $last_category ) && ! empty( $custom_taxonomy ) && $taxonomy_exists ) {

					$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
					$cat_id         = $taxonomy_terms[0]->term_id;
					$cat_nicename   = $taxonomy_terms[0]->slug;
					$cat_link       = get_term_link( $taxonomy_terms[0]->term_id, $custom_taxonomy );
					$cat_name       = $taxonomy_terms[0]->name;

				}

				// Check if the post is in a category.
				if ( ! empty( $last_category ) ) {
					echo esc_html( $cat_display );
					echo '<li class="item-current item-' . esc_html( $post->ID ) . '"><span class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

					// elseif post is in a custom taxonomy.
				} elseif ( ! empty( $cat_id ) ) {

					echo '<li class="item-cat item-cat-' . esc_html( $cat_id ) . ' item-cat-' . esc_html( $cat_nicename ) . '"><a class="bread-cat bread-cat-' . esc_html( $cat_id ) . 'bread-cat-' . esc_html( $cat_nicename ) . '" href="' . esc_html( $cat_link ) . '" title="' . esc_html( $cat_name ) . '">' . esc_html( $cat_name ) . '</a></li>';
					echo '<li class="separator"> ' . esc_html( $separator ) . ' </li>';
					echo '<li class="item-current item-' . esc_html( $post->ID ) . '"><span class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

				} else {

					echo '<li class="item-current item-' . esc_html( $post->ID ) . '"><span class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';
				}
			} elseif ( is_category() ) {

				// Category page.
				echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . esc_html( single_cat_title( '', false ) ) . '</span></li>';

			} elseif ( is_page() ) {
				// Standard page.
				if ( $post->post_parent ) {
					// If child page, get parents.
					$anc = get_post_ancestors( $post->ID );

					// Get parents in the right order.
					$anc = array_reverse( $anc );

					// Parent page loop.
					if ( ! isset( $parents ) ) {
						$parents = null;
					}
					foreach ( $anc as $ancestor ) {
								/*  $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';. */

						$parents .= '<li class="item-parent item-parent-' . $ancestor . '">' . get_the_title( $ancestor ) . '</li>';
						$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
					}
					// Display parent pages.
					echo esc_html( $parents );

					// Current page.
					echo '<li class="item-current item-' . esc_html( $post->ID ) . '"><span class="bread-current" title="' . esc_html( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</span></li>';

				} else {

					// Just display current page if not parents.
					echo '<li class="item-current item-' . esc_html( $post->ID ) . '"><span class="bread-current bread-' . esc_html( $post->ID ) . '"> ' . esc_html( get_the_title() ) . '</span></li>';

				}
			} elseif ( is_tag() ) {

				// Tag page.

				// Get tag information.
				$term_id       = get_query_var( 'tag_id' );
				$taxonomy      = 'post_tag';
				$args          = 'include=' . $term_id;
				$terms         = get_terms( $taxonomy, $args );
				$get_term_id   = $terms[0]->term_id;
				$get_term_slug = $terms[0]->slug;
				$get_term_name = $terms[0]->name;

				// Display the tag name.
				echo '<li class="item-current item-tag-' . esc_html( $get_term_id ) . ' item-tag-' . esc_url( $get_term_slug ) . '"><span class="bread-current bread-tag-' . esc_html( $get_term_id ) . ' bread-tag-' . esc_url( $get_term_slug ) . '">' . esc_html( $get_term_name ) . '</span></li>';

			} elseif ( is_day() ) {

				// Day archive.

				// Year link.
				echo '<li class="item-year item-year-' . esc_html( get_the_time( 'Y' ) ) . '"><a class="bread-year bread-year-' . esc_html( get_the_time( 'Y' ) ) . '" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</a></li>';
				echo '<li class="separator separator-' . esc_html( get_the_time( 'Y' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Month link.
				echo '<li class="item-month item-month-' . esc_html( get_the_time( 'm' ) ) . '"><a class="bread-month bread-month-' . esc_html( get_the_time( 'm' ) ) . '" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . esc_html( get_the_time( 'm' ) ) . '">' . esc_html( get_the_time( 'm' ) ) . ' Archives</a></li>';
				echo '<li class="separator separator-' . esc_html( get_the_time( 'm' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Day display.
				echo '<li class="item-current item-' . esc_html( get_the_time( 'j' ) ) . '"><span class="bread-current bread-' . esc_html( get_the_time( 'j' ) ) . '"> ' . esc_html( get_the_time( 'jS' ) ) . ' ' . esc_html( get_the_time( 'M' ) ) . ' Archives</span></li>';

			} elseif ( is_month() ) {

				// Month Archive.

				// Year link.
				echo '<li class="item-year item-year-' . esc_html( get_the_time( 'Y' ) ) . '"><a class="bread-year bread-year-' . esc_html( get_the_time( 'Y' ) ) . '" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</a></li>';
				echo '<li class="separator separator-' . esc_html( get_the_time( 'Y' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Month display.
				echo '<li class="item-month item-month-' . esc_html( get_the_time( 'm' ) ) . '"><span class="bread-month bread-month-' . esc_html( get_the_time( 'm' ) ) . '" title="' . esc_html( get_the_time( 'm' ) ) . '">' . esc_html( get_the_time( 'm' ) ) . ' Archives</span></li>';
			} elseif ( is_year() ) {
				// Display year archive.
				echo '<li class="item-current item-current-' . esc_html( get_the_time( 'Y' ) ) . '"><span class="bread-current bread-current-' . esc_html( get_the_time( 'Y' ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</span></li>';
			} elseif ( is_author() ) {
				// Auhor archive.
				// Get the author information.
				global $author;
				$userdata = get_userdata( $author );
				// Display author name.
				echo '<li class="item-current item-current-' . esc_html( $userdata->user_nicename ) . '"><span class="bread-current bread-current-' . esc_html( $userdata->user_nicename ) . '" title="' . esc_html( $userdata->display_name ) . '">Author: ' . esc_html( $userdata->display_name ) . '</span></li>';

			} elseif ( get_query_var( 'paged' ) ) {
				// Paginated archives.
				echo '<li class="item-current item-current-' . esc_html( get_query_var( 'paged' ) ) . '"><span class="bread-current bread-current-' . esc_html( get_query_var( 'paged' ) ) . '" title="Page ' . esc_html( get_query_var( 'paged' ) ) . '">' . esc_html__( 'Page' ) . ' ' . esc_html( get_query_var( 'paged ' ) ) . '</span></li>';
			} elseif ( is_search() ) {
				// Search results page.
				echo '<li class="item-current item-current-' . esc_html( get_search_query() ) . '"><span class="bread-current bread-current-' . esc_html( get_search_query() ) . '" title="Search results for: ' . esc_html( get_search_query() ) . '">Search results for: ' . esc_html( get_search_query() ) . '</span></li>';
			} elseif ( is_404() ) {
				// 404 page.
				echo '<li>Error 404</li>';
			}
			echo '</ul>';
		}
	}
endif;
/**
 * Modify query_vars to add pagination.
 *
 * @param  [type] $qvars Original query variables.
 * @return object $qvars Query vars with addition page query.
 */
function themeslug_query_vars( $qvars ) {
	$qvars[] = 'page_query_var';
	return $qvars;
}
add_filter( 'query_vars', 'themeslug_query_vars' );

/**
 * Testimonial posts ordered by testimonial_order.
 *
 * Route for testimonial.
 * namespace: wp-json/coaching/v1/
 * route: testimonial
 * May use $post_type = $query->query['post_type'];
 *
 * @param  [type] $query WordPress post query.
 * @return [type] $query WordPress post query modified.
 * @package 1.0.0
 */
function workroom1128_change_posttypes_per_page( $query ) {

	if ( ! is_admin() && $query->is_main_query() ) {

		if ( is_post_type_archive( 'testimonial' ) ) {
			$query->set( 'posts_per_page', -1 );
			$query->set( 'meta_key', 'testimonial_order' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'ASC' );
			return $query;
		}

		if ( 'testimonial' === get_post_type() ) {

			$query->set( 'meta_key', 'testimonial_order' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'orderby', 'ASC' );

			if ( $query->is_front_page() && ! is_archive() ) {

				$page = $query->query_vars['paged'];

				$nums = 9;

				$diff = get_option( 'posts_per_page' ) - $nums;
				/* $offs = ( $query->query_vars['paged'] - 1 ) * $nums + $diff;    offset to correct for diference */
				$offs = ( $page - 1 ) * $nums + $diff;  /* offset to correct for diference */

				$query->set( 'posts_per_page', $nums );

				$query->set( 'offset', $offs );
			}

			if ( is_archive() ) {
				$query->set( 'posts_per_page', -1 );
				$query->set( 'meta_key', 'testimonial_order' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'orderby', 'ASC' );
			}
		}
	}
	return $query;

}
// add_action( 'pre_get_posts', 'workroom1128_change_posttypes_per_page', 1 );.


// Breadcrumbs.
if ( ! function_exists( 'workroom1128_custom_breadcrumb' ) ) :
	/**
	 * Add breadcrumbs to pages.
	 **/
	function workroom1128_custom_breadcrumb() {

		// Settings.
		$breadcrumbs_id      = 'breadcrumbs';
		$breadcrumbs_class   = 'breadcrumb';
		$breadcrumbs_margins = 'mt-5 mb-5';
		$home_title          = 'HOME';
		$prefix              = ''; // Display this before the title.
		$custom_taxonomy     = '';
		// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)  $custom_taxonomy = 'tribe_events'.

		// Get the query & post information.
		global $post;
		global $wp_query;

		// Do not display on the homepage.
		if ( ! is_front_page() ) {

			// Build the breadcrumbs.
			echo '<ol id="' . esc_attr( $breadcrumbs_id ) . '" class="' . esc_attr( $breadcrumbs_class ) . ' ' . esc_attr( $breadcrumbs_margins ) . '">';
			// Home page.
			echo '<li class="breadcrumb-item"><a class="bread-link bread-home" href="' . esc_url( get_home_url() ) . '" title="' . esc_html( $home_title ) . '">' . esc_html( $home_title ) . '</a></li>';
			// echo '<li class="separator separator-home"> ' . esc_html( $separator ) . ' </li>';

			if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() ) {
				echo '<li class="breadcrumb-item active" aria-current="page"><span class="bread-current bread-archive">' . post_type_archive_title( $prefix, false ) . '</span></li>';
			} elseif ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {
				// If post is a custom post type.
				$post_type = get_post_type();

				// If it is a custom post type display name and link.
				if ( 'post' !== $post_type ) {

					$post_type_object  = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );

					echo '<li class="breadcrumb-item active item-cat item-custom-post-type-' . esc_html( $post_type ) . '" aria-current="page"><a class="bread-cat bread-custom-post-type-' . esc_html( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_html( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';

				}

				$custom_tax_name = get_queried_object()->name;
				echo '<li class="breadcrumb-item active item-archive"arai-current="taxonomy" ><span class="bread-current bread-archive">' . esc_html( $custom_tax_name ) . '</span></li>';
			} elseif ( is_single() ) {
				// If post is a custom post type.
				$post_type = get_post_type();

				// If it is a custom post type display name and link.
				if ( 'post' !== $post_type ) {
					$post_type_object  = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );
					echo '<li class="breadcrumb-item active item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_html( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_html( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';

				}

				// Get post category info.
				$category = get_the_category();

				if ( ! empty( $category ) ) {

					// Get last category post is in.
					$last_category = end( array_values( $category ) );

					// Get parent any categories and create array.
					$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
					$cat_parents     = explode( ',', $get_cat_parents );

					// Loop through parent categories and store in variable $cat_display.
					$cat_display = '';
					foreach ( $cat_parents as $parents ) {
						$cat_display .= '<li class="breadcrumb-item active">' . $parents . '</li>';
						// $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
					}
				}
				// If it's a custom post type within a custom taxonomy.
				$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
				if ( empty( $last_category ) && ! empty( $custom_taxonomy ) && $taxonomy_exists ) {

					$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
					$cat_id         = $taxonomy_terms[0]->term_id;
					$cat_nicename   = $taxonomy_terms[0]->slug;
					$cat_link       = get_term_link( $taxonomy_terms[0]->term_id, $custom_taxonomy );
					$cat_name       = $taxonomy_terms[0]->name;

				}

				// Check if the post is in a category.
				if ( ! empty( $last_category ) ) {
					echo esc_html( $cat_display );
					echo '<li class="breadcrumb-item active item-' . esc_html( $post->ID ) . '"><span class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

					// elseif post is in a custom taxonomy.
				} elseif ( ! empty( $cat_id ) ) {

					echo '<li class="breadcrumb-item active item-cat-' . esc_html( $cat_id ) . ' item-cat-' . esc_html( $cat_nicename ) . '"><a class="bread-cat bread-cat-' . esc_html( $cat_id ) . 'bread-cat-' . esc_html( $cat_nicename ) . '" href="' . esc_html( $cat_link ) . '" title="' . esc_html( $cat_name ) . '">' . esc_html( $cat_name ) . '</a></li>';
					// echo '<li class="separator"> ' . esc_html( $separator ) . ' </li>';
					echo '<li class="breadcrumb-item active item-' . esc_html( $post->ID ) . '"><span class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';

				} else {

					echo '<li class="breadcrumb-item active item-' . esc_html( $post->ID ) . '"><span class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</span></li>';
				}
			} elseif ( is_category() ) {

				// Category page.
				echo '<li class="breadcrumb-item active item-cat"><span class="bread-current bread-cat">' . esc_html( single_cat_title( '', false ) ) . '</span></li>';

			} elseif ( is_page() ) {
				// Standard page.
				if ( $post->post_parent ) {
					// If child page, get parents.
					$anc = get_post_ancestors( $post->ID );

					// Get parents in the right order.
					$anc = array_reverse( $anc );

					// Parent page loop.
					if ( ! isset( $parents ) ) {
						$parents = null;
					}
					foreach ( $anc as $ancestor ) {
								/*  $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';. */

						$parents .= '<li class="breadcrumb-item item-parent item-parent-' . $ancestor . '">' . get_the_title( $ancestor ) . '</li>';
						// $parents .= '<li class="separator separator-' . $ancestor . '"> ' . // $separator . ' </li>';
					}
					// Display parent pages.
					echo esc_html( $parents );

					// Current page.
					echo '<li class="breadcrumb-item active item-' . esc_html( $post->ID ) . '"><span class="bread-current" title="' . esc_html( get_the_title() ) . '"> ' . esc_html( get_the_title() ) . '</span></li>';

				} else {

					// Just display current page if not parents.
					echo '<li class="breadcrumb-item active item-' . esc_html( $post->ID ) . '"><span class="bread-current bread-' . esc_html( $post->ID ) . '"> ' . esc_html( get_the_title() ) . '</span></li>';

				}
			} elseif ( is_tag() ) {

				// Tag page.

				// Get tag information.
				$term_id       = get_query_var( 'tag_id' );
				$taxonomy      = 'post_tag';
				$args          = 'include=' . $term_id;
				$terms         = get_terms( $taxonomy, $args );
				$get_term_id   = $terms[0]->term_id;
				$get_term_slug = $terms[0]->slug;
				$get_term_name = $terms[0]->name;

				// Display the tag name.
				echo '<li class="breadcrumb-item active item-tag-' . esc_html( $get_term_id ) . ' item-tag-' . esc_url( $get_term_slug ) . '"><span class="bread-current bread-tag-' . esc_html( $get_term_id ) . ' bread-tag-' . esc_url( $get_term_slug ) . '">' . esc_html( $get_term_name ) . '</span></li>';

			} elseif ( is_day() ) {

				// Day archive.

				// Year link.
				echo '<li class="breadcrumb-item active item-year item-year-' . esc_html( get_the_time( 'Y' ) ) . '"><a class="bread-year bread-year-' . esc_html( get_the_time( 'Y' ) ) . '" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</a></li>';
				//echo '<li class="separator separator-' . esc_html( get_the_time( 'Y' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Month link.
				echo '<li class="breadcrumb-item active item-month item-month-' . esc_html( get_the_time( 'm' ) ) . '"><a class="bread-month bread-month-' . esc_html( get_the_time( 'm' ) ) . '" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . esc_html( get_the_time( 'm' ) ) . '">' . esc_html( get_the_time( 'm' ) ) . ' Archives</a></li>';
			//	echo '<li class="separator separator-' . esc_html( get_the_time( 'm' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Day display.
				echo '<li class="breadcrumb-item active item-' . esc_html( get_the_time( 'j' ) ) . '"><span class="bread-current bread-' . esc_html( get_the_time( 'j' ) ) . '"> ' . esc_html( get_the_time( 'jS' ) ) . ' ' . esc_html( get_the_time( 'M' ) ) . ' Archives</span></li>';

			} elseif ( is_month() ) {

				// Month Archive.

				// Year link.
				echo '<li class="breadcrumb-item active item-year item-year-' . esc_html( get_the_time( 'Y' ) ) . '"><a class="bread-year bread-year-' . esc_html( get_the_time( 'Y' ) ) . '" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</a></li>';
			//	echo '<li class="separator separator-' . esc_html( get_the_time( 'Y' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Month display.
				echo '<li class="breadcrumb-item active item-month item-month-' . esc_html( get_the_time( 'm' ) ) . '"><span class="bread-month bread-month-' . esc_html( get_the_time( 'm' ) ) . '" title="' . esc_html( get_the_time( 'm' ) ) . '">' . esc_html( get_the_time( 'm' ) ) . ' Archives</span></li>';
			} elseif ( is_year() ) {
				// Display year archive.
				echo '<li class="breadcrumb-item active item-current-' . esc_html( get_the_time( 'Y' ) ) . '"><span class="bread-current bread-current-' . esc_html( get_the_time( 'Y' ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</span></li>';
			} elseif ( is_author() ) {
				// Auhor archive.
				// Get the author information.
				global $author;
				$userdata = get_userdata( $author );
				// Display author name.
				echo '<li class="breadcrumb-item active  item-current-' . esc_html( $userdata->user_nicename ) . '"><span class="bread-current bread-current-' . esc_html( $userdata->user_nicename ) . '" title="' . esc_html( $userdata->display_name ) . '">Author: ' . esc_html( $userdata->display_name ) . '</span></li>';

			} elseif ( get_query_var( 'paged' ) ) {
				// Paginated archives.
				echo '<li class="breadcrumb-item active item-current-' . esc_html( get_query_var( 'paged' ) ) . '"><span class="bread-current bread-current-' . esc_html( get_query_var( 'paged' ) ) . '" title="Page ' . esc_html( get_query_var( 'paged' ) ) . '">' . esc_html__( 'Page' ) . ' ' . esc_html( get_query_var( 'paged ' ) ) . '</span></li>';
			} elseif ( is_search() ) {
				// Search results page.
				echo '<li class="breadcrumb-item active item-current-' . esc_html( get_search_query() ) . '"><span class="bread-current bread-current-' . esc_html( get_search_query() ) . '" title="Search results for: ' . esc_html( get_search_query() ) . '">Search results for: ' . esc_html( get_search_query() ) . '</span></li>';
			} elseif ( is_404() ) {
				// 404 page.
				echo '<li>Error 404</li>';
			}
			echo '</ol>';
		}
	}
endif;
