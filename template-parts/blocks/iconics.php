<?php

if( empty( $child_blocks ) ) {
    return;
}

$iconics = [];
foreach( $child_blocks as $child_block ) {
    $child_data = $child_block['attrs'];
    $title = trim( $child_data['title'] );
    $content = trim( $child_data['content'] );
    if( '' === $title && '' === $content ) {
        continue;
    }
    $icon_url = ogr_get_image_url( $child_data['icon_id'], 'thumbnail' );
    $iconics[] = [
        'title' => $title,
        'content' => $content,
        'icon_url' => $icon_url
    ];
}

if( empty( $iconics ) ) {
    return;
}

$title = trim( $data['title'] );
$headline = trim( $data['headline'] );
$has_header = ( '' !== $title || '' !== $content );
$style = trim( $data['style'] );
$style_class = $style ? " style-$style" : '';

?>
<section class="iconics<?php echo $style_class; ?>">
    <?php if( $has_header ): ?>
        <header class="iconics-header">
            <?php if( '' !== $headline ): ?>
                <h4 class="iconics-headline"><?php echo $headline; ?></h4>
            <?php endif;
            if( '' !== $title ): ?>
                <h2 class="iconics-title"><?php echo $title; ?></h2>
            <?php endif; ?>
        </header>
    <?php endif; ?>
    <div class="iconics-items">
        <?php foreach( $iconics as $iconic ): ?>
            <div class="iconics-item">
                <div class="iconic">
                    <?php if( $iconic['icon_url'] ): ?>
                        <div class="iconic-icon" style="background-image: url(<?php echo esc_attr( $iconic['icon_url'] ); ?>)"></div>
                    <?php endif; 
                    if( '' !== $iconic['title'] ): ?>
                        <h3 class="iconic-title"><?php echo $iconic['title']; ?></h3>
                    <?php endif;
                    if( '' !== $iconic['content'] ): ?>
                        <div class="iconic-content"><?php echo wpautop( $iconic['content'] ); ?></div>
                    <?php endif; ?>
                </div><!-- / Iconic -->
            </div>
        <?php endforeach; ?>
    </div>
</section><!-- / Iconics -->