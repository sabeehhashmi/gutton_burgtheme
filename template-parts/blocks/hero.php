<?php
$agegroups = [];
if(!empty($child_blocks)){
    foreach( $child_blocks as $child_block ) {
        $id = (int) $child_block['attrs']['id'];
        if( $id < 0 ) {
            continue;
        }
        $post = get_post( $id );
        if( empty( $post ) ) {
            continue;
        }
        $agegroups[] = $post;
    }


}

$title = trim( $data['title'] );
$sub_title = trim( $data['after_title'] );
$button_text = trim( $data['button_text'] );
$button_url = trim( $data['button_url'] );
$bg_image = ogr_get_image( $data['bg_image_id'] );
$bg_video = ogr_get_video( $data['bg_video_id'] );


$has_button = ( '' !== $button_text && '' !== $button_url );
$has_content = ( '' !== $title || $has_button );
$has_media = ( ! empty( $bg_image ) || ! empty( $bg_video ) );

if( ! $has_content && ! $has_media ) {
    return;
}

if( ! empty( $bg_image ) ) {
    $bg_image_url = ogr_get_image_url( $data['bg_image_id'] );
}
?>
<div class="hero-section d-flex align-items-center" style="background-image: url(<?php echo  $bg_image_url; ?>
    );">
    <div class="container top-120">
      <div class="row">
        <div class="col-md-5">
          <div class="hero-content">
            <h1 class="heading-1 text-primary font-bold"><?php echo $title; ?>  <span class="d-block">
              <?php echo $sub_title; ?>
          </span>
      </h1>
      <p class="text-white">A purpose built childcare in Bexley for 0-6 year olds where new discoveries are made each day</p>
      <a class="btn btn-primary text-white btn--lagre px-3 py-1" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
  </div>
</div>
</div>

<!-- group-cards -->
<section class="group-cards pt-5">
    <h3 class="heading-3 mb-3 text-white font-bold">Our Age groups</h3>
    <div class="row">
        <?php
        if(!empty($agegroups)){
            foreach($agegroups as $agegroup){
                $meta = get_post_meta($agegroup->ID,'ogr_data',true);
                $bgcolor = ['red'=>'danger', 'green'=>'success','blue'=>'primary'];
                $classes = ['red'=>'Nursery', 'green'=>'Preschool','blue'=>'Toddlers'];
                $color = $meta['color'];
                $desc = $meta['desc'];
                $image_url = ogr_get_image_url( $meta['icon_id'], 'full' );
                ?>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="group-cards-wrapper border-<?php echo $bgcolor[$color]; ?> rounded bg-white p-3">
                      <div class="group-cards-icon mt-2 mb-4 mx-5">
                        <?php if($image_url): ?>
                            <img src="<?php echo $image_url; ?>" alt="Icon">
                        <?php endif; ?>
                    </div>
                    <div class="group-cards-title">
                        <h4 class="heading-4 text-<?php echo $bgcolor[$color]; ?> font-bold"><?php echo $classes[$color]; ?></h4>
                    </div>
                    <div class="group-cards-pera">
                        <p><?php echo $desc; ?></p>
                    </div>
                    <div class="group-cards-link">
                        <a class="text-<?php echo $bgcolor[$color]; ?> font-bold" href="<?php echo get_the_permalink($agegroup->ID ); ?>">Learn more &gt;</a>
                    </div>
                    <div class="label-main bg-<?php echo $bgcolor[$color]; ?>">
                        <h5 class="text-white"><?php echo $meta['age']; ?></h5>
                        <p class="text-white">Years</p>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
</section>
</div>
</div>
<?php
