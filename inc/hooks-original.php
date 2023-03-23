<?php
/**
 * Custom hooks
 *
 * @package workroom1128
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'workroom1128_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function workroom1128_site_info() {
		do_action( 'workroom1128_site_info' );
	}
}

add_action( 'workroom1128_site_info', 'workroom1128_add_site_info' );
if ( ! function_exists( 'workroom1128_add_site_info' ) ) {
	/**
	 * Add site info content.
	 *  2019 - 2022 Deliberate Doing, LLC. All Rights Reserved
	 */
	function workroom1128_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
			esc_url( __( 'https://wordpress.org/', 'workroom1128' ) ),
			sprintf(
				/* translators: WordPress */
				esc_html__( 'Proudly powered by %s', 'workroom1128' ),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: 1: Theme name, 2: Theme author */
				esc_html__( 'Theme: %1$s by %2$s.', 'workroom1128' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'https://workroom1128.com', 'workroom1128' ) ) . '">workroom1128.com</a>'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: Theme version */
				esc_html__( 'Version: %1$s', 'workroom1128' ),
				$the_theme->get( 'Version' )
			)
		);

		// Check if customizer site info has value.
		if ( get_theme_mod( 'workroom1128_site_info_override' ) ) {
			$site_info = get_theme_mod( 'workroom1128_site_info_override' );
		}

		echo apply_filters( 'workroom1128_site_info_content', $site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}

if (! function_exists('workroom1128_site_info')) {
    /**
     * Add site info hook to WP hook library.
     */
    function workroom1128_site_info()
    {
        do_action('workroom1128_site_info');
    }
}

if (! function_exists('workroom1128_add_site_info')) {
    /**
     * Add site info content.
     */
    function workroom1128_add_site_info()
    {
        $the_theme = wp_get_theme();
        $currentYear = date("Y");
        
        $startyear = workroom1128_get_option('site_options_start_year');
        $sitename = get_bloginfo('name');
       // $themeURI = esc_html__($the_theme->get( 'AuthorURI' ));
        $site_info = sprintf(
           /* '<div class="d-flex justify-content-between"><div class="flex-grow-1"><p><span>&copy;&nbsp;%1$s&#8211;%2$s</span><span class="sep"> | </span>%3$s</p></div><div class=""><p><span>&nbsp;&nbsp;%4$s %5$s</span></p></div></div>',*/
            '<div class="d-flex justify-content-between"><div class="flex-grow-1"><p><span>&copy;&nbsp;%1$s&#8211;%2$s</span><span class="sep"> | </span>%3$s</p></div><div class=""><a href="%4$s">Privacy Policy</a></div></div>',
            //esc_html(__( '2022', 'workroom1128' )),
            sprintf(
                esc_html(__($startyear, 'workroom1128')),
            ),
            sprintf(
                esc_html(__($currentYear, 'workroom1128')),
            ),
            sprintf(
                esc_html__($sitename, 'workroom1128'),
                // $the_theme->get( 'Name' ),
            ),
            sprintf(
                esc_html__('%s', 'workroom1128'),
                get_permalink(get_page_by_title('Privacy Policy')),
            ),
            // sprintf( // WPCS: XSS ok.
            //     /* translators: 1: Theme name, 2: Theme author */
            //     esc_html__('By: %1$s %2$s', 'workroom1128'),
            //     '<a href="' . esc_url(__($the_theme->get('AuthorURI'))) . '">',
            //    ,
            // ),
            /*sprintf(
            esc_html__('Theme: %s', 'workroom1128'),
            $the_theme->get('Name'),
            ),
            sprintf( // WPCS: XSS ok.
            /* translators: 1: Theme name, 2: Theme author */
            /* esc_html__('By: %1$s %2$s', 'workroom1128'),
            '<a href="' . esc_url(__($the_theme->get('AuthorURI'))) . '">',
            esc_html__($the_theme->get('Author')),
            ),*/ /*
            sprintf( // WPCS: XSS ok.
            /* translators: Theme version */
            /* esc_html__( 'Version: %1$s', 'workroom1128' ),
            $the_theme->get( 'Version' )
            )*/
        );

        // Check if customizer site info has value.
        if (get_theme_mod('workroom1128_site_info_override')) {
            $site_info = get_theme_mod('workroom1128_site_info_override');
        }

        echo apply_filters('workroom1128_site_info_content', $site_info); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
}
    //function workroom1128_add_site_info() {
    /*  $the_theme = wp_get_theme();


      //  echo esc_html( $the_theme->get( 'AuthorURI' ) );
        $startyear = workroom1128_get_option( 'site_options_start_year');
    // echo '&copy;&nbsp;' . $startyear .'-' . date("Y");

        $site_info = sprintf(
             '<p><span>&copy;&nbsp;%1$s&#8211;%2$s</span><span class="sep"> | </span>%3$s(%4$s)',
            esc_url( __( site_url('/') , 'workroom1128' ) ),
            //'<span class="sep"> | </span>%3$s(%4$s)</p>',

            sprintf(
                /* translators: WordPress */
            /*  esc_html__( 'Proudly powered by %s', 'workroom1128' ),
                '1128 Workroom, LLC'
            ),
        sprintf( // WPCS: XSS ok.
                /* translators: 1: Theme name, 2: Theme author */
                /*esc_html__( 'Theme: %1$s by %2$s.', 'workroom1128' ),
                $the_theme->get( 'Name' ),
                '<a href="' . esc_url( __( 'https://workroom1128.com', 'workroom1128' ) ) . '">workroom1128.com</a>'
            ),
            sprintf( // WPCS: XSS ok.
                /* translators: Theme version */
            /*  esc_html__( 'Version: %1$s', 'workroom1128' ),
                $the_theme->get( 'Version' )
            )
        );

        echo apply_filters( 'workroom1128_site_info_content', $site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped*/
   // }
//}

/* customize STUDENT login process */
// Redirect student accounts out of admin and onto homepage
 
 
     


// redirect to dashboard page
if (! function_exists('workroom1128_redirectStudents')) {

    function workroom1128_redirectStudents()
    {

        $currentUser = wp_get_current_user();

        $count = count($currentUser->roles);

        if (count($currentUser->roles) == 1 and $currentUser->roles[0] == 'student') {
            wp_redirect(home_url('/elearning-dashboard'));

            exit;
        }
    }
}
// do NOT show admin bar for STUDENT
if (! function_exists('workroom1128_noStudentsAdminBar')) {

    function workroom1128_noStudentsAdminBar()
    {
     
        $currentUser = wp_get_current_user();
 
         $count = count($currentUser->roles);

         if (count($currentUser->roles) == 1 and $currentUser->roles[0] == 'student') {
             show_admin_bar(false);
         }
    }
   // add_action('wp_loaded', 'workroom1128_noStudentsAdminBar');
}

// Example 2: Restrict access to specific pages
//add_action( 'template_redirect', 'workroom1128_custom_redirects' );
//if ( ! function_exists( 'workroom1128_custom_redirects' ) ) {
//  function workroom1128_custom_redirects() {

            // if ( is_front_page() ) {
       //      wp_redirect( home_url( '/dashboard/' ) );
       //      die;
       //  }
     
       //  if ( is_page('contact') ) {
       //      wp_redirect( home_url( '/new-contact/' ) );
       //      die;
       //  }

        // Get global post
    //  global $post;

        // Prevent access to page with ID of 2 and all children of this page
        //$page_id = 170;
        // if ( is_page() && ( $post->post_parent == $page_id || is_page( $page_id ) ) ) {
//  if ( is_page('elearning-dashboard') || is_post_type_archive(array('course','module','class', 'student')) || is_singular( array('course','module','class', 'student'))   ) {
            // Set redirect to true by default
         // $redirect = true;

            // If logged in do not redirect
            // You can/should place additional checks here based on user roles or user meta
            //if ( is_user_logged_in() ) {
        //      $redirect = false;
        //  }

            // Redirect people without access to login page
        //  if ( $redirect ) {
                //wp_redirect( esc_url( wp_login_url() ), 307 );
                //exit; //die;
        //  }


        //}

    //}
//}
/* customize LOGIN screen */
// modify header link to be site URL
//
if (! function_exists('workroom1128_headerurl')) {

    function workroom1128_headerurl()
    {
     
         return esc_url(site_url('/'));
    }
}
// modify login title to be name of site
if (! function_exists('workroom1128_login_title')) {

    function workroom1128_login_title()
    {
        return get_option('blogname');
    }
}
// modify styles using admin.css
if (! function_exists('workroom1128_loginCSS')) {

    function workroom1128_loginCSS()
    {
        $the_theme     = wp_get_theme();
        $theme_version = $the_theme->get('Version');

        $css_version = $theme_version . '.' . filemtime(get_template_directory() . '/dist/css/admin.css');
        if (is_admin()) {
            wp_enqueue_style('_workroom1128-stylesheet', get_template_directory_uri() . '/dist/css/admin.css', array(), $css_version);
        }
    }
}
/* redirects */
//http://localhost/Wordpress/dashboard/maureen/settings
//http://localhost/Wordpress/dashboard/maureen/orders
//http://localhost/Wordpress/dashboard/maureen/quizzes
//http://localhost/Wordpress/dashboard/maureen/courses
//http://localhost/Wordpress/dashboard/maureen/settings/avatar
//http://localhost/Wordpress/dashboard/maureen/settings/change-password
//http://localhost/Wordpress/dashboard/maureen/settings/privacy
//http://localhost/Wordpress/dashboard/maureen/settings/basic-information  //  is General tab
//
//  https://www.udemy.com/course/rank-local-business-websites/?src=sac&kw=2021+Complete+SEO+Guide
//
//   https://www.udemy.com/course/rank-local-business-websites/learn/lecture/4029486?components=buy_button%2Cdiscount_expiration%2Cgift_this_course%2Cpurchase%2Cdeal_badge%2Credeem_coupon&kw=2021+Complete+SEO+Guide&src=sac#overview
//
//   udemy.com/course/coursename/learn/lecture/lecturenumber?&src=sac#overview
//   https://www.udemy.com/course/coursename/learn/lecture/lecturenumber#questions
//
//   http://localhost/Test/lp-courses/sample-course-3/
//   http://localhost/Test/lp-courses/sample-course-3/lessons/lesson-1-3/
//
//   we need Overview tab / Announcements tab /  Q & A tab ?? /
//
//
//   Display avatar in menu
//   add_filter( 'wp_nav_menu_objects', 'my_dynamic_menu_items', 10 );
function my_dynamic_menu_items($menu_items)
{
    foreach ($menu_items as $menu_item) {
        if (strpos($menu_item->title, '#profile_name#') !== false) {
            $menu_item->title =  str_replace("#profile_name#", wp_get_current_user()->user_login .' '. get_avatar(wp_get_current_user()->user_email, 50), $menu_item->title);
        }
    }
    return $menu_items;
}


//add_filter('wp_nav_menu_items', 'login_logout_menu_items', 10, 2);
function login_logout_menu_items($items, $args)
{

    if (is_user_logged_in() && $args->theme_location == 'secondary') {
        $items .= '<li class="d-flex align-items-center me-3"><a href="'. wp_logout_url(). '" class="btn  btn--login btn--with-photo" ><span class="site-header__avatar">'.  get_avatar(get_current_user_id(), 60). '</span><span class="btn__text">Log Out</span></a>';
    } else {
        $items .= '<li class="d-flex align-items-center me-3"><a href="'. wp_login_url(). '" class="btn btn--login" ><span class="btn__text">Login</span></a></li>';
                   //$items .= '<li><a href="'. wp_logout_url( $logout_redirect ) .'" title="'. esc_attr( $text ) .'" class="wpex-logout"><span class="link-inner">'. strip_tags( $text ) .'</span></a>';
                     // <a href="<?php //echo wp_login_url(); " class="btn btn--small btn--orange float-left push-right">Login</a></li>';'
    }
    return $items;
}


//
function wptuts_add_endpoint()
{
    add_rewrite_endpoint('form', EP_PAGES);
}
//add_action( 'init', 'wptuts_add_endpoint');

function wptuts_add_queryvars($query_vars)
{
    $query_vars[] = 'form';
    return $query_vars;
}
//add_filter( 'query_vars', 'wptuts_add_queryvars' );

function wptuts_form_handler()
{
 
    // Are we wanting to process the form
    if (! isset($_POST['action']) || 'wptuts_send_message' != $_POST['action']) {
        return;
    }
 
    // ID of the contact form page
    $form_id = 9;
    $redirect= get_permalink($form_id);
 
    // Check nonces
    $data = $_POST['wptuts_contact'];
 
    if (!isset($_POST['wptuts_contact_nonce']) || !wp_verify_nonce($_POST['wptuts_contact_nonce'], 'wptuts_send_message')) {
        // Failed nonce check
        $redirect .= 'form/error';
     //   wp_redirect($redirect);
        exit();
    }
 
    if (!empty($data['confirmation'])) {
        // Bees in the honey...
        $redirect .= 'form/error';
       // wp_redirect($redirect);
        exit();
    }
 
    // Santize and validate data etc.
 
    // Then actually do something with the sanitized data
 
    // Successful!
    $redirect .= 'form/success';
    //wp_redirect($redirect);
    exit();
}
//add_action( 'init', 'wptuts_form_handler');

function wptuts_add_class_endpoint()
{
    add_rewrite_endpoint('class', EP_PAGES);
}
//add_action( 'init', 'wptuts_add_class_endpoint');

function wptuts_add_class_queryvars($query_vars)
{
    $query_vars[] = 'class';
    return $query_vars;
}
//add_filter( 'query_vars', 'wptuts_add_class_queryvars' );

function wptuts_class_url_handler()
{
 
    
    
    // ID of the class page
   // $page_id = 2753;
   // $redirect= get_permalink($page_id);
 
    // Check nonces
    //$data = $_POST['wptuts_contact'];
 
    // if( !isset($_POST['wptuts_contact_nonce'] ) || !wp_verify_nonce($_POST['wptuts_contact_nonce'],'wptuts_send_message') ) {
    //     // Failed nonce check
    //     $redirect .= 'form/error';
    //     wp_redirect($redirect);
    //     exit();
    // }
 
    // if( !empty( $data['confirmation'] ) ) {
    //     // Bees in the honey...
    //     $redirect .= 'form/error';
    //     wp_redirect($redirect);
    //     exit();
    // }
 
    // Santize and validate data etc.
 
    // Then actually do something with the sanitized data
 
   // // Successful!
   // $redirect .= 'lessons/class';
   // wp_redirect($redirect);
   // exit();
}
//add_action( 'init', 'wptuts_class_url_handler');
//

 
 
function my_rest_route(WP_REST_Request $request)
{
    //$param = $request['some_param'];
 
  // Or via the helper method:
  //$param = $request->get_param( 'some_param' );
 
  // You can get the combined, merged set of parameters:
    $parameters = $request->get_params();
 
  // The individual sets of parameters are also available, if needed:
  //$parameters = $request->get_url_params();
 // $parameters = $request->get_query_params();
  //$parameters = $request->get_body_params();
  //$parameters = $request->get_json_params();
  //$parameters = $request->get_default_params();
 
  // Uploads aren't merged in, but can be accessed separately:
  //$parameters = $request->get_file_params();
  // note If the request has the Content-type: application/json header set and valid JSON in the body, get_json_params() will return the parsed JSON body as an associative array. As of WordPress 5.5, a _doing_it_wrong notice is issued if the wp_send_json() family of functions is used during a REST API request.

//Return a WP_REST_Response or WP_Error object from your callback when using the REST API.
//return new WP_REST_Response( array( 'message' => 'Form sent!' ), 200 );
    $ok = empty($request['is_error']);

    // Send the response with custom HTTP status code.
    if ($ok) {
      //  return new WP_REST_Response( array( 'message' => 'Form sent!' ), 200 );
    } else {
       // return new WP_REST_Response( array( 'message' => 'Something wrong..' ), 400 );
    }
}

//add_filter( 'posts_orderby', 'workroom1128_sort_questions_in_topic', 99, 2 );
// function workroom1128_sort_questions_in_topic($orderby, $query)
// {
//     if (! workroom1128_is_topic_tax_query($query)) {
//         return;
//     }
//     global $wpdb;
//     return "{$wpdb->term_relationships}.term_order ASC";
// }

// function workroom1128_is_topic_tax_query($query)
// {
//     if (empty($query->tax_query)) {
//         return;
//     }
//     if (empty($query->tax_query->queries)) {
//         return;
//     }
//     return in_array(
//         $query->tax_query->queries[0]['taxonomy'],
//         [ 'series' ],
//         true
//     );
// }

if (! function_exists('workroom1128_entry_meta_categories')) :
    function workroom1128_entry_meta_categories()
    {
     
        $category = get_the_category();
        echo "Categories: ";
        if ($category) {
            echo  the_category(' | ');
        }
    }
endif;

  
