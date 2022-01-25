<?php get_header();

$post_type = get_post_type();
$page_id = ogr_get_setting( 'general', $post_type, 'archive_page' );
?>
<main class="page-main">
    <div class="container">
        <?php
            if( $page_id ) {
                ogr_the_post( get_post( $page_id ) );
                the_content();
                wp_reset_postdata();
            }
        ?>
    </div>
</main><!-- / Page Main -->
<?php get_footer();
