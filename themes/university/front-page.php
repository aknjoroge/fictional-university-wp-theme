<?php

get_header();

?>

<div class="page-banner">
    <div class="page-banner-image"
        style="background-image: url(<?php echo get_theme_file_uri( '/assets/images/library-hero.jpg' ) ?>)">
    </div>

    <div
        class=" d-flex align-items-center justify-content-center flex-column page-banner-content text-center text-white py-5">
        <h1>Welcome!</h1>
        
        <h2>We think you&rsquo;ll like it here.</h2>
        <h3>Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
        <div> <a href="<?php echo get_post_type_archive_link('program'); ?>" class="mt-2 btn btn-primary">Find Your
                Major</a></div>
    </div>


</div>

<div class="d-md-flex">
    <div class="col-md-6 pt-5 pb-5 px-5">

        <div class="px-5">
            <h3 class="text-center font-weight-normal">Upcoming Events</h3>


            <?php
                $today = date('Ymd');


                $eventQueryFilters = array(
                    'post_type' =>'event',
                    'posts_per_page' => 2,
                    'order' =>'ASC',
                    'orderby' => 'meta_value_num' ,
                    'meta_key' => 'event_date',
                    'meta_type' => 'NUMERIC',
                    'meta_query' => array(
                        'key' => 'event_date',
                        'value' => $today,
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    )
                );
                $eventData = new WP_Query($eventQueryFilters);

                    while($eventData -> have_posts(  )){
                        $eventData -> the_post(  );
                        get_template_part('/template-parts/content','event');
                        ?>
            <?php
                    }

                    wp_reset_postdata(  );



                ?>








            <p class="text-center"><a href="<?php echo get_post_type_archive_link('event'); ?>"
                    class="btn btn-secondary mt-3">View All Events</a></p>
        </div>

    </div>
    <div class="blog-col col-md-6 pt-5 pb-5 px-5">
        <div class="px-5">
            <h3 class="text-center font-weight-normal">From Our Blogs</h3>

            <?php 
            $queryOptions = array(
                'post_type' => 'post',
                'posts_per_page' => 2,
                'orderby' => 'date'
            );

            $blogs = new WP_Query($queryOptions );

            while($blogs-> have_posts(  )){
                $blogs->the_post();

                ?>
            <div class=" row   py-2 rounded">
                <div class="col-md-3">
                    <div class="event-date blog-date">

                        <span class="month">
                            <?php the_time('M'); ?>
                        </span>
                        <span class="day">
                            <?php the_time('d'); ?>
                        </span>
                    </div>

                </div>
                <div class="col-md-9">
                    <h5><a href="<?php the_permalink(  ); ?>">
                            <?php the_title(); ?>
                        </a></h5>
                    <p>
                        <?php echo wp_trim_words(get_the_content( ), 10); ?>
                        <a href="<?php the_permalink(  ); ?>" class="nu gray">Learn more</a>
                    </p>
                </div>
            </div>
            <?php

                wp_reset_postdata();           
                 

            }



            ?>




            <p class="text-center"><a href="<?php echo site_url('/blogs') ?>" class="btn btn-primary mt-3">View All Blog
                    Posts</a></p>
        </div>
    </div>
</div>


<div>
    <div class="slider-item p-5 d-flex align-items-center justify-content-center"
        style="background-image: url(<?php echo get_theme_file_uri( '/assets/images/bus.jpg' ) ?>)">

        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="p-5 text-center content text-white">
                        <h2>Free Transportation</h2>
                        <p>All students have free unlimited bus fare.</p>
                        <p><a href="#" class="btn btn-primary">Learn more</a></p>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>


    </div>
</div>







<?php


get_footer();

?>