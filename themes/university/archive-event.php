<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>


<div class="page-banner">
    <div class="page-banner-image"
        style="background-image: url(<?php echo get_theme_file_uri( '/assets/images/library-hero.jpg' ) ?>)">
    </div>

    <div
        class=" d-flex  justify-content-end flex-column page-banner-content blog-page-banner-content text-center text-white py-5">
        <div class="text-left container">

            <h1>
                <?php the_archive_title(); ?>
            </h1>

            <div class="row">

                <?php 

				if(get_the_archive_description(  )){

					?>

                <div class="col-md-12">
                    <div class="alert alert-info width-fit-content " role="alert">
                        <?php echo the_archive_description(); ?>
                    </div>
                </div>
                <?php

				};

				?>


            </div>

        </div>
    </div>
</div>

<div class="container mt-3 py-4">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
            while(have_posts(  )){
                the_post(  );

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
        
        ?>
        </div>
        <div class="col-md-2"></div>
    </div>




    <div class="row">
        <div class="col-md-12">
            <?php echo paginate_links(  ); ?>
        </div>
    </div>


</div>



<?php
get_sidebar();
get_footer();