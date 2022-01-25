<?php

$title = trim( $data['title'] );
$headline = trim( $data['headline'] );
$content = trim( $data['content'] );

if( '' === $title && '' === $content ) {
    return;
}
$image_url = ogr_get_image_url( $data['image_id'], 'full' );
$image_style = $image_url ? sprintf( ' style="background-image:url(%s)"', esc_attr( $image_url ) ) : '';

$button_url = trim( $data['button_url'] );
$button_text = trim( $data['button_text'] );
$has_button = ( '' !== $button_url && '' !== $button_text );

$style = trim( $data['style'] );
$style_class = $style ? " style-$style" : '';
ogr_close_container();
?>
<div class="angled-hero<?php echo $style_class; ?>">
    <div class="angled-hero-inner">
        <div class="angled-hero-main">
            <?php if( '' !== $headline ): ?>
                <h2 class="angled-hero-headline"><?php echo $headline; ?></h2>
            <?php endif; 
            if( '' !== $title ): ?>
                <h1 class="angled-hero-title"><?php echo $title; ?></h1>
            <?php endif; 
            if( '' !== $content ): ?>
                <div class="angled-hero-content"><?php echo wpautop( $content ); ?></div>
            <?php endif; 
            if( $has_button ): ?>
                <a href="<?php echo esc_attr( $button_url ); ?>" class="angled-hero-button"><?php echo $button_text; ?></a>
            <?php endif; ?>
        </div>
        <?php if( ! empty( $image_url ) ): ?>
            <div class="angled-hero-image"<?php echo $image_style; ?>>
                <div class="angled-hero-angle"></div>
            </div>
        <?php endif; ?>
    </div>
</div><!-- / Angled Hero -->
<?php
ogr_open_container();