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
        <div> <a href="#" class="mt-2 btn btn-primary">Find Your Major</a></div>
    </div>


</div>

<div class="d-md-flex">
    <div class="col-md-6 pt-5 pb-5 px-5">

        <div class="px-5">
            <h3 class="text-center font-weight-normal">Upcoming Events</h3>

            <div class="row shadow-sm py-2 rounded">
                <div class="col-md-3">
                    <div class="event-date">

                        <span class="month">Mar</span>
                        <span class="day">25</span>
                    </div>

                </div>
                <div class="col-md-9">
                    <h5><a href="#">Poetry in the 100</a></h5>
                    <p>Bring poems you&rsquo;ve wrote to the 100 building this Tuesday for an open mic and snacks.
                        <a href="#" class="nu gray">Learn more</a>
                    </p>
                </div>
            </div>

            <div class="mt-3 row shadow-sm py-2 rounded">
                <div class="col-md-3">
                    <div class="event-date">

                        <span class="month">Apr</span>
                        <span class="day">02</span>
                    </div>

                </div>
                <div class="col-md-9">
                    <h5><a href="#">Quad Picnic Party</a></h5>
                    <p>Live music, a taco truck and more can found in our third annual quad picnic day.
                        <a href="#" class="nu gray">Learn more</a>
                    </p>
                </div>
            </div>




            <p class="text-center"><a href="#" class="btn btn-secondary mt-3">View All Events</a></p>
        </div>

    </div>
    <div class="blog-col col-md-6 pt-5 pb-5 px-5">
        <div class="px-5">
            <h3 class="text-center font-weight-normal">From Our Blogs</h3>

            <div class=" row   py-2 rounded">
                <div class="col-md-3">
                    <div class="event-date blog-date">

                        <span class="month">jan</span>
                        <span class="day">20</span>
                    </div>

                </div>
                <div class="col-md-9">
                    <h5><a href="#">We Were Voted Best School</a></h5>
                    <p>For the 100th year in a row we are voted #1.
                        <a href="#" class="nu gray">Learn more</a>
                    </p>
                </div>
            </div>
            <div class="mt-3 row   py-2 rounded">
                <div class="col-md-3">
                    <div class="event-date blog-date">

                        <span class="month">feb</span>
                        <span class="day">04</span>
                    </div>

                </div>
                <div class="col-md-9">
                    <h5><a href="#">Professors in the National Spotlight</a></h5>
                    <p>Two of our professors have been in national news lately. Read more


                        <a href="#" class="nu gray">Learn more</a>
                    </p>
                </div>
            </div>





            <p class="text-center"><a href="#" class="btn btn-primary mt-3">View All Blog Posts</a></p>
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