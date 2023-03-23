<?php
/**
 * The template for displaying taxonomy series page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package workroom1128
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?> 
	<li class="col p-0 p-lg-3">
		 
		<div class="card mb-3"  >
			<a href="<?php the_permalink(); ?>" class="stretched-link"></a>
				<div class="row g-0 align-items-center">
					<div class="col-md-4 col-lg-3">
						<div class="d-none d-md-block">
							<?php the_post_thumbnail('blog-small', array( 'class' =>'card--img')); ?> 
						</div>
					</div>
					<div class="col-xm-12 col-md-8 col-lg-9">
						<div class="card-body">
							<h5 class="card-title fw-bold"> <?php the_title(); ?></h5>
							<p class="card-text"><?php echo wp_trim_words(get_field('video_description'), 35); ?></p>
				
						</div>
					</div>
				</div>
		</div> 
	</li> 
