<?php

function _turtletot_block_categories( $categories, $post ) {
	return array_merge(
        $categories,
        [
            [
                'slug' => 'turtletot',
                'title'=> __( 'Turtletot', 'turtletot' )
            ]
        ]
    );
}
add_filter( 'block_categories', '_turtletot_block_categories', 10, 2 );

function _turtletot_gutenberg_register_blocks() {
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }
    wp_register_script( 'turtletot-blocks', ONEGROUP_URI . 'includes/blocks/blocks.js',
        [ 'wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'jquery' ], '1.0.0'
    );
    wp_register_style( 'turtletot-blocks', ONEGROUP_URI . 'includes/blocks/blocks.css' );

    $block_names = ['hero','site-introduction','parents','parent-slider', 'kinder','our-parents','parent-list','our-waitlist','turtletot-story','turtletot-came-to-be','turtletot-came-to-be-image','arrow-straight','arrow-curly','day-care-age-groups','text-with-left-image','text-with-right-image','get-in-touch-banner','contact-form','age-group-title-section','room-features','feature','bembul-banner','partner','partners','careers','job','jobs', 'services', 'service-tab', 'featured-success-stories',
    'success-story', 'featured-testimonials', 'testimonial', 'visit-cards', 'callout',
    'video-callout', 'reports', 'report-tab', 'angled-hero', 'video', 'featured-team',
    'team-member', 'iconics', 'iconic', 'loop', 'while-box', 'tabs', 'header',
    'team-members'];

    foreach( $block_names as $block_name ) {
        register_block_type( "turtletot/$block_name", [
            'style' => 'turtletot-blocks',
            'editor_script' => 'turtletot-blocks',
        ] );
    }
}
add_action( 'init', '_turtletot_gutenberg_register_blocks' );

function _turtletot_blocks_scripts(){
    wp_enqueue_script( 'turtletot-blocks' );
    wp_enqueue_style( 'turtletot-blocks' );

    // service categories
    $service_category_terms = get_terms( 'service_category', [
        'hide_empty' => false,
    ] );
    $service_categories = [];
    foreach( $service_category_terms as $service_category_term ) {
        $service_categories[ $service_category_term->term_id ] = $service_category_term->name;
    }

    $parent_category_terms = get_terms( 'parent_category', [
        'hide_empty' => false,
    ] );
    $parent_categories = [];
    foreach( $parent_category_terms as $parent_category_term ) {
        $parent_categories[ $parent_category_term->term_id ] = $parent_category_term->name;
    }

    // team categories
    $team_group_terms = get_terms( 'team_group', [
        'hide_empty' => false,
    ] );
    $team_groups = [];
    foreach( $team_group_terms as $team_group_term ) {
        $team_groups[ $team_group_term->term_id ] = $team_group_term->name;
    }

    // success stories
    $wp_success_stories = get_posts( [
        'posts_per_page' => -1,
        'post_type' => 'success_story'
    ] );
    $success_stories = [];
    foreach( $wp_success_stories as $wp_success_story ) {
        $success_stories[ $wp_success_story->ID ] = $wp_success_story->post_title;
    }

    // testimonials
    $wp_testimonials = get_posts( [
        'posts_per_page' => -1,
        'post_type' => 'testimonial'
    ] );
    $testimonials = [];
    foreach( $wp_testimonials as $wp_testimonial ) {
        $testimonials[ $wp_testimonial->ID ] = $wp_testimonial->post_title;
    }

    // team_members
    $wp_team_members = get_posts( [
        'posts_per_page' => -1,
        'post_type' => 'team_member'
    ] );
    $team_members = [];
    foreach( $wp_team_members as $wp_team_member ) {
        $team_members[ $wp_team_member->ID ] = $wp_team_member->post_title;
    }

    // locations
    $location_terms = get_terms( 'location', [
        'hide_empty' => false,
    ] );
    $locations = [];
    foreach( $location_terms as $location_term ) {
        $locations[ $location_term->term_id ] = $location_term->name;
    }

    // reports
    $wp_reports = get_posts( [
        'posts_per_page' => -1,
        'post_type' => 'report'
    ] );

    $location_reports = [];
    foreach( $wp_reports as $wp_report ) {
        $report_locations = wp_get_post_terms( $wp_report->ID , 'location' );
        if( empty( $report_locations ) ) {
            continue;
        }
        foreach( $report_locations as $report_location ) {
            if( ! isset( $location_reports[ $report_location->term_id ] ) ) {
                $location_reports[ $report_location->term_id ] = [];
            }
            $location_reports[ $report_location->term_id ][ $wp_report->ID ] = $wp_report->post_title;
        }
    }

    $wp_agegroups = get_posts( [
        'posts_per_page' => -1,
        'post_type' => 'agegroup'
    ] );

    $agegroups = [];
    foreach( $wp_agegroups as $wp_agegroup ) {
        $agegroups[ $wp_agegroup->ID ] = $wp_agegroup->post_title;
    }
    $wp_jobs = get_posts( [
        'posts_per_page' => -1,
        'post_type' => 'job'
    ] );

    $jobs = [];
    foreach( $wp_jobs as $wp_job ) {
        $jobs[ $wp_job->ID ] = $wp_job->post_title;
    }

    wp_localize_script( 'turtletot-blocks', 'turtletotData', [
        'service_categories' => $service_categories,
        'parent_categories' => $parent_categories,
        'success_stories' => $success_stories,
        'testimonials' => $testimonials,
        'location_reports' => $location_reports,
        'locations' => $locations,
        'team_members' => $team_members,
        'team_groups' => $team_groups,
        'agegroups' => $agegroups,
        'jobs' => $jobs,

    ] );
}
add_action( 'admin_enqueue_scripts', '_turtletot_blocks_scripts' );

function _turtletot_blocks_the_content( $the_content ){
    if( is_admin() ) {
        remove_filter( 'the_content', '_turtletot_blocks_the_content' );
        return $the_content;
    }
    $content = get_the_content( null, false, get_post() );
    $blocks = parse_blocks( $content );

    if( empty( $blocks ) ) {
        remove_filter( 'the_content', '_turtletot_blocks_the_content' );
        return $the_content;
    }

    ob_start();
    foreach( $blocks as $block ) {
        $block_name = $block['blockName'];
        $block_name_parts = explode( '/', $block_name );
        $group_name = ( ! empty( $block_name_parts ) ) ? $block_name_parts[0] : '';

        if( 'turtletot' !== $group_name ) {
            echo render_block( $block );
            continue;
        }

        $block_pure_name = $block_name_parts[1];
        extract( [
            'data' => $block['attrs'],
            'child_blocks' => $block['innerBlocks']
        ] );

        $file = ONEGROUP_TEMPLATES_PATH . "blocks/$block_pure_name.php";
        include $file;

    }

    remove_filter( 'the_content', '_turtletot_blocks_the_content' );
    return ob_get_clean();
}
add_filter( 'the_content', '_turtletot_blocks_the_content' );
