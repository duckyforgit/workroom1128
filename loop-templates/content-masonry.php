<?php
/**
 * The template part for displaying Masonry content.
 *
 * @package workroom1128
 * @since workroom1128 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
echo '<h2>In masonry</h2>';
// get masonry images.
	$args          = array(
		'posts_per_page' => -1,
		'post_type'      => 'masonry',
		'category_name'  => 'masonry-gallery',
	);
	$masonry_posts = new WP_Query( $args );


	if ( $masonry_posts->have_posts() ) :
		?>
		<div class="container">
			<div class="masonry">
				<?php
				while ( $masonry_posts->have_posts() ) :
					$masonry_posts->the_post();
					$images = get_field( 'gallery_image' );
					$size   = 'full'; // Use (thumbnail, medium, large, full or custom size).
					if ( $images ) :
						?>
						<?php foreach ( $images as $image_id ) : ?>
							<div class="grid">
								<?php echo wp_get_attachment_image( $image_id, $size ); ?>
								<div class="grid__body">
									<div class="relative">
										<a class="grid__link" target="_blank" href="/" ></a>
										<h1 class="grid__title">Title 1</h1>
										<p class="grid__author">Mario Rossi</p>
									</div>
									<div class="mt-auto" >
										<span class="grid__tag">#tag1</span>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						<?php
					endif;
				endwhile;
				?>
			</div>
		</div>
		<?php
	endif;
	?>
