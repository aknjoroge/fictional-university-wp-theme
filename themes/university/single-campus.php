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

	</div>



</div>

<?php

}

get_sidebar();
get_footer();

?>