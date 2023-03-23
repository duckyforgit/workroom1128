<?php
/**
 * Template Name: Elearning Dashboard Page
 *
 * This template overrides the default template and sidebar setup
 *
 * @package __workroom1128_WP_Biz
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper vh-60" id="page-wrapper">

	<div class="container" id="content" tabindex="-1">

		<main class="site-main" id="main">
		<?php
		if ( is_user_logged_in() ) :
			$data = get_userdata( get_current_user_id() );

			if ( is_object( $data ) ) {
				$current_user_caps = $data->allcaps;

				// Print it to the screen.
				// You can use echo '<pre>' . print_r( $current_user_caps, true ) . '</pre>';.
			}
			?>
			<?php
			while ( have_posts() ) :
				the_post();
				// Print the incoming post for page print_r( $post ); // Dashboard post only.
				?>

				<div class="d-flex" id="wrapper">

					<div id="page-content-wrapper">
						<!-- Page content-->

							<div id="workroom1128-profile" class="workroom1128-user-profile d-flex flex-column">
								<?php
								$currentuser = wp_get_current_user();
								if ( $currentuser ) :
									// Use this commented out code  to get $userid = $currentuser->user_id;.
									$currentuserid = $currentuser->ID;
									$user_info     = get_userdata( $currentuserid );
									// Use this to comment out the code for username $username = $user_info->user_login;.
									$first_name = $user_info->first_name;
									// Use this commented out code for lastname $last_name = $user_info->last_name;.
									$user_id = 'user_' . $currentuserid;
								else :
									echo '<h2>You are not logged in.</h2>';
									return;
								endif;
								?>

								<div class="workroom1128-user-profile-username">
									<h2>Welcome  <?php echo esc_html( $first_name ); ?>!</h2>
								</div>

							</div>

							<div class="mt-5">
								<h3>My Courses</h3>
								<?php
								// Check if the repeater field has rows of data.

								if ( have_rows( 'registration_repeater', $user_id ) ) :

									// Loop through the rows of data.
									while ( have_rows( 'registration_repeater', $user_id ) ) :
										the_row();
										// Display relationship subfield.
										$course_posts = get_sub_field( 'course' );

										if ( $course_posts ) :
											$postid = get_sub_field( 'post_id' );
											?>
										<ul class="list-unstyled mt-3">
											<?php
											foreach ( $course_posts as $post ) :// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

												// Setup this post for WP functions (variable must be named $post).
												setup_postdata( $post );
												$postid = get_sub_field( 'post_id' );
												?>
												<li><i class="fas fa-book-reader pe-1"></i>
													<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php esc_html( the_title() ); ?>
													</a>
												</li><?php // Is 7851 on live site. ?>
											<?php endforeach; ?>
										</ul>
											<?php
											// Reset the global post object so that the rest.
											// Of the page works correctly.
											wp_reset_postdata();
										endif;

									endwhile;

								else :
									// no rows found.
									?>
									<h2>You must purchase a course to view this page.</h2>
									<a class="wp-post-link" href="<?php esc_url( home_url( 'offers/life-skills-course/' ) ); ?>" title="" rel="bookmark" ><h3 class="h4 mt-5">View more about our Life Skills Course: Overcoming Career Constraints</h3></a>
									<?php
								endif;
								?>
							</div>

					</div>

				</div>
			<?php endwhile; ?>
		<?php endif; ?>
		</main><!-- #main -->

	</div><!-- #content -->

</div> <!-- #page-wrapper -->
<?php
get_footer();
