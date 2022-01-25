<?php

$title = trim( $data['title'] );
$content = trim( $data['content'] );

if( '' === $title && '' === $content ) {
    return;
}

?>
<div class="content">
    <div class="content-title-container">
        <?php if( '' !== $title ): ?>
            <h2 class="content-title"><?php echo $title; ?></h2>
        <?php endif; ?>
    </div>
    <div class="content-text-container">
        <?php if( '' !== $content ): ?>
            <div class="content-text"><?php echo wpautop( $content ); ?></div>
        <?php endif; ?>
    </div>
</div><!-- / Content -->