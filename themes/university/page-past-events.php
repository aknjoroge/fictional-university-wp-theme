<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); 
pageBanner(array(
	 'subtitle' => 'A recap of our past events.'
));

?>

 
<div class="container mt-3 py-4">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
             $today = date('Ymd');

$past_events_query = array(
  'paged'=> get_query_var( 'paged',1 ),
  'post_type' =>'event',
  'posts_per_page' => 10,
  'order' =>'ASC',
  'orderby' => 'meta_value_num' ,
  'meta_key' => 'event_date',
  'meta_type' => 'NUMERIC',
  'meta_query' => array(
      'key' => 'event_date',
      'value' => $today,
      'compare' => '<',
      'type' => 'NUMERIC'
  )
);

            $past_events = new WP_Query($past_events_query);



            while($past_events-> have_posts(  )){
              $past_events->the_post(  );

                $eventDate = new DateTime(get_field('event_date'));

        
                ?>

            <div class="row mb-3  shadow-sm py-2 mb-3 rounded">
                <div class="col-md-3">
                    <div class="event-date">

                        <span class="month">
                            <?php echo $eventDate->format('M'); ?>
                        </span>
                        <span class="day">
                            <?php echo $eventDate->format('d'); ?>
                        </span>
                        <!-- <span><?php echo $eventDate->format('y'); ?></span> -->
                    </div>

                </div>
                <div class="col-md-9">
                    <h5><a href="<?php the_permalink(  ); ?>">
                            <?php the_title(); ?>
                        </a></h5>
                    <p>
                        <?php 
                            
                             
                            
                            if(has_excerpt()){
                                echo get_the_excerpt();
    
                            } else {
                                echo wp_trim_words( get_the_content (), 18  );
                            }
                            
                            
                             ?>
                        <a href="<?php the_permalink(  ); ?>" class="nu gray">Learn more</a>
                    </p>
                </div>
            </div>





            <?php

        
            }

            wp_reset_postdata();  
        
        ?>
        </div>
        <div class="col-md-2"></div>
    </div>




    <div class="row">
        <div class="col-md-12 text-center">
            <?php
             
            
            echo paginate_links( array(
              'total'=> $past_events -> max_num_pages
            ) ); ?>
        </div>
    </div>


</div>

<?php
get_sidebar();
get_footer();