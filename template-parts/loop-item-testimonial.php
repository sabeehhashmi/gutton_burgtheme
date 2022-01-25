<?php 
    $headline = trim( ogr_get_setting( 'general', 'testimonial', 'item_headline' ) );
    $testimonial_data = ogr_get_data( get_the_ID() );
    $logo = $author = $company = '';
    if( ! empty( $testimonial_data ) ) {
        $logo = ogr_get_image( (int) $testimonial_data['logo_id'], 'full' );
        $author = trim( $testimonial_data['author'] );
        $company = trim( $testimonial_data['company'] );
        $sep = ( '' !== $author && '' !== $company ) ? ' / ' : '';
    }
    $content = get_the_content();
    $has_credits = ( '' !== $author || '' !== $company );
    $has_content = ( '' !== $content );
?>
<div class="testimonial">
    <?php if( has_post_thumbnail() ): ?>
        <div class="testimonial-side">
            <div class="testimonial-image"><?php the_post_thumbnail( 'large' ); ?></div>
        </div>
    <?php endif; ?>
    <div class="testimonial-main">
        <?php if( '' !== $headline ): ?>
            <div class="testimonial-heading">
                <h2 class="testimonial-headline"><?php echo $headline; ?></h2>
            </div>
        <?php endif; 
        if( $logo ): ?>
            <div class="testimonial-logo"><?php echo $logo; ?></div>
        <?php endif; ?>
        <h3 class="testimonial-title"><?php the_title(); ?></h3>
        <?php if( $has_content ): ?>
            <blockquote class="testimonial-contents">
                <div class="testimonial-content"><?php echo wpautop( $content ); ?></div>
                <?php if( $has_credits ): ?>
                    <footer class="testimonial-author-line">- <?php echo $author . $sep . $company; ?></footer>
                <?php endif; ?>
            </blockquote>
        <?php endif; ?>
    </div>
</div><!-- / Testimonial -->