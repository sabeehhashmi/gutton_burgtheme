<?php

if( empty( $child_blocks ) ) {
    return;
}
$title =  $data['title'];



?>
<section class="slider-cards bg-light parents-card-slider-crouseel">
    <h2 class="heading-2 text-primary text-center font-bold mb-4"><?php echo $title; ?>
</h2>
<div class="container">
  <div class="owl-carousel owl-theme web-slide-1">
    <?php foreach( $child_blocks as $child_block ) {
        $title =  $child_block['attrs']['title'];
        $description =  $child_block['attrs']['description'];
        $parent_name =  $child_block['attrs']['parent_name'];
        $icon = ogr_get_image( $child_block['attrs']['icon_id'] );
        if( ! empty( $icon ) ) {
            $icon_url = ogr_get_image_url( $child_block['attrs']['icon_id'] );
        }
        ?>
        <div class="bg-white rounded px-4 py-5 mb-4">
          <div class="slider-content">
            <?php if($icon_url): ?>
                <img src="<?php echo $icon_url; ?>">
            <?php endif; ?>
            <h3><?php echo $title; ?> </h3>
            <?php echo $description; ?>
            <a class="text-dark" href="#">
              -  <?php echo $parent_name; ?>
          </a>
      </div>
  </div>
  <?php
}
?>



</div>
</div>

</section>
<?php
$crousel_script = "jQuery(document).ready(function ($) {
    $('.web-slide-1').owlCarousel({
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
                    items:2
                    },
                    1000:{
                        items:2
                    }
                }
                });
            });";
            wp_add_inline_script('Turtletot-carousel', $crousel_script);
            wp_reset_postdata();
