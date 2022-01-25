<?php

$video = ogr_get_video( $data['video_id'] );
$youtube_id = false;
if( ! $video ) {
    $youtube_url = trim( $data['youtube_url'] );
    $youtube_id = ogr_get_youtube_id( $youtube_url );
}
if( ! $video && ! $youtube_id ) {
    return;
}

$title = trim( $data['title'] );
$video_thumbnail_url = ogr_get_image_url( $data['video_thumbnail_id'], 'full' );
$video_thumbnail_style = $video_thumbnail_url ? sprintf( ' style="background-image:url(%s)"', esc_attr( $video_thumbnail_url ) ) : '';

?>
<div class="video">
    <div class="video-media">
        <?php if( false !== $youtube_id ): ?>
            <div class="video-youtube" data-id="<?php echo esc_attr( $youtube_id ); ?>"></div>
        <?php else: ?>
            <video class="video-el" controls>
                <source src="<?php echo esc_attr( $video['url'] ); ?>" type="<?php echo esc_attr( $video['mime'] ); ?>"></source>
            </video>
        <?php endif; ?>
    </div>
    <div class="video-overlay"<?php echo $video_thumbnail_style; ?>>
        <?php if('' !== $title ): ?>
            <h2 class="video-title"><?php echo $title; ?></h2>
        <?php endif; ?>
        <button class="video-play-button" type="button"></button>
    </div>
</div><!-- / Video -->