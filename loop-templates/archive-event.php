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
  
<?php 
		$students = get_posts(array(
			'post_type' => 'student',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'course', // name of custom field
					'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
					'compare' => 'LIKE'
				)
			)
		));

		?>
	<?php $total = intval(get_field('course_total_seats'));
	$registered = count($students);
	$avail = $total - $registered;
  $course_instructor = get_field( 'course_instructor' ); 

		 		?>
  <li class="col">
  		
    <div class="card course-card align-items-center ">

    	<div class="card-img">
    		<?php the_post_thumbnail('course-image', array('class' => 'card-img-top ', 'class' =>'course-card--img-top')); ?>
    	</div>
    	 
      <div class="card-body course-card--body d-flex flex-column">
      	<div class="course-card--wrap" style="position:relative"> 
        	<h2 class="card-title course-card--title"><?php the_title();?></h2>
        	<a href="<?php the_permalink(); ?>" class="stretched-link"></a> 
        </div>
        	
      	
      	<?php if ( $course_instructor ) : ?>
						<?php foreach ( $course_instructor as $post ) : ?>
							<?php setup_postdata ( $post ); ?>
							<div style="position:relative">
							<h3 class="course-card--instructor text-muted"><a href="<?php the_permalink(); ?>" style="transform:scale(1.5,1.5);"><?php the_title(); ?></a></h3>
						</div>
						<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>

      	 
      	<div class="relative" style="position:relative">
      		<a href="<?php the_permalink(); ?>" class="stretched-link"></a> 
        <p class="card-text course-card--text"><?php the_field( 'course_description' ); ?></p>
        <ul class="course-card--meta">
 
					<?php $duration_time = '';$duration_number ='';

					  if ( have_rows( 'course_duration_group' ) ) :
						 while ( have_rows( 'course_duration_group' ) ) : the_row();
							  $duration_time = get_sub_field( 'duration_time' );  
					 			$duration_number = intval(get_sub_field( 'duration_number' ));
						  endwhile;  
					 endif;  
					 $price = get_field( 'course_price' );
					 $certificate ='';
					 $cert = get_field('course_certificate');
  
						/*
						*  Query posts for a relationship value.
						*  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
						*/?> 
        	<li><span class="duration"> <?php echo $duration_number .'&nbsp;'. $duration_time;?> </span>
						<span class="classes">  <?php the_field( 'total_classes' ); ?> Classes</span>
						<span class="level"> <?php the_field( 'course_level' ); ?> Level</span>
						<span class="seats"> <?php echo $avail; ?> Seats Available </span>
						<?php if ($cert == 'yes') { ?>
						<span class="certificate"> <?php echo $cert; ?>Certificate</span>
					<?php } ?>

					</li>
				</ul>
				<?php if ( $price )  { ?>
					<h3 class="card-title course-card--title">Price: $<?php the_field('course_price');  ?></h3>
				<?php } ?>
			</div>
    </div>
  </div>
   
  </li> 
