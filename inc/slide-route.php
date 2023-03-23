<?php
/**
 * [workroom1128RegisterSlide description]
 * @param  [type]   [description]
 * @return [type]       [description]
 */
add_action( 'rest_api_init', 'workroom1128RegisterSlide' );
/** 
 * Route does not have to be a custom post type name. It is custom choice.
 * namespace: wp-json/coachingy/v1/
 * route: lesson_slide
 *
 * @args:  Either an array of options for the endpoint,
 * or an array of arrays for multiple methods.
 * method: CRUD is Read here Use WP_REST_SERVER instead of Get to avoid any errors
 * Namespace must not start or end with a slash
 * This does NOT substitute for search.js module.
 * This adds custom post types to search in a custom rest route.
 * @return [type] [description]
 */

function workroom1128RegisterSlide()
{
     
    register_rest_route(
        'coaching/v1',
        'lesson_slide',
        array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'workroom1128SlideResults',
        'permission_callback' => '__return_true'
        ) 
    );
   
    register_rest_route(
        'coaching/v1',      
        '(?P<id>\d+)lesson_slide/', 
        array(
              'methods'             => \WP_REST_Server::READABLE,
              'callback'            => 'workroom1128SlideResultsID',
              'permission_callback' => '__return_true' 
        )           
    );
    
}
 
/**
 * [workroom1128SlideResultsID description]
 * WP will automatically convert JSON data in PHP
 *
 * @param [type] $data [description]
 *  $data['id'] [description]
 *                      
 *  will be used on url
 *  https://deliberatedoing/wp-json/coaching/v1/lesson_slide?id=522
 *                      
 *
 * @return [type] [description]
 */
function workroom1128SlideResultsID($data) {
    $slideQuery = new WP_Query(
        array(
        'post_type' => 'lesson_slide',        
        'p' => $data['id'], 
        )
      );
      
      
      $results = array(
        'slides' => array(),
        
        );
            // Initialize the array that will receive the posts' data. 
            while ($slideQuery->have_posts()) {
                $slideQuery->the_post();
        
                $rows = get_field('class_slides', get_the_ID() );
        
                $images = array();  
        
                if( $rows ) {    
                     
                    foreach( $rows as $row ) {
                        
                        $image = $row['slide_image'];
                     
                      //  echo '<pre>'; print_r($image); echo '</pre>';
                        array_push($images, $image['url']);
                    }
                }
               // echo '<pre>'; print_r($images); echo '</pre>';
                
                array_push(
                  $results['slides'],
                  array(                
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(get_the_ID()),
                    'slidesImages' => $images,                  
                  )
              );
             
             } // end of while loop

            
        wp_reset_postdata();
    
       return $results;           
   
}
/**
 * [workroom1128LessonResults description]
 * WP will automatically convert JSON data in PHP
 *
 * @param [type] $data [description]
 *  $data['term'] [description]
 *  's' => sanitize_text_field($data['term'])
 *  will be used on url
 *  http://localhost/deliberatedoing/wp-json/coaching/v1/lesson_slide?term=meowsalot
 *  's' is WP standard for search and is what people are keying in
 *  term is our custom parameter after ?
 *
 * @return [type] [description]
 */
function workroom1128SlideResults($request)
{ 
    $slideQuery = new WP_Query(
        array(
        'post_type' => 'lesson_slide',
        'posts_per_page' => -1,  
        )
    );
    
    $slidesResults = array(
      'slides' => array(),      
    );

    while ($slideQuery->have_posts()) {

        $slideQuery->the_post();

        $rows = get_field('class_slides',get_the_ID() );

        $images = array();  

        if( $rows ) {    
             
            foreach( $rows as $row ) {
                
                $image = $row['slide_image'];
              //  echo '<pre>'; print_r($image); echo '</pre>';
                array_push($images, $image);
            }
        }

        //echo '<pre>'; print_r($images); echo '</pre>';
        
        array_push(
          $slidesResults['slides'],
          array(                
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'permalink' => get_the_permalink(get_the_ID()),
            'slides' => $images,                  
          )
      );
     
     } // end of while loop

    wp_reset_postdata();

    return $slidesResults;
    //return rest_ensure_response( $results );     
}


