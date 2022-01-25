<?php

function _onegroup_wp_nav_menu_item_custom_fields( $item_id, $item, $depth, $args, $id ){
    if( $depth !== 1 ) {
        return;
    }

    $image_id = (int) get_post_meta( $item_id, '_ogr_image_id', true );
    $input_val = $image_id > 0 ? $image_id : '';
    $image = $image_id >0 ? wp_get_attachment_image( $image_id ) : '';
    $upload_text = __( 'Upload', 'onegroup' );
    $remove_text = __( 'Remove', 'onegroup' );
    $button_text = $image_id > 0 ? $remove_text : $upload_text;

    /*$out = '<div class="ogr-menu-upload-container">'
                . '<div class="ogr-upload">'
                    . '<div class="ogr-upload-preview">' . $image . '</div>'
                    . '<input type="hidden" name="menu-item-image[' . $item_id . ']" class="ogr-upload-input" value="' . $input_val . '" />'
                    . '<button class="ogr-upload-button button-secondary" type="button" data-remove-text="'
                    . $remove_text . '" data-upload-text="' . $upload_text . '">' . $button_text . '</button>'
                . '</div>'
            . '</div>';
    echo $out;*/

}
add_action('wp_nav_menu_item_custom_fields', '_onegroup_wp_nav_menu_item_custom_fields', 10, 5 );

function _onegroup_wp_update_nav_menu( $menu_id ) {
    $menu_item_images = filter_input( INPUT_POST, 'menu-item-image', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
    if( empty( $menu_item_images ) ) {
        return;
    }

    foreach( $menu_item_images as $item_id => $image_id ) {
        $image_id = (int) $image_id;
        if( $image_id < 1 ) {
            delete_post_meta( $item_id, '_ogr_image_id' );
            continue;
        }
        update_post_meta( $item_id, '_ogr_image_id', $image_id );
    }
}
add_action( 'wp_update_nav_menu', '_onegroup_wp_update_nav_menu', 10, 1 );
