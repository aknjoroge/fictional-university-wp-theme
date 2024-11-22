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

	?>

<div class="page-banner">
	<div class="page-banner-image"
		style="background-image: url(<?php echo get_theme_file_uri( '/assets/images/ocean.jpg' ) ?>)">
	</div>

	<div
		class=" d-flex  justify-content-end flex-column page-banner-content blog-page-banner-content text-center text-white py-5">
		<div class="text-left container">

			<h1>
				<?php the_title(); ?>
			</h1>



		</div>
	</div>
</div>

<div class="container mt-4">

	<div class="row">

		<div class="col-md-12">
			<nav style="width: fit-content;" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link( 'event' ); ?>">
							Events Home
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

		<?php
		$programs = get_field('related_programs');
if($programs){
	?>

<div class="col-md-12">
			<hr>
		</div>
		<div class="col-md-12">

			<h3>Related programs</h3>

			<div class="row mt-3">

			<?php			
			foreach($programs as $program){
				?>
			<div class="col-md-4">
				<a href="<?php echo get_the_permalink($program); ?>">
					<div class="card mb-2">
						<div class="card-body">
							<h6 class="m-0 p-0">
								<?php echo get_the_title( $program ); ?>
							</h6>
						</div>
					</div>
				</a>
			</div>
			<?php
			}
			?>

			</div>

			
		</div>
	<?php

}
		?>



	</div>



</div>

<?php

}

get_sidebar();
get_footer();

?>