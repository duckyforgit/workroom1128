<?php
 
/**
 * Related Posts Widget
 *
 * Display the related posts from a selected category in a boxed layout.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Related Posts Widget Class
 */
class Related_Posts_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 *
	 * @uses WP_Widget::__construct() Create Widget
	 * @return void
	 */
	function __construct() {

		parent::__construct(
			'related-posts',  
			esc_html__( 'Related Posts (workroom1128)', 'workroom1128' ),  
			array(
				'classname' => 'related-posts',
				'description' => esc_html__( 'Displays related posts.', 'workroom1128' ),
				'customize_selective_refresh' => true,
			)  
		);

		// Delete Widget Cache on when saving or deleting a post. 
		//add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
	//	add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
	}

	/**
	 * Set default settings of the widget
	 *
	 * @return array Default widget settings.
	 */
	private function default_settings( $args = 'optional' ) {

		$defaults = array (
        'widget_title' => 'wp_parse_args() merges $args into $defaults',
        'before_widget'  => '<section id="%1$s" class="widget %2$s">', 
        'after_widget'   => '</section>',
        'thumbnails'    => TRUE,
        'echo' => FALSE
    );
 // Parse incoming $args into an array and merge it with $defaults
 //   $args = wp_parse_args( $args, $defaults );
     
 //   $output = $args['before_widget'] . $args['widget_title'] . $args['after_widget'];
     
  //  if (!$args['echo'])
  //      return $output;
     
  //  echo $output;
		return $defaults;
	}

	/**
	 * Reset widget cache object
	 *
	 * @return void
	 */
	public function delete_widget_cache() {

		wp_cache_delete( 'related-posts', 'widget' );

	}

	 

	/**
	 * Main Function to display the widget
	 *
	 * @uses this->render()
	 *
	 * @param array $args Parameters from widget area created with register_sidebar().
	 * @param array $instance Settings for this widget instance.
	 * @return void
	 */
	function widget( $args, $instance ) {

		$cache = array();

		// Get Widget Object Cache.
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'related-posts', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		// Display Widget from Cache if exists.
		if ( isset( $cache[ $this->id ] ) ) {
			echo $cache[ $this->id ];
			return;
		}

		// Start Output Buffering.
		ob_start();

		// Get Widget Settings.
		//$settings = wp_parse_args( $instance, $this->default_settings() );
		extract( $args );
		// Add Widget Title Filter.
		$widget_title = apply_filters( 'widget_title', empty( $instance['widget_title'] ) ? '' : $instance['widget_title'], $instance, $this->id_base );

		// Output.
		echo $args['before_widget'];  

		// Display Title.
		if ( ! empty( $widget_title ) ) { echo $args['before_title'] . $widget_title . $args['after_title']; };  ?> 

		<div class="content">

			<!-- <ul class="posts-list"> -->
				<?php echo $this->render( ); ?>
		<!-- 	</ul> -->

		</div>

		<?php
		echo $args['after_widget'];

		// Set Cache.
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'related-posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * Display the post list
	 *
	 * @param array $settings Settings for this widget instance.
	 * @return void
	 */
	function render( ) {
 

$postID = get_the_ID();
 


		$related = get_posts( 
			array( 'category__in' => wp_get_post_categories($postID), 
				'numberposts' => 5, 
				'post__not_in' => array($postID) 
			));

	//	$cat = wp_get_post_categories($postID);

		if( $related ) foreach ( $related as $post ) {
			setup_postdata($post);  ?>
			<ul class="no-bullet"> 
        <li>         
     			<a href="<?php the_permalink() ?>" title="<?php echo $post->post_title ?>">						 
						</a>
		        <span class="media-object align-center-middle">
			        <span class="media-object-section">
			            <span class=" ">
			            	 <?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
			            <?php //the_post_thumbnail('thumbnail'); ?> 
			            </span>
			        </span>
			        <span class="media-object-section main-section">
			          <h2 class="entry-title"><?php echo $post->post_title ?> </h2>
			        <!--  <p class="meta-date meta-date"><?php //the_time( get_option( 'date_format' ) ); ?></p> -->
			        </span>
		      	</span>
    			</a>
        </li>
    	</ul>   
<?php }
wp_reset_postdata();  
 
	}

 
	/**
	 * Update Widget Settings
	 *
	 * @param array $new_instance Form Input for this widget instance.
	 * @param array $old_instance Old Settings for this widget instance.
	 * @return array $instance New widget settings
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['widget_title'] = sanitize_text_field( $new_instance['widget_title'] );
		//$instance['category'] = (int) $new_instance['category'];
		//$instance['order'] = esc_attr( $new_instance['order'] );
	//	$instance['number'] = (int) $new_instance['number'];
		 
		//$instance['thumbnails'] = ! empty( $new_instance['thumbnails'] );
	 

		//$this->delete_widget_cache();

		return $instance;
	}

	/**
	 * Display Widget Settings Form in the Backend
	 *
	 * @param array $instance Settings for this widget instance.
	 * @return void
	 */
	function form( $instance ) {

		// Get Widget Settings.
	//$settings = wp_parse_args( $instance, $this->default_settings() );
	 
		 $instance = wp_parse_args( (array) $instance, 
  array(  'widget_title' => '' 
           
                   
           ) );
    $filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
    $widget_title = sanitize_text_field( $instance['widget_title'] );

     
     
    ?>

		<p>
      <label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php esc_html_e( 'Title:', 'workroom1128' ); ?>
        <input class="widefat" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
      </label>
    </p> 

		<?php
	}
}
