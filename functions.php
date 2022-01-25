<?php

// config
define( 'ONEGROUP_PATH', trailingslashit( get_template_directory() ) );
define( 'ONEGROUP_INCLUDES_PATH', ONEGROUP_PATH . 'includes/' );
define( 'ONEGROUP_LIBRARY_PATH', ONEGROUP_PATH . 'library/' );
define( 'ONEGROUP_TEMPLATES_PATH', ONEGROUP_PATH . 'template-parts/' );
define( 'ONEGROUP_URI', trailingslashit( get_template_directory_uri() ) );

// load
require_once ONEGROUP_INCLUDES_PATH . 'common.php';
require_once ONEGROUP_INCLUDES_PATH . 'custom-post-types.php';
require_once ONEGROUP_INCLUDES_PATH . 'customizer.php';
require_once ONEGROUP_INCLUDES_PATH . 'shortcodes.php';
require_once ONEGROUP_INCLUDES_PATH . 'menu.php';
require_once ONEGROUP_INCLUDES_PATH . 'main-menu-walker.php';
require_once ONEGROUP_INCLUDES_PATH . 'blocks/blocks.php';

// scripts
function _onegroup_scripts(){
    wp_enqueue_style( 'turtletot', ONEGROUP_URI . '/turtletot-assets/scss/main-style.css' );
   // wp_enqueue_style( 'Turtletot-bstrap', ONEGROUP_URI . 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
    wp_enqueue_style( 'turtletot-carousel', ONEGROUP_URI . '/turtletot-assets/css/owl.carousel.min.css' );
    wp_enqueue_style( 'turtletot-carousel', ONEGROUP_URI . '/turtletot-assets/css/owl.theme.green.min.css' );
    wp_enqueue_style( 'turtletot-gstatic' , '/https://fonts.gstatic.com' );

    wp_enqueue_style( 'turtletot-googleapis' , 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap' );

    wp_enqueue_script( 'Turtletot-plugins', ONEGROUP_URI . '/turtletot-assets/js/jquery-3.5.1.js', ['jquery'], '1.0.0', true );
    wp_enqueue_script( 'Turtletot-bootstrap', ONEGROUP_URI . '/turtletot-assets/js/bootstrap.min.js', ['jquery'], '1.0.0', true );
    wp_enqueue_script( 'Turtletot-carousel', ONEGROUP_URI . '/turtletot-assets/js/owl.carousel.min.js', ['jquery'], '1.0.0', true );
    wp_enqueue_script( 'Turtletot-cutom', ONEGROUP_URI . '/turtletot-assets/js/cutom.js', ['jquery'], '1.0.0', true );

    wp_localize_script( 'Turtletot', 'TurtletotData', [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'hubspot_css' => ONEGROUP_URI . 'assets/css/hubspot.css'
    ] );
}
add_action( 'wp_enqueue_scripts', '_onegroup_scripts' );

function _onegroup_admin_scripts(){
    wp_enqueue_media();
    wp_enqueue_script( 'onegroup-admin', ONEGROUP_URI . 'assets/js/admin.js', ['jquery'], '1.0.0', true );
    wp_enqueue_style( 'onegroup-admin', ONEGROUP_URI . 'assets/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', '_onegroup_admin_scripts' );

// setup
add_action( 'after_setup_theme', '_onegroup_after_setup_theme' );
function _onegroup_after_setup_theme(){
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}

// menu
register_nav_menus( [
    'main' => __( 'Main Menu', 'onegroup' ),
    'footer' => __( 'Footer Menu', 'onegroup' ),
    'footer_1' => __( 'Footer 1', 'onegroup' ),
    'footer_2' => __( 'Footer 2', 'onegroup' ),
    'footer_3' => __( 'Footer 3', 'onegroup' ),
    'footer_4' => __( 'Footer 4', 'onegroup' ),
    'footer_social' => __( 'Footer Social', 'onegroup' ),
] );

// page post states
global $ogr_data;
$ogr_data = [];

add_filter( 'display_post_states', '_onegroup_display_post_states', 10, 2 );
function _onegroup_display_post_states( $post_states, $post ){
    global $ogr_data;
    if( ! isset( $ogr_data['template_ids'] ) ) {
        $ogr_data['template_ids'] = [
            'report' => (int) ogr_get_setting( 'general', 'report', 'archive_page' ),
            'success_story' => (int) ogr_get_setting( 'general', 'success_story', 'archive_page' ),
            'service' => (int) ogr_get_setting( 'general', 'service', 'archive_page' ),
            'testimonial' => (int) ogr_get_setting( 'general', 'testimonial', 'archive_page' ),
            'team_member' => (int) ogr_get_setting( 'general', 'team_member', 'archive_page' ),
        ];
        $ogr_data['template_names'] = [
            'report' => __( 'Reports Archive Page', 'onegroup' ),
            'success_story' => __( 'Success Stories Archive Page', 'onegroup' ),
            'service' => __( 'Services Archive Page', 'onegroup' ),
            'testimonial' => __( 'Testimonials Archive Page', 'onegroup' ),
            'team_member' => __( 'Team Member Archive Page', 'onegroup' ),
        ];
    }

    foreach( $ogr_data['template_ids'] as $template_name => $template_id ) {
        if( $post->ID === $template_id ) {
            $post_states[ $template_name ] = $ogr_data['template_names'][ $template_name ];
        }
    }

    return $post_states;
}

 function _onegroup_excerpt_more( $more ) {
     return '...';
 }
 add_filter( 'excerpt_more', '_onegroup_excerpt_more' );
function sabeeh_get_the_excerpt($post_id) {
  global $post;
  $save_post = $post;
  $post = get_post($post_id);
  $output = get_the_excerpt();
  $post = $save_post;
  return $output;
}
