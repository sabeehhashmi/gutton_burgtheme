<?php get_header();
global $wp_query,$post;

$show_waitlist_banner = ogr_get_setting( 'general', 'blog', 'show_waitlist_banner' );
$banner_title = ogr_get_setting( 'general', 'blog', 'banner_title' );
$blog_page_heading = ogr_get_setting( 'general', 'blog', 'blog_page_heading' );
$banner_subtitle = ogr_get_setting( 'general', 'blog', 'banner_subtitle' );
$button_text = ogr_get_setting( 'general', 'blog', 'button_text' );
$button_url = ogr_get_setting( 'general', 'blog', 'button_url' );
?>
<div class="hero-section blog-hero d-flex align-items-end" style="background-image: url(<?php echo get_template_directory_uri(); ?>/turtletot-assets/images/blog/blog-bread-bg.png);">
  <div class="container group-top-150">
    <!-- Age Group Banner cards -->
    <section class="group-cards border-primary contact-card-bg bg-white rounded py-5">
      <div class="row">
        <div class="col-md-7">
          <div class="about-card-text px-3 px-md-5">
            <h2 class="heading-2 text-primary font-bold"><?php echo $blog_page_heading ; ?></h2>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<section class="bread sec-layout py-5 bg-light">
 <div class="container group-top-150">
   <div class="row ">
     <div class="col-12">
       <small>Blog /</small>
       <hr>
     </div>
   </div>
 </div>
</section>

<?php
while (have_posts()) : the_post();
  $data = ogr_get_data( get_the_ID() );
  $school_type = isset($data['school_type'])? trim( $data['school_type'] ):'';
  ?>
  <section class="sec-layout pb-5">
   <div class="container group-top-150">
    <div class="row">
      <div class="col-12">
        <h2 class="text-primary mb-4">Latest Articles</h2>
      </div>
    </div>
    <a href="<?php the_permalink(); ?>" class="card border-primary">
     <div class="row ">
      <div class="col-md-6">
        <div class="d-flex d-md-none  justify-content-start">

        </div>
        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" class=" img-fluid">
      </div>
       <div class="col-md-6">
        <div class="d-none d-md-flex flex-row ms-3">

       </div>
       <div class="blog-detail py-3 px-3">
        <small><?php the_time( 'F j Y' ); ?></small>
        <span class="text-teal my-3"> <h2 class="text-teal"><?php the_title(); ?></h2> </span>
        <p style="width: 80%;" class="text-muted"><?php echo trim(  substr(get_the_excerpt(),0,200 )); ?></p>
      </div>
    </div>
  </div>
</a>
</section>

<?php break; endwhile; ?>

<!-- <section class="sec-layout pb-5">
  <div class="container group-top-150">
   <div class="row">
    <div class="col-md-12 mb-4">
      <h2 class="text-primary ">More Articles</h2>
    </div>
    <div class="col-md-1 me-2 bg-primary text-center text-white p-3 rounded-start d-none d-md-block">
      <strong>Filters</strong>
    </div>
    <div class="col-md-10 card border-primary width-100">
     <div class="dropdown p-3">
      <a class="dropdown-toggle text-primary " href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
       All Categories
     </a>

     <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <li><a class="dropdown-item" href="#">Categories 1</a></li>
      <li><a class="dropdown-item" href="#">Categories 2</a></li>
      <li><a class="dropdown-item" href="#">Categories 3</a></li>
    </ul>
  </div>
</div>
</div>
</div>
</section> -->
<section class="sec-layout pb-5">
  <div class="container group-top-150">
   <div class="row">
    <div class="col-md-12 mb-4">
      <h2 class="text-primary ">More Articles</h2>
    </div>
  </div>
</div>
</section>


<section class="sec-layout pb-5">
  <div class="container group-top-150">
   <div class="row">
    <?php while (have_posts()) : the_post();

      $data = ogr_get_data( get_the_ID() );
      $school_type = isset($data['school_type'])? trim( $data['school_type'] ):''; ?>
      <div class="col-md-4 mb-3 single-post-loop">
        <a href="<?php the_permalink(); ?>">
          <div class="card border-primary  blog-single-post">

           <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" class="card-img-top" alt="...">
           <div class="card-body p-4">
            <small><?php the_time( 'F j Y' ); ?></small>

            <h5 class="card-title my-3 text-teal"><?php the_title(); ?></h5>
            <p class="card-text"><?php echo trim(  substr(get_the_excerpt(),0,200 )); ?></p>

          </div>
        </div>
      </a>
    </div>
  <?php  endwhile; ?>






  <div class="col-12 paginaation-areatext-center pt-5">

    <div class="btn-wrap">
      <a class="btn bg-primary text-white font-bold" href="#">Load More</a>
    </div>
  </div>




</div>
</div>
</section>

<!-- wish list -->

<?php wp_reset_postdata(); ?>
<?php if($show_waitlist_banner): ?>
  <section class="wish-list bg-light py-5">
    <div class="container ">
      <div class="bg-primary rounded bg-2 bg-orange-box-after px-5 py-3">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="wish-list-text px-4">
              <h2 class="heading-2 font-bold text-white m-0"><?php echo $banner_title; ?></h2>
              <p class="text-white font-bold m-0"><?php echo $banner_subtitle; ?></p>
            </div>

          </div>
          <div class="col-md-4">
            <div class="d-flex justify-content-center justify-content-md-end mt-3 mt-md-0">
              <a class="btn bg-white text-primary font-bold" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
<?php endif;
$crousel_script = "jQuery(document).ready(function ($) {
  $(document).on('click','.single-post-loop',function(e){
    url=$(this).data('url');
    window.location.replace(url);
    });
  });";
  wp_add_inline_script('Turtletot-cutom-js', $crousel_script);
  get_footer();
