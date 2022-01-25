<?php
    $data = ogr_get_data( get_the_ID() );
    $role = trim( $data['role'] );
    $exerpt = get_the_excerpt();
    $linkedin_url = trim( $data['linkedin_url'] );
?>
<div class="team-member with-bio">
    <div class="team-member-inner">
        <?php if( has_post_thumbnail() ): ?>
            <div class="team-member-image"><?php the_post_thumbnail( 'large' ); ?></div>
        <?php endif; ?>
        <div class="team-member-contents">
            <div class="team-member-heading">
                <h3 class="team-member-name"><?php the_title(); ?></h3>
                <?php if( '' !== $role ): ?>
                    <strong class="team-member-role"><?php echo $role; ?></strong>
                <?php endif; ?>
            </div>
            <div class="team-member-content"><?php echo wpautop( $exerpt ); ?></div>
            <div class="team-member-footer">
                <a href="<?php echo esc_attr( get_the_permalink() ); ?>" class="team-member-link"><?php _e( 'Read Bio', 'onegroup' ); ?></a>
                <?php if( '' !== $linkedin_url ): ?>
                    <a href="<?php echo esc_attr( $linkedin_url ); ?>" target="_blank" class="team-member-linkedin-url"><?php
                    echo sprintf( __( 'Follow %s on LinkedIn', 'onegroup' ), get_the_title() ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><!-- / Team Member -->