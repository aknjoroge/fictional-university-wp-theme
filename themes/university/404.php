<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>


<div class="page-banner">
	<div class="page-banner-image"
		style="background-image: url(<?php echo get_theme_file_uri( '/assets/images/library-hero.jpg' ) ?>)">
	</div>

	<div
		class=" d-flex  justify-content-end flex-column page-banner-content blog-page-banner-content text-center text-white py-5">
		<div class="text-left container">

			<h1>
				404
			</h1>

			<div class="row">

				<div class="col-md-12">
					<div class="alert alert-info width-fit-content " role="alert">
						<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wp-bootstrap-starter' ); ?>
					</div>
				</div>


			</div>

		</div>
	</div>
</div>

<div class="container py-5 ">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="text-left">
						<h5 class="mb-3">
							<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-bootstrap-starter' ); ?>
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




<?php
get_sidebar();
get_footer();