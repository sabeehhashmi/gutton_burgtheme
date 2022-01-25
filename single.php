<?php get_header(); ?>
<main class="page-main">
    <div class="container">
        <?php while( have_posts() ): the_post();
            $data = ogr_get_data( get_the_ID() );

            $school_type = isset($data['school_type'])? trim( $data['school_type'] ):'';
            $post_privacy_type = isset($data['post_privacy_type'])? trim( $data['post_privacy_type'] ):'';
            $show_waitlist_banner = ogr_get_setting( 'general', 'blog', 'show_waitlist_banner' );
            $banner_title = ogr_get_setting( 'general', 'blog', 'banner_title' );
            $banner_subtitle = ogr_get_setting( 'general', 'blog', 'banner_subtitle' );
            $button_text = ogr_get_setting( 'general', 'blog', 'button_text' );
            $button_url = ogr_get_setting( 'general', 'blog', 'button_url' );
                ?>
                <section class="bread sec-layout py-5 bg-light">
                 <div class="container">
                   <div class="row ">
                     <div class="col-12">
                       <small><a href="/blog"> Blog </a>/ <strong><?php the_title(); ?></strong></small>
                       <hr>
                   </div>
               </div>
           </div>
       </section>


       <section class="sec-layout mt-3">
         <div class="container">
           <div class="row text-center">
             <div class="col-md-6 offset-md-3">
               <span class="badge bdage-success p-3 ">
                 <?php echo $school_type; ?>
             </span>
             <br><br>
             <small class="mb-4"><?php the_time( 'F j Y' ); ?>,</small>
             <br>
             <h1 class="text-teal"><?php the_title(); ?></h1>
         </div>
     </div>
 </div>
</section>


<section class="sec-layout single-blog-banner-bg my-5">
 <div class="container">
    <div class="row">
      <div class="col-10 offset-1 text-center">
        <?php if( has_post_thumbnail() ): ?>

         <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>" class="img-fluid">

     <?php endif; ?>

 </div>
</div>
</div>
</section>



<section class="sec-layout mb-5">
 <div class="container">
   <div class="row">
     <div class="col-md-8 offset-md-2">
       <?php the_content(); ?>




   </div>
</div>
</div>
</section>




<?php get_template_part( 'template-parts/related-posts' ); ?>


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

<?php
endif;

endwhile;
wp_reset_postdata(); ?>
</div>
</main><!-- / Page Main -->
<?php get_footer();
