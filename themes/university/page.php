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

get_header(); ?>

<div class="page-banner">
  <div class="page-banner-image"
    style="background-image: url(<?php echo get_theme_file_uri( '/assets/images/ocean.jpg' ) ?>)">
  </div>

  <div
    class=" d-flex  justify-content-end flex-column page-banner-content inner-page-banner-content text-center text-white py-5">
    <div class="text-left container">

      <h1>Our History!</h1>
      <h3>Learn how the school of your dreams got started.</h3>
    </div>
  </div>


</div>

<div class="container py-5">
  <div class="row">
    <div class="col-md-9">

      <nav style="width: fit-content;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Library</li>
        </ol>
      </nav>


      <div>

        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus aliquid
        possimus,
        facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum odit nobis, consectetur dicta.
        Lorem
        ipsum dolor sit amet, consectetur adipisicing elit. Quos molestiae, tempora alias atque vero officiis sit
        commodi ipsa
        vitae impedit odio repellendus doloremque quibusdam quo, ea veniam, ad quod sed.

      </div>

    </div>
    <div class="col-md-3">
      <div class="parent-links">
        <h2 class="parent"><a href="#">About Us</a></h2>
        <ul>
          <li class="active"><a href=" #">Our History</a></li>
          <li><a href="#">Our Goals</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>






<?php
get_sidebar();
get_footer();