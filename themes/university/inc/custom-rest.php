<?php

function custom_rest_config(){
 
    register_rest_route( 'university/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'restHandler'

    ) );

}

function restHandler($query){
    
    $searchTerm = $query['term'];

    $searchData = array(
        'page' => array(),
        'post' => array(),
        'program' => array(),
        'professor' => array(),
        'campus' => array(),
        'event' => array(),
    );

    if(!isset($searchTerm)){
        return  $searchData ;
    }

    
    $pagesData = new WP_Query(array(
        'post_type' => array('page','post','program','professor','campus'),
        // 'posts_per_page' => 2,
        'order' =>'ASC',
        's' => $searchTerm 
    ));

    while($pagesData -> have_posts()){
        $pagesData -> the_post(  );

            $dataObject = array(
                'id' => get_the_ID(  ),
                'title' => get_the_title(  ),
                'url' => get_the_permalink (),
                'type' => get_post_type()
            );
            if(get_post_type()  == 'professor' ){
                $dataObject['image'] = get_the_post_thumbnail_url( );
            }
            if(get_post_type()  == 'post' ){
                $dataObject['authorName'] = get_author_name();
            }
            array_push($searchData[get_post_type()], $dataObject );
    
    }

    
    $today = date('Ymd');
    
    $eventData = new WP_Query(
        array(
            'post_type' =>'event',
            // 'posts_per_page' => 2,
            'order' =>'ASC',
            'orderby' => 'meta_value_num' ,
            'meta_key' => 'event_date',
            'meta_type' => 'NUMERIC',
            'meta_query' => array(
                'key' => 'event_date',
                'value' => $today,
                'compare' => '>=',
                'type' => 'NUMERIC'
            ),
            's'=>  $searchTerm
        )
    );

    while($eventData -> have_posts()){
        $eventData -> the_post(  );
        array_push($searchData['event'], array(
            'id' => get_the_ID(  ),
            'title' => get_the_title(  ),
            'url' => get_the_permalink (),
            'type' => get_post_type()
        ) );
    }

    if(isset($searchData['program']) && !empty($searchData['program'])){


        foreach($searchData['program'] as $singleProgram ){

            $relatedProfessor = new WP_Query(
                
                array(
                'post_type' =>'professor',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'meta_query' => array(
                    array(
                        'key' => 'related_programs',
                        'value' => '"'. $singleProgram['id'] .'"',
                        'compare' => 'LIKE',
                        // 'type' => 'NUMERIC'
                    )
                )
                    )

                     
        );
            $relatedEvents = new WP_Query(
                    array(
                        'post_type' =>'event',
                        // 'posts_per_page' => 2,
                        'order' =>'ASC',
                        'orderby' => 'meta_value_num' ,
                        'meta_key' => 'event_date',
                        'meta_type' => 'NUMERIC',
                        'meta_query' => array(
                            'key' => 'related_programs',
                            'value' => '"'. $singleProgram['id'] .'"',
                           'compare' => 'LIKE',
                            // 'type' => 'NUMERIC'
                        )
                        
                    )
        );

            while($relatedProfessor -> have_posts()){
                $relatedProfessor -> the_post(  );
                    $dataObject = array(
                        'id' => get_the_ID(  ),
                        'title' => get_the_title(  ),
                        'url' => get_the_permalink (),
                        'type' => get_post_type(),
                        'image' =>  get_the_post_thumbnail_url( )
                    );
                    array_push($searchData[get_post_type()], $dataObject );
            }

            while($relatedEvents -> have_posts()){
                $relatedEvents -> the_post(  );
                array_push($searchData['event'], array(
                    'id' => get_the_ID(  ),
                    'title' => get_the_title(  ),
                    'url' => get_the_permalink (),
                    'type' => get_post_type()
                ) );
            }

        }

    }

    // Remove duplicates

    $searchData['professor'] = array_values(array_unique($searchData['professor'], SORT_REGULAR));

    return $searchData;
}

add_action('rest_api_init','custom_rest_config' )


?>