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
    }

    function createLike($data){

    if(!is_user_logged_in(  ) || !get_current_user_id()){
        die("You need to be loggedin to like a professor");
    }

    
    $id = $data['id'];

    if(!isset($id)){
        die("Professor id not provided");
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


        authProtect($data);


        return "postHandler";
    }

}


add_action( 'rest_api_init', 'like_rest_handler');