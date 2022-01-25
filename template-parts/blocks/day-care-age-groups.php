<?php

$title = trim( $data['title'] );
$description =  $data['description'] ;

$agegroups = [];
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
        $agegroups[] = $post;
    }


}

?>
<section class="text-image-part bottom-arrow-down bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 order-md-2">
          <div class="row">
            <?php
            if(!empty($agegroups)){
                foreach($agegroups as $agegroup){
                    $meta = get_post_meta($agegroup->ID,'ogr_data',true);
                    $bgcolor = ['red'=>'danger', 'green'=>'success','blue'=>'primary'];
                    $classes = ['red'=>'Nursery', 'green'=>'Preschool','blue'=>'Toddlers'];
                    $color = $meta['color'];
                    $image_url = ogr_get_image_url( $meta['icon_id'], 'full' );
                    $desc = $meta['desc'];
                    ?>
                    <div class="col-md-12 mb-2">
                      <div class="group-cards-wrapper border-<?php echo $bgcolor[$color]; ?> rounded bg-white p-3">
                        <div class="row align-items-center">
                          <div class="col-md-7">
                            <div class="group-cards-title">
                              <h4 class="heading-4 text-<?php echo $bgcolor[$color]; ?> font-bold"><?php echo $classes[$color]; ?></h4>
                          </div>
                          <div class="group-cards-pera about-min-h">
                              <p><?php echo $desc; ?></p>
                          </div>
                          <div class="group-cards-link">
                              <a class="text-<?php echo $bgcolor[$color]; ?> font-bold" href="<?php echo get_the_permalink($agegroup->ID ); ?>">Learn more ></a>
                          </div>
                      </div>
                      <div class="col-md-5">
                        <div class="group-cards-icon mt-2 mb-4 mx-5">
                         <?php if($image_url): ?>
                          <img src="<?php echo $image_url; ?>" alt="Icon">
                      <?php endif; ?>
                  </div>
              </div>
          </div>
          <div class="label-main bg-<?php echo $bgcolor[$color]; ?>">
              <h5 class="text-white"><?php echo $meta['age']; ?></h5>
              <p class="text-white">Years</p>
          </div>
      </div>
  </div>
  <?php
}
}
?>

</div>
</div>
<div class="col-md-6">
  <div class="text-wrapper pb-5 pb-md-0">
    <h2 class="heading-2 text-primary font-bold"><?php echo $title; ?></h2>
    <?php echo $description; ?>
</div>
</div>
</div>

</div>
</section>
</div>
<?php
