<?php

if( empty( $child_blocks ) ) {
    return;
}

$reports = [];
foreach( $child_blocks as $child_block ) {
    $attrs = $child_block['attrs'];
    $category_id = isset( $attrs['category_id'] ) ? (int) $attrs['category_id'] : 0;
    $report_id = isset( $attrs['report_id'] ) ? (int) $attrs['report_id'] : 0;
    if( $category_id < 1 || $report_id < 1 ) {
        continue;
    }
    $category = get_term( $category_id, 'location' );
    if( empty( $category ) || is_wp_error( $category ) ) {
        continue;
    }
    
    $report = get_post( $report_id );
    if( empty( $report ) ) {
        continue;
    }
    
    $reports[] = [
        'category' => $category,
        'report' => $report
    ];
}

if( empty( $reports ) ) {
    return;
}

$link_text = trim( $data['link_text'] );

?>
<div class="featured-reports">
    <div class="featured-reports-header">
        <ul class="featured-reports-tabs">
            <?php foreach( $reports as $report ): ?>
                <li><?php echo esc_html( $report['category']->name ); ?></li>
            <?php endforeach; ?>
        </ul>
        <?php if( ''!== $link_text ): ?>
            <div class="featured-reports-archive-link-container">
                <a href="<?php echo esc_attr( get_post_type_archive_link( 'report' ) ); ?>" class="featured-reports-archive-link"><?php echo esc_html( $link_text ); ?></a>
            </div>
        <?php endif; ?>
    </div>
    <div class="featured-reports-contents">
        <?php foreach( $reports as $report ): ogr_the_post( $report['report'] ); ?>
            <div class="featured-reports-content">
                <?php get_template_part( 'template-parts/loop', 'report' ); ?>
            </div>
        <?php endforeach; 
        wp_reset_postdata(); ?>
    </div>
</div><!-- / Featured Reports -->