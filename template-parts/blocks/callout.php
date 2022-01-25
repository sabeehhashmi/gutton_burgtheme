<?php

$bg_image = ogr_get_image_url( $data['bg_image_id'] );
$title = trim( $data['title'] );
$button_text = trim( $data['button_text'] );
$button_url = trim( $data['button_url'] );
$has_button = ( '' !== $button_url && '' !== $button_text );
if( '' === $title && ! $has_button ) {
    return;
}

ogr_close_container();
?>
<div class="callout"<?php echo ( ! empty( $bg_image ) ) ? ' style="background-image:url(' . esc_attr( $bg_image ) . ')"' : ''; ?>>
    <div class="callout-inner">
        <div class="callout-contents">
            <?php if( '' !== $title ): ?>
                <h2 class="callout-title"><?php echo $title; ?></h2>
            <?php endif; 
            if( $has_button ): ?>
                <a href="<?php echo esc_attr( $button_url ); ?>" class="callout-button"><?php echo $button_text; ?></a>
            <?php endif; ?>
        </div>
    </div>
</div><!-- / Callout -->
<?php
ogr_open_container();
