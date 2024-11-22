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

	?>

<div class="page-banner">
	<div class="page-banner-image"
		style="background-image: url(<?php echo get_theme_file_uri( '/assets/images/ocean.jpg' ) ?>)">
	</div>

	<div
		class=" d-flex  justify-content-end flex-column page-banner-content blog-page-banner-content text-center text-white py-5">
		<div class="text-left container">

			<h1>
				<?php the_title(); ?>
			</h1>



		</div>
	</div>
</div>

<div class="container mt-4">

	<div class="row">

		<div class="col-md-12">
			<nav style="width: fit-content;" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link( 'program' ); ?>">
							Programs Home
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


		<?php

 
$professorsQueryFilters = array(
	'post_type' =>'professor',
	'posts_per_page' => -1,
	'orderby' => 'title' ,
	'meta_query' => array(
		array(
			'key' => 'related_programs',
			'value' => '"'. get_the_ID() .'"',
			'compare' => 'LIKE',
			// 'type' => 'NUMERIC'
		)
	)
);
$professorData = new WP_Query($professorsQueryFilters);

if($professorData-> have_posts(  )){

?>

<div class="col-md-12">
	<hr>
	<h4 class="mb-3 text-left font-weight-normal mb-1"><?php the_title();?> professors </h4>
	<div class="row"   >
		<?php
	 
			while($professorData -> have_posts(  )){
				$professorData -> the_post(  );
				$eventDate = new DateTime(get_field('event_date'));
				?>

		<div class="col-md-3  ">

		<div class="card"  >
		<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title();?>" class="card-img-top img-thumbnail"/>
   <div class="card-body">
   <h5 class="card-title"><a href="<?php the_permalink(  ); ?>">
							<?php the_title(); ?>
						</a></h5>
    
      
  </div>
</div>
		 
		</div>
		<?php
			}
		?>
	</div>
</div>
<?php
}

wp_reset_postdata();  
?>

		

		<?php

		$today = date('Ymd');
		$eventQueryFilters = array(
			'post_type' =>'event',
			'posts_per_page' => 2,
			'order' =>'ASC',
			'orderby' => 'meta_value_num' ,
			'meta_key' => 'event_date',
			'meta_type' => 'NUMERIC',
			'meta_query' => array(
				array(
					'key' => 'event_date',
					'value' => $today,
					'compare' => '>=',
					'type' => 'NUMERIC'
				),
				array(
					'key' => 'related_programs',
					'value' => '"'. get_the_ID() .'"',
					'compare' => 'LIKE',
					// 'type' => 'NUMERIC'
				)
			)
		);
$eventData = new WP_Query($eventQueryFilters);

if($eventData-> have_posts(  )){

	?>

		<div class="col-md-12">
			<hr>
			<h4 class="text-left font-weight-normal mb-1">Related Events</h4>
			<div class="row">
				<?php
               
                    while($eventData -> have_posts(  )){
                        $eventData -> the_post(  );
                        $eventDate = new DateTime(get_field('event_date'));
                        ?>
				<div class="col-md-6 p-4">
					<div class="row shadow-sm   rounded">
						<div class="col-md-3">
							<div class="event-date">

								<span class="month">
									<?php echo $eventDate->format('M'); ?>
								</span>
								<span class="day">
									<?php echo $eventDate->format('d'); ?>
								</span>
								<!-- <span><?php echo $eventDate->format('y'); ?></span> -->
							</div>

						</div>
						<div class="col-md-9">
							<h5><a href="<?php the_permalink(  ); ?>">
									<?php the_title(); ?>
								</a></h5>
							<p>
								<?php 
							if(has_excerpt()){
								echo get_the_excerpt();
	
							} else {
								echo wp_trim_words( get_the_content (), 10  );
							}
							 ?>
								<a href="<?php the_permalink(  ); ?>" class="nu gray">Learn more</a>
							</p>
						</div>
					</div>
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