<?php

$related_posts = ogr_get_related_jobs( get_the_ID() );
/*if( empty( $related_posts ) ) {
    return;
}*/
$title = ogr_get_setting( 'general', 'blog', 'related_posts_title' );
?>

<div class="simple-card-wrapper p-top-200 bg-light">
    <section class="text-image-part p-career-z bg-light pb-5">
      <div class="container">
          <hr>
          <div class="row py-5">
              <div class="col-md-12 text-center">
                <h2 class="text-primary">Other jobs that may interest you</h2>
            </div>
        </div>
        <?php foreach( $related_posts as $post ): ogr_the_post( $post ); ?>

        <?php get_template_part( 'template-parts/loop-item-job' ); ?>

    <?php endforeach;
    wp_reset_postdata(); ?>

</div>
</section>
</div>


