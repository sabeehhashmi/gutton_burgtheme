<?php

$title = trim( $data['title'] );
$description = $data['description'];
$button_text = trim( $data['button_text'] );
$button_url = trim( $data['button_url'] );
$side_image = ogr_get_image( $data['side_image_id'] );
$section_logo = ogr_get_image( $data['section_logo_id'] );




if( ! empty( $side_image ) ) {
    $side_image_url = ogr_get_image_url( $data['side_image_id'] );
}
if( ! empty( $section_logo ) ) {
    $section_logo_url = ogr_get_image_url( $data['section_logo_id'] );
}
?>
<section class="kids-info py-5 bg-light">
    <div class="container">
      <div class="boder-danger-img border-primary-img">
        <div class="row align-items-center px-3 py-3 py-md-0">
          <div class="col-md-7">
            <div class="kids-wrapper">
              <div class="kids-logo">
                <?php if($section_logo_url): ?>
                <img src="<?php echo $section_logo_url; ?>" alt="Kids Logo">
              <?php endif; ?>
            </div>
            <div class="kids-title">
                <h2 class="heading-2 text-primary font-bold py-3"><?php echo $title; ?>
              </h2>
              <p><?php echo $description; ?></p>
              <a class="btn btn-primary text-white btn--lagre mb-4 px-3 py-1" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
          </div>
      </div>
  </div>
  <div class="col-md-5">
    <div class="mobile-big">
      <img src="<?php echo $side_image_url; ?>" alt="Phone">
      <div class="orange-box">
        <img src="<?php echo ONEGROUP_URI . 'turtletot-assets/images/orange-box-1.png'; ?>">
    </div>
</div>
</div>
</div>
</div>
</div>
</section>
<?php
