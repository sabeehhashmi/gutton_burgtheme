<?php

$title = trim( $data['title'] );
$sub_title = $data['sub_title'];
$button_text = trim( $data['button_text'] );
$button_url = trim( $data['button_url'] );
$bg_image = ogr_get_image( $data['bg_image'] );

if( ! empty( $bg_image ) ) {
    $bg_image_url = ogr_get_image_url( $data['bg_image'] );
}

?>
<section class="wish-list bg-light py-5">
    <div class="container">
      <div class="bg-primary rounded bg-2 bg-orange-box-after px-5 py-3">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="wish-list-text px-4">
              <h2 class="heading-2 font-bold text-white m-0"><?php echo $title; ?></h2>
              <p class="text-white font-bold m-0"><?php echo $sub_title; ?></p>
            </div>

          </div>
          <div class="col-md-4">
            <div class="d-flex justify-content-center justify-content-md-end mt-3 mt-md-0">
              <a class="btn bg-white text-primary font-bold" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
<?php
