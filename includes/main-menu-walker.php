<?php

namespace OneGroup;

if( ! defined( 'ABSPATH' ) ) {
    return;
}

class Main_Menu_Walker extends \Walker_Nav_Menu{
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul>';
    }
        
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $text = esc_html( $item->title );
        $url = esc_attr( $item->url );
//        $has_children = in_array( 'menu-item-has-children', $item->classes ); 
        $has_children = true;
        $sub_html = '';
        if( 0 === $depth && $has_children ) {
            $sub_html .= '<div class="sub-menu-container">';
        }
        if( 1 === $depth && $has_children ) {
            $sub_html .= '<div class="sub-menu"><div class="sub-menu-main">';
            $subtitle = trim( $item->attr_title );
            $subtitle = ( '' !== $subtitle ) ? $subtitle : $text;
            $subdescription = trim( $item->description );
            $sub_html .= sprintf( '<div class="sub-menu-header"><strong class="sub-menu-title">%s</strong>%s</div>', 
                esc_html( $subtitle ), 
                ( '' !== $subdescription ? sprintf( '<div class="sub-menu-content">%s</div>', wpautop( $subdescription ) ) : '' ) 
            );
        }

        $classes = ( ! empty( $item->classes ) ) ? sprintf( ' class="%s"', esc_attr( join( ' ', $item->classes ) ) ) : '';
        $output .= sprintf( '<li%s><a href="%s">%s</a>%s', $classes, $url, $text, $sub_html );
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
//        $has_children = in_array( 'menu-item-has-children', $item->classes ); 
        $has_children = true;
        $sub_html = '';
        if( 0 === $depth && $has_children ) {
            $sub_html .= '<div class="sub-menu"></div></div>';
        }
        if( 1 === $depth && $has_children ) {
            $sub_html .= '</div>';
            $image_id = (int) get_post_meta( $item->ID, '_ogr_image_id', true );
            $image = $image_id > 0 ? wp_get_attachment_image( $image_id, 'medium' ) : '';
            if( '' !== $image ) {
                $sub_html .= '<div class="sub-menu-image">' . $image . '</div>';
            }
            $sub_html .= '</div>';
        }
        $output .= $sub_html . '</li>';
    }
}