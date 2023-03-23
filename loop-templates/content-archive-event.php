<?php
/**
 * The template for displaying course archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package workroom1128
 */

/*  Exit if accessed directly. */
defined( 'ABSPATH' ) || exit;
?> 
<li class = "col"> 
	<div class = "d-flex">

		<div class = "flex-shrink ps-5 pe-5 d-none d-lg-block">
			<time class="d-flex flex-column align-items-center" datetime="2022-03-02" aria-hidden="true">
				<span class=" text-uppercase">
				</span>
				<span class="fw-bold" style="font-size:20px">
				<?php
				echo esc_html( $dates->format( 'd' ) );
				?>
				</span>
			</time>
		</div>

		<div class=" flex-grow ">
			<article class="has-post-thumbnail category-name d-flex event--details ">

				<div class=" d-none d-xl-block me-5 pt-2 ">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" 
					rel="bookmark" tabindex="-1">
					<?php
					the_post_thumbnail( 'blog', array( 'class' => 'card--img' ) );
					?>
					<!-- use width 150px --> 
					</a>
				</div>

				<div class=" d-flex align-items-center">

					<header class=" d-flex flex-column justify-content-center">
						<div class="mb-3">
						<time class=""  style="font-size:16px">
						<span class="" >
							<?php echo esc_html( $dates->format( 'F, d, Y ' ) ); ?> @ <?php the_field( 'event_time' ); ?></span> - <span class="event-time">
								<?php the_field( 'event-time-end' ); ?>
							</span> <span class="timezone"> EST </span>	</time>
						</div>
						<h3 class="h4">
							<a href="<?php the_permalink(); ?> " title="<?php the_title(); ?>" rel="bookmark" class="fw-bold" style="font-size:24px; color:#0a0a0a;">
							<?php the_title(); ?>
						</a>
						</h3>
						<div class="" style="font-size:18px">
							<span class="fw-bold"><?php the_excerpt(); ?></span>
						</div>
					</header>
				</div>

			</article>
		</div>

	</div> 
</li> 
