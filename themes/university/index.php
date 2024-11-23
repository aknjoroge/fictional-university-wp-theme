<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); 

pageBanner(array(
	'title'=> 'Welcome to our blog!',
	'subtitle' => 'Keep up with our latest news'
));

?>

<div class="mt-4 container">
	<div class="row">

	<?php
 
while(have_posts( )){
the_post();

?>

<div class="col-md-6 p-3">
<div class="card blog-item"  >
  <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
  <div class="card-body">
    <h5 class="card-title"><?php the_title( ) ?></h5>
	<div class="card-text">
	<div class="alert alert-warning" role="alert">
 Posted by <?php the_author_posts_link( ); ?> on <?php the_time('j/m/y'  ); ?> in <?php  the_category( ', ');?>
</div>
		<?php echo wp_trim_words( get_the_content(), 18 ); ?>
	</div>
     <a href="<?php the_permalink( ); ?>" class="mt-2 btn btn-primary">Read More</a>
  </div>
</div>

	 
</div>


<?php



}

?>

	</div>
</div>


<div class="container mt-3">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 text-center">
			<?php echo paginate_links(  ); ?>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>









<?php
get_sidebar();
get_footer();