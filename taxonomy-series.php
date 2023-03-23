<?php
/**
 * A Category Template for video category 'series'
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
			if ( have_posts() ) {
				?>
				<div class="container">
					<div class="elearning-archive-courses row justify-content-between">
						<div class="col-sm-6">
							<header class="page-header">
								<?php
								if ( is_post_type_archive( 'event' ) ) {
									echo '<h1 class="entry-title">Upcoming Events</h1>';
								} else {
									?>
									<h1 class="entry-title">
										<?php single_term_title(); ?>
									</h1>
									<div class="taxonomy-description">
										<?php the_archive_description(); ?>
									</div>
									<?php
								}
								?>

							</header><!-- .page-header -->
						</div> 

						<div class="elearning-courses-bar col-sm-4 justify-content-flex-end no-border"> 
						<?php get_search_form(); ?> 
						</div>
						<ul id="<?php echo esc_html( get_post_type() ); ?>-list" class="list-unstyled row flex-column gx-5 gy-3 <?php echo esc_html( get_post_type() ); ?>"  > 
						<?php
						// Start the loop.
						while ( have_posts() ) {
							the_post();

							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part( 'loop-templates/content', 'series' );
						}
						?>
						</ul>
			</div>
				<?php
			} else {
				get_template_part( 'loop-templates/content', 'none' );
			}
			?>
			</main><!-- #main -->

			<?php
			// Display the pagination component.
			workroom1128_pagination();
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->
<?php
get_footer();
