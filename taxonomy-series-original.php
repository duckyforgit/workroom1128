<?php
/**
* A Category Template for video category 'series'
*/
// Exit if accessed directly.
defined('ABSPATH') || exit;

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
								if (is_post_type_archive( $post_types = 'event' )) {  
									echo '<h1 class="entry-title">Upcoming Events</h1>';
							
								}
								else {
									the_archive_title( '<h1 class="entry-title">', '</h1>' );
									the_archive_description( '<div class="taxonomy-description">', '</div>' );
								}
							?>

							</header><!-- .page-header -->
					</div> 

					<div class="elearning-courses-bar col-sm-4 justify-content-flex-end no-border">
                                 
                    <?php get_search_form(); ?>

                         

                    </div>
				 

					<ul id="<?php echo get_post_type(); ?>-list" class="list-unstyled row flex-column gx-5 gy-3 <?php echo get_post_type();?>"  >
					
					<?php
					// Start the loop.
					while ( have_posts() ) {
						the_post();?>
 
						<?php 
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						 
                        
						 	get_template_part( 'loop-templates/content', 'series' );
						 
						 
					}
				} else {
					get_template_part( 'loop-templates/content', 'none' );
				}
				?>
				</ul>
			</div>
			 
			</main><!-- #main -->

			<?php
			// Display the pagination component.
			workroom1128_pagination();
			 
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->
<?php get_footer();
            
            // Check if there are any posts to display
        //  if (have_posts()) : ?>
              <!--  <header class="archive-header">
                  <h1 class="archive-title entry-title"><?php // single_cat_title('', true); ?>
                  </h1>
                 
                                 
                    <?php
                    // Display optional category description
                 //   if (category_description()) : ?>
                        <div class="archive-meta"><?php //echo category_description(); ?></div>
                    <?php //endif; ?>
                </header>
 
                <?php
                // The Loop
              //  while (have_posts()) :
                  //  the_post(); ?>

 
                <div class="entry-content mt-5">
                        <div class="media-object">
                          <div class="media-object-section ">
                            <div class="thumbnail">
                              <?php //the_post_thumbnail('featured-video'); ?>    
                            </div>
                          </div>
                          <div class="media-object-section main-section middle">
                             <?php //$link =  get_post_type_archive_link('videos'); ?> 
                            <h3><a href="<?php// the_permalink(); ?>"><?php the_field('video_title'); ?></a></h3>
                             
                             <!-- <p><?php //the_field('order_in_series'); ?></p> -->
                        <!--  </div>
                        </div>  
                        <p><?php //edit_post_link(__('(Edit)', 'workroom1128'), '<span class="edit-link">', '</span>'); ?></p> 
                </div>  
                 
                <?php //endwhile;
           // else : ?>
                <!-- <p>Sorry, no posts matched your criteria.</p> -->
            <?php //endif; ?>
        <!-- </main>
        </div>
         
    </div>
</div> -->  
