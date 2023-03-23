<?php
/**
 * Template Name: Events Template
 * Template Post Type: event, page,
 *
 * Template for displaying the Events Calendar page.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header( 'workroom1128' );
?>
<?php
$bannertitle    = '';
$bannersubtitle = '';
$bannercat      = '';
$args           = array(
	'title'    => '',
	'subtitle' => $bannersubtitle,
	'cat'      => 'events',
);
get_template_part( 'global-templates/banner', 'banner', $args );

?>
<div class="wrapper wrapper--page" id="index-wrapper">
	<div class="container-fluid" id="content" tabindex="-1">
		<div class="row"> 
			<main class="site-main" id="main"> 
				<div class="mt-5"></div>

					<!-- ======= Events Content Section ======= -->
					<section id="events" class="events section-bg">
						<div class="container" data-aos="fade-up">
							<div class="mb-5">
								<?php echo esc_html( get_workroom1128_breadcrumbs() ); ?>
							</div>

							<div class="section-title mt-5">
								<h2 class="display-3">Events</h2>				 
							</div>
						<!-- Post Content
						============================================= -->
								<?php
								if ( have_posts() ) {
									// Start the Loop.
									while ( have_posts() ) {
										the_post();
										get_template_part( 'loop-templates/content', 'page' );
									}
								}
								?>
						</div>
					</section>
				</div>

			</main>
		</div>
	</div>
</div>

<?php
get_footer();
