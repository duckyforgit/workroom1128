<?php
/**
 * Tabbed Content Widget
 *
 * Display the latest posts from a selected category in a boxed layout.
 *
 * @package workroom1128
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tabbed Content Widget Class
 */
class Tabbed_Content_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 *
	 * @uses WP_Widget::__construct() Create Widget
	 * @return void
	 */
	function __construct() {

		parent::__construct(
			'tabbed-content', // ID.
			esc_html__( 'Tabbed Content (workroom1128)', 'workroom1128' ), // Name.
			array(
				'classname' => 'tabbed-content',
				'description' => esc_html__( 'Displays various content with tabs.', 'workroom1128' ),
				'customize_selective_refresh' => true,
			) // Args.

		);

		// Enqueue Javascript for Tabs.
		 
		//if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
		//	add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		//}

		// Delete Widget Cache on certain actions.
		add_action( 'save_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'delete_widget_cache' ) );
		add_action( 'comment_post', array( $this, 'delete_widget_cache' ) );
		add_action( 'transition_comment_status', array( $this, 'delete_widget_cache' ) );
	}

	/**
	 * Set default settings of the widget
	 *
	 * @return array Default widget settings.
	 */
	private function default_settings() {

		$defaults = array(
			'title'       => '',
			'number'      => 5,
			'thumbnails'  => true,
			'tab_titles'  => array( '', '', '', '' ),
			'tab_content' => array( 0, 0, 0, 0 ),
		);

		return $defaults;
	}

	/**
	 * Reset widget cache object
	 *
	 * @return void
	 */
	public function delete_widget_cache() {

		wp_cache_delete( 'up_tabbed_content', 'widget' );

	}

	/**
	 * Enqueue jquery tabs javascript
	 *
	 * @see https://codex.wordpress.org/Function_Reference/wp_enqueue_script WordPress Codex.
	 * @return void
	 */
	public function enqueue_scripts() {

	//	wp_enqueue_script( 'tabbed-content', workroom1128_PLUGIN_URL . '/assets/js/tabbed-content.js', array( 'jquery' ), workroom1128_VERSION );

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

		// Start Output Buffering.
		ob_start();

		// Get Widget Settings.
		$settings = wp_parse_args( $instance, $this->default_settings() );

		// Add Widget Title Filter.
		$widget_title = apply_filters( 'widget_title', $settings['title'], $settings, $this->id_base );

		// Output.
		echo $args['before_widget'];

		// Display Title.
		if ( ! empty( $widget_title ) ) { echo $args['before_title'] . $widget_title . $args['after_title']; }; ?>

		<div class="content clearfix">

			<?php echo $this->render( $args, $settings ); ?>

		</div>

		<?php
		echo $args['after_widget'];

		// Set Cache.
		if ( ! $this->is_preview() ) {
			$cache[ $this->id ] = ob_get_flush();
			wp_cache_set( 'tabbed_content', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * Display the tab navigation
	 *
	 * @uses this->tab_content() to display content of tabs.
	 * @param array $args Parameters from widget area created with register_sidebar().
	 * @param array $settings Settings for this widget instance.
	 * @return void
	 */
	function render( $args, $settings ) {
		?>
<div class="sidebar-wrapper ">
  
   <ul class="nav nav-tabs" id="tabbed-posts"  >
   	<?php // Display Tab Titles.
			 	for ( $i = 0; $i <= 3; $i++ ) :

					// Do not display empty tabs.
			 	if ( '' === $settings['tab_titles'][ $i ] and 0 === $settings['tab_content'][ $i ] ) {
					 	continue;
			 	}       
					?>
	<?php  if ( $i == 0 ) { ?> <!-- is active -->
  <li class="nav-item" role="presentation">
   <button class="nav-link active" id="<?php echo $args['widget_id']; ?>-tab-<?php echo $i; ?>" data-bs-toggle="tab" data-bs-target="#<?php echo $args['widget_id']; ?>-tabbed-<?php echo $i; ?>" type="button" role="tab" ><?php echo esc_html( $settings['tab_titles'][ $i ] ); ?></button>  
     
  </li>
<?php } else { ?>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="<?php echo $args['widget_id']; ?>-tab-<?php echo $i; ?>" data-bs-toggle="tab" data-bs-target="#<?php echo $args['widget_id']; ?>-tabbed-<?php echo $i; ?>" type="button" role="tab" ><?php echo esc_html( $settings['tab_titles'][ $i ] ); ?></button>
  </li>
 <?php	} ?>
		<?php	endfor;	 ?>  
</ul>
 
		
<div class="tab-content" id="tabbed-posts">
	<?php
		// Display Tab Content.
		for ( $i = 0; $i <= 3; $i++ ) : ?>
			<?php if ( $i == 0 ) { ?> 
  			<div class="tab-pane fade show active" id="<?php echo $args['widget_id']; ?>-tabbed-<?php echo $i; ?>" role="tabpanel" aria-labelledby="<?php echo $args['widget_id']; ?>-tab-<?php echo $i; ?>"><?php echo $this->tab_content( $settings, $settings['tab_content'][ $i ] ); ?>
  			</div>
  		 <?php } else { ?>
  			<div class="tab-pane fade" id="<?php echo $args['widget_id']; ?>-tabbed-<?php echo $i; ?>" role="tabpanel" aria-labelledby="<?php echo $args['widget_id']; ?>-tab-<?php echo $i; ?>"><?php echo $this->tab_content( $settings, $settings['tab_content'][ $i ] ); ?>
  			</div>
  		<?php	} ?>
  <?php	endfor;	 ?>
</div>
</div>
  
<?php   }  

	/**
	 * Display the tab content
	 *
	 * @param array   $settings Settings for this widget instance.
	 * @param integer $tabcontent Tab ID to select which tab is displayed.
	 * @return void
	 */
	function tab_content( $settings, $tabcontent ) {

		switch ( $tabcontent ) :

			 // Archives.
			case 1: ?>

				<ul class="tabcontent-archives list-unstyled mt-3">
					<?php wp_get_archives( array( 'type' => 'yearly', 'show_post_count' => 1 ) ); ?>
				</ul>

			<?php
			break;
			// Categories.
			case 2:  
			wp_reset_postdata(); 

			?>

				<ul class="tabcontent-categories list-unstyled mt-3">
			<?php $categories = get_categories( array(
			    'orderby' => 'name',
			    'order'   => 'ASC'
			) );
 // foreach( $categories as $category ) {
 //      $category_link = sprintf( 
 //          '<a href="%1$s" alt="%2$s">%3$s</a>',
 //          esc_url( get_category_link( $category->term_id ) ),
 //          esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
 //          esc_html( $category->name )
 //      );

 //      echo '<p>' . sprintf( esc_html__( '%s', 'textdomain' ), $category_link ) . '</p> ';
 //  }

  foreach( $categories as $category ) {
    $category_link = sprintf( 
        '<a href="%1$s" alt="%2$s">%3$s</a>',
        esc_url( get_category_link( $category->term_id ) ),
        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
        esc_html( $category->name )
    );
     
    echo '<li>' . sprintf( esc_html__( '%s', 'textdomain' ), $category_link ) . '<span class="count">(';
    //echo '<p>' . sprintf( esc_html__( 'Description: %s', 'textdomain' ), $category->description ) . '</p>';
    echo '' . sprintf( esc_html__( '%s', 'textdomain' ), $category->count ) . ')</span></li>';
} 
				// foreach( $categories as $category ) {
				//     $category_link = sprintf( 
				//         '<a href="%1$s" alt="%2$s" class="%3$s">',
				//         esc_url( get_category_link( $category->term_id ) ),
				//         esc_attr( sprintf( __( 'View all posts in %s', 'workroom1128' ), $category->name ) ),
				//         esc_attr( sprintf( __( '%s', 'workroom1128' ), 'tabcontent-categories-style' ) )
				//        // esc_html( $category->name )
				//     );
				//     //$category_name =  esc_html( $category->name );
				     
				//     echo '<li>' . sprintf( esc_html__( '%s', 'workroom1128' ), $category_link ) ;
		 	// 			echo '<span>' . sprintf( esc_html__( '%s', 'workroom1128' ), $category->name ) . '</span>';
				//     echo '<span>&nbsp;(' . sprintf( esc_html__( '%s', 'workroom1128' ), $category->count ) . ')</span></li>';
				// } 
					 // wp_list_categories( array( 'title_li' => '', 'orderby' => 'name', 'show_count' => 1, 'hierarchical' => false ) ); ?>
				<!-- 	<i class="far fa-folder"></i> -->
				</ul>

			<?php
			break;

			// Pages.
			case 3: 
			wp_reset_postdata(); 

			?>

				<ul class="tabcontent-pages list-unstyled mt-3">
					<?php wp_list_pages( array( 'title_li' => '' ) ); ?>
				</ul>

			<?php
			break;

			// Popular Posts.
			case 4:
			wp_reset_postdata(); 
				// Get latest popular posts from database.
				$query_arguments = array(
					'posts_per_page' => (int) $settings['number'],
					'ignore_sticky_posts' => true,
					'orderby' => 'comment_count',
				);
				$posts_query = new WP_Query( $query_arguments );
			?>

				<ul class="tabcontent-popular-posts posts-list list-unstyled mt-3">

					<?php // Display Posts.
					if ( $posts_query->have_posts() ) : while ( $posts_query->have_posts() ) : $posts_query->the_post();

							if ( true == $settings['thumbnails'] and has_post_thumbnail() ) : ?>

									<li class="has-thumbnail">
										<a href="<?php esc_url( the_permalink() ) ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
											<?php the_post_thumbnail( 'sidebar-img' ); ?>
										</a>

								<?php else : ?>

							<li>

						<?php endif; ?>

							<a href="<?php esc_url( the_permalink() ) ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
								<?php if ( get_the_title() ) { the_title(); } else { the_ID();} ?>
							</a>

							<div class="entry-meta entry-meta">

							<?php // Display Date only on posts with thumbnails.
							if ( true == $settings['thumbnails'] and has_post_thumbnail() ) : ?>

								<span class="meta-date meta-date"><?php the_time( get_option( 'date_format' ) ); ?></span>

							<?php endif; ?>

							</div>

					<?php endwhile;
					endif; ?>

				</ul>

			<?php
			break;

			// Recent Comments.
			case 5:

				// Get latest comments from database.
				$comments = get_comments( array(
					'number' => (int) $settings['number'],
					'status' => 'approve',
					'post_status' => 'publish',
				) );
			?>

				<ul class="tabcontent-comments comments-list list-unstyled mt-3">

					<?php // Display Comments.
					if ( $comments ) :
						foreach ( (array) $comments as $comment ) :

							 // Display Gravatar.
							if ( true == $settings['sidebar-img'] ) : ?>

								<li class="has-avatar">
									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<?php echo get_avatar( $comment, 55 ); ?>
									</a>

									<?php else : ?>

									

									<?php endif;

									echo get_comment_author_link( $comment->comment_ID );
									esc_html_e( ' on', 'workroom1128' ); ?>

									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<?php echo get_the_title( $comment->comment_post_ID ); ?>
									</a>
								</li>
					<?php endforeach;
					endif; ?>

				</ul>

			<?php
			break;

			// Recent Posts.
			case 6:
			
				wp_reset_postdata(); 
				// Get latest posts from database.
				$query_arguments = array(
					'posts_per_page' => (int) $settings['number'],
					'ignore_sticky_posts' => true,
				);
				$posts_query = new WP_Query( $query_arguments );
				?>

				<ul class="tabcontent-recent-posts tabbed-list list-unstyled mt-3">

					<?php
					// Display Posts.
					if ( $posts_query->have_posts() ) : while ( $posts_query->have_posts() ) : $posts_query->the_post();

					?>	
							<li class="mt-3">
								<span class="media-object">
							<?php  if ( true == $settings['thumbnails'] and has_post_thumbnail() ) : ?>
									
										<span class="media-object-section ">
										
												<?php echo get_the_post_thumbnail('sidebar-img'); ?>						 
														
										</span>
							<?php endif; ?>
										<span class="media-object-section main-section d-inline-flex flex-column justify-content-around">
										<a href="<?php esc_url( the_permalink() ) ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
												<?php if ( get_the_title() ) { the_title(); } else { the_ID();} ?>
											</a>
												
												<?php $time = get_the_time('F j, Y', get_the_ID()); ?>
											<p class="meta-date meta-date">&nbsp;<?php echo $time; //$post->the_time( get_option( 'date_format' ) ); ?></p>
										
										
											 
										</span>
									</span> 
							
							</li>
				 
					<?php endwhile; endif; ?>

				</ul>

			<?php
			break;

			// Tag Cloud.
			case 7: ?>
			<?php // set largest tag to equal smallest at 8 ?>
				<ul class="tabcontent-categories tabcontent-related-posts tabbed-list list-unstyled mt-3">
					<li class="tagcloud"><?php wp_tag_cloud( array( 'largest' => 8, 'taxonomy' => 'post_tag' ) ); ?></li>
			 	</ul> 

			<?php
			break;

			// Related Posts
			case 8: ?>
					<?php $postID = get_the_ID();
  

						//	$link2 = get_permalink();


					$related = get_posts( 
						array( 'category__in' => wp_get_post_categories($postID), 
							'numberposts' => (int) $settings['number'],				 
							'post__not_in' => array($postID) 
						)); ?>
						<ul class="tabcontent-related-posts tabbed-list list-unstyled mt-3">
					<?php if( $related ) foreach ( $related as $post ) {
						setup_postdata($post);  
					?>
						

							<li class="mt-3">
								<span class="media-object">
							<?php  if ( true == $settings['thumbnails'] and has_post_thumbnail() ) : ?>
									
										<span class="media-object-section ">
										
												<?php echo get_the_post_thumbnail($post->ID, 'sidebar-img'); ?>						 
														
										</span>
							<?php endif; ?>
										<span class="media-object-section main-section d-inline-flex flex-column justify-content-between">
											<a href="<?php echo esc_url(the_permalink( $post )) ?>"  title="<?php echo $post->post_title; ?>">
													<?php echo $post->post_title; ?> </a>
												
												<?php $time = get_the_time('F j, Y', $post->ID); ?>
											<p class="meta-date meta-date">&nbsp;<?php echo $time; //$post->the_time( get_option( 'date_format' ) ); ?></p>
						
										</span>
									</span> 
							
							</li>

						  
			<?php }
				wp_reset_postdata();  ?>
				</ul> 
				<?php
		break; 
			// No Content selected.
			default: ?>
             
				<p class="tabcontent-missing">
					<?php esc_html_e( 'Please select the Tab Content in the Widget Settings.', 'workroom1128' ); ?>
				</p>

			<?php
			break;

		endswitch;
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
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['thumbnails'] = ! empty( $new_instance['thumbnails'] );

		// Validate Tab Settings.
		$instance['tab_content'] = array();
		$instance['tab_titles'] = array();

		for ( $i = 0; $i <= 3; $i++ ) :

			$instance['tab_content'][ $i ] = (int) $new_instance[ 'tab_content-' . $i ];
			$instance['tab_titles'][ $i ] = sanitize_text_field( $new_instance[ 'tab_titles-' . $i ] );

		endfor;

		$this->delete_widget_cache();

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
		$settings = wp_parse_args( $instance, $this->default_settings() );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'workroom1128' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $settings['title'] ); ?>" />
			</label>
		</p>

		<div style="background: #fafafa; border-top: 1px solid #eaeaea; margin-bottom: 20px;">

		<?php
		// Display Tab Options.
		for ( $i = 0; $i <= 3; $i++ ) : ?>

			<p style="border-bottom: 1px solid #eaeaea; padding: 10px; margin: 0;">

				<label style="display: inline-block; min-width: 50px" for="<?php echo $this->get_field_id( 'tab_content-' . $i ); ?>">
					<?php printf( esc_html__( 'Tab %s:', 'workroom1128' ), $i + 1 ); ?>
				</label>

				<select id="<?php echo $this->get_field_id( 'tab_content-' . $i ); ?>" name="<?php echo $this->get_field_name( 'tab_content-' . $i ); ?>">
					<option value="0" <?php selected( $settings['tab_content'][ $i ], 0 ); ?>></option>
					<option value="1" <?php selected( $settings['tab_content'][ $i ], 1 ); ?>><?php esc_html_e( 'Archives', 'workroom1128' ); ?></option>
					<option value="2" <?php selected( $settings['tab_content'][ $i ], 2 ); ?>><?php esc_html_e( 'Categories', 'workroom1128' ); ?></option>
					<option value="3" <?php selected( $settings['tab_content'][ $i ], 3 ); ?>><?php esc_html_e( 'Pages', 'workroom1128' ); ?></option>
					<option value="4" <?php selected( $settings['tab_content'][ $i ], 4 ); ?>><?php esc_html_e( 'Popular Posts', 'workroom1128' ); ?></option>
					<option value="5" <?php selected( $settings['tab_content'][ $i ], 5 ); ?>><?php esc_html_e( 'Recent Comments', 'workroom1128' ); ?></option>
					<option value="6" <?php selected( $settings['tab_content'][ $i ], 6 ); ?>><?php esc_html_e( 'Recent Posts', 'workroom1128' ); ?></option>
					<option value="7" <?php selected( $settings['tab_content'][ $i ], 7 ); ?>><?php esc_html_e( 'Tag Cloud', 'workroom1128' ); ?></option>
					<option value="8" <?php selected( $settings['tab_content'][ $i ], 8 ); ?>><?php esc_html_e( 'Related Posts', 'workroom1128' ); ?></option>
				</select>

				<br/>

				<label style="display: inline-block; min-width: 50px" for="<?php echo $this->get_field_id( 'tab_titles-' . $i ); ?>">
					<?php esc_html_e( 'Title:', 'workroom1128' ); ?>
				</label>

				<input style="width: auto" id="<?php echo $this->get_field_id( 'tab_titles-' . $i ); ?>" name="<?php echo $this->get_field_name( 'tab_titles-' . $i ); ?>" type="text" value="<?php echo esc_attr( $settings['tab_titles'][ $i ] ); ?>" />

			</p>

		<?php endfor; ?>

		</div>

		<strong><?php esc_html_e( 'Settings for Recent/Popular/Related Posts and Recent Comments', 'workroom1128' ); ?></strong>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of entries:', 'workroom1128' ); ?>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint( $settings['number'] ); ?>" size="3" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnails' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $settings['thumbnails'] ); ?> id="<?php echo $this->get_field_id( 'thumbnails' ); ?>" name="<?php echo $this->get_field_name( 'thumbnails' ); ?>" />
				<?php esc_html_e( 'Show Thumbnails?', 'workroom1128' ); ?>
			</label>
		</p>

		<?php
	}
}
