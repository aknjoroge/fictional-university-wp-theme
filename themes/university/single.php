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
	function metaData(){
		?>
		<div class="alert alert-info width-fit-content " role="alert"> Posted by <?php the_author_posts_link( ); ?> on <?php the_time('j/m/y'  ); ?> in <?php  the_category( ', ');?> </div>
		<?php
	}

	pageBanner( array(	
		'callback' => 'metaData'
	) );

	?>

 
 

<div class="container mt-4">

	<div class="row">

		<div class="col-md-12">
			<nav style="width: fit-content;" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo site_url('/blogs' ); ?>">
							Blog Home
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

	</div>



</div>

<?php

}

get_sidebar();
get_footer();

?>