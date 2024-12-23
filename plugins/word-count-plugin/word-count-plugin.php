<?php

/*
Plugin Name: Word Count Plugin
Description: A simple word count plugin
Version: 1.0.0
Author: Aknjoroge
Author URI: https://aknjoroge.techkey.co.ke/ 
Text Domain: wcpdomain
Domain Path: /languages

*/
if ( !defined('ABSPATH') ) exit;

$word_count_plugin_slug ='word-count-settings-page';


 
 
class WordCountPlugin{
   function __construct(){
    // Register plugin settings
    add_action('admin_init',array($this,'register_word_count_settings'));

    // Add menu link in settings 
    add_action( 'admin_menu', array($this, 'admin_menu_handler'));

    // Plugin functionality
    add_filter( 'the_content', array($this, 'content_filter') );

    // Load translation
    add_action( 'init', array($this, 'load_languages') );
   }

   function register_word_count_settings(){
    // Create settings section 
    add_settings_section( 'wcp_section_1', '<hr/>', array($this, 'section_1_content'), $word_count_plugin_slug, array('sectiontitle'=> 'Primary settings') );
    add_settings_section( 'wcp_section_2', '<hr/>', array($this, 'section_1_content'), $word_count_plugin_slug, array('sectiontitle'=> 'Secondary settings') );

    // Add fields to the section
    add_settings_field( 'wcp_location', esc_html__( 'Display Location', 'wcpdomain' ), array($this,'wcp_location_handler'), $word_count_plugin_slug, 'wcp_section_1');
    add_settings_field( 'wcp_headline', esc_html__( 'Headline Text', 'wcpdomain' ), array($this,'wcp_headline_handler'), $word_count_plugin_slug, 'wcp_section_1');
    add_settings_field( 'wcp_word_count', esc_html__( 'Word Count', 'wcpdomain' ), array($this,'wcp_checkbox_handler'), $word_count_plugin_slug, 'wcp_section_2', array('fieldName'=> 'wcp_word_count'));
    add_settings_field( 'wcp_character_count', esc_html__( 'Character Count', 'wcpdomain' ), array($this,'wcp_checkbox_handler'), $word_count_plugin_slug, 'wcp_section_2', array('fieldName'=> 'wcp_character_count'));
    add_settings_field( 'wcp_read_count', esc_html__( 'Read Time', 'wcpdomain' ) , array($this,'wcp_checkbox_handler'), $word_count_plugin_slug, 'wcp_section_2',array('fieldName'=> 'wcp_read_count'));

    // Register fields to settings
    register_setting(  'wordcountplugin', 'wcp_location', array(
        'sanitize_callback' => array($this,'custom_sanitize_function'),
        'default' => '0'
    ) );

    register_setting(  'wordcountplugin', 'wcp_headline', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'Post statistics'
    ) );

    register_setting(  'wordcountplugin', 'wcp_word_count', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'on'
    ) );
    register_setting(  'wordcountplugin', 'wcp_character_count', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'on'
    ) );
    register_setting(  'wordcountplugin', 'wcp_read_count', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'on'
    ) );

   }

   function section_1_content($args){
    ?>
    <h4 style="margin:0"> <?php echo $args['sectiontitle']; ?></h4>
    <?php 
    }

    function wcp_location_handler(){
    ?>
        <select name="wcp_location" >
         <option <?php selected( get_option('wcp_location' ),'0' ); ?> value="0" > End of post</option>
         <option <?php selected( get_option('wcp_location' ), '1' ); ?>  value="1" > Beginning of post</option>
        </select>
    <?php 
    }

    function wcp_headline_handler(){
        ?>
            <input type="text"  value="<?php  echo esc_attr( get_option('wcp_headline'),'0' ); ?>" name="wcp_headline"  >
        <?php 
        }

    function wcp_checkbox_handler($args){
        ?>
        <input type="checkbox" name="<?php echo $args['fieldName']; ?>" <?php checked( get_option($args['fieldName']), 'on' ); ?>  >
        <?php 
    }

    function custom_sanitize_function($input){

        if($input !='1' && $input !='0'){
            add_settings_error( 'wcp_location','wcp_location_error', 'Invalid display location value' );
            return  get_option('wcp_location');
        }

        return $input;
    }

    

   function admin_menu_handler(){
    // Register menu link
    add_options_page( 'Word Count Settings', esc_html__('Word count','wcpdomain'), 'manage_options', $word_count_plugin_slug, array($this, 'menu_link_markup_handler') );
   }

    
    // Generate settings page content
   function menu_link_markup_handler(){
    ?>
<div class="wrap">
<h1> <?php echo esc_html__('Word count settings','wcpdomain'); ?> </h1>
    <form action="options.php" method="POST">
        <?php 
        
        settings_fields('wordcountplugin' );
        do_settings_sections( $word_count_plugin_slug );
        submit_button( );
       ?>
    </form>
</div>
    <?php
   }

   function content_filter($content){


   // Check if any plugin option is active and is a single blog    
    if(is_main_query(  ) && is_single(  ) && get_post_type(  ) == 'post' && (get_option( 'wcp_word_count', 'on' ) || get_option( 'wcp_character_count', 'on' )  || get_option( 'wcp_read_count', 'on' ) ) ){
       return $this -> word_count_functionality($content);
     
    }

    return $content;

   }

   function word_count_functionality($content){


    $title = '<h5> '. esc_html__(get_option( 'wcp_headline'),'wcpdomain' ) .' </h5>';
    $markup = '';

    if(get_option( 'wcp_word_count', 'on' ) || get_option( 'wcp_read_count', 'on' ) ){
        $total_words = str_word_count(strip_tags($content));

    }

    if(get_option( 'wcp_word_count', 'on' ) ){
        $markup =  esc_html__('This post has','wcpdomain') .' ' .$total_words .' '. esc_html__('words','wcpdomain') .' <br/>';
    }

    if(get_option( 'wcp_character_count', 'on' ) ){
        $total_length = strlen($content);
        $markup = $markup .esc_html__('This post has','wcpdomain') .' ' .$total_length .' '. esc_html__('characters','wcpdomain') .'</br>';
    }

    if(get_option( 'wcp_read_count', 'on' ) ){
        $reading_time =  round($total_words/225);
        $markup = $markup. esc_html__('This post will take','wcpdomain') .' ' .$reading_time .' '. esc_html__( 'min(s) to read', 'wcpdomain' );
    }
    

    if(get_option( 'wcp_location','0' )){
        $content = $title . $markup . '<hr/>'. $content;
    }else{
        $content = $content .'<hr/>'.$title .$markup;

    }

    return $content;

   }

   function load_languages(){
    load_plugin_textdomain( 'wcpdomain', false, dirname( plugin_basename( __FILE__)) . '/languages' );
   }


}

$wordCountPlugin = new WordCountPlugin();



