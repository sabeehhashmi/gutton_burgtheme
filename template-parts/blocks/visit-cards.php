<?php

if( empty( $child_blocks ) ) {
    return;
}

$title = trim( $data['title'] );
$style = trim( $data['style'] );
$style_class = $style ? " style-$style" : '';

?>
<section class="visit-cards<?php echo $style_class; ?>">
    <?php if( '' !== $title ): ?>
        <header class="visit-cards-heading">
            <h2 class="visit-cards-title"><?php echo $title; ?></h2>
        </header>
    <?php endif; ?>
    <div class="visit-card-items">
        <?php foreach( $child_blocks as $child_block ): 
            $bg_image = ogr_get_image( $child_block['attrs']['bg_image_id'], 'large' );
            $card_title = trim( $child_block['attrs']['title'] );
            $subtitle = trim( $child_block['attrs']['subtitle'] );
            $link_text = trim( $child_block['attrs']['link_text'] );
            $link_url = trim( $child_block['attrs']['link_url'] );
            $has_link = ( '' !== $link_text && '' !== $link_url );
            if( empty( $bg_image ) && '' === $card_title && '' === $subtitle && ! $has_link ) {
                continue;
            }
            ?>
            <div class="visit-card-item">
                <div class="visit-card">
                    <div class="visit-card-inner">
                        <?php if( ! empty( $bg_image ) ): ?>
                            <div class="visit-card-image"><?php echo $bg_image; ?></div>
                        <?php endif; ?>
                        <div class="visit-card-contents">
                            <?php if( '' !== $card_title ): ?>
                                <h3 class="visit-card-title"><?php echo $card_title; ?></h3>
                            <?php endif; 
                            if( '' !== $subtitle || $has_link ): ?>
                                <div class="visit-card-footer">
                                    <?php if( '' !== $subtitle ): ?>
                                        <p class="visit-card-desc"><?php echo $subtitle; ?></p>
                                    <?php endif;
                                    if( $has_link ): ?>
                                        <a href="<?php echo esc_attr( $link_url ); ?>" class="visit-card-link"><?php echo $link_text; ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section><!-- / Visit Cards -->