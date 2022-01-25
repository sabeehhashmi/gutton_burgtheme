<?php

if( empty( $child_blocks ) ) {
    return;
}

$wp_success_stories = [];
foreach( $child_blocks as $child_block ) {
    $id = (int) $child_block['attrs']['id'];
    if( $id < 0 ) {
        continue;
    }
    $post = get_post( $id );
    if( empty( $post ) ) {
        continue;
    }
    $wp_success_stories[] = $post;
}

if( empty( $wp_success_stories ) ) {
    return;
}

$tagline = trim( $data['tagline'] );
$archive_link_text = trim( $data['archive_link_text'] );
$read_more_text = trim( $data['read_more_text'] );
$read_more_text = ( '' !== $read_more_text ) ? $read_more_text : __( 'read more', 'onegroup' );
$background = trim( $data['background'] );
$background_class = $background ? " bg-$background" : '';

ogr_excerpt_hooks_on_success_story();
ogr_close_container();
?>
<section class="featured-success-stories<?php echo $background_class; ?>">
    <div class="featured-success-stories-inner">
        <?php if( '' !== $tagline ): ?>
            <header class="featured-success-stories-heading">
                <h2 class="featured-success-stories-title"><?php echo $tagline; ?></h2>
            </header>
        <?php endif; ?>
        <ul class="success-story-items">
            <?php foreach( $wp_success_stories as $wp_success_story ): ogr_the_post( $wp_success_story );
                $headline = ogr_get_headline( $wp_success_story->ID );
                $excerpt = trim( get_the_excerpt() );
                $excerpt = ( '' !== $excerpt ) ? $excerpt . '..... ' : '';
                ?>
                <li class="success-story-item">
                    <div class="success-story-item-inner">
                        <?php if( has_post_thumbnail() ): ?>
                            <div class="success-story-item-side">
                                <div class="success-story-item-image"><?php the_post_thumbnail( 'large' ); ?></div>
                            </div>
                        <?php endif; ?>
                        <div class="success-story-item-main">
                            <div class="success-story-item-heading">
                                <?php if( '' !== $headline ): ?>
                                    <h4 class="success-story-item-headline"><?php echo $headline; ?></h4>
                                <?php endif; ?>
                                <h3 class="success-story-item-title"><?php the_title(); ?></h3>
                            </div>
                            <div class="success-story-item-body">
                                <div class="success-story-item-excerpt">
                                    <?php echo $excerpt; ?>
                                    <a href="<?php echo esc_attr( get_the_permalink() ); ?>" class="success-story-item-link"><?php echo $read_more_text; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; 
            wp_reset_postdata();
            ogr_excerpt_hooks_off_success_story(); ?>
        </ul>
        <?php if( '' !== $archive_link_text ): ?>
            <footer class="featured-success-stories-footer">
                <a href="<?php echo esc_attr( get_post_type_archive_link( 'success_story' ) ); ?>" class="featured-success-stories-archive-link"><?php echo $archive_link_text; ?></a>
            </footer>
        <?php endif; ?>
    </div>
</section><!-- / Featured Success Stories -->
<?php 
ogr_open_container();