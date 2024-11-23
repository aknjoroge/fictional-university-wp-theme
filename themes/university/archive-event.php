<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); 
pageBanner(array(
	'title'=> ' All Events',
	'photo' => get_theme_file_uri( '/assets/images/library-hero.jpg' )
));
?>


 

<div class="container mt-3 py-4">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
            while(have_posts(  )){
                the_post(  );

                


                 
                get_template_part('/template-parts/content','event');
        
                ?>

            





            <?php
        
            }
        
        ?>
        </div>
        <div class="col-md-2"></div>
    </div>




    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo paginate_links(  ); ?>
        </div>

        <div class="col-md-12 text-center my-3">

            <a class="btn btn-primary" href="<?php echo site_url('/past-events'); ?>">View past events</a>
        </div>
    </div>


</div>



<?php
get_sidebar();
get_footer();