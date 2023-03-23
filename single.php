<?php
/**
 * The template for displaying all single posts
 * Template Post Type: post, resource
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

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
				<?php echo esc_html( workroom1128_custom_breadcrumb() ); ?>
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content', 'single' );
					workroom1128_post_nav();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						?>
						<?php
						comments_template();
					}
				}
				?>

			</main><!-- #main -->
		</div><!-- #closing the primary container from /global-templates/left-sidebar-check.php -->
			<!-- Do the right sidebar check -->
			<?php get_template_part( 'sidebar-templates/sidebar-right' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
