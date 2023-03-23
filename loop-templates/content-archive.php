<?php
/**
 * The template for displaying course archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package workroom1128
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?> 
  <li class="col  "> 
    <div class="d-flex">

   
        <div class=" flex-grow ">
            <article class="has-post-thumbnail category-name d-flex event--details ">

                <div class=" d-sm-none d-lg-block me-5 pt-2 ">
                    <a   href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" 
                    rel="bookmark" class="tribe-events-calendar-list__event-featured-image-link" tabindex="-1">
                    <?php the_post_thumbnail('blog-thumbnail', array( 'class' =>'card--img')); ?> 
                    <!-- use width 150px --> 
                    </a>
                </div>

                <div class=" d-flex align-items-center">

                    <header class=" d-flex flex-column justify-content-center">
                         
                        <h3 class="h4 ">
                            <a href="<?php the_permalink(); ?> " title="<?php the_title(); ?>" rel="bookmark" 
                            class="fw-bold  " style="font-size:24px; color:#0a0a0a;"><?php the_title(); ?></a>
                        </h3>
                        <div class="" style="font-size:18px">
                            <span class="fw-bold"><?php the_excerpt(); ?></span>
                        </div>
                    </header>
                </div>

            </article>
        </div>
    </div> 
  </li>  
