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
		 
		
		<?php the_content( ); 

		$hasLiked = false;

		$allLikes = new WP_Query(array(
			'post_type'=> 'like',
			'meta_query' => array(
				array(
					'key' => 'professor_id',
					'compare' => '=',
					'value' =>  get_the_ID()
				)
			)
 		));


		if(is_user_logged_in(  )){

			$userLike = new WP_Query(array(
				'post_type'=> 'like',
				'meta_query' => array(
					array(
						'key' => 'professor_id',
						'value' => get_the_ID(),
						'compare' => '=',
						'type' => 'NUMERIC'
					)
				),
				'author' => get_current_user_id()
			));

			if($userLike->found_posts){
				$hasLiked = true;
			}

		}

	 
		?>
		<div class="text-right heart-container ">
		<span id="heart" data-status="<?php echo $hasLiked? 'active':'' ?>" data-id="<?php the_ID(); ?>" class="heart badge badge-light <?php echo $hasLiked? 'active':'' ?> ">	
		<span id="like-count" data-total="<?php echo $allLikes->found_posts; ?>" class="mr-1"><?php echo $allLikes->found_posts; ?></span><i class="fa fa-heart" aria-hidden="true"></i>
	    </span>
		</div>
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