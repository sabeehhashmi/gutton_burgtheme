<?php

if( empty( $child_blocks ) ) {
    return;
}

$tabs = [];
foreach( $child_blocks as $child_block ) {
    $child_data = $child_block['attrs'];
    $tab_title = trim( $child_data['tab_title'] );
    if( '' === $tab_title ) {
        continue;
    }
    $content_title = trim( $child_data['content_title'] );
    $content_title = ( '' === $content_title ) ? $tab_title : '';
    $icon_id = (int) $child_data['tab_icon_id'];
    $icon_url = ogr_get_image_url( $icon_id );
    $tabs[] = [
        'title' => $tab_title,
        'icon_url' => $icon_url,
        'content_title' => $content_title,
        'content_text' => trim( $child_data['content_text'] ),
        'content_button' => [
            'url' => trim( $child_data['content_button_url'] ),
            'text' => trim( $child_data['content_button_text'] )
        ]
    ];
}

if( empty( $tabs ) ) {
    return;
}

$headline = trim( $data['headline'] );
$title = trim( $data['title'] );
$has_heading = ( '' !== $headline || '' !== $title );
$style = trim( $data['style'] );
$style_class = $style ? " style-$style" : '';

ogr_close_container();
?>
<div class="tabs-section<?php echo $style_class; ?>">
    <?php if( 'white-skewed' === $style ): ?>
        <div class="tabs-section-bg">
            <div class="tabs-section-bg-inner"></div>
        </div>
    <?php endif; ?>
    <section class="tabs">
        <?php if( $has_heading ): ?>
            <header class="tabs-header">
                <?php if( '' !== $headline ): ?>
                    <h2 class="tabs-headline"><?php echo $headline; ?></h2>
                <?php endif; 
                if( '' !== $title ): ?>
                    <h3 class="tabs-title"><?php echo $title; ?></h3>
                <?php endif; ?>
            </header>
        <?php endif; ?>
        <div class="tabs-container">
            <ul class="tab-titles">
                <?php foreach( $tabs as $tab ): ?>
                    <li><?php echo $tab['title']; ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-contents">
                <?php foreach( $tabs as $tab ): ?>
                    <div class="tab-content">
                        <?php if( $tab['icon_url'] ): ?>
                            <div class="tab-content-side">
                                <span class="tab-content-icon">
                                    <span class="tab-content-icon-image" style="background-image: url(<?php echo esc_attr( $tab['icon_url'] ); ?>)"></span>
                                </span>
                            </div>
                        <?php endif; ?>
                        <div class="tab-content-main">
                            <h4 class="tab-content-title"><?php echo $tab['content_title']; ?></h4>
                            <?php if( '' !== $tab['content_text'] ): ?>
                                <div class="tab-content-text"><?php echo wpautop( $tab['content_text'] ); ?></div>
                            <?php endif;
                            if( '' !== $tab['content_button']['url'] && '' !== $tab['content_button']['text'] ): ?>
                                <a href="<?php echo esc_attr( $tab['contet_button']['url'] ); ?>" class="tab-content-button"><?php echo $tab['content_button']['text']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section><!-- / Tabs -->
</div>
<?php
ogr_open_container();