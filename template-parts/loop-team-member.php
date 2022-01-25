<?php
    $data = ogr_get_data( get_the_ID() );
    $role = trim( $data['role'] );
?>
<div class="team-member">
    <div class="team-member-inner">
        <?php if( has_post_thumbnail() ): ?>
            <div class="team-member-image"><?php the_post_thumbnail( 'large' ); ?></div>
        <?php endif; ?>
        <div class="team-member-contents">
            <h3 class="team-member-name"><?php the_title(); ?></h3>
            <?php if( '' !== $role ): ?>
                <strong class="team-member-role"><?php echo $role; ?></strong>
            <?php endif; ?>
        </div>
    </div>
</div><!-- / Team Member -->