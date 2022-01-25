<?php

if( empty( $child_blocks ) ) {
  return;
}

$title =  $data['title'];
$meta = get_post_meta( get_the_ID(),'ogr_data',true);
$bgcolor = ['red'=>'danger', 'green'=>'success','blue'=>'primary'];
$color = $meta['color'];
?>
<section class="text-image-part bg-light p-top-200">
  <div class="container">
    <h2 class="text-<?php echo $bgcolor[$color]; ?> heading-2 font-bold text-center"><?php echo $title; ?></h2>
    <div class="row align-items-center py-3">
      <?php foreach( $child_blocks as $child_block ) {

        $image = ogr_get_image( $child_block['attrs']['icon_id'] );
        $image_url = '';
        if( ! empty( $image ) ) {
          $image_url = ogr_get_image_url( $child_block['attrs']['icon_id'] );

        }
        $title =  $child_block['attrs']['title'];
        $description =  $child_block['attrs']['description'];
        ?>
        <div class="col-md-3 mb-3 mb-md-0">
          <div class="group-cards-main px-2">
            <div class="group-cards-icon mx-3">
              <?php if($image_url): ?>
                <img src="<?php echo $image_url; ?>">
              <?php endif; ?>
            </div>
          </div>
          <div class="groups-<?php echo $bgcolor[$color]; ?>-text px-3">
            <h3 class="font-bold text-<?php echo $bgcolor[$color]; ?> heading-4"><?php echo $title; ?></h3>
            <p><?php echo $description; ?></p>
          </div>

        </div>
      <?php } ?>



    </div>

  </div>
</section>

