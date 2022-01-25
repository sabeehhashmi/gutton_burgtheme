<?php

$data = ogr_get_data( get_the_ID() );

$school_type = isset($data['school_type'])? trim( $data['school_type'] ):'';
$excerpt = trim(  substr(get_the_excerpt(),0,100 ));

?>
<div class="col-md-4 mb-3 single-post-loop" >
  <a href="<?php the_permalink(); ?>">
    <div class="card border-primary">
      <div class="d-flex  justify-content-start">
        <div class="year-badge  bdage-success rounded-bottom text-center text-white px-3 py-2">
          <strong><?php echo $school_type; ?></strong>
        </div>
      </div>
      <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'large'); ?>" class="card-img-top" alt="...">
      <div class="card-body p-4">
        <small><?php the_time( 'F j Y' ); ?></small>
        <h5 class="card-title my-3 text-teal"><?php the_title(); ?></h5>
        <p class="card-text"><?php echo $excerpt; ?></p>

      </div>
    </div>
  </a>
</div>
