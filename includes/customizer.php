<?php

function _onegroup_customize_register( $wp_customize ) {
    $options = include ONEGROUP_INCLUDES_PATH . 'customizer-options.php';
    foreach( $options as $panel_id => $panel_options ) {
        $wp_customize->add_panel( $panel_id, array(
            'title' => $panel_options['title'],
            'priority' => 0
        ) );
        foreach( $panel_options['sections'] as $section_id => $section_options ) {
            $section_id = $panel_id . '_' . $section_id; 
            $wp_customize->add_section( $section_id , array(
                'title' => $section_options['title'],
                'panel' => $panel_id,
            ) );
            
            foreach( $section_options['settings'] as $setting_id => $setting_options ) {
                $setting_id = $section_id . '_' . $setting_id;
                $wp_customize->add_setting( $setting_id );
                $control_options = $setting_options;
                unset( $control_options['title'] );
                $control_options['label'] = $setting_options['title'];
                $control_options['section'] = $section_id;
                $control_options['settings'] = $setting_id;
                
                if( 'image' === $control_options['type'] ) {
                    unset( $control_options['type'] );
                    $wp_customize->add_control( new WP_Customize_Image_Control(
                        $wp_customize, $setting_id, $control_options ) );
                    continue;
                }
                if( 'dropdown-custom-post-type' === $control_options['type'] ) {
                    $post_type = $control_options['post_type'];
                    $posts = get_posts( [
                        'posts_per_page' => -1,
                        'post_type' => $post_type,
                        'orderby' => 'title',
                        'order' => 'ASC'
                    ] );
                    $choices = [];
                    foreach( $posts as $post ) {
                        $choices[ $post->ID ] = $post->post_title;
                    }
                    $control_options['type'] = 'select';
                    $control_options['choices'] = $choices;
                }
                $wp_customize->add_control( new WP_Customize_Control(
                        $wp_customize, $setting_id, $control_options ) );
            }
        }
    }
}

add_action( 'customize_register', '_onegroup_customize_register' );