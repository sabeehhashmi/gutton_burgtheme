<?php

if( empty( $child_blocks ) ) {
    return;
}
$title =  $data['title'];
$meta = get_post_meta( get_the_ID(),'ogr_data',true);
$bgcolor = ['red'=>'danger', 'green'=>'success','blue'=>'primary'];
$color = $meta['color'];
?>
<section class="main-cards pt-5 bg-light">
    <div class="container">
      <div class="row">
         <?php foreach( $child_blocks as $child_block ) {

            $image = ogr_get_image( $child_block['attrs']['icon_id'] );

            $title =  $child_block['attrs']['title'];
            $description =  $child_block['attrs']['description'];
            $layout =  $child_block['attrs']['layout'];
            $button_text =  $child_block['attrs']['button_text'];
            $button_url =  $child_block['attrs']['button_url'];
            $layouts = ['green'=>'main-card-wrapper bg-success rounded main-cards-bg-1','blue'=>'main-card-wrapper bg-info rounded main-cards-bg-2'];


            ?>
            <div class="col-md-6 mb-3 mb-md-0">
              <div class="<?php echo $layouts[$layout]; ?> ">
                <div class="row">
                  <div class="col-md-8">
                    <div class="main-cards-content p-4">
                        <h2 class="font-bold text-white"><?php echo $title; ?></h2>
                      <p class="text-white group-partners"><?php echo $description; ?></p>
                      <a class="btn btn-light bg-white text-primary font-bold" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php } ?>

</div>
</div>
</section>


