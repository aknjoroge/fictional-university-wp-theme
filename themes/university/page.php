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
pageBanner();
?>

 
<div class="container py-5">
  <div class="row">

    <?php
    $parentId = wp_get_post_parent_id(get_the_ID());

    $hasChildren = get_pages( array(
      'child_of' =>  get_the_ID()
    )  );

    if($parentId or $hasChildren){
        $show_relation_menu = true;
    }   

    ?>

    <div class="col-md-<?php echo $show_relation_menu ? '9':'12' ?>">

      <?php
      if($parentId){
        ?>

      <nav style="width: fit-content;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo get_the_permalink($parentId ); ?>">
              <?php echo get_the_title($parentId); ?>
            </a></li>
          <li class="breadcrumb-item active" aria-current="page">
            <?php the_title(); ?>
          </li>
        </ol>
      </nav>
      <?php       
      }; 
      ?>

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

    <?php
    if (isset($show_relation_menu)) {
      ?>

    <div class="col-md-3">
      <div class="parent-links">
        <h2 class="parent"><a href="<?php echo get_the_permalink($parentId  ); ?>">
            <?php 
          echo get_the_title( $parentId )
          ?>
          </a></h2>
        <ul>
          <?php 

          if ($parentId) {
            $child_of = $parentId;
            
          }else{
            $child_of = get_the_ID();
          }

          $child_page_options = array(
            'title_li' => NULL,
            'child_of' => $child_of,
            'sort_column' =>'order_menu'

          );
        
          wp_list_pages($child_page_options);
          ?>

        </ul>
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