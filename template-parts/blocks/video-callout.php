<?php

$headline = trim( $data['headline'] );
$title = trim( $data['title'] );
$content = trim( $data['content'] );
$button_text = trim( $data['button_text'] );
$button_url = trim( $data['button_url'] );
$video_thumbnail_url = ogr_get_image_url( $data['video_thumbnail_id'], 'medium' );
$video = ogr_get_video( $data['video_id'] );
$youtube_url = trim( $data['youtube_url'] );
$youtube_id = ogr_get_youtube_id( $youtube_url );

$has_button = ( '' !== $button_text && '' !== $button_url );
$has_header = ( '' !== $headline || '' !== $title );
$has_contents = $has_header || '' !== $content || $has_button;
$has_video = ( false !== $video || false !== $youtube_id );
$has_media = $has_video || false !== $video_thumbnail_url;

if( ! $has_contents && ! $has_media ) {
    return;
}

ogr_close_container();
?>
<div class="video-callout-container">
    <article class="video-callout">
        <div class="video-callout-inner">
            <div class="video-callout-contents">
                <?php if( $has_header ): ?>
                    <header class="video-callout-header">
                        <?php if( '' !== $headline ): ?>
                            <h2 class="video-callout-headline"><?php echo $headline; ?></h2>
                        <?php endif;
                        if( '' !== $title ): ?>
                            <h3 class="video-callout-title"><?php echo $title; ?></h3>
                        <?php endif; ?>
                    </header>
                <?php endif; 
                if( '' !== $content ): ?>
                    <div class="video-callout-content"><?php echo wpautop( $content ); ?></div>
                <?php endif; 
                if( $has_button ): ?>
                    <a href="<?php echo esc_attr( $button_url ); ?>" class="video-callout-button"><?php echo $button_text; ?></a>
                <?php endif; ?>
            </div>
            <?php if( $has_media ): ?>
            <div class="video-callout-media">
                <div class="video-callout-media-inner">
                    <?php if( $has_video ): ?>
                        <div class="video-callout-video">
                            <?php if( false !== $youtube_id ): ?>
                                <div class="video-callout-youtube" data-id="<?php echo esc_attr( $youtube_id ); ?>"></div>
                            <?php else: ?>
                                <video class="video-callout-video-el" controls>
                                    <source src="<?php echo esc_attr( $video['url'] ); ?>" type="<?php echo esc_attr( $video['mime'] ); ?>"></source>
                                </video>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="video-callout-media-play-layer"<?php 
                    echo ( false !== $video_thumbnail_url ) ? ' style="background-image:url(' . esc_attr( $video_thumbnail_url ) . ')"' : ''; ?>>
                        <?php if( $has_video ): ?>
                            <div class="video-callout-media-play-overlay">
                                <button class="video-callout-media-play-button" type="button"></button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </article>
</div><!-- / Video Callout -->
<?php
ogr_open_container();