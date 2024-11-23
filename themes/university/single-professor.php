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

	pageBanner( );

	?>

 

<div class="container mt-4">

	<div class="row">

		 

	<?php

 			$thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'professor_portrait');
		 
		?>


		<div class="col-md-<?php echo $thumbnail ?  '8':  '12'; ?> pt-4">
			<?php the_content( ); ?>
		</div>

		<?php 
		if($thumbnail){
			?>
				<div class="col-md-4">

				 
		 
				 
		 <img src="<?php echo $thumbnail; ?>" alt="<?php the_title();?>" class="img-thumbnail"/>
	 </div>
			<?php

		}
		?>

	

		<?php
		$programs = get_field('related_programs');
if($programs){
	?>

<div class="col-md-12">
			<hr>
		</div>
		<div class="col-md-12">

			<h3>Subjects taught</h3>

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