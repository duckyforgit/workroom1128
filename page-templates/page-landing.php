<?php
/**
 * Template Name: Landing Page
 *
 * This is the template that displays about page.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
// page-template-page-landing.

?>
<div class="front-wrapper" id="page-wrapper">
	<div id="hidden-div" class="hidden">


	</div>
	<div id="main-content-div" >
				
		<div class="wrapper p-0" id="index-wrapper">

			<div class="container-fluid p-0" id="content">

				<main class="site-main" id="main">
				<?php
				if ( have_posts() ) {
					// Start the Loop.
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', 'hero-banner-video' );
						
						get_template_part( 'template-parts/content', 'clients' );

						?>
						<div class="container">
							<hr class="mb-5">
						<?php
						the_content();

						get_template_part( 'template-parts/content', 'testimonial-ajax' );
						get_template_part( 'template-parts/content', 'survey' );
						get_template_part( 'template-parts/content', 'consultation' );
						/* use the get template part  ( 'template-parts/sections/section', 'exit-intent');.  */
						?>
						<?php
					}
				} else {
					get_template_part( 'loop-templates/content', 'none' );
				}
				?>

				</main><!-- #main --> 

			</div><!-- #content -->

		</div><!-- #index-wrapper -->
	</div> 

</div>
<?php
get_footer();
