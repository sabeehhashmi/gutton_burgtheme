<?php

if( empty( $child_blocks ) ) {
    return;
}
$quantity = (int) $data['quantity'];
$quantity = ( $quantity < 1 ) ? -1 : $quantity;
$services = [];

foreach( $child_blocks as $child_block ) {
    $category_id = (int) $child_block['attrs']['category_id'];
    if( $category_id < 1 ) {
        continue;
    }
    
    $category = get_term( $category_id, 'service_category' );
    if( empty( $category ) ) {
        continue;
    }
    
    $service_posts = get_posts( [
        'posts_per_page' => $quantity,
        'post_type' => 'service',
        'tax_query' => [
            [
                'taxonomy' => 'service_category',
                'field'    => 'term_id',
                'terms'    => $category_id,
            ]
        ]
    ] );
    if( empty( $service_posts ) ) {
        continue;
    }
    
    $title = trim( $child_block['attrs']['title'] );
    
    $services[] = [
        'title' => ( '' !== $title ) ? $title : $category->name,
        'posts' => $service_posts
    ];
}

if( empty( $services ) ) {
    return;
}

$button_text = trim( $data['button_text'] );
$title = trim( $data['title'] );
$layout = trim( $data['layout'] );
$layout_class = $layout ? " layout-$layout" : '';

?>
<section class="services<?php echo $layout_class; ?>">
    <?php if( '' !== $title ): ?>
        <header class="services-heading">
            <h2 class="services-title"><?php echo $title; ?></h2>
        </header>
    <?php endif; ?>
    <div class="service-tabs">
        <ul class="service-tab-titles">
            <?php foreach( $services as $service ): ?>
                <li class="service-tab-title"><?php echo $service['title']; ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="service-tab-contents">
            <?php foreach( $services as $service ): ?>
                <div class="service-tab-content">
                    <?php foreach( $service['posts'] as $service_post ):
                        ogr_the_post( $service_post );
                        $cta_button_text = ( '' !== $button_text ) ? $button_text : trim( ogr_get_service_cta_button_text( $service_post->ID ) ); ?>
                        <div class="service-item-container">
                            <a class="service-item" href="<?php echo esc_attr(get_the_permalink() ); ?>">
                                <div class="service-item-media"><?php the_post_thumbnail( 'large' ); ?></div>
                                <div class="service-item-contents">
                                    <h3 class="service-item-title"><?php the_title(); ?></h3>
                                    <?php if( '' !== $cta_button_text ): ?>
                                        <span class="service-item-button"><?php echo $cta_button_text; ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section><!-- / Services -->
<?php 
wp_reset_postdata();