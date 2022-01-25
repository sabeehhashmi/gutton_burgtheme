<?php 
$logo = ( ! empty( $data['logo_id'] ) ) ? wp_get_attachment_image( $data['logo_id'], 'thumbnail' ) : '';
$button_text_upload = __( 'Upload Image', 'onegroup' );
$button_text_remove = __( 'Remove Image', 'onegroup' );
?>
<p>
    <input type="text" class="regular-text" name="ogr[author]" value="<?php echo esc_attr( $data['author'] ); ?>" placeholder="<?php esc_attr_e( 'Author', 'onegroup' ); ?>" />
    <input type="text" class="regular-text" name="ogr[company]" value="<?php echo esc_attr( $data['company'] ); ?>" placeholder="<?php esc_attr_e( 'Company', 'onegroup' ); ?>" />
</p>
<div>
    <div class="ogr-upload">
        <div class="ogr-upload-preview"><?php echo $logo; ?></div>
        <input type="hidden" name="ogr[logo_id]" class="ogr-upload-input" value="<?php echo esc_attr( $data['logo_id'] ); ?>" />
        <button class="ogr-upload-button button-secondary" type="button" data-remove-text="<?php 
            echo $button_text_remove; ?>" data-upload-text="<?php echo $button_text_upload; ?>"><?php 
            echo $logo ? $button_text_remove : $button_text_upload; ?></button>
    </div>
</div>