<?php

$title = trim( $data['title'] );
$description = trim( $data['description'] );
$feature_title = trim( $data['feature_title'] );
$button_text = trim( $data['button_text'] );
$button_url = trim( $data['button_url'] );
$side_image = ogr_get_image( $data['side_image_id'] );



$has_button = ( '' !== $button_text && '' !== $button_url );
$has_content = ( '' !== $title || $has_button );
$has_media = ( ! empty( $bg_image ) || ! empty( $bg_video ) );

if( ! $has_content && ! $has_media ) {
    return;
}

if( ! empty( $side_image ) ) {
    $side_image_url = ogr_get_image_url( $data['side_image_id'] );
}
?>
<section class="text-image-part bg-light p-top-200">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-7">
          <div class="text-image-inner">
            <?php if($side_image_url): ?>
                <img src="<?php echo $side_image_url; ?>" alt="Image 1">
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-5">
      <div class="text-wrapper pb-5 pb-md-0">
        <h2 class="heading-2 text-primary font-bold"><?php echo $title; ?></h2>
        <p><?php echo $description; ?></p>
        <a class="btn btn-primary text-white font-bold" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
    </div>
</div>
</div>
<!-- simple-cards-section -->
<section class="simple-cards-section pb-5">
    <div class="container">
      <div class="bg-white rounded py-3 px-3 px-md-5">
        <h2 class="heading-2 py-3 text-primary font-bold"><?php echo $feature_title; ?></h2>
        <div class="row">
            <?php if(!empty($child_blocks)){ foreach( $child_blocks as $child_block ) {
                $title =  $child_block['attrs']['title'];
                $description =  $child_block['attrs']['description'];

                $icon = $child_block['attrs']['image_url'] ;
                ?>
                <div class="col-md-4 mb-3">
                  <div class="simple-cards-wrapper">
                      <div class="simple-cards-icon">
                         <?php if($icon): ?>
                          <img src="<?php echo $icon; ?>" alt="Bed">
                      <?php endif; ?>
                      </div>
                      <div class="simple-cards-title font-bold my-2">
                          <h4 class="text-primary font-bold"><?php echo $title; ?></h4>
                      </div>
                      <div class="simple-cards-pera">
                          <p><?php echo $description; ?></p>
                      </div>
                  </div>
              </div>
          <?php }
      } ?>


  </div>
  <a class="btn btn-primary text-white btn--lagre mb-4 px-3 py-1" href="/contact-us/">Get in touch</a>
</div>
</div>
</section>
</div>
</section>
<?php
