<?php

$group_id = (int) $data['group_id'];

$args = [
    'post_type' => 'team_member',
    'posts_per_page' => -1,
];
if( $group_id ) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'team_group',
            'terms' => $group_id
        ]
    ];
}
$team_members = get_posts( $args );

if( empty( $team_members ) ) {
    return;
}

$title = trim( $data['title'] );
$display = trim( $data['display'] );
$layout = trim( $data['layout'] );
$layout_class = $layout ? " layout-$layout" : '';
ogr_close_container();
?>
<section class="team-members<?php echo $layout_class; ?>">
    <div class="team-members-inner">
        <?php if( '' !== $title ): ?>
            <header class="team-members-header">
                <h2 class="team-members-title"><?php echo $title; ?></h2>
            </header>
        <?php endif; ?>
        <div class="team-member-items">
            <?php foreach( $team_members as $team_member ): ogr_the_post( $team_member ); ?>
                <div class="team-member-item">
                    <?php get_template_part( 'template-parts/loop-team-member', $display ); ?>
                </div>
            <?php endforeach;
            wp_reset_postdata(); ?>
        </div>
    </div>
</section><!-- / Team Members -->
<?php
ogr_open_container();