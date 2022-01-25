<?php


$tag_line =  $data['tag_line'];
$title =  $data['title'];
$description =  $data['description'];


$image_url = ogr_get_image_url( $data['bg_image_id'], 'full' );

?>
<div class="hero-section d-flex align-items-end" style="background-image: url(<?php echo $image_url; ?>);">
    <div class="container group-top-150">
      <!-- Age Group Banner cards -->
      <section class="group-cards career-card-bg bg-white rounded py-5">
        <div class="row">
          <div class="col-md-7">
            <div class="about-card-text px-3 px-md-5">
              <h5 class="heading-5 font-bold"><?php echo $tag_line; ?></h5>
              <h2 class="heading-2 text-primary font-bold"><?php echo $title; ?>
              </h2>
              <p class="main-pera"><?php echo $description; ?></p>
            </div>
          </div>

        </div>


      </section>
    </div>
  </div>





