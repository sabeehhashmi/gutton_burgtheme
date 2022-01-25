<?php

if( empty( $child_blocks ) ) {
    return;
}

$jobs = [];
if(!empty($child_blocks)){
    foreach( $child_blocks as $child_block ) {
        $id = (int) $child_block['attrs']['id'];
        if( $id < 0 ) {
            continue;
        }
        $post = get_post( $id );
        if( empty( $post ) ) {
            continue;
        }
        $jobs[] = $post;
    }


}

?>
<div class="simple-card-wrapper p-top-200 bg-light ">
   <?php foreach( $jobs as $job ) {

    global $post;
    $data = ogr_get_data( $job->ID );

    $location = isset($data['location'])? trim( $data['location'] ):'';
    $location_link = isset($data['location_link'])? trim( $data['location_link'] ):'';
    $type_of_work = isset($data['type_of_work'])? trim( $data['type_of_work'] ):'';
    $post = get_post($job->ID);
    setup_postdata($post);
    $excerpt = trim(  substr(get_the_excerpt($post),0,100 ));

    $categories = wp_get_object_terms( $job->ID, 'job_category', [
        'hide_empty' => false,
    ] );

    ?>
    <section class="text-image-part p-career-z bg-light pb-4 ">
      <div class="container">
        <div class="bg-white border-primary rounded">
          <div class="row align-items-center">
            <div class="col-md-9">
              <div class="small-card p-4">
                <h2 class="text-info heading-2 font-bold"><?php echo get_the_title($job->ID); ?></h2>
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
                <a class="btn bg-primary text-white  font-bold" href="<?php echo get_the_permalink($job->ID); ?>">See job</a>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<?php wp_reset_postdata(); } ?>



</div>


