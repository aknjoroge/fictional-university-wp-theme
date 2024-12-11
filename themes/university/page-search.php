<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); 

 

pageBanner(
  array(
    'title'=>'What are you looking for?',
    'photo' => get_theme_file_uri( '/assets/images/library-hero.jpg' ),
    
  )
);
?>

 
<div class="container  my-4">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow">
				<div class="card-body">
					<div class="text-left">
						 

						<?php get_search_form(); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
get_sidebar();
get_footer();