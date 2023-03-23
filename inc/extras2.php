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


if ( ! function_exists( 'workroom1128_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link.
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
	 *
	 * @return string The navigation text.
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

			<div class="row p0 nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<div class="nav-previous">%link</div>', _x( '<i class="far fa-arrow-alt-circle-left" aria-hidden="true" style="color:#bbb"></i>&nbsp;%title', 'Previous article', 'workroom1128' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<div class="nav-next">%link</div>', _x( '%title&nbsp;<i class="far fa-arrow-alt-circle-right" aria-hidden="true" style="color:#bbb"></i>', 'Next article', 'workroom1128' ) );
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
 **/
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
