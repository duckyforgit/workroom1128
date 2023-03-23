<?php
/**
 * [workroom1128RegisterLesson description]
 * @param  [type]   [description]
 * @return [type]       [description]
 */
add_action('rest_api_init', 'workroom1128RegisterLesson');
/**
 * [workroom1128RegisterLesson description]
 * Route does not have to be a custom post type name. It is custom choice.
 * namespace: wp-json/coaching/v1/
 * route: search
 *
 * @args:  Either an array of options for the endpoint,
 * or an array of arrays for multiple methods.
 * method: CRUD is Read here Use WP_REST_SERVER instead of Get to avoid any errors
 * Namespace must not start or end with a slash
 * This does NOT substitute for search.js module.
 * This adds custom post types to search in a custom rest route.
 * @return [type] [description]
 */

function workroom1128RegisterLesson()
{
    register_rest_route(
        'coaching/v1',
        '/lesson/(?P<id>\d+)',
        array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'workroom1128LessonResults',
        'permission_callback' => '__return_true'
        )
    );
//     register_rest_route($namespace, '/lesson/', [
//         [
//             'methods'             => \WP_REST_Server::READABLE,
//             'callback'            => 'custom_api_get_lesson_callback',
//             'permission_callback' => '__return_true'            
//         ]         
//     ]);
//   register_rest_route($namespace, '/lesson/(?P<id>\d+)', [
//         [
//             'methods'             => \WP_REST_Server::READABLE,
//             'callback'            => 'custom_api_get_post_callback',
//             'permission_callback' => '__return_true'            
//         ]         
//     ]);
}
/**
 * [workroom1128RegisterLesson description]
 * WP will automatically convert JSON data in PHP
 *
 * @param [type] $data [description]
 *                    // $data['id'] [description]
 *                      
 *                     will be used on url
 *                     http://localhost/deliberatedoing/wp-json/coaching/v1/lesson?id=meowsalot
 *                      
 *
 * @return [type] [description]
 */
function workroom1128LessonResults($data)
{
    $lessonQuery = new WP_Query(
        array(
            'id' =>  $data['id'],
        'post_type' => 'lesson',   
        )
    );
     
    $lessonResults = array(
        'lessons' => array(),
        
     );  
    // print_r($data);  
    while ($lessonQuery->have_posts()) {
        $lessonQuery->the_post();
         
           
          //  $post = get_post(get_the_ID());
            $id = get_the_ID();
            $title = get_the_title();
            $permalink = get_the_permalink();
            $order_in_series = get_field('class_order_in_series');
            $class_video = get_field('class_video');
            $class_pdf_resource = get_field('class_pdf_resource');
            $class_slides = array();
            $caption = '';
            array_push(
                $lessonResults['lessons'],
                array(                
                'id' => $id,
                'title' => $title,
                'permalink' => $permalink,
                'order_in_series' => $order_in_series, 
                'class_video' => $class_video,
                'class_pdf_resource' => $class_pdf_resource                
                )
            );
            $related_class_video = get_field( 'class_video_relationship' );  
            if ( $related_class_video ) :  
                foreach ( $related_class_video as $video ) :  
                // loop through multiple related class video
               
                      //$video_url = get_permalink( $video->ID );  
                    $video_file = get_field( 'video_file', $video->ID ); 
                    if ($video_file) :
                      $video_url = $video_file['url'];
                      $video_filename = $video_file['filename'];
                    endif;   
                        
                       //  $video_url = get_field('video_file['url']', $video->ID);
                        // $video_filename =get_field('video_file['filename']', $video->ID); 
                        
                endforeach;  

            endif; 
            
            $related_class_pdf = get_field( 'class_pdf_relationship' );  
            if ( $related_class_pdf ) :  
                foreach ( $related_class_pdf as $pdf ) :  
                // loop through multiple related class pdf
               
                      
                    $pdf_file = get_field( 'pdf_file', $pdf->ID ); 
                    if ($pdf_file) :
                      $pdf_url = $pdf_file['url'];
                      $pdf_filename = $pdf_file['filename'];
                   endif;   
                        
                       //  $video_url = get_field('video_file['url']', $video->ID);
                        // $video_filename =get_field('video_file['filename']', $video->ID); 
                        
                endforeach;  

            endif;  
                 
            // get slides
            // relationship field of $related_class_slides and is a array of ID, post_title etc the post
            $related_class_slides = get_field( 'class_slides_relationship' );  
                    if ( $related_class_slides ) :  
                        foreach ( $related_class_slides as $slide ) :  
                        // loop through multiple related class slides
                       
                            $rows = get_field('class_slides',  $slide->ID);
                            if($rows) {

                                $class_slides = '<ul class="slides">';
                                
                                foreach($rows as $row) { 
                                
                                    $image = $row['slide_image']; 
                                    $url = $image['url']; 
                                   
                                    $imageAttachment = wp_get_attachment_image( $image, 'full' );
                                  //  $caption = wpautop( $row['caption'] );
                                   $caption = $image['caption'];
                                    $class_slides .= '<li>';
                                    $class_slides .=  $url; 
                                    $class_slides .=     '<p>';
                                    $class_slides .=  $caption;
                                    $class_slides .= '</p></li>'; 
                                
                                }
                                $class_slides .= '</ul>';
                            }
                        endforeach;  
        
                    endif;  
            
        
            $results['id'] = $id;
            $results['title'] = $title;  
            $results['permalink'] = $permalink;  
            $results['order_in_series'] = $order_in_series;
            $results['class_video_url'] = $video_url;
            $results['class_video_filename'] =  $video_filename; 
            $results['class_pdf_url'] = $pdf_url;
            $results['class_pdf_filename'] =  $pdf_filename; 
            $results['class_slides'] = $class_slides;
            $results['class_slides_relationship'] = $related_class_slides; 
            
               
                
        
        
    } // end of while loop

    wp_reset_postdata();

    return $results;   
    
}
