<?php
/**
 * The main template file blog with boxed columns
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>


<section class="wrapper" id="index-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">
				<div class="container d-none d-md-block">
					<div class="row">
						<div class="col-12">
							<div class="elearning-courses-bar justify-content-flex-end relative"  >
								<div id="switched" class="switch-layout">

									<input class="switch-input" type="radio" name="elearning-switch-layout-btn" value="grid" id="elearning-switch-layout-btn-grid"   >

									<label class="switch-btn grid" title="Switch to grid" for="elearning-switch-layout-btn-grid"></label>

									<input class="switch-input" type="radio" name="elearning-switch-layout-btn" value="list" id="elearning-switch-layout-btn-list" >

									<label class="switch-btn list" title="Switch to list" for="elearning-switch-layout-btn-list"></label>

								</div>
							</div>
						</div>
					</div>
				</div>  
				<!-- Category Filters for Articles
				============================================= -->

				<div id="filters" class="container">  
				<?php

				$categories = get_categories();

				// search for space and replace with hyphen.
				?>

				<div class="blog-selectors button-group filters-button-group ">

					<button class="col button is-checked" data-filter="*">All</button>

					<?php foreach ( $categories as $category ) : ?>
						<?php if ( 'Uncategorized' !== $category ) : ?>
							<button class="button" data-filter=".<?php echo esc_html( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?>
							</button>
						<?php endif; ?>
					<?php endforeach; ?>

				</div> 

			</div> 
			<!-- Post Content
			============================================= -->
			<?php
			if ( have_posts() ) :
				?>

			<div class="container p-0 m-0"> 

			<ul id="blog-list"  class="row gy-3 gridlayout list-unstyled" data-layout="grid" >

				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<?php
					$blogterms = get_the_terms( get_the_ID(), 'category' );

					if ( $blogterms && ! is_wp_error( $blogterms ) ) :
						$tslugs_arr = array();
						$string     = '';
						foreach ( $blogterms as $blogterm ) {
							$string .= $blogterm->slug;
							$string .= ' ';
						}
					endif;
					?>

					<!-- Posts
					============================================= -->
				<li class="col grid-item  <?php echo esc_html( $string ); ?>" data-category="<?php echo esc_html( $string ); ?>" >

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'list-content' ); ?> >

						<div class="post-thumbnail d-none d-md-flex"> <!-- add d-none to eliminate the image on mobile -->

							<a class="wp-post-image-link" href="<?php esc_url( the_permalink() ); ?>" title="" rel="bookmark" >
							</a>

							<?php
							the_post_thumbnail( 'blog-thumbnail', array( 'class' => 'skip-lazy' ) );
							?>

						</div>

						<div class="entry-wrapper ">

							<header class="entry-header">

								<div class="entry-meta flex-column">

									<div class="entry-meta__date">

										<?php echo get_the_date(); ?>

									</div>

									<div class="entry-meta__category">

										<?php the_category( ' | ' ); ?>

									</div>

								</div>

								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

								<div class="entry-description align-items-start justify-content-center flex-column">

									<p><?php echo esc_html( wp_trim_words( get_the_content(), 20 ) ); ?></p>
								</div>

							</header>

						</div>

					</article> 
				</li>

					<?php
			endwhile;
			else :
				?>

			<div class="item align-center text-center">

				<h2>No articles to show</h2>

			</div> 
			<!-- show 404 error here -->
		</ul>

	</div>

					<?php
		endif;
			wp_reset_postdata();
			?>

</main>

</div>  

</div>

</section>
<?php
get_footer();
