<?php
/**
 * workroom1128 PHP template
 *
 * @package workroom1128
 * @since workroom1128
 */

if ( ! function_exists( 'workroom1128_entry_meta_post_data' ) ) :
	/**
	 * Displays the date and categories of a post
	 */
	function workroom1128_entry_meta_post_data() {
		$postmeta  = '<span class="screen-reader-text">Posted on</span>';
		$postmeta .= esc_html( workroom1128_meta_date() );

		echo '<div class="entry-meta">' . esc_html( $postmeta ) . '</div>';
	}
endif;


if ( ! function_exists( 'workroom1128_meta_date' ) ) :
	/**
	 * Displays the post date
	 */
	function workroom1128_meta_date() {

		$time_string = sprintf(
			'<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		return '<span class="meta-date">' . $time_string . '</span>';
	}
endif;

if ( ! function_exists( 'workroom1128_entry_meta_date' ) ) :
	/**
	 * Displays the post meta date
	 */
	function workroom1128_entry_meta_date() {
		// Code with avatar in meta echo '<div class="time">' . get_avatar( get_the_author_meta( 'ID' ), 32 ) . '</div>';.
		echo '<div class="time"><time class="updated" datetime="' . esc_html( get_the_time( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time></div>';
	}
endif;


if ( ! function_exists( 'workroom1128_meta_category' ) ) :
	/**
	 * Displays the category of posts
	 */
	function workroom1128_meta_category() {

		return '<span class="meta-category"> ' . get_the_category_list( ' / ' ) . '</span>';

	}
endif;

if ( ! function_exists( 'workroom1128_entry_meta_categories' ) ) :
	/**
	 * Displays the category of posts
	 */
	function workroom1128_entry_meta_categories() {

		$category = get_the_category();
		echo 'Categories: ';
		if ( $category ) {
			echo esc_html( the_category( ' | ' ) );
		}

	}
endif;

if ( ! function_exists( 'workroom1128_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function workroom1128_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: Post author. */
			__( 'by %s', 'workroom1128' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . esc_url( workroom1128_time_link() ) . '</span><span class="byline"> ' . esc_html( $byline ) . '</span>';
	}
endif;


if ( ! function_exists( 'workroom1128_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function workroom1128_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: Post date. */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'workroom1128' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;


/**
 * Entry meta information for posts
 *
 * @package workroom1128
 * @since workroom1128 1.0.0
 */

if ( ! function_exists( 'workroom1128_entry_meta' ) ) :
	/**
	 * Displays the meta of posts
	 */
	function workroom1128_entry_meta() {
		/* translators: %1$s: current date, %2$s: current time */
		echo '<time class="updated" datetime="' . esc_html( get_the_time( 'c' ) ) . '">' . sprintf( esc_html__( 'Posted on %1$s at %2$s.', 'workroom1128' ), esc_html( get_the_date() ), esc_html( get_the_time() ) ) . '</time>';
		echo '<p class="byline author">' . esc_html__( 'Written by', 'workroom1128' ) . ' <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author" class="fn">' . esc_html( get_the_author() ) . '</a></p>';
	}
endif;

if ( ! function_exists( 'workroom1128_entry_meta_altered' ) ) :
	/**
	 * Displays the meta of posts
	 */
	function workroom1128_entry_meta_altered() {
		// translators: %1$s: current date, %2$s: current time.
		// echo '<div class="entry-avatar">' . get_avatar( get_the_author_meta( 'ID' ), 32 ) . '</div>';.
		echo '<p class="byline author"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author" class="fn entry-author">' . get_the_author() . '</a>';

		echo '&nbsp;·&nbsp;<time class="updated" datetime="' . esc_html( get_the_time( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
		// Add comment number to meta echo '<span class="entry-comments">&nbsp;·&nbsp;'. get_comments_number() . '&nbsp;Comments</span></p>';.
	}
endif;
if ( ! function_exists( 'workroom1128_entry_meta_name' ) ) :
	/**
	 * Displays the meta of posts
	 */
	function workroom1128_entry_meta_name() {
		// translators: %1$s: current date, %2$s: current time.
		// echo '<div class="entry-avatar">' . get_avatar( get_the_author_meta( 'ID' ), 32 ) . '</div>';.
		echo '<span class="byline author">By: <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author" class="fn entry-author">' . get_the_author() . '</a></span>';
	}
endif;

if ( ! function_exists( 'workroom1128_entry_meta_date' ) ) :
	/**
	 * Displays the meta of posts
	 */
	function workroom1128_entry_meta_date() {
		// translators: %1$s: current date, %2$s: current time.
		echo '<div class="time"><time class="updated" datetime="' . esc_html( get_the_time( 'c' ) ) . '">' . sprintf( esc_html__( '%1$s at %2$s.', 'workroom1128' ), esc_html( get_the_date() ), esc_html( get_the_time() ) ) . '</time></div>';
	}
endif;

if ( ! function_exists( 'workroom1128_entry_meta_date_with_icon' ) ) :
	/**
	 * Displays the meta of posts
	 */
	function workroom1128_entry_meta_date_with_icon() {
		// echo '<div class="time">' . get_avatar( get_the_author_meta( 'ID' ), 32 ) . '</div>';.
		// translators: %1$s: current time, %2$s: current date.
		// echo '<div class="time"><span class="icon calendar"></span><time class="updated" datetime="' . sprintf( __( '%1$s', 'workroom1128' ), esc_html( get_the_time( 'c' ) ) ) . '">' . sprintf( esc_html__( '%2$s', 'workroom1128'), get_the_date() ) . '</time></div>';.
		echo sprintf( '<div class="time"><span class="icon calendar"></span><time class="updated" datetime="%1$s">%2$s</time></div>', esc_html( get_the_time( 'c' ) ), esc_html( get_the_date() ) );
	}
endif;

if ( ! function_exists( 'workroom1128_entry_meta_categories' ) ) :
	/**
	 * Displays the meta of posts
	 */
	function workroom1128_entry_meta_categories() {

		$category = get_the_category();
		echo 'Categories: ';
		if ( $category ) {
			echo esc_html( the_category( ' | ' ) );
		}
	}
endif;

if ( ! function_exists( 'workroom1128_entry_meta_comment_numbers' ) ) :
	/**
	 * Displays the meta of posts
	 */
	function workroom1128_entry_meta_comment_numbers() {
		$comments = esc_html( get_comments_number( get_the_ID() ) );
		echo esc_html( comments_number() );

	}
endif;
