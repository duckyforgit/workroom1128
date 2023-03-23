<?php
/**
 * The template for displaying all single testimonial posts
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
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header> <!-- .entry-header -->
					<div class="entry-content quote-icon mt-5">
						<?php
						the_field( 'client_testimonial' );
						workroom1128_link_pages();
						?>
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
			</main><!-- #main -->
		</div><!-- .row -->
	</div><!-- #content -->
</div><!-- #single-wrapper -->
<?php
get_footer();
