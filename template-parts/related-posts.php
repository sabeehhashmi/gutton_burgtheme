<?php

$related_posts = ogr_get_related_posts( get_the_ID() );
/*if( empty( $related_posts ) ) {
    return;
}*/
$title = ogr_get_setting( 'general', 'blog', 'related_posts_title' );
?>
<section class="sec-layout py-5">
  <div class="container">
     <hr>
     <div class="row">
      <div class="col-12 my-5">
          <h2 class="text-primary "><?php echo $title; ?></h2>
      </div>
  </div>
  <div class="row">

    <?php foreach( $related_posts as $post ): ogr_the_post( $post ); ?>

        <?php get_template_part( 'template-parts/loop-item' ); ?>

    <?php endforeach;
    wp_reset_postdata(); ?>



</div>
</div>
</section>

