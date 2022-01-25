<?php 
$file_id = (int) $data['file_id'];
$file_id = $file_id > 0 ? $file_id : '';
$button_text_upload = __( 'Upload File', 'onegroup' );
$button_text_remove = __( 'Remove File', 'onegroup' );
$file_url = $file_id > 0 ? includes_url( 'images/media/document.png' ) : '';
$file_image = ( '' !== $file_url ) ? sprintf( '<img src="%s" />', esc_attr( $file_url ) ) : '';
?>
<div>
    <div class="ogr-upload">
        <div class="ogr-upload-preview"><?php echo $file_image; ?></div>
        <input type="hidden" name="ogr[file_id]" class="ogr-upload-input" value="<?php echo $file_id; ?>" />
        <button class="ogr-upload-button button-secondary" type="button" data-type="application/pdf" data-remove-text="<?php 
            echo $button_text_remove; ?>" data-upload-text="<?php echo $button_text_upload; ?>"><?php 
            echo $logo ? $button_text_remove : $button_text_upload; ?></button>
    </div>
</div>