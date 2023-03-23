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
						<section id="webinar-series" class="offers"> 
							<div class="grid-wrapper webinar-series mt-5">
								<div class="box-1 justify-content-center flex-column align-items-center text-white grid-box-shadow">
									<h2 class="display-5 text-shadow pe-5 ps-5">ENGAGE THROUGH A COMBINATION COACHING AND COURSE PACKAGE</h2>
								</div>
								<div class="box-2 grid-box-shadow img31"></div>
								<div class="box-3 box-3--growth align-items-start flex-column grid-box-shadow ps-2 pe-2">
									<h3 class="pb-2" >The course will reinforce coaching concepts to help you apply newly learned tools in your day-to-day.</h3>
								</div>
								<div class="box-4 grid-box-shadow img51 justify-content-center align-items-center">
								</div>
								<div class="box-5 align-items-start flex-column justify-content-center grid-box-shadow ps-2 pe-2">
									<h4 class="h5 text-center text-shadow-black "> This self-paced course will also introduce you to additional tools and resources to help you connect additional dots from your private coaching.</h4>
								</div>
								<div class="box-6 grid-box-shadow img30">
									<div class="box-6--presentation"></div>
								</div>
								<div class="box-7 grid-box-shadow img41">
								</div>								
								<div class="box-8 flex-column justify-content-center background-primary grid-box-shadow">
									<img class="width-200 d-none d-sm-none d-md-none d-lg-none d-xl-flex" src="<?php echo esc_url( get_template_directory_uri() . '/dist/img/noun-talk-1471159-FFFFFF.png' ); ?>" width="200" alt="Let's talk about it">
									<h3 class="h2 text-white ps-3 pe-1 text-shadow ">My career needs help.<br>Let's talk about it!</h3>
									<div class="btn-group">
										<a href="#nf-form-11-cont" role="button" class="btn btn btn-outline-light btn-outline-gold m-2 mt-4">I would like more information, let&#39;s chat!</a>
									</div>
								</div>
							</div>
						</section>
						<div class="entry-content">
							<!-- <div class="course-options-title mt-3">
								<p class="mt-2 mb-2" style="text-align:center">*Deliberate Doing Original Course: <em>Overcoming Career Constraints - What College Doesn't Teach You"</em></p>
							</div> -->

							<div class="entry-content mt-5">
								<?php
								the_content();
								workroom1128_link_pages();
								?>
							</div>

							<!-- <div class="container">
								<div class="row mt-5" style="justify-content:center">
									<div class="col-sm-12 col-lg-6" >
										<div class="button-wrapper d-flex justify-content-center">
											<button role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#groupCourseModal">I am interested in this group course, let's chat!</button>
										</div>
									</div>
								</div>
							</div> -->
						</div>
						<footer class="entry-footer">
								<!-- edit button which is only visible if logged in -->
								<?php workroom1128_entry_footer(); ?>
						</footer>
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

				<div class="modal" id="comboPackageModal" tabindex="-1" aria-labelledby="comboPackageModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">

								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php echo do_shortcode( '[ninja_form id=7]' ); ?>
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
