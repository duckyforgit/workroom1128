<?php
/**
 * The template for displaying single lesson pdf file posts
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'workroom1128_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
			<?php
			if ( is_user_logged_in() ) {
				?>
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content', 'single' );
					workroom1128_post_nav();


				}
				?>
				<?php
			} else {
				?>
				<h2>You must purchase a course to view this page.</h2>
				<a class="wp-post-link" href="<?php home_url( 'offers/life-skills-course/' ); ?>" title="" rel="bookmark">
				<h3 class="h4 mt-5">View more about our Life Skills Course: Overcoming Career Constraints</h3>
				</a>
				<?php
			}
			?>
			</main><!-- #main -->

			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
