<?php
/**
 * Template Name: Course Learning Page
 *
 * This template overrides the default template and sidebar setup
 *
 * @package __workroom1128_WP_Biz
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('__workroom1128_wp_biz_container_type');
?> 
<?php
//if (!is_user_logged_in()) {
      // Redirect people without access to login page
          //wp_redirect(  wp_login_url());
        //   auth_redirect();
//} else {
    ?>
    
 
  <div class="wrapper" id="page-wrapper">  

    <div class="container-fluid" id="content" tabindex="-1">

         
            
        <!--    <main class="site-main" id="main">
 -->
        <?php
        while (have_posts()) :
            the_post(); ?>
                    
                    <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white box-shadow--sidebar" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">
                    
                    <div id="workroom1128-profile" class="workroom1128-user-profile d-flex flex-column">
                    <?php
                        $current_user = wp_get_current_user();
                        if ($current_user) :  ?>
                            <div class="workroom1128-user-profile-avatar">
                                <img alt="User Avatar" src="<?php  echo esc_url(get_avatar_url($current_user->ID)); ?>" class="avatar avatar-96 photo" height="96" width="96" loading="lazy">
                            </div>
                                                                                    
                                                                                    
                        <div class="workroom1128-user-profile-username">
                                    <?php echo $current_user->display_name; ?> 
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3"  data-bs-toggle="tab" data-bs-target="#nav-dashboard" type="button" role="tab" aria-controls="nav-dashboard" aria-selected="true"  href="#!"><i class="fas fa-puzzle-piece"></i>Dashboard</a>

                    <a data-bs-toggle="tab" data-bs-target="#nav-courses" class="list-group-item list-group-item-action list-group-item-light p-3" type="button" role="tab" aria-controls="nav-courses" aria-selected="true" href="#!"><i class="fas fa-book-open"></i>Courses</a>

                    <a data-bs-toggle="tab" data-bs-target="#nav-orders" class="list-group-item list-group-item-action list-group-item-light p-3" type="button" role="tab" aria-controls="nav-order" aria-selected="true" href="#!"><i class="fas fa-shopping-cart"></i>Orders</a>

                    <a  data-bs-toggle="tab" data-bs-target="#nav-settings" class="list-group-item list-group-item-action list-group-item-light p-3" href="#!"><i class="fas fa-cog"></i> Settings</a>

                    
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?php echo wp_logout_url();  ?>"><i class="fas fa-sign-out-alt"></i>Logout</a> 
                         
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        
                      
                    </div>
                </nav>
                <!-- Page content-->
                <div class="panel-wrapper">
                    <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-dashboard" role="tabpanel" aria-labelledby="nav-dashboard">
                        <?php get_template_part('template-parts/panels/content', 'dashboard');
                        ?>                          
                    </div>
                    <div class="tab-pane fade show " id="nav-courses" role="tabpanel" aria-labelledby="nav-courses">
                      <?php get_template_part('template-parts/panels/content', 'courses');    ?>
                    </div>
                                        <div class="tab-pane fade" id="nav-orders" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <?php get_template_part('template-parts/panels/content', 'orders');   ?>
                                        </div>
                                        <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-contact-tab">
                                  <?php get_template_part('template-parts/panels/content', 'settings');   ?>
                                        </div>
                                         
                    
                </div>
            </div>
        </div>
        </div>
         
                <?php
        endwhile;
        ?>

        <!--    </main> --><!-- #main -->
            

         

    </div><!-- #content -->

 </div> <!-- #page-wrapper -->
<?php //} ?> 
<?php
get_footer();
