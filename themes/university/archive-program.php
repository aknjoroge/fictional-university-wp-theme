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
	'title'=> 'All Programs',
	'photo' => get_theme_file_uri( '/assets/images/library-hero.jpg' )
));
?>


 

<div class="container py-4">
	<div class="row">

		<?php
	while(have_posts(  )){
		the_post(  );

		?>

		<div class="col-md-6 my-2">
			<a href="<?php the_permalink(  ); ?>">

				<div class="card ">
	
					<div class="card-body">
	
						<div class="card-title m-0 p-0">
							<h5 class="m-0 p-0">
								<?php the_title( );?>
							</h5>
						</div>
	 
						 
						 
	
					</div>
				</div>
			</a>



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