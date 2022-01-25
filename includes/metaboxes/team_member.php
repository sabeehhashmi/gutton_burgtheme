<?php 
$banner_id = (int) $data['banner_id'];
$banner_id = $banner_id > 0 ? $banner_id : '';
$button_text_upload = __( 'Upload File', 'onegroup' );
$button_text_remove = __( 'Remove File', 'onegroup' );
$banner_url = $banner_id > 0 ? ogr_get_image_url( $banner_id, 'thumbnail' ) : '';
$banner_image = ( '' !== $banner_url ) ? sprintf( '<img src="%s" />', esc_attr( $banner_url ) ) : '';
?>
<p>
    <input type="text" class="regular-text" name="ogr[role]" value="<?php echo esc_attr( $data['role'] ); ?>" placeholder="<?php esc_attr_e( 'Role', 'onegroup' ); ?>" />
</p>
<p>
    <input type="text" class="regular-text" name="ogr[linkedin_url]" value="<?php echo esc_attr( $data['linkedin_url'] ); ?>" placeholder="<?php esc_attr_e( 'LinkedIn URL', 'onegroup' ); ?>" />
</p>
<p><?php _e( 'Banner', 'onegroup' ); ?></p>
<div>
    <div class="ogr-upload">
        <div class="ogr-upload-preview"><?php echo $banner_image; ?></div>
        <input type="hidden" name="ogr[banner_id]" class="ogr-upload-input" value="<?php echo $banner_id; ?>" />
        <button class="ogr-upload-button button-secondary" type="button" data-remove-text="<?php 
            echo $button_text_remove; ?>" data-upload-text="<?php echo $button_text_upload; ?>"><?php 
            echo $logo ? $button_text_remove : $button_text_upload; ?></button>
    </div>
</div>