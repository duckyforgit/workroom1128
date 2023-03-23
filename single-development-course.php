<?php
/**
 * The template for displaying all single posts
 *
 * @category Category
 * @package  workroom1128
 * Display Name:  Maureen
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$user = wp_get_current_user();
if ( ! is_user_logged_in() ) {
	wp_safe_redirect( home_url() );
}

get_header( 'course' );

?>
<div class="" id="popup-course">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">

			<?php
			while ( have_posts() ) {
				the_post();

				get_template_part( 'template-parts/single-course/content-item/popup-header' );
				?>
					<div class="d-none d-sm-none d-xl-flex justify-content-end">
						<button class="btn btn-primary m-1 arrow"
							type="button"
							data-bs-target="#popup-sidebar"
							data-bs-toggle="collapse"
							aria-controls="collapse"
							aria-expanded="true">
						<h5 class="maximize">Maximize Screen</h5>
						<h5 class="course-content">Back to Course Content</h5>	
						</button>
					</div>

				<div class="container-fluid">

					<div class="row">

						<div class="col-sm col border-start">

							<?php get_template_part( 'template-parts/single-course/content-item/popup-content' ); ?>
						</div>
						<div class="col-auto d-none d-xl-block">
							<div class="collapse collapse-horizontal show"
							id="popup-sidebar"
							aria-controls="popup-sidebar" >
							<?php get_template_part( 'template-parts/single-course/content-item/popup-sidebar' ); ?>
						</div>
					</div>

					</div>

				</div>

				<?php
			}
			?>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
