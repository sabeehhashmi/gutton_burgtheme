<?php

$title =  $data['title'];
$description =  $data['description'];

$image = ogr_get_image( $data['image_id'] );
if( ! empty( $image ) ) {
  $image_url = ogr_get_image_url( $data['image_id'] );
}

?>

<section class="text-image-part bottom-arrow-top bg-light ">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7">
        <div class="text-image-inner bg-orange-box p-5">
          <?php if($image_url): ?>
            <img class="p-5" src="<?php echo $image_url; ?>">
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-5">
        <div class="text-wrapper pb-5 pb-md-0">
          <h2 class="heading-2 text-primary font-bold"><?php echo $title; ?>
        </h2>
        <?php echo $description; ?>
      </div>
    </div>
  </div>

</div>
</section>
<?php
