<?php
/**
 * The template for displaying single offer life skills group course offer
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="single-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">
			<main class="site-main" id="main">
				<?php
				while ( have_posts() ) {
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header>
							<h1 class="entry-title entry-mobile-title"><?php the_title(); ?></h1>

						</header>
						<section id="single-course" class="offers">
							<div style="position:relative; width:100%; height:50px">
							</div>
							<div class="grid-wrapper single-course">
								<div class="box-1 justify-content-center flex-column align-items-center text-white grid-box-shadow">
										<h2 class="display-5 text-shadow pe-5 ps-5">ENGAGE THROUGH A LIFE SKILLS COURSE</h2>
									</div>
									<div class="box-2 grid-box-shadow img31"></div>
									<div class="box-3 box-3--growth align-items-start flex-column grid-box-shadow ps-2 pe-2">
										<h3 class="text-shadow-black " >Generate self-authority, authenticity, and critical thinking to create a healthy career.</h3><h3>Then apply the above outcomes to sustain a robust and meaningful future.</h4>
									</div>								
								</div>
							</div>
							<div class="entry-content mt-5">							
								<?php
								the_content();
								workroom1128_link_pages();
								?>
							</div>
							<footer class="entry-footer">
								<!-- edit button which is only visible if logged in -->
								<?php workroom1128_entry_footer(); ?>
							</footer>
						</section>
						<footer>
							<?php
							wp_link_pages(
								array(
									'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'workroom1128' ),
									'after'  => '</p></nav>',
								),
							);
							?>
						</footer>
					</article>
					<?php
				}
				?>

				<div class="modal" id="groupCourseModal" tabindex="-1" aria-labelledby="groupCourseModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">

								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php echo do_shortcode( '[ninja_form id=13]' ); ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</main><!-- #content -->

		</div><!-- container full width -->
	</div>

</div>

<?php
get_footer();
