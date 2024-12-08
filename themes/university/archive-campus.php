<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); 


 
 

pageBanner( array(
	'title' => 'Our Campus',
	'photo' => get_theme_file_uri( '/assets/images/library-hero.jpg' )
) );

?>


 

<div class="container py-4">
	<div class="row">

		<?php
	while(have_posts(  )){
		the_post(  );

		$location = get_field('location');

		$lat = $location['lat'];
		$lng = $location['lng'];

		 

		if(isset($location)){
			?>
			 
			<div class="acf-map" data-zoom="16">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
			<?php
		}
 







		print_r($location);



		?>

		<div class="col-md-6 my-2">
			<div class="card ">

				<div class="card-body">

					<div class="card-title">
						<h5>
							<?php the_title( );?>
						</h5>
					</div>

					<div class="alert alert-warning" role="alert">
						<?php wp_bootstrap_starter_posted_on(); ?>
					</div>
					<div>
						<?php echo wp_trim_words( get_the_content (), 20  ) ?>
					</div>

					<hr>
					<div>

						<?php wp_bootstrap_starter_entry_footer(); ?>
					</div>

				</div>
			</div>



		</div>



		<?php

	}

?>

		<div class="col-md-12 text-center">
			<?php echo paginate_links(  ); ?>
		</div>

	</div>
</div>



<?php
get_sidebar();
get_footer();