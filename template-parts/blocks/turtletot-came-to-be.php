<?php

if( empty( $child_blocks ) ) {
    return;
}
$title =  $data['title'];
$description =  $data['description'];



?>
<section class="text-image-part bg-light p-top-200 turtletot-came-to-be">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-7">
          <div class="text-image-inner bg-success-box">
            <div class="owl-carousel owl-theme web-slide-2 p-md-5">
             <?php foreach( $child_blocks as $child_block ) {

                $image = ogr_get_image( $child_block['attrs']['image_id'] );
                if( ! empty( $image ) ) {
                    $image_url = ogr_get_image_url( $child_block['attrs']['image_id'] );
                }

                ?>
                <div class="image-slide-item p-4 p-md-5">
                    <?php if($image_url): ?>
                        <img src="<?php echo $image_url; ?>">
                    <?php endif; ?>
                </div>
                <?php
            }
            ?>


        </div>
    </div>
</div>
<div class="col-md-5">
  <div class="text-wrapper pb-5 pb-md-0">
    <h2 class="heading-2 text-primary font-bold"><?php echo $title; ?></h2>
    <?php echo $description; ?>
</div>
</div>
</div>

</div>
</section>

<?php
$crousel_script = "jQuery(document).ready(function ($) {
    $('.web-slide-2').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        autoplay:true,
        nav: false,
        responsive:{
            0:{
                items:1
                },
                600:{
                    items:1
                    },
                    1000:{
                        items:1
                    }
                }
                });
            });";
            wp_add_inline_script('Turtletot-carousel', $crousel_script);

