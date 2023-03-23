<?php
/**
 * A Category Template for video category 'series'.
 *
 * @package 1.0.0
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
				// Check if there are any posts to display.
				if ( have_posts() ) :
					?>
					<header class="archive-header">
						<h1 class="archive-title entry-title"><?php single_cat_title( '', true ); ?></h1>
						<?php
						// Display optional category description.
						if ( category_description() ) :
							?>
							<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php endif; ?>
					</header>


					<?php
					// The Loop.
					while ( have_posts() ) :
						?>
						<ul id="<?php echo esc_html( get_post_type() ); ?>-list" class="list-unstyled row flex-column gx-5 gy-3 <?php echo esc_html( get_post_type() ); ?>">
						<?php
							the_post();
							get_template_part( 'loop-templates/content', 'taxonomy-category' );
						?>
							</ul>
						<?php
					endwhile;
				else :
					?>
					<p>Sorry, no posts matched your criteria.</p>
				<?php endif; ?>
			</main>
		</div>
	</div>
</div>

<?php
get_footer();
