<?php
    $download_button_text = trim( ogr_get_setting( 'general', 'report', 'download_button_text' ) );
    $data = ogr_get_data( get_the_ID() );
    $file_id = (int) $data['file_id'];
    $has_download_button = ( '' !== $download_button_text && $file_id > 0 );
    $download_url = add_query_arg( 'action', 'download', get_the_permalink() );
?>
<div class="report">
    <?php if( has_post_thumbnail() ): ?>
        <div class="report-image"><?php the_post_thumbnail( 'medium' ); ?></div>
    <?php endif; ?>
    <div class="report-contents">
        <h3 class="report-title"><?php the_title(); ?></h3>
        <div class="report-content"><?php the_content(); ?></div>
        <?php if( $has_download_button ): ?>
            <a href="<?php echo esc_attr( $download_url ); ?>" class="report-download-button"><?php echo $download_button_text; ?></a>
        <?php endif; ?>
    </div>
</div><!-- / Report -->