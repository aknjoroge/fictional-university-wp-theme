<?php 

function like_rest_handler(){

    register_rest_route( 'university/v1', 'like', array(
        'methods' => WP_REST_SERVER::CREATABLE,
        'callback' => 'createLike'
    )  );


    function authProtect($data){
        if(!is_user_logged_in(  ) || !get_current_user_id()){
            die("You need to be loggedin to like a professor");
        }
    
        
        $id = $data['id'];
    
        if(!isset($id)){
            die("Professor id not provided");
        }
        return  $id; 
    }

    function createLike($data){

        $id = authProtect($data);


        $userLike = new WP_Query(array(
            'post_type'=> 'like',
            'meta_query' => array(
                array(
                    'key' => 'professor_id',
                    'value' => $id,
                    'compare' => '=',
                    'type' => 'NUMERIC'
                )
            ),
            'author' => get_current_user_id()
        ));
        if($userLike->found_posts){
            die("You already liked this professor");
        }


     $data = wp_insert_post( array(
        'post_type' => 'like',
        'post_status'=>'publish',
        'meta_input' => array(
                'professor_id' => $id
        ),
        'author' => get_current_user_id()
     ));

        return  $data ;
    }

    register_rest_route( 'university/v1', 'like', array(
        'methods' => WP_REST_SERVER::DELETABLE,
        'callback' => 'deleteHandler'

    )  );

    function deleteHandler($data){


        $id = authProtect($data);


        $userLike = new WP_Query(array(
            'post_type'=> 'like',
            'meta_query' => array(
                array(
                    'key' => 'professor_id',
                    'value' => $id,
                    'compare' => '=',
                    'type' => 'NUMERIC'
                )
            ),
            'author' => get_current_user_id()
        ));
        if($userLike -> have_posts(  )){

            if( isset($userLike->post) && isset($userLike->post-> ID) ){
                $data = wp_delete_post($userLike->post-> ID,false);
                return $data->ID;
            }

            die("Post id not identified");
             
        }

        die("You have not liked this professor");
    }

}


add_action( 'rest_api_init', 'like_rest_handler');