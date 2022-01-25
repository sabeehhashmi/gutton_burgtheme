<?php

if( empty( $child_blocks ) ) {
    return;
}

$wp_testimonials = [];
foreach( $child_blocks as $child_block ) {
    $id = (int) $child_block['attrs']['id'];
    if( $id < 0 ) {
        continue;
    }
    $post = get_post( $id );
    if( empty( $post ) ) {
        continue;
    }
    $wp_testimonials[] = $post;
}

if( empty( $wp_testimonials ) ) {
    return;
}

$tagline = trim( $data['tagline'] );
$archive_link_text = trim( $data['archive_link_text'] );

?>
<section class="featured-testimonials">
    <div class="featured-testimonials-side">
        <div class="featured-testimonials-image"></div>
    </div>
    <div class="featured-testimonials-main">
        <?php if( '' !== $tagline || '' !== $archive_link_text ): ?>
            <div class="featured-testimonials-heading">
                <?php if( '' !== $tagline ): ?>
                    <h2 class="featured-testimonials-title"><?php echo $tagline; ?></h2>
                <?php endif; 
                if( '' !== $archive_link_text ): ?>
                    <a href="<?php echo esc_attr( get_post_type_archive_link( 'testimonial' ) ); ?>" class="featured-testimonials-archive-link"><?php echo $archive_link_text; ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="testimonial-items-container">
            <ul class="testimonial-items">
                <?php foreach( $wp_testimonials as $wp_testimonial ):
                    ogr_the_post( $wp_testimonial );
                    $testimonial_data = ogr_get_data( $wp_testimonial->ID );
                    $logo = $author = $company = '';
                    if( ! empty( $testimonial_data ) ) {
                        $logo_id = (int) $testimonial_data['logo_id'];
                        if( $logo_id > 0 ) {
                            $logo = wp_get_attachment_image( $logo_id, 'full' );
                        }
                        $author = trim( $testimonial_data['author'] );
                        $company = trim( $testimonial_data['company'] );
                        $sep = ( '' !== $author && '' !== $company ) ? ' / ' : '';
                    }
                ?>
                    <li class="testimonial-item">
                        <?php if( has_post_thumbnail() ): ?>
                            <div class="testimonial-item-image"><?php the_post_thumbnail( 'large' ); ?></div>
                        <?php endif; ?>
                        <?php if( ! empty( $logo ) ): ?>
                            <div class="testimonial-item-logo"><?php echo $logo; ?></div>
                        <?php endif; ?>
                        <h3 class="testimonial-item-title"><?php the_title(); ?></h3>
                        <blockquote class="testimonial-item-contents">
                            <div class="testimonial-item-content"><?php the_content(); ?></div>
                            <footer class="testimonial-item-author-line">- <?php echo $author . $sep . $company; ?></footer>
                        </blockquote>
                    </li>
                <?php endforeach;
                wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</section><!-- / Featured Testimonials -->