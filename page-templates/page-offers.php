<?php
/**
 * Template Name: Offers Listing Page
 *
 * This template overrides the default template and sidebar setup
 *
 * @package __workroom1128_WP_Biz
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
 
?>  
    
 
  <div class="wrapper" id="page-wrapper">  

    <div class="container" id="content" tabindex="-1">
            
        <main class="site-main" id="main">
  
        <?php
        while (have_posts()) :
            the_post(); ?>
                    
                  
        <?php $categories = get_terms('offer_category', 'orderby=count&order=DESC&hide_empty=1');
        foreach( $categories as $category ): 
        ?>
                <div class="mt-5 mb-3">
                        
					<h3 class="entry-title--category"><?php echo $category->name; // Prints the cat/taxonomy group title ?></h3>
               
				</div>

                <?php
                $posts = get_posts(array(
                'post_type' => 'offer',
                'taxonomy' => $category->taxonomy,
                'term' => $category->slug,
                'nopaging' => true,
                ));

                foreach($posts as $post): 

                    setup_postdata($post); //enables the_title(), the_content(), etc. without specifying a post ID

                ?>

					<ul id="<?php echo get_post_type(); ?>-list" class="list-unstyled row flex-column gx-5 gy-3 <?php echo get_post_type();?>"  >
															
						<?php get_template_part( 'loop-templates/content-archive', 'offer' ); ?>

					</ul> 

                <?php 
				endforeach; ?>

        	<?php 
			endforeach; ?>
       
        <?php
        endwhile;
        ?>

        </main>  <!-- #main -->

    </div><!-- #content -->

 </div> <!-- #page-wrapper -->
 
<?php
get_footer();
