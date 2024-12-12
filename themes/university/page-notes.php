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


 if(!is_user_logged_in()){

  wp_redirect( site_url("/" ) );

  exit;
 }


get_header(); 
pageBanner(
  array(
    'title' =>"Your Notes",
    'subtitle' => "Log what's happening"
  )
);
?>

 
<div class="container py-4">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
   <div class="card shadow">
    <div class="card-body">
    <form>
  <div class="form-group">
    <label for="note-title">Title</label>
    <input type="text" class="form-control" id="note-title" 
    aria-describedby="titleHelp"  >
   </div>
   <div class="form-group">
    <label for="exampleFormControlTextarea1">Content</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
    </div>
   </div>
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

<div class="container mt-1">
 <div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
  <div class="card note">
    <div class="card-header d-flex justify-content-between align-items-center">
      <input 
      
        type="text" 
        class="form-control form-control-sm w-75 border-0 bg-white note-title" 
        placeholder="Note Title" 
        value="Sample Note Title"
         
        readonly
      />
      <div class="btn-group">
        <button class="btn btn-primary btn-sm edit-btn"  >Edit</button>
        <button class="btn btn-secondary btn-sm hidden cancel-btn"  >Cancel</button>
        
        <button class="btn btn-danger btn-sm  delete-btn"  >Delete</button>
      </div>
    </div>
    <div class="card-body">

    <input readonly
        type="text" 
        class="form-control form-control-sm w-75 border-0 bg-white note-content" 
        placeholder="Note Content" 
        value="Sample Note Title"
 
       value = "Sample note content goes here..."
       style="min-height: 100px; white-space: pre-wrap; overflow-y: auto;" 
      />


     

      <button class="mt-3 btn btn-success btn-sm hidden save-btn"  >Save</button>
    </div>
  </div>
  </div>
  <div class="col-md-1"></div>
 </div>
</div>



<?php
get_sidebar();
get_footer();