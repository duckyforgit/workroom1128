<?php
/**
 * Template Name: About Page
 *
 * This is the template that displays about page.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<div class="wrapper" id="page-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row"> 

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					the_post();
						get_template_part( 'loop-templates/content', 'about' );
				}
				?>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
