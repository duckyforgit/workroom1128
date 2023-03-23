<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="wrapper wrapper--page" id="index-wrapper">
	<div class="container" id="content" tabindex="-1">
		<div class="row"> 
			<main class="site-main" id="main">

				<!-- ======= Page Content Section ======= -->
				<!-- Post Content
				============================================= -->
				<?php
				if ( have_posts() ) {
					// Start the Loop.
					while ( have_posts() ) {
						the_post();

						if ( has_post_format() ) {
							get_template_part( 'loop-templates/content', get_post_format() );
						} elseif ( get_post_type( 'event', 'testimonial', 'offer', 'faq', 'book_preview', 'speaking_topic', 'client' ) ) {
							get_template_part( 'loop-templates/content', get_post_type() );
						} else {
							get_template_part( 'loop-templates/content', 'page' );
						}
					}
				} // end of the loop.
				?>
			</main><!-- #main -->
		</div><!-- .row -->

	</div><!-- #content -->

</div><!--#page-wrapper -->

<?php
get_footer();
