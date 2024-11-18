<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
				<?php the_archive_title(); ?>
			</h1>

			<div class="row">

				<?php 

				if(get_the_archive_description(  )){

					?>

				<div class="col-md-12">
					<div class="alert alert-info width-fit-content " role="alert">
						<?php echo the_archive_description(); ?>
					</div>
				</div>
				<?php

				};

				?>


			</div>

		</div>
	</div>
</div>

<section id="primary" class="content-area col-sm-12 col-lg-8">
	<div id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
		</header><!-- .page-header -->

		<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

	</div><!-- #main -->
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();