<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */


 get_template_part( 'footer-widget' );
?>

<div id="searchModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="searchModal"
	aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><b>What are you looking for?</b></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input placeholder="Type here..." class="form-control" type="text" name="searchField" id="searchField">


				<hr class="mb-2">

				<div class="row" id="search-results">


				</div>



			</div>

		</div>
	</div>
</div>

<footer class="text-dark pt-5 site-footer">

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
				<a href="<?php echo esc_url( home_url( '/' )); ?>">
					<img src="<?php echo esc_url(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>"
						alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				</a>
				<?php else : ?>
				<a class="" href="<?php echo esc_url( home_url( '/' )); ?>">
					<h3>
						<?php esc_url(bloginfo('name')); ?>
					</h3>
				</a>
				<?php endif; ?>

				<p><a href="#">555.555.5555</a></p>
			</div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-6">
						<h3>Explore</h3>
						<?php
						
						wp_nav_menu( array(
							'theme_location'=>'footer-explore'
						) );
						?>

					</div>
					<div class="col-md-6">
						<h3>Learn</h3>
						<?php
						
						wp_nav_menu( array(
							'theme_location'=>'footer-learn'
						) );
						?>
					</div>
				</div>
			</div>
			<div class="col-md-3">

				<h3>Connect With Us</h3>

				<nav class="footer-socials">
					<ul>
						<li>
							<a href=" #"><i class="fab fa-facebook-square" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="#"><i class="fab fa-youtube" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
						</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>

	<div class="container pt-3 pb-3">
		<div class="site-info">
			&copy;
			<?php echo date('Y'); ?>
			<?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?>



		</div>
	</div>



</footer>







<?php wp_footer(); ?>
</body>

</html>