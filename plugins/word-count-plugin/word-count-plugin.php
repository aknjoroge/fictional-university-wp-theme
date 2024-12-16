<?php

/*
Plugin Name: Word Count Plugin
Description: A simple word count plugin
Version: 1.0.0
Author: Aknjoroge
Author URI: https://aknjoroge.techkey.co.ke/ 
*/


function content_filter($content){
    if(get_post_type(  ) == 'event'){
        return $content .'Custom plugin filtering the event content';    
    }

    if( is_single() && is_main_query() ){
        return $content .'Single blog content';
    }
    return  $content;
}
add_filter( 'the_content', 'content_filter' );

