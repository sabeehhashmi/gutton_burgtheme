<?php

add_shortcode( 'ogr_title', '_ogr_shortcode_title' );
function _ogr_shortcode_title( $atts ) {
    return get_the_title( get_queried_object_id() );
}