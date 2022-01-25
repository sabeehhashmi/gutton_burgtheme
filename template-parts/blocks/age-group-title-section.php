<?php


$tag_line =  $data['tag_line'];
$description =  $data['description'];

$meta = get_post_meta( get_the_ID(),'ogr_data',true);
$bgcolor = ['red'=>'danger', 'green'=>'success','blue'=>'primary'];
$color = $meta['color'];
$image_url = ogr_get_image_url( $data['icon_id'], 'full' );

?>
<div class="hero-section d-flex align-items-end" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(),'full'); ?>);">

</div>

<div class="container">
  <section class="group-cards <?php echo $bgcolor[$color]; ?>-card-bg bg-white rounded py-5">
      <div class="row">
        <div class="col-md-7">
          <div class="about-card-text px-3 px-md-5">
            <h5 class="heading-5 font-bold"><?php echo $tag_line; ?></h5>
            <h2 class="heading-2 text-<?php echo $bgcolor[$color]; ?> font-bold"><?php echo the_title(); ?></h2>
            <p class="main-pera"><?php echo $description; ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="kids-age-img">
            <?php if($image_url): ?>
              <img src="<?php echo $image_url; ?>">
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="label-main bg-<?php echo $bgcolor[$color]; ?> text-center">
        <h5 class="text-white heading-3"><?php echo $meta['age']; ?></h5>
        <p class="text-white heading-6">Years</p>
      </div>

    </section>
</div>


