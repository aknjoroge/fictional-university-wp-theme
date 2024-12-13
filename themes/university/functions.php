<?php


 require get_theme_file_path( '/inc/custom-rest.php' );

 require get_theme_file_path( '/inc/theme-functions.php' );
 require get_theme_file_path( '/inc/like-rest-controller.php' );



//============================================================================================

function adjust_queries($query){
    if(!is_admin(  ) && is_post_type_archive('event') && $query-> is_main_query(  ) ){
        $today = date('Ymd');
        $query->set('order','ASC');
        $query->set('orderby','meta_value_num');
        $query->set('meta_key','event_date');
        $query->set('meta_type','NUMERIC');
        $query->set('meta_query', array(
            'key' => 'event_date',
            'value' => $today,
            'compare' => '>=',
            'type' => 'NUMERIC'
        ));
    }

    if(!is_admin(  ) && is_post_type_archive('campus') && $query-> is_main_query(  ) ){
        
        $query->set('posts_per_page', -1);
       
    }
}

add_action( 'pre_get_posts', 'adjust_queries');


function theme_features(){

add_image_size('professor_landscape', 400,260, true);
add_image_size('professor_portrait', 130,260, true);


/* XXX
- To use the Manual Image Crop plugin by Tomasz Sita you need to open the
  details page and click on the featured image

 */

// add_image_size('custom_crop', 130,260, array('left', 'top'));


}

add_action('after_setup_theme', 'theme_features' );


// Page banner
function pageBanner($args = null){



    if(!isset($args['title'])){
        $args['title'] = get_the_title();
    }

    if(!isset($args['subtitle'])){
        $args['subtitle'] = get_field('subtitle');
    }
    
    if(!isset($args['photo'])){

        if(get_field('background_image') and !is_archive() and !is_home( )){
         
            $args['photo'] =get_field('background_image')['sizes']['large'];
        }else{
            $args['photo'] = get_theme_file_uri( '/assets/images/ocean.jpg' );
        }

    }
    
    ?>
        <div class="page-banner">
        <div class="page-banner-image"
            style="background-image: url(<?php echo $args['photo']; ?>); background-size: cover">
        </div>

        <div
            class=" d-flex  justify-content-end flex-column page-banner-content inner-page-banner-content text-center text-white py-5">
            <div class="text-left container">

            <h1>
                <?php echo $args['title']; ?>
            </h1>
            <?php 
            if(isset($args['subtitle'])){
                ?>
            <h3> <?php echo $args['subtitle']; ?> </h3>
                <?php
            }

            if(isset($args['callback'])){

                  $args['callback']();

            }

            ?>

            
            </div>
        </div>
        </div>
    <?php

}


function custom_style_imports(){

    wp_enqueue_script('custom-js', get_theme_file_uri('build/index.js'), 'theme-jquery-js', '1.0.0', true);

    wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDtFh5jbAIX0WqTqF6QCbqEPiLW7dQqtvM', array(), '', true );

    wp_enqueue_style( 'custom-css', get_theme_file_uri('build/style-index.css'));


    wp_localize_script( 'custom-js', 'globalData', array(
        'url' =>  get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ) );
}

add_action( 'wp_enqueue_scripts', 'custom_style_imports' );


function my_acf_google_map_api( $api ){

    $apiKey = GOOGLE_API_KEY;

    $api['key'] = $apiKey;
    
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


function update_rest_data(){
    register_rest_field( 'post', 'authorName', array(
        'get_callback' => function (){
            return  get_author_name(  );
        }
    ) );

    register_rest_field( 'note', 'totalUserNotes', array(
        'get_callback' => function (){
            return  count_user_posts( get_current_user_id(  ), 'note' );
        }
    ) );
    
}

add_action( "rest_api_init","update_rest_data" );


function customize_load(){
    $user = wp_get_current_user();
    if(count($user->roles) ==1 && $user->roles[0] == "subscriber"){
        show_admin_bar( false );
    }
}

add_action("wp_loaded" ,'customize_load' );

function manage_admin(){
    $user = wp_get_current_user();
    if(count($user->roles) ==1 && $user->roles[0] == "subscriber"){

        wp_redirect(site_url('/' ));
        exit;
        
    }
}

add_action("admin_init" ,'manage_admin' );


function custom_login_message(){
    return get_bloginfo('name' );
}


add_filter( 'login_headertext','custom_login_message');

function custom_login_headerurl(){
    return site_url('/' );
}

add_filter( 'login_headerurl','custom_login_headerurl');


function custom_login_site_html_link(){
    return  '<a href="'. site_url('/') .' ">← Go Home </a>';
}
add_filter( 'login_site_html_link','custom_login_site_html_link');


function custom_login_enqueue_scripts(){
    wp_enqueue_style( 'custom-css', get_theme_file_uri('build/style-index.css'));

}

add_action('login_enqueue_scripts', 'custom_login_enqueue_scripts');


function filter_post_data($data, $postarr){

 


  if($data['post_type']=='note' && $data['post_status'] !='trash' ){

    if( count_user_posts( get_current_user_id(  ), 'note' )  > 4 && !$postarr['ID']){
        die('You have reached the notes limit of your account');
    }

    $data['post_status'] ='private';
    $data['post_title'] = esc_html( $data['post_title'] );
    $data['post_content'] = sanitize_textarea_field( $data['post_content'] );

  }



    return $data;

}

 add_filter( "wp_insert_post_data", 'filter_post_data', 10,2 );