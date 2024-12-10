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
        'supports' => array('title',  'excerpt'),
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'programs'
        )
    ) );


    register_post_type( 'professor',  array(
        'public'=>true,
        'labels' => array(
            'name'=>'Professor',
            'singular_name'=>'Professor',
            'add_new'=>'Add professor',
            'add_new_item'=>'Add new professor',
            'edit_item'=>'Edit professor',
        ),
        'menu_icon'=> 'dashicons-businessperson',
        'supports' => array('title', 'editor','excerpt', 'thumbnail' ),
        'show_in_rest' => true
         
    ) );


    register_post_type( 'campus',  array(
        'public'=>true,
        'labels' => array(
            'name'=>'Campus',
            'singular_name'=>'Campus',
            'add_new'=>'Add campus',
            'add_new_item'=>'Add new campus',
            'edit_item'=>'Edit campus',

        ),
        'menu_icon'=> 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor','excerpt'),
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'campus'
        )
    ) );

}





add_action( 'init', 'post_types_cb' );



?>