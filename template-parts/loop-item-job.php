<?php

$data = ogr_get_data( get_the_ID() );

$location = isset($data['location'])? trim( $data['location'] ):'';
$location_link = isset($data['location_link'])? trim( $data['location_link'] ):'';
$type_of_work = isset($data['type_of_work'])? trim( $data['type_of_work'] ):'';
$excerpt = trim(  substr(get_the_excerpt(),0,100 ));
$categories = wp_get_object_terms( get_the_ID(), 'job_category', [
    'hide_empty' => false,
] );
?>

<div class="bg-white border-primary rounded">
  <div class="row align-items-center">
    <div class="col-md-9">
      <div class="small-card p-4">
        <h2 class="text-info heading-2 font-bold"><?php the_title(); ?></h2>
        <ul class="m-0 p-0 d-flex flex-wrap">
            <?php
            if(!empty($categories)):
                foreach($categories as $category):
                    ?>
                    <li>
                        <a href="#"><?php echo $category->name; ?> </a>
                    </li>
                    <?php break; endforeach; endif; ?>
                    <li>
                        <a href="<?php echo $location_link; ?>"><?php echo $location; ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $type_of_work; ?></a>
                    </li>
                </ul>
                <p><?php echo $excerpt; ?></p>
            </div>
        </div>
        <div class="col-md-3">
          <div class="d-flex justify-content-center justify-content-md-end mt-3 mt-md-0 mx-3 pb-4 pb-md-0">
            <a class="btn bg-primary text-white  font-bold" href="<?php the_permalink(); ?>">See job</a>
        </div>
    </div>
</div>
</div>
