<?php
/**
 * The template for displaying all single offer posts
 *
 * @package Workroom1128
 * https://www.youtube.com/channel/UC3Ho_r7DD58Cz3fb47vbxxg
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
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<div class="container">
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header> <!-- .entry-header -->
					</div>
					<div class="entry-content mt-5">
						<?php
						the_content();
						workroom1128_link_pages();
						?>
					</div>
					<div class="container">
						<div class="row mt-5" style="justify-content:center">
							<div class="col-sm-12 col-lg-6" >
								<div class="button-wrapper d-flex justify-content-center">
									<button role="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#privateCoachingModal" aria-controls="consultation" aria-haspopup="true" tabindex="0"><h3>My career needs help, I would like more information about how to Optimize My Career!</h3></button>
								</div>
							</div>
						</div>
					</div>
					<footer class="entry-footer">
						<!-- edit button which is only visible if logged in -->
						<?php workroom1128_entry_footer(); ?>
					</footer>
				</article><!-- #post-## -->
				<?php
				workroom1128_post_nav();
			}
			?>
			<div class="modal" id="privateCoachingModal" tabindex="-1" aria-labelledby="privateCoachingModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">

								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<?php echo do_shortcode( '[ninja_form id=8]' ); ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</main><!-- #main -->
		</div><!-- .row -->
	</div><!-- #content -->
</div><!-- #single-wrapper -->
<?php
get_footer();
