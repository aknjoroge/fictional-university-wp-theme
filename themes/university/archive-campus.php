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
	'title' => 'Our Campuses',
	'photo' => get_theme_file_uri( '/assets/images/library-hero.jpg' ),
	'subtitle' => 'We have several conveniently located campuses'
) );

?>


<div class="container py-4">
	<div class="row">

		<div class="col-md-12">
			<div class="acf-map" data-zoom="16">

				<?php

	while(have_posts(  )){
		the_post(  );
		$location = get_field('location');
		$lat = $location['lat'];
		$lng = $location['lng'];

		if(isset($location)){
			?>
				<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>"
					data-lng="<?php echo esc_attr($location['lng']); ?>">
					<a href="<?php the_permalink( ); ?>">
						<p>
							<?php the_title(); ?>
						</p>
					</a>
				</div>
				<?php
		}		 

	}

?>

			</div>










		</div>
	</div>

</div>



<?php
get_sidebar();
get_footer();