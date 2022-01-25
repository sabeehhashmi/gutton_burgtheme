<?php
$icon_id = (int) $data['icon_id'];
$icon_id = $icon_id > 0 ? $icon_id : '';
$button_text_upload = __( 'Upload Icon', 'onegroup' );
$button_text_remove = __( 'Remove Icon', 'onegroup' );
$banner_url = $icon_id > 0 ? ogr_get_image_url( $icon_id, 'thumbnail' ) : '';
$banner_image = ( '' !== $banner_url ) ? sprintf( '<img src="%s" />', esc_attr( $banner_url ) ) : '';
?>
<p>
    <input type="text" class="regular-text" name="ogr[age]" value="<?php echo esc_attr( $data['age'] ); ?>" placeholder="<?php esc_attr_e( 'Age Range', 'onegroup' ); ?>" />
</p>
<p>
    <label>Group Type</label>
    <select class="regular-text" name="ogr[color]">
        <option value="red" <?php echo ( $data['color'] == 'red' ) ? 'selected' : ''; ?>>Nursery</option>
        <option value="green" <?php echo ( $data['color'] == 'green' ) ? 'selected' : ''; ?>>Preschool</option>
        <option value="blue" <?php echo ( $data['color'] == 'blue' ) ? 'selected' : ''; ?>>Toddlers</option>
    </select>
</p>
<p>
    <label>Short Description</label>
    <textarea name="ogr[desc]"><?php echo $data['desc']; ?></textarea>
</p>
<p><?php _e( 'Icon', 'onegroup' ); ?></p>
<div>
    <div class="ogr-upload">
        <div class="ogr-upload-preview"><?php echo $banner_image; ?></div>
        <input type="hidden" name="ogr[icon_id]" class="ogr-upload-input" value="<?php echo $icon_id; ?>" />
        <button class="ogr-upload-button button-secondary" type="button" data-remove-text="<?php
        echo $button_text_remove; ?>" data-upload-text="<?php echo $button_text_upload; ?>"><?php
        echo $logo ? $button_text_remove : $button_text_upload; ?></button>
    </div>
</div>
