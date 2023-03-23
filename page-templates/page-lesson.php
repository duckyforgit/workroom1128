<?php
/**
 * Template Name: Page Lessoni
 * Template Post Type: post, page, event, development_course, lesson_slide, lesson_pdf, lesson_video, student, lesson, speaking_topic, client, book_preview. faq, testimonial, videos, offers, series
 * @author   Maureen Mladucky
 * @package  workroom1128
 * @version  1.0.0
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

?>

<div class="wrapper" id="class-wrapper">

	<div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

    	<main class="site-main" id="main">

		<?php
		//while ( have_posts() ):
		//  the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
		<h1 class="h2 entry-title"><?php the_title(); ?></h1>
		<hr>
		</header>
		<div class="entry-content">

		<h2>Class Module</h2>



<!--  <?php //the_field('class_title'); ?> -->
<!-- <?php //the_field('class_order_in_series'); ?> -->
<?php if ( get_field('class_video') ) : ?>
<!-- <a href="<?php //the_field( 'class_video' ); ?>">Download File</a> -->

<video width="100%" height="auto" controls>
    <source src="<?php the_field('class_video');?>" type="video/mp4">
</video>
<?php endif; ?>
<?php if (get_field('class_pdf_resource')) : ?>
  <a href="<?php the_field('class_pdf_resource'); ?>">Download File</a>
<?php endif; ?>


                  <!-- get the classes here. below is code to list pdfs slides and video -->
                <!--  <h3>Downloadable PDF</h3> -->

                  <!-- <div class="wp-block-file">
                    <a href="<?php //echo get_field('class_pdf_resource'); ?>">Editable Mod1Class1Worksheets to download</a>
                    <a href="<?php //echo get_field('class_pdf_resource'); ?>" class="wp-block-file__button" download="">Download</a>
                  </div>

                  <figure class="wp-block-embedpress-document embedpress-embed-document">
                    <div style="height:1000px;width:1000px" class="embedpress-embed-document-pdf embedpress-pdf-1622125522842 pdfobject-container" data-emid="embedpress-pdf-1622125522842" data-emsrc="<?php //echo get_field('class_pdf_resource'); ?>">
                      <embed class="pdfobject" src="<?php //echo get_field('class_pdf_resource'); ?>" type="application/pdf" style="overflow: auto; width: 100%; height: 100%;">
                      </div>
                    </figure> -->



                    <!-- <h3>Class Video</h3>
                    <figure data-coblocks-align-support="1" id="block-29f34972-2d81-466b-a4f3-af90d1856a0c" tabindex="0" role="group" aria-label="Block: Video" data-block="29f34972-2d81-466b-a4f3-af90d1856a0c" data-type="core/video" data-title="Video" class="wp-block-video no-lazyload block-editor-block-list__block wp-block is-selected">
                      <div class="components-disabled css-idxg31-StyledWrapper e1ac3xxk0">
                        <video controls="" poster="" src="<?php //echo get_field('class_video'); ?>">
                        </video>
                      </div>
                      <figcaption role="textbox" aria-multiline="true" aria-label="Video caption text" class="block-editor-rich-text__editable rich-text" contenteditable="true" style="white-space: pre-wrap;">&#xFEFF;<span data-rich-text-placeholder="Write caption…" contenteditable="false"></span>
                      </figcaption>
                    </figure> -->



                  <!--  <h3>Class Slides</h3> -->
                    <!-- repeater field class_slides -->

                   <!--  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel"> -->
    <!-- <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">

                      <?php //while( have_rows('class_slides') ): the_row();
                         // $image = get_sub_field('slide_image');
                        ?>
                <div class="carousel-item ">-->
                           <!-- <li class="is-active orbit-slide"> -->

                               <?php //echo wp_get_attachment_image( $image, 'full' ); ?>
                              <!-- <figcaption class="orbit-caption"><?php //the_sub_field('caption'); ?></figcaption> -->

                     <!--   </div> -->

                      <?php //endwhile; ?>

                   <!-- </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
                     -->


<?php //if( have_rows('class_slides') ): ?>

<!-- <div style="text-align:center">
  <h2>Tabbed Image Gallery</h2>
  <p>Click on the images below:</p>
</div>
<div class="row " >
  <div class="col-sm-12 col-md-3">
    <div class="d-flex flex-column">
   <?php //while( have_rows('class_slides') ): the_row();
      //  $image = get_sub_field('slide_image');
    ?>
  <div class="col-sm-12">
     <figure class="orbit-figure ImgThumbnail" >
        <?php //echo wp_get_attachment_image( $image, 'full' ); ?>
        <figcaption class="orbit-caption"><?php //the_sub_field('caption'); ?></figcaption>
    </figure>
  </div>
<?php //endwhile; ?>
 </div>
  </div> -->
  <!-- <div class="col-sm-12 col-md-9" style="border:1px solid #333; position:relative">
    <div class="modal">-->
   <!--  <span class="close">×</span>  -->
    <!--<img class="modalImage" id="img01" src="">
    </div>
  </div>
</div>     -->            <!-- The grid: four columns -->

<?php //endif;  wp_reset_postdata();?>



<!-- The four columns -->
<!-- <div class="row">

  <div class="column"> -->
    <!-- <figure onclick="myFunction(this);">
      <?php //echo wp_get_attachment_image( $image, 'full' ); ?>
    </figure> -->
   <!--  <img src="<?php //echo get_stylesheet_directory_uri().'/dist/assets/images/sample-2.jpg';?>" alt="Nature" style="width:100%" onclick="myFunction(this);">
  </div>
   <div class="column"> -->
    <!-- <figure onclick="myFunction(this);">
      <?php //echo wp_get_attachment_image( $image, 'full' ); ?>
    </figure> -->
   <!--  <img src="<?php //echo get_stylesheet_directory_uri().'/dist/assets/images/sample-2.jpg';?>" alt="Nature" style="width:100%" onclick="myFunction(this);">
  </div>
  <div class="column"> -->
    <!-- <figure onclick="myFunction(this);">
      <?php //echo wp_get_attachment_image( $image, 'full' ); ?>
    </figure> -->
    <!-- <img src="<?php //echo get_stylesheet_directory_uri().'/dist/assets/images/sample-2.jpg';?>" alt="Nature" style="width:100%" onclick="myFunction(this);">
  </div> -->


<!-- </div> -->



<!-- The expanding image container -->
<!-- <div class="container">-->
  <!-- Close the image -->
  <!-- <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span> -->

  <!-- Expanded image -->
  <!-- <img id="expandedImg" style="width:100%"> -->

  <!-- Image text -->
  <!--<div id="imgtext"></div>
</div> -->
<!-- <img class="ImgThumbnail" src="https://images.pexels.com/photos/3635300/pexels-photo-3635300.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"/>
<img class="ImgThumbnail" src="https://i.picsum.photos/id/237/536/354.jpg"/>
<img class="ImgThumbnail" src="https://images.pexels.com/photos/3802510/pexels-photo-3802510.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"/> -->




            <?php //the_content(); ?>
            <?php //edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>

         </div>
        </article>
       <?php //endwhile;  ?>
    </main>
  </div>
</div>
