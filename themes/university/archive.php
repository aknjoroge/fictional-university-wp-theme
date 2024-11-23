<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); 


function metaData(){
	if(get_the_archive_description(  )){

		?>
	
	<div class="col-md-12">
		<div class="alert alert-info width-fit-content " role="alert">
			<?php echo the_archive_description(); ?>
		</div>
	</div>
	<?php
	
	};
}

 

pageBanner( array(	
	'title' => get_the_archive_title(),
	'callback' => 'metaData',
	'photo' => get_theme_file_uri( '/assets/images/library-hero.jpg' )
	
) );

?>


 

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