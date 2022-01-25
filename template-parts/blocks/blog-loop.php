<?php
$title = trim( $data['title'] );
$headline = trim( $data['headline'] );
$has_header = ( '' !== $title || '' !== $headline );

$categories = get_categories();
$locations = get_terms( [
    'taxonomy' => 'location'
] );
$earliest_post = get_posts( [
    'posts_per_page' => 1,
    'order' => 'ASC',
    'orderby' => 'date'
] );
$earliest_post = ! empty( $earliest_post ) ? $earliest_post[0] : false;
$year_range = [];
if( $earliest_post ) {
    $min_year = (int) mysql2date( 'Y', $earliest_post->post_date );
    $max_year = (int) date( 'Y' );
    if( $min_year < $max_year ) {
        $year_range['min'] = $min_year;
        $year_range['max'] = $max_year;
    }
}

$has_dropdown_filters = ( ! empty( $year_range ) || ! empty( $locations ) );
$has_filters = $has_dropdown_filters || ( ! empty( $categories ) );

$current_year = (int) filter_input( INPUT_GET, 'y' );
$current_location = (int) filter_input( INPUT_GET, 'l' );
$current_category = (int) filter_input( INPUT_GET, 'c' );
$page = max( 1, (int) get_query_var( 'paged' ) );

$args = [
    'post_type' => 'post',
    'paged' => $page
];
$has_tax_query = ( $current_year || $current_location || $current_category );
if( $has_tax_query ) {
    $tax_query = [];
    if( $current_category ) {
        $tax_query[] = [
            'taxonomy' => 'category',
            'terms' => $current_category
        ];
    }
    if( $current_location ) {
        $tax_query[] = [
            'taxonomy' => 'location',
            'terms' => $current_location
        ];
    }
    if( ! empty( $tax_query ) ) {
        $tax_query['relation'] = 'AND';
        $args['tax_query'] = $tax_query;
    }
    if( $current_year ) {
        $args['date_query'] = [
            [
                'year' => $current_year
            ]
        ];
    }
}
$query = new WP_Query( $args );

ogr_close_container();
?>
<section class="blog-loop">
    <?php if( $has_header ): ?>
        <header class="blog-loop-header">
            <?php if( '' !== $headline ): ?>
                <h2 class="blog-loop-headline"><?php echo $headline; ?></h2>
            <?php endif; 
            if( '' !== $title ): ?>
                <h1 class="blog-loop-title"><?php echo $title; ?></h1>
            <?php endif; ?>
        </header><!-- / Blog Loop Header -->
    <?php endif; 
    if( $has_filters ): ?>
        <div class="blog-loop-filters">
            <div class="blog-loop-filters-inner">
                <?php if( ! empty( $categories ) ): ?>
                    <ul class="blog-loop-filter-buttons">
                        <li><a href="<?php echo esc_attr( remove_query_arg( 'c' ) ); ?>" class="blog-loop-filter-button"><?php _e( 'All', 'onegroup' ); ?></a></li>
                        <?php foreach( $categories as $category ):
                            $class = ( $category->term_id === $current_category ) ? ' active' : ''; ?>
                            <li><a href="<?php echo esc_attr( add_query_arg( 'c', $category->term_id ) ); ?>" class="blog-loop-filter-button<?php echo $class; ?>"><?php echo esc_html( $category->name ); ?></a></li>
                        <?php endforeach; ?>
                    </ul><!-- / Categories -->
                <?php endif; 
                if( $has_dropdown_filters ): ?>
                    <div class="blog-loop-filter-dropdowns">
                        <strong class="blog-loop-filter-dropdowns-title"><?php _e( 'Filter: ', 'onegroup' ); ?></strong>
                        <div class="blog-loop-filter-dropdowns-contents">
                            <?php if( ! empty( $year_range ) ): ?>
                                <select class="blog-loop-filter-dropdown" data-custom-dropdown>
                                    <option value="<?php echo esc_attr( remove_query_arg( 'y' ) ); ?>"><?php 
                                    _e( 'All Years', 'onegroup' ); ?></option>
                                    <?php for( $year = $year_range['min']; $year <= $year_range['max']; $year ++ ): ?>
                                        <option value="<?php echo esc_attr( add_query_arg( 'y', $year ) ); 
                                        ?>" <?php selected( $year, $current_year ); ?>><?php echo $year; ?></option>
                                    <?php endfor; ?>
                                </select><!-- / Years Dropdown -->
                            <?php endif;
                            if( ! empty( $locations ) ): ?>
                                <select class="blog-loop-filter-dropdown" data-custom-dropdown>
                                    <option value="<?php echo esc_attr( remove_query_arg( 'l' ) ); ?>"><?php _e( 'Location', 'onegroup' ); ?></option>
                                    <?php foreach( $locations as $location ): ?>
                                        <option value="<?php echo esc_attr( add_query_arg( 'l', $location->term_id ) );
                                        ?>" <?php selected( $location->term_id, $current_location ); ?>><?php 
                                        echo esc_html( $location->name ); ?></option>
                                    <?php endforeach; ?>
                                </select><!-- / Locations Dropdown -->
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- / Blog Loop Filters -->
    <?php endif; ?>
    <div class="blog-loop-inner">
        <?php if( $query->have_posts() ): ?>
            <div class="blog-items">
                <?php while( $query->have_posts() ): $query->the_post();
                    get_template_part( 'template-parts/blog-item' );
                endwhile; ?>
            </div><!-- / Blog Loop Items -->
            <?php $next_link = get_next_posts_page_link( $query->max_num_pages );
            if( $next_link ): ?>
                <div class="blog-loop-pagination">
                    <a href="<?php echo esc_attr( $next_link ); ?>" class="blog-loop-next-link"><?php _e( 'Load more', 'onegroup' ); ?></a>
                </div><!-- / Pagination -->
            <?php endif; 
        wp_reset_postdata(); 
        else: ?>
            <p class="nothing-found"><?php _e( 'Nothing found', 'onegroup' ); ?></p>
        <?php endif; ?>
    </div>
</section><!--/ Blog Loop-->
<?php
ogr_open_container();