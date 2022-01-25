<?php

if( empty( $child_blocks ) ) {
    return;
} 

$wp_members = [];
foreach( $child_blocks as $child_block ) {
    $id = (int) $child_block['attrs']['id'];
    if( $id < 0 ) {
        continue;
    }
    $post = get_post( $id );
    if( empty( $post ) ) {
        continue;
    }
    $wp_members[] = $post;
}

if( empty( $wp_members ) ) {
    return;
}

$headline = trim( $data['headline'] );
$title = trim( $data['title'] );
$button_text = trim( $data['button_text'] );
$has_button = ( '' !== $button_text );
$has_header = ( '' !== $headline || '' !== $title );
$has_heading = $has_header || $has_button;

$background = trim( $data['background'] );
$background_class = $background ? " bg-$background" : '';
ogr_close_container();
?>
<section class="featured-team">
    <?php if( $background ): ?>
        <div class="featured-team-bg"><div class="featured-team-bg-inner"></div></div>
    <?php endif; ?>
    <?php if( $has_heading ): ?>
        <div class="featured-team-heading">
            <?php if( $has_header ): ?>
                <header class="featured-team-header">
                    <?php if( '' !== $headline ): ?>
                        <h4 class="featured-team-headline"><?php echo $headline; ?></h4>
                    <?php endif; 
                    if( '' !== $title ): ?>
                        <h2 class="featured-team-title"><?php echo $title; ?></h2>
                    <?php endif; ?>
                </header>
            <?php endif; 
            if( $has_button ): ?>
                <div class="featured-team-button-container">
                    <a href="<?php echo esc_attr( get_post_type_archive_link( 'team_member' ) ); ?>" class="featured-team-button"><?php echo $button_text; ?></a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="featured-team-members-container-wrap">
        <div class="featured-team-members-container">
            <ul class="featured-team-member-items">
                <?php foreach( $wp_members as $wp_member ):
                    ogr_the_post( $wp_member ); ?>
                    <li class="featured-team-member-item">
                        <?php get_template_part( 'template-parts/loop', 'team-member' ); ?>
                    </li>
                <?php endforeach;
                wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</section><!-- / Featured Team -->
<?php
ogr_open_container();