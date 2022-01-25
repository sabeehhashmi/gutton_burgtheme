<?php

add_action( 'init', '_onegroup_register_cpt' );
function _onegroup_register_cpt(){

    // Age Group
    register_post_type( 'AgeGroup', [
        'labels' => [
            'name' => __( 'AgeGroups', 'onegroup' ),
            'singular_name' => __( 'AgeGroup', 'onegroup' ),
        ],
        'public'             => true,
        'show_ui'            => true,
        'show_in_rest' => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => ['title', 'thumbnail', 'editor'],

    ] );
    // job
    register_post_type( 'job', [
        'labels' => [
            'name' => __( 'Jobs', 'onegroup' ),
            'singular_name' => __( 'Job', 'onegroup' ),
        ],
        'public'             => true,
        'show_ui'            => true,
        'show_in_rest' => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => ['title', 'editor'],

    ] );
    register_taxonomy( 'job_category', 'job', [
        'labels' => [
            'name' => __( 'Job Categories', 'onegroup' ),
            'singular_name' => __( 'Job Category', 'onegroup' ),
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_admin_column'  => true,
        'show_in_quick_edit' => true,
        'hierarchical'       => true,
        'show_in_rest' => true
    ] );





}

// === Save Data === //
add_action( 'save_post', '_onegroup_save_post_meta' );
function _onegroup_save_post_meta( $post_id ) {
    $meta_data = filter_input( INPUT_POST, 'ogr', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
    if( empty( $meta_data ) ) {
        return;
    }

    update_post_meta( $post_id, 'ogr_data', $meta_data );
}

// === Metaboxes === //
add_action( 'add_meta_boxes', '_onegroup_add_meta_boxes' );
function _onegroup_add_meta_boxes() {
    add_meta_box( 'ogr-service-cta', __( 'CTA', 'onegroup' ),
        '_onegroup_metabox_service_cta', 'service', 'side' );
    add_meta_box( 'ogr-headline', __( 'Headline', 'onegroup' ),
        '_onegroup_metabox_headline', 'success_story', 'advanced' );
    add_meta_box( 'ogr-testimonial', __( 'Testimonial Attributes', 'onegroup' ),
        '_onegroup_metabox_testimonial', 'testimonial', 'advanced' );
    add_meta_box( 'ogr-report', __( 'Report File', 'onegroup' ),
        '_onegroup_metabox_report', 'report', 'advanced' );
    add_meta_box( 'ogr-team-member', __( 'About', 'onegroup' ),
        '_onegroup_metabox_team_member', 'team_member', 'side' );
    add_meta_box( 'ogr-age-group', __( 'About', 'onegroup' ),
        '_onegroup_metabox_age_group', 'AgeGroup', 'side' );
    add_meta_box( 'ogr-long-title', __( 'School Type', 'onegroup' ),
        '_onegroup_metabox_post', 'post', 'side' );
    add_meta_box( 'ogr-job', __( 'Extra Fields', 'onegroup' ),
        '_onegroup_metabox_job', 'job', 'side' );
}

/* Post Long Title */
function _onegroup_metabox_post( $post ) {
    $data = get_post_meta( $post->ID, 'ogr_data', true );
    $data = wp_parse_args( $data, [
        'school_type' => '',
    ] );
    extract( [ 'data' => $data ] );
    include ONEGROUP_INCLUDES_PATH . 'metaboxes/simple_post.php';
}

/* Service CTA */
function _onegroup_metabox_service_cta( $post ) {
    $data = get_post_meta( $post->ID, 'ogr_data', true );
    $data = wp_parse_args( $data, [
        'button_text' => ''
    ] );
    extract( [ 'data' => $data ] );
    include ONEGROUP_INCLUDES_PATH . 'metaboxes/service_cta.php';
}

/* Headline */
function _onegroup_metabox_headline( $post ) {
    $data = get_post_meta( $post->ID, 'ogr_data', true );
    $data = wp_parse_args( $data, [
        'headline' => ''
    ] );
    extract( [ 'data' => $data ] );
    include ONEGROUP_INCLUDES_PATH . 'metaboxes/headline.php';
}

/* Testimonial */
function _onegroup_metabox_testimonial( $post ) {
    $data = get_post_meta( $post->ID, 'ogr_data', true );
    $data = wp_parse_args( $data, [
        'author' => '',
        'company' => '',
        'logo_id' => ''
    ] );
    extract( [ 'data' => $data ] );
    include ONEGROUP_INCLUDES_PATH . 'metaboxes/testimonial.php';
}

/* Report */
function _onegroup_metabox_report( $post ) {
    $data = get_post_meta( $post->ID, 'ogr_data', true );
    $data = wp_parse_args( $data, [
        'file_id' => 0
    ] );
    extract( [ 'data' => $data ] );
    include ONEGROUP_INCLUDES_PATH . 'metaboxes/report.php';
}


/* Team Member */
function _onegroup_metabox_team_member( $post ) {
    $data = get_post_meta( $post->ID, 'ogr_data', true );
    $data = wp_parse_args( $data, [
        'role' => ''
    ] );
    extract( [ 'data' => $data ] );
    include ONEGROUP_INCLUDES_PATH . 'metaboxes/team_member.php';
}
/* Age grooup */
function _onegroup_metabox_age_group( $post ) {
    $data = get_post_meta( $post->ID, 'ogr_data', true );
    $data = wp_parse_args( $data, [
        'role' => '',
        'desc' => ''
    ] );
    extract( [ 'data' => $data ] );
    include ONEGROUP_INCLUDES_PATH . 'metaboxes/age_group.php';
}
/* Jobs */
function _onegroup_metabox_job( $post ) {
    $data = get_post_meta( $post->ID, 'ogr_data', true );
    $data = wp_parse_args( $data, [
        'location' => '',
        'location_link' => '',
        'type_of_work' => '',
    ] );
    extract( [ 'data' => $data ] );
    include ONEGROUP_INCLUDES_PATH . 'metaboxes/jobs.php';
}
