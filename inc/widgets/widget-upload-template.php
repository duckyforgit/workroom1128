 <?php
 
/**
 * Upload Widget
 *
 * Upload files in widget
 *
 * @package workroom1128
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
class Upload_Assets_Widget extends WP_Widget { // setup the widget name, description etc.
 

 public function __construct() 
{ 
  parent::__construct(
      'upload_assets',  
      esc_html__( 'Media Upload (workroom1128)', 'workroom1128' ),  
      array(
        'classname' => 'upload_assets',
        'description' => esc_html__( 'Uploads media.', 'workroom1128' ),
        'customize_selective_refresh' => true,
      )        
    );
   

   add_action( 'admin_enqueue_scripts', array( $this, 'upload_assets' ) );
   add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
}

   function upload_assets()
{
    if(function_exists( 'wp_enqueue_media' )){
        wp_enqueue_media();
    }else{
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }
  //  wp_enqueue_script('upload_assets', get_template_directory_uri() . '/inc/widgets/upload-assets.js', false, '1.0.0', true);
    
} 
  /**
   * Reset widget cache object
   *
   * @return void
   */
  public function delete_widget_cache() {

    wp_cache_delete( 'up_tabbed_content', 'widget' );

  }

  // front-end display of widget
  function widget( $args, $instance ) {
      $cache = array();

    // Get Widget Object Cache.
    if ( ! $this->is_preview() ) {
      $cache = wp_cache_get( 'up_tabbed_content', 'widget' );
    }
    if ( ! is_array( $cache ) ) {
      $cache = array();
    }

    // Display Widget from Cache if exists.
    if ( isset( $cache[ $this->id ] ) ) {
      echo $cache[ $this->id ];
      return;
    }

    extract( $args );
    echo $args['before_widget'];

    if ( ! empty( $instance['image_url'] ) ) {
      $alt = get_post_meta( attachment_url_to_postid($instance['image_url']), '_wp_attachment_image_alt', true );
      ?>
        <img src="<?php echo esc_url( $instance['image_url'] ); ?>" class="widget-about-img" alt="<?php echo esc_attr( $alt ); ?>">
      <?php
    }


    echo $args['after_widget'];
  }


  // back-end display of widget
  function form( $instance ) {

    $instance = wp_parse_args(
      (array) $instance,
      array(
        'image_url' => '',
      )
    );

    $image = ( ! empty( $instance['image_url'] ) ? $instance['image_url'] : '' );

    ?>  


      <!-- Image -->
      <h4><?php esc_attr_e( "Choose your image", 'lami' ); ?></h4>
      <p>        
        <img class="deo-image-media" src="<?php echo esc_url( $image ); ?>" style="display: block; width: 100%;" />
      </p>
      <p>
        <input type="text" class="deo-image-hidden-input widefat" name="<?php echo $this->get_field_name( 'image_url' ); ?>" id="<?php echo $this->get_field_id( 'image_url' ); ?>" value="<?php echo esc_url( $image ); ?>" />
        <input type="button" class="deo-image-upload-button button button-primary" value="<?php esc_attr_e('Choose Image','lami')?>">
        <input type="button" class="deo-image-delete-button button" value="<?php esc_attr_e('Remove Image', 'lami') ?>">
      </p>


    <?php
  }


  // update of the widget
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['image_url'] = ( ! empty( $new_instance['image_url'] ) ) ? strip_tags( $new_instance['image_url'] ) : '';
  }

}


 