<?php

$headline = trim( $data['headline'] );
$title = trim( $data['title'] );
$description = trim( $data['description'] );

if( '' === $headline && '' === $title || '' === $description ) {
    return;
}

?>
<div class="page-header small">
    <?php if( '' !== $headline ): ?>
        <h2><?php echo $headline; ?></h2>
    <?php endif; 
    if( '' !== $title ): ?>
        <h1><?php echo $title; ?></h1>
    <?php endif;
    if( '' !== $description ): ?>
        <div class="description"><?php echo wpautop( $description ); ?></div>
    <?php endif; ?>
</div><!-- / Page Header -->