<?php get_header(); ?>
<main class="page-main">
    <div class="container">
        <?php while( have_posts() ): the_post();
            $data = ogr_get_data( get_the_ID() );
            $headline = trim( $data['headline'] );
            $title = get_the_title();
            $long_title = ( '' !== $headline ) ? $headline : $title; 
            $out_locations = get_the_term_list( get_the_ID(), 'location', '', '<span class="sep"></span>' );
            $has_terms = ( ! empty( $out_categories ) || ! empty( $out_locations ) );
            ?>
            <article class="blog-entry success-story-entry">
                <header class="blog-entry-header">
                    <div class="breadcrumps">
                        <a href="<?php echo esc_attr( get_post_type_archive_link( 'success_story' ) ); ?>"><?php _e( 'Success Stories', 'onegroup' ); ?></a>
                        <span><?php echo $long_title; ?></span>
                    </div>
                    <h1 class="blog-entry-title"><?php echo $title; ?></h1>
                </header>
                <div class="blog-entry-meta">
                    <?php if( $has_terms ): ?>
                        <div class="blog-entry-terms">
                            <?php if( ! empty( $out_locations ) ): ?>
                                <div class="blog-entry-locations"><?php echo $out_locations; ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if( has_post_thumbnail() ): ?>
                    <div class="blog-entry-image"><?php the_post_thumbnail( 'full' ); ?></div>
                <?php endif; ?>
                <div class="blog-entry-contents"><?php the_content(); ?></div>
            </article><!-- / Blog Entry -->
        <?php endwhile;
        wp_reset_postdata();
        
        $bottom_section_id = ogr_get_setting( 'general', 'success_story', 'single_bottom_section' );
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