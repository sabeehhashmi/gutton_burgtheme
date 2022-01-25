<?php


$tag_line =  $data['tag_line'];
$description =  $data['description'];

$meta = get_post_meta( get_the_ID(),'ogr_data',true);
$bgcolor = ['red'=>'danger', 'green'=>'success','blue'=>'primary'];
$color = $meta['color'];
$image_url = ogr_get_image_url( $data['side_image_id'], 'full' );

?>
<section class="info-details bg-light py-5">
  <div class="container pt-0 pt-md-5">
    <div class="bg-<?php echo $bgcolor[$color]; ?> bg-info-details rounded p-0 p-md-5">
      <div class="row">
        <div class="col-md-7">
          <div class="info-details-text p-3">
            <h2 class="heading-2 text-white font-bold"><?php echo $tag_line; ?></h2>
            <p class="heading-4 font-bold text-white"><?php echo $description; ?></p>
          </div>
        </div>
      </div>
      <div class="list-img">
        <?php if($image_url): ?>
          <img src="<?php echo $image_url; ?>">
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>




