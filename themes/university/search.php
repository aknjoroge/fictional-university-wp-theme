<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); 

pageBanner(array(
	'title'=>  'Search Results for: '. get_search_query().' ',
	 
	'photo' => get_theme_file_uri( '/assets/images/library-hero.jpg' )
));

?>

 

<div class="container  my-4">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow">
				<div class="card-body">
					<div class="text-left">
						<h5 class="mb-3">
							<?php esc_html_e( 'You searched for', 'wp-bootstrap-starter' ); ?>
						</h5>

						<?php
								get_search_form();
		
		
							?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container " >
	<div class="row">

	<?php
	while(have_posts(  )){
		the_post(  );
		?>

<div class="col-md-6 mb-3">
	<div class="card">
		<div class="card-body">

			<h5> <?php the_title( ); ?> </h5>
			<p>
				<?php echo wp_trim_words( get_the_content(), 18 ); ?>
			</p>
			<a href="<?php  the_permalink(  ); ?>">View</a>
		</div>
	</div>

</div>


		<?php


	}
	
	?>

		
	</div>
</div>

 

<?php
get_sidebar();
get_footer();
