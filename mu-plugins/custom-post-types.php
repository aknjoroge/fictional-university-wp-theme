<?php

function post_types_cb(){

    register_post_type( 'event',  array(
        'public'=>true,
        'labels' => array(
            'name'=>'Event',
            'singular_name'=>'Event',
            'add_new'=>'Add event',
            'add_new_item'=>'Add new event',
            'edit_item'=>'Edit event',

        ),
        'menu_icon'=> 'dashicons-calendar-alt',
        'supports' => array('title', 'editor','excerpt'),
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'events'
        )

         
    ) );

}



add_action( 'init', 'post_types_cb' );



?>