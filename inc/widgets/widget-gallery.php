<?php 
/**
 * workroom1128 Widget Gallery
 *
 * Display the gallery on the gallery section of the front page
 *
 * @package workroom1128
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
} 
if ( ! class_exists( 'workroom1128_Widget_Gallery' ) ) {

    class workroom1128_Widget_Gallery extends WP_Widget {
  /**
   * Widget Constructor
   *
   * @uses WP_Widget::__construct() Create Widget
   * @return void
   */
  
  public function __construct() {

    parent::__construct(
      'example',  
      esc_html__( 'workroom1128 Widget Gallery', 'workroom1128' ),  
      array(
        'classname' => 'workroom1128-widget-gallery',
        'description' => esc_html__( 'Displays Gallery of Posts in On Focus area of Home Page.', 'workroom1128' ),
        'customize_selective_refresh' => true,
      )  
    );
    
    // Delete Widget Cache on when saving or deleting a post. 
   // add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
   // add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
   add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
  }

   

  /**
   * Reset widget cache object
   *
   * @return void
   */
  public function delete_widget_cache() {

    wp_cache_delete( 'workroom1128-widget-gallery', 'widget' );

  }
  public function parse_my_args( $args = 'optional' ) {
     $defaults = array (
          'widget_title' => 'wp_parse_args() merges $args into $defaults',
          'before_widget'  => '<section id="%1$s" class="widget %2$s">', 
          'after_widget'   => '</section>',
          'echo' => FALSE
      );
       
      // Parse incoming $args into an array and merge it with $defaults
      $args = wp_parse_args( $args, $defaults );
       
      $output = $args['before_widget'] . $args['widget_title'] . $args['after_widget'];
       
      if (!$args['echo'])
          return $output;
       
      echo $output;
  }
   

  /**
   * Main Function to display the widget
   *
   * @uses this->render()
   *
   * @param array $args Parameters from widget area on front page.
   * @param array $instance Settings for this widget instance.
   * @return void
   */
  public function widget( $args, $instance ) {

    $cache = array();

    // Get Widget Object Cache.
   if ( ! $this->is_preview() ) {
     $cache = wp_cache_get( 'workroom1128-widget-gallery', 'widget' );
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
  
    extract( $args );  
   
  $widget_title = apply_filters( 'widget_title', empty( $instance['widget_title'] ) ? '' : $instance['widget_title'], $instance, $this->id_base );
 
  $Example_1  = ! empty( $instance['Example_1']) ? $instance['Example_1'] : '';
  $Example_2  = ! empty( $instance['Example_2']) ? $instance['Example_2'] : '';
  $Example_3  = ! empty( $instance['Example_3']) ? $instance['Example_3'] : '';
   
  // Output.
  echo $args['before_widget'];

  
     // Display Title.
  if ( ! empty( $widget_title ) ) { echo $args['before_title'] . $widget_title . $args['after_title']; };  
  
?>
      <ol class="workroom1128-widget-gallery">
        
        <li>
          <?php if ( $Example_1 ) { 
            echo $Example_1; }  ?>              
        </li>
        <li>
           <?php if ( $Example_2 ) { 
            echo $Example_2; }  ?>              
        </li>    
        <li><?php if ( $Example_3 ) {
          echo $Example_3; }  ?>
        </li>            
         
      </ol>
      


    <?php
    echo $args['after_widget'];

    // Set Cache.
    if ( ! $this->is_preview() ) {
      $cache[ $this->id ] = ob_get_flush();
      wp_cache_set( 'workroom1128-widget-gallery', $cache, 'widget' );
    } else {
      ob_end_flush();
    }
 
 }
 
  

  /**
   * Update Widget Settings
   *
   * @param array $new_instance Form Input for this widget instance.
   * @param array $old_instance Old Settings for this widget instance.
   * @return array $instance New widget settings
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
  
    $instance['widget_title'] = sanitize_text_field( $new_instance['widget_title'] );
         

    $instance['Example_1'] = sanitize_text_field($new_instance['Example_1']);
    $instance['Example_2'] = sanitize_text_field($new_instance['Example_2']);
    $instance['Example_3'] = sanitize_text_field($new_instance['Example_3']); 
    

    //$this->delete_widget_cache();

    return $instance;
  }

  /**
   * Display Widget Settings Form in the Backend
   *
   * @param array $instance Settings for this widget instance.
   * @return void
   */
  public function form( $instance ) {

    // Get Widget Settings.
   $instance = wp_parse_args( (array) $instance, 
  array(  'widget_title' => '', 
          'Example_1'  => '',
          'Example_2'  => '',
          'Example_3'  => ''
                   
           ) );
    $filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
    $widget_title = sanitize_text_field( $instance['widget_title'] );

     $Example_1 = sanitize_text_field($instance['Example_1']);
     $Example_2 = sanitize_text_field($instance['Example_2']);
     $Example_3 = sanitize_text_field($instance['Example_3']);
     
    ?>
<?php /* removed rows="16" cols="20" */ ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'widget_title' ); ?>"><?php esc_html_e( 'Title:', 'workroom1128' ); ?>
        <input class="widefat" id="<?php echo $this->get_field_id( 'widget_title' ); ?>" name="<?php echo $this->get_field_name( 'widget_title' ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('Example_1'); ?>"><?php esc_html_e('Enter line 1', 'workroom1128'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('Example_1'); ?>" name="<?php echo $this->get_field_name('Example_1'); ?>" type="text" value="<?php echo $Example_1; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('Example_2'); ?>"><?php esc_html_e('Enter line 1', 'workroom1128'); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id('Example_2'); ?>" name="<?php echo $this->get_field_name('Example_2'); ?>" type="text" value="<?php echo $Example_2; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('Example_3'); ?>"><?php esc_html_e('Enter line 1', 'workroom1128'); ?></label> 
      <input class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('Example_3'); ?>" name="<?php echo $this->get_field_name('Example_3'); ?>" type="text" value="<?php echo $Example_3; ?>" />
    </p> 
    <?php
  }
 
 } 
 
} // end of class  registered in widget-areas.php 
