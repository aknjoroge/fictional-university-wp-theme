<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); 


while(have_posts()){
	the_post();
	 

	pageBanner(  );

	?>




<div class="container mt-4">

	<div class="row">

		<div class="col-md-12">
			<nav style="width: fit-content;" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url('/campus' ); ?>">
							Campus Home
						</a></li>
					<li class="breadcrumb-item active" aria-current="page">
						<?php  the_title(); ?>
					</li>
				</ol>
			</nav>


		</div>


		<div class="col-md-12">
			<?php the_content( ); ?>
		</div>

		<div class="col-md-12">
			<div class="acf-map" data-zoom="16">

				<?php
		$location = get_field('location');
		$lat = $location['lat'];
		$lng = $location['lng'];
		if(isset($location)){
		?>
				<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>"
					data-lng="<?php echo esc_attr($location['lng']); ?>">
					<p>
						<?php the_title(); ?>
					</p>
				</div>
				<?php
		}		 
		?>

			</div>
		</div>

		<div class="col-md-12">


		<?php


		$programQueryFilters = array(
			'post_type' =>'program',
			'posts_per_page' => -1,
			'order' =>'ASC',
			 
			'meta_query' => array(
				array(
					'key' => 'where_taught',
					'value' => '"'. get_the_ID() .'"',
					'compare' => 'LIKE',
					// 'type' => 'NUMERIC'
				)
			)
		);
		$programData = new WP_Query($programQueryFilters);

		if( $programData -> have_posts(  )){
			?>

			<hr>
			<h4 class="mb-3 text-left font-weight-normal mb-1"> Programs available at this campus </h4>

		<div class="row">

		<?php

		while ($programData -> have_posts(  )) {
			$programData->the_post();


			?>

		<div class="col-md-3  ">

						<div class="card">
							
							<div class="card-body">
								<h5 class="card-title m-0"><a href="<?php  the_permalink( );  ?>">
										<?php the_title( ); ?>
									</a></h5>


							</div>
						</div>

					</div>

<?php



		}

		}

		wp_reset_postdata(  );

			?>
		</div>



			
		</div>

	</div>

</div>

<?php

}

get_sidebar();
get_footer();

?>