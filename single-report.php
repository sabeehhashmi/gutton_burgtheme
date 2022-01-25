<?php
$action = trim( filter_input( INPUT_GET, 'action' ) );
if( 'download' === $action ) {
    $data = ogr_get_data( get_the_ID() );
    $file_id = (int) $data['file_id'];
    if( $file_id > 0 ) {
        $file_url = wp_get_attachment_url( $file_id );
        if( $file_url ) {
            header( "Content-Disposition: attachment; filename=\"" . basename( $file_url ) . "\"" );
            header( "Content-Type: application/octet-stream" );
            header( "Content-Length: " . filesize( $file_url ) );
            header( "Connection: close" );
            exit;
        }
    }
}

get_header(); ?>
<main class="page-main">
    <div class="container">
        <div class="page-header">
            <h1><?php the_title(); ?></h1>
        </div>
        <?php 
            while( have_posts() ): the_post(); 
                get_template_part( 'template-parts/loop-report' );
            endwhile;
            wp_reset_postdata();
        ?>
    </div>
</main><!-- / Page Main -->
<?php get_footer();