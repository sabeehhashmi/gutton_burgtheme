<?php get_header(); ?>
<main class="page-main">
    <div class="container">
        <?php while( have_posts() ): the_post();
            the_content();
        endwhile;
        wp_reset_postdata(); ?>
    </div>
</main><!-- / Page Main -->
<?php get_footer();