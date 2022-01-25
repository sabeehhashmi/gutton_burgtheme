<?php

function ogr_get_image( $id, $size = 'full' ){
    $id = (int) $id;
    if( $id < 1 ) {
        return false;
    }

    return wp_get_attachment_image( $id, $size );
}

function ogr_get_image_url( $id, $size = 'full' ){
    $id = (int) $id;
    if( $id < 1 ) {
        return false;
    }

    $src = wp_get_attachment_image_src( $id, $size );
    if( empty( $src ) ) {
        return false;
    }

    return $src[0];
}

function ogr_get_video( $id ) {
    $id = (int) $id;
    if( $id < 1 ) {
        return false;
    }

    $url = wp_get_attachment_url( $id );
    if( empty( $url ) ) {
        return false;
    }

    $mime_type = get_post_mime_type( $id );

    return [
        'url' => $url,
        'mime' => $mime_type
    ];

}

function ogr_get_youtube_id( $url ) {
    $url .= '&d=s';
    if( empty( $url ) ) {
        return false;
    }
    $parsed = parse_url( $url );
    if( empty( $parsed['query'] ) ) {
        return false;
    }

    $query_parts = explode( '&', $parsed['query'] );
    if( empty( $query_parts ) ) {
        return false;
    }

    $video_id = false;
    foreach( $query_parts as $query_part ) {
        $single_parts = explode( '=', $query_part );
        if( empty( $single_parts ) || 'v' !== $single_parts[0] ) {
            continue;
        }
        $video_id = $single_parts[1];
    }

    return $video_id;
}

function ogr_close_container(){
    echo '</div>';
}

function ogr_open_container(){
    echo '<div class="container">';
}

function ogr_the_post( $the_post ) {
    global $post;
    $post = $the_post;
    setup_postdata( $the_post );
}

function ogr_get_service_cta_button_text( $service_id ) {
    $data = get_post_meta( $service_id, 'ogr_data', true );

    return isset( $data['button_text'] ) ? trim( $data['button_text'] ) : '';
}

function ogr_get_headline( $post_id ) {
    $data = get_post_meta( $post_id, 'ogr_data', true );

    return isset( $data['headline'] ) ? trim( $data['headline'] ) : '';
}

function ogr_excerpt_hooks_on_success_story(){
    add_filter( 'excerpt_length', '_onegroup_excerpt_length_success_story', 999 );
    add_filter( 'excerpt_more', '_onegroup_excerpt_more_success_story', 999 );
}

function ogr_excerpt_hooks_off_success_story(){
    remove_filter( 'excerpt_length', '_onegroup_excerpt_length_success_story', 999 );
    remove_filter( 'excerpt_more', '_onegroup_excerpt_more_success_story', 999 );
}

function _onegroup_excerpt_length_success_story(){
    return 36;
}

function _onegroup_excerpt_more_success_story(){
    return '';
}

function ogr_get_data( $post_id ) {
    $data = get_post_meta( $post_id, 'ogr_data', true );

    return $data;
}

function ogr_get_setting( $group, $section, $setting ){
    $option_name = "{$group}_{$section}_{$setting}";
    $option = trim( get_theme_mod( $option_name ) );

    return $option;
}

function ogr_get_related_posts( $post_id, $quantity = 3 ) {
    $post = get_post( $post_id );
    if( empty( $post ) || 'post' !== $post->post_type ) {
        return false;
    }

    $categories = wp_get_object_terms( $post_id, 'category', [
        'hide_empty' => false,
        'fields' => 'ids'
    ] );
    $locations = wp_get_object_terms( $post_id, 'location', [
        'hide_empty' => false,
        'fields' => 'ids'
    ] );

    $args = [
        'posts_per_page' => $quantity,
        'post_type' => 'post',
        'orderby' => 'rand',
        'post__not_in' => [ $post_id ]
    ];
    $tax_query = [];
    if( ! empty( $categories ) ) {
        $tax_query[] = [
            'taxonomy' => 'category',
            'terms' => $categories
        ];
    }
    if( ! empty( $locations ) ) {
        $tax_query[] = [
            'taxonomy' => 'location',
            'terms' => $locations
        ];
    }
    if( ! empty( $tax_query ) ) {
        $tax_query['relation'] = 'OR';
        $args['tax_query'] = $tax_query;
    }

    $posts = get_posts( $args );

    return $posts;
}
function ogr_get_related_jobs( $post_id, $quantity = 3 ) {
    $post = get_post( $post_id );
    if( empty( $post ) || 'job' !== $post->post_type ) {
        return false;
    }

    $categories = wp_get_object_terms( $post_id, 'job_category', [
        'hide_empty' => false,
        'fields' => 'ids'
    ] );

    $args = [
        'posts_per_page' => $quantity,
        'post_type' => 'job',
        'orderby' => 'rand',
        'post__not_in' => [ $post_id ]
    ];
    $tax_query = [];
    if( ! empty( $categories ) ) {
        $tax_query[] = [
            'taxonomy' => 'job_category',
            'terms' => $categories
        ];
    }
    if( ! empty( $tax_query ) ) {
        $tax_query['relation'] = 'OR';
        $args['tax_query'] = $tax_query;
    }

    $posts = get_posts( $args );

    return $posts;
}
function ogr_get_terms( $post_type, $term_args ) {
    add_filter( 'terms_clauses', '_onegroup_filter_terms_by_cpt', 10, 3 );
    $term_args['post_types'] = [ $post_type ];
    $terms = get_terms( $term_args );
    remove_filter( 'terms_clauses', '_onegroup_filter_terms_by_cpt', 10 );

    return $terms;
}

function _onegroup_filter_terms_by_cpt( $pieces, $tax, $args){
    global $wpdb;

    // Don't use db count
    $pieces['fields'] .= ", COUNT(*) ";

    //Join extra tables to restrict by post type.
    $pieces['join'] .= " INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
                        INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id ";

    // Restrict by post type and Group by term_id for COUNTing.
    $post_types_str = implode( ',', $args['post_types'] );
    $pieces['where'] .= $wpdb->prepare(" AND p.post_type IN(%s) GROUP BY t.term_id", $post_types_str );


    return $pieces;
}

function ogr_get_post_terms_list( $post_id, $taxonomy ){
    $terms = get_the_terms( $post_id, $taxonomy );
    $out = '';
    if( ! empty( $terms ) ) {
        $term_names = [];
        foreach( $terms as $term ) {
            $term_names[] = $term->name;
        }
        $out = join( '<span class="sep"></span>', $term_names );
    }

    return $out;
}
