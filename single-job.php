<?php get_header(); ?>

<section class="bread sec-layout py-5 bg-light">
   <div class="container">
     <div class="row ">
       <div class="col-12">
        <small><a href="/employment">Careers</a> / <strong><?php echo get_the_title(); ?></strong></small>
        <hr>
    </div>
</div>
</div>
</section>

<?php while( have_posts() ): the_post();

    $job_shortcode = ogr_get_setting( 'general', 'job', 'job-short-code' );

    ?>
    <section class="sec-layout bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <div class="col-md-11">
                <small> <?php the_time( 'F j Y' ); ?></small>
                <h1 class="my-4 text-primary"><?php echo get_the_title(  ); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
        <div class="col-md-5">
           <div class="card card-shadow border-primary">
              <div class="card-header bg-primary text-white py-3 px-5">
                <h5>Apply Now</h5>
            </div>
            <div class="card-body main-contact py-5 px-5">
              <div class="apply-job-form">
                <?php echo do_shortcode($job_shortcode ); ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</section>

<?php endwhile;

wp_reset_postdata(); ?>


<!-- simple card -->
<?php get_template_part( 'template-parts/related-jobs' ); ?>


<?php get_footer();
