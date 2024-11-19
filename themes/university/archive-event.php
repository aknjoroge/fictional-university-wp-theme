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

<div class="container py-4">
	<div class="row">

		<?php
	while(have_posts(  )){
		the_post(  );

		?>

		<div class="col-md-6 my-2">
			<div class="card ">

				<div class="card-body">

					<div class="card-title">
						<h5>
							<?php the_title( );?>
						</h5>
					</div>

				 
					<div>
						<?php 
                        
                         
                        
                        if(has_excerpt()){
                            echo get_the_excerpt();

                        } else {
                            echo wp_trim_words( get_the_content (), 18  );
                        }
                        
                        
                         ?>
                         <div class="mt-2">
                         <a href="<?php the_permalink(  ); ?>" class="btn btn-primary">View</a>
                    </div>
					</div>

					 
				 

				</div>
			</div>



		</div>



		<?php

	}

?>

		<div class="col-md-12">
			<?php echo paginate_links(  ); ?>
		</div>

	</div>
</div>



<?php
get_sidebar();
get_footer();