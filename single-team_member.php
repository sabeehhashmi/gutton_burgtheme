<?php get_header(); ?>
<main class="page-main">
    <div class="container">
        <?php while( have_posts() ): the_post();
            $data = ogr_get_data( get_the_ID() );
            $breadcrumps_text = trim( ogr_get_setting( 'general', 'team_member', 'breadcrumps_text' ) );
            $breadcrumps_text = ( '' !== $breadcrumps_text ) ? $breadcrumps_text : __( 'Team Members', 'onegroup' );
            $banner_id = (int) $data['banner_id'];
            $banner_image = ogr_get_image( $banner_id, 'full' );
            $role = trim( $data['role'] );
            $linkedin_url = trim( $data['linkedin_url'] );
            ?>
            <article class="blog-entry team-member-entry">
                <header class="blog-entry-header">
                    <div class="breadcrumps">
                        <a href="<?php echo esc_attr( get_post_type_archive_link( 'team_member' ) ); ?>"><?php echo $breadcrumps_text; ?></a>
                        <span><?php the_title(); ?></span>
                    </div>
                    <h1 class="blog-entry-title"><?php the_title(); ?></h1>
                    <?php if( '' !== $role ): ?>
                        <strong class="team-member-entry-role"><?php echo $role; ?></strong>
                    <?php endif; 
                    if( '' !== $linkedin_url ): ?>
                        <a href="<?php echo esc_attr( $linkedin_url ); ?>" class="team-member-entry-linkedin-url"><?php
                        echo sprintf( __( 'Follow %s on LinkedIn', 'onegroup' ), get_the_title() ); ?></a>
                    <?php endif; ?>
                </header>
                <?php if( $banner_image ): ?>
                    <div class="blog-entry-image"><?php echo $banner_image; ?></div>
                <?php endif; ?>
                <div class="blog-entry-contents"><?php the_content(); ?></div>
            </article><!-- / Blog Entry -->
        <?php endwhile;
        wp_reset_postdata();
        
        $bottom_section_id = ogr_get_setting( 'general', 'team_member', 'single_bottom_section' );
        if( $bottom_section_id ) {
            ogr_the_post( get_post( $bottom_section_id ) );
            add_filter( 'the_content', '_onegroup_blocks_the_content' );
            the_content();
            wp_reset_postdata();
        }
        ?>
    </div>
</main><!-- / Page Main -->
<?php get_footer();