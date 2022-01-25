<?php

$title = trim( $data['title'] );
$sub_title = $data['sub_title'];
$bg_image = ogr_get_image( $data['image_id'] );





if( ! empty( $bg_image ) ) {
    $bg_image_url = ogr_get_image_url( $data['image_id'] );
}
?>
<div class="hero-section d-flex align-items-end" style="background-image: url(<?php echo $bg_image_url; ?>);">
    <div class="container group-top-150">
      <!-- Age Group Banner cards -->
      <section class="group-cards border-primary contact-card-bg bg-white rounded py-5">
        <div class="row">
          <div class="col-md-7">
            <div class="about-card-text px-3 px-md-5">
              <h5 class="heading-5 font-bold"><?php echo $sub_title; ?></h5>
              <h2 class="heading-2 text-primary font-bold"><?php echo $title; ?></h2>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
<?php
