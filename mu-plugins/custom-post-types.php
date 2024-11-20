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

    register_post_type( 'program',  array(
        'public'=>true,
        'labels' => array(
            'name'=>'Program',
            'singular_name'=>'Program',
            'add_new'=>'Add program',
            'add_new_item'=>'Add new program',
            'edit_item'=>'Edit program',

        ),
        'menu_icon'=> 'dashicons-schedule',
        'supports' => array('title', 'editor','excerpt'),
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'programs'
        )

         
    ) );

}



add_action( 'init', 'post_types_cb' );



?>