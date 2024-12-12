<?php

function post_types_cb(){

    register_post_type( 'event',  array(
        'capability_type' => 'event',
        'map_meta_cap' => true,
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
        'capability_type' => 'program',
        'map_meta_cap' => true,
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
        'capability_type' => 'professor',
        'map_meta_cap' => true,
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
        'capability_type' => 'campu',
        'map_meta_cap' => true,
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


    register_post_type( 'note',  array(
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'public'=>false,
        'show_ui' => true,
        'labels' => array(
            'name'=>'Note',
            'singular_name'=>'Note',
            'add_new'=>'Add note',
            'add_new_item'=>'Add new note',
            'edit_item'=>'Edit note',

        ),
        'menu_icon'=> 'dashicons-welcome-write-blog',
        'supports' => array('title', 'editor'),
         
    ) );

}





add_action( 'init', 'post_types_cb' );



?>