<?php

if( empty( $child_blocks ) ) {
    return;
}
$title =  $data['title'];

?>
<section class="slider-cards bg-1 after-icon py-5 bg-primary">
    <div class="container py-5">
        <h2 class="heading-2 text-white font-bold mb-4"><?php echo $title; ?>
      </h2>
      <!-- Set up your HTML -->
      <div class="owl-carousel owl-theme web-slide-2 ">
        <?php foreach( $child_blocks as $child_block ) {
            $title =  $child_block['attrs']['title'];
            $description =  $child_block['attrs']['description'];
            $parent_name =  $child_block['attrs']['parent_name'];
            ?>
            <div class="bg-light rounded px-4 py-5 mb-4">
              <div class="slider-content">
                <h3><?php echo $title; ?> </h3>
                <p><?php echo $description; ?></p>
                <a class="text-dark" href="#">
                  <?php echo $parent_name; ?>
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
