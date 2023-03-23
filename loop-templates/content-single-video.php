<?php
/**
 * Single post partial template
 *
 * @package Workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h1 class="entry-title"><?php the_title(); ?></h1>

	</header>
	<div class="container">
		<div class="row align-center-middle">
			<div class="col-sm-12">
				<div class="video-wrapper"  >
					<?php the_field( 'video_embed' ); ?>
				</div>
				<p><?php edit_post_link( __( 'Edit' ), '', '', 0, 'post-edit-link ' ); ?>
				</p>
			</div>

		</div>
		<div class="row align-middle">
			<div class="col-sm-12">
				<div class="entry-categories">

					<p><?php the_terms( $post->ID, 'series', 'Series Categories: ' ); ?></p>

				</div>

				<div class="entry-description">

					<p><?php the_field( 'video_description' ); ?></p>

				</div>
			</div>
		</div>

	</div>

</article>
