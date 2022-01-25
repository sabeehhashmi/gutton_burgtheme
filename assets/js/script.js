function hubspot_form_ready( $form ){
    ( function( $ ) {
            'use strict';
            
            var $input_submit = $form.find( 'input[type="submit"]' );
            if( $input_submit.length > 0 ) {
                var $button_submit = $( '<button />', {
                    type: 'submit',
                    'class': $input_submit.attr( 'class' ),
                    'data-reactid': $input_submit.attr( 'data-reactid' )
                } );
                $button_submit.text( $input_submit.val() );
                $button_submit.data( 'reactid', $input_submit.attr( 'data-reactid' ) );
                $input_submit.replaceWith( $button_submit );
            }
            
            var $html = $form.closest( 'html' );
            var $head = $html.find( 'head' );
            $( '<link />', {
                rel: 'stylesheet',
                type: 'text/css',
                media: 'all',
                href: OneGroupData.hubspot_css
            } ).appendTo( $head );
    } ( jQuery ) );
}

jQuery( document ).ready( function() {
    // === Global Functions === //
    function get_youtube_iframe( id ) {
        var url = 'https://www.youtube.com/embed/' + id;
        var $iframe = jQuery( '<iframe />', {
            type: 'text/html',
            width: 640,
            height: 360,
            src: url + '?autoplay=1&mute=1',
            frameborder: 0
        } );
        
        return $iframe;
    }
    
    // === Main Container === //
    ( function( $ ) {
        'use strict';

        var $container = $( '.main-container' );
        if( $container.length < 1 ) {
            return;
        }
        
        var $header = $( '.header' ),
            $footer = $( '.footer' ),
            $window = $( window ),
            $html = $( 'html' );
        function adjust_size() {
            var min_height = $window.height() 
                    - $header.outerHeight( true ) 
                    - $footer.outerHeight( true ) 
                    - parseInt( $html.css( 'margin-top' ) );
            var min_height_css = ( min_height > 0 ) ? ( min_height + 'px' ) : '';
            $container.css( 'min-height', min_height_css );
        }
        
        adjust_size();
        $window.on( 'resize', function() {
            adjust_size();
        } );
    } ( jQuery ) );
    
    // === Service Tabs === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' )
            .on( 'click', '.service-tab-title', function() {
                var $tab = $( this );

                if( $tab.is( '.active' ) ) {
                    return;
                }

                $tab.siblings( '.active' ).removeClass( 'active' );
                $tab.addClass( 'active' );
                
                var $tab_content = $tab.closest( '.service-tabs' )
                        .find( '.service-tab-contents .service-tab-content:eq(' + $tab.index() + ')' );
                $tab_content.siblings( '.active' ).removeClass( 'active' );
                $tab_content.addClass( 'active' );
            } );
        
        $( '.service-tab-titles .service-tab-title:first-child' ).trigger( 'click' );
    } ( jQuery ) );
    
    // === Featured Success Stories === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' ).on( 'click', '.success-story-item', function() {
            var $item = $( this );
            if( $item.is( '.active' ) ) {
                return;
            }
            
            var $story = $item.closest( '.featured-success-stories' ).find( '.featured-success-story' );
            var $story_contents = $story.find( '.featured-success-story-contents' );
            $story_contents.empty();
            
            var $title = $item.find( '.success-story-item-title' );
            $title.clone().removeClass( 'success-story-item-title' ).addClass( 'featured-success-story-title' ).appendTo( $story_contents );
            
            var $excerpt = $item.find( '.success-story-item-excerpt' ).clone();
            var $excerpt_link = $excerpt.find( '.success-story-item-link' );
            $excerpt.removeClass( 'success-story-item-excerpt' ).addClass( 'featured-success-story-excerpt' );
            $excerpt_link.removeClass( 'success-story-item-link' ).addClass( 'featured-success-story-link' );
            var $excerpt_last_paragraph = $excerpt.find( 'p' ).last();
            if( $excerpt_last_paragraph.length > 0 ) {
                $excerpt_link.appendTo( $excerpt_last_paragraph );
            }
            $excerpt.appendTo( $story_contents );
            
            var $image = $item.find( '.success-story-item-image' );
            var $story_image = $story.find( '.featured-success-story-image' );
            var $new_story_image = $( '<div class="success-story-item-image" />' );
            if( $image.length > 0 ) {
                $new_story_image = $( '<a />', {
                    href: $excerpt_link.get( 0 ).href,
                    'class': 'featured-success-story-image'
                } );
                $image.find( 'img' ).clone().appendTo( $new_story_image );
            }
            $story_image.replaceWith( $new_story_image );
            
            $item.siblings( '.active' ).removeClass( 'active' );
            $item.addClass( 'active' );
        } );
        
        $( '.featured-success-stories' ).each( function() {
            var $container = $( this );
            var $inner = $container.find( '.featured-success-stories-inner' );

            var $story = $( '<div class="featured-success-story" />' ).prependTo( $inner );
            var $side = $( '<div class="featured-success-story-side" />' ).appendTo( $story );
            $( '<div class="featured-success-story-image" />' ).appendTo( $side );
            var $main = $( '<div class="featured-success-story-main" />' ).appendTo( $story );
            
            var $title = $container.find( '.featured-success-stories-title' ),
                $archive_link = $container.find( '.featured-success-stories-archive-link' );
                
            if( $title.length > 0 || $archive_link.length > 0 ) {
                var $stories_heading = $( '<div class="featured-success-story-main-heading" />' ).appendTo( $main );
                if( $title.length > 0 ) {
                    $title.clone().appendTo( $stories_heading );
                }
                if( $archive_link.length > 0 ) {
                    $archive_link.clone().appendTo( $stories_heading );
                }
            }
            
            $( '<div class="featured-success-story-contents" />' ).appendTo( $main );
            
            $container.find( '.success-story-item:eq(0)' ).trigger( 'click' );
            
            // mobile support
            var $carousel = $( '<div class="featured-success-stories-slider" />' ).insertAfter( $inner.find( '.success-story-items' ) );
            $container.find( '.success-story-items' ).clone().appendTo( $carousel );
            
        } );
        
        $( '.featured-success-stories-slider .success-story-items' ).lightSlider( {
            item: 1,
            controls: false,
            slideMargin: 0
        } );
    } ( jQuery ) );
    
    // === Featured Team === //
    ( function( $ ) {
        'use strict';
        
        $( '.featured-team-member-items' ).each( function() {
            var $items = $( this );
            $items.lightSlider( {
                item: 3,
                controls: false,
                slideMargin: 40,
                pager: false,
                responsive : [
                    {
                        breakpoint:900,
                        settings: {
                            item: 2,
                            slideMargin: 30
                          }
                    },
                    {
                        breakpoint:550,
                        settings: {
                            item: 1,
                            slideMargin: 30
                          }
                    }
                ]
            } );
        } );
    } ( jQuery ) );
    
    // === Featured Testimonials === */
    ( function( $ ) {
        'use strict';
        
        $( '.testimonial-items' ).lightSlider( {
            item: 1,
            controls: false,
            slideMargin: 0,
            adaptiveHeight: true,
            onSliderLoad: function( el ) {
                var $slider = $( el[0] );
                var $image = $slider.find( '.testimonial-item:eq(0) .testimonial-item-image img' );
                if( $image.length > 0 ) {
                    var $featured_image = $slider.closest( '.featured-testimonials' ).find( '.featured-testimonials-image' );
                    $image.clone().appendTo( $featured_image );
                }
            },
            onBeforeSlide: function( el ) {
                var $slider = $( el[0] );
                var eq = el.getCurrentSlideCount() - 1;
                var $image = $slider.find( '.testimonial-item:eq(' + eq + ') .testimonial-item-image img' );
                var $featured_image = $slider.closest( '.featured-testimonials' ).find( '.featured-testimonials-image' );
                $featured_image.empty();
                if( $image.length > 0 ) {
                    $image.clone().appendTo( $featured_image );
                }
            }
        } );
        $( '.featured-testimonials-archive-link' ).each( function() {
            var $link = $( this );
            $link.clone().appendTo( $link.closest( '.featured-testimonials-main' ) );
        } );
    } ( jQuery ) );
    
    // === Hero === //
    ( function( $ ) {
        'use strict';
        
        var $window = $( window ),
            $html = $( 'html' );

        function adjust(){
            var min_height = $( window ).height() - parseInt( $html.css( 'margin-top' ) ) - $( '.header' ).outerHeight();
            min_height = min_height > 0 ? ( min_height + 'px' ) : '';
            $( '.hero' ).each( function() {
                $( this ).css( 'min-height', min_height );
            } );
        }
        
        adjust();
        $window.on( 'resize', function() {
            adjust();
        } );
    } ( jQuery ));
    
    // === Main Navigation === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' ).on( 'mouseenter', '.main-nav > ul > li > .sub-menu-container > ul > li', function() {
            var $li = $( this ),
                $li_submenu = $li.find( '.sub-menu' ),
                $submenu = $li.closest( '.sub-menu-container' ).find( ' > .sub-menu' );
                
            if( $li_submenu.length > 0 ) {
                $submenu.replaceWith( $li_submenu.clone() );
            }
            else{
                $submenu.empty();
            }
            $li.siblings( '.active' ).removeClass( 'active' );
            $li.addClass( 'active' );
        } );
        $( '.main-nav > ul > li > .sub-menu-container > ul > li:first-child' ).trigger( 'mouseenter' );
        
        // mobile nav
        $( '<button class="nav-toggle" type="button" />' ).insertBefore( '.header .menus' );
        $( 'body' )
            .on( 'click', '.nav-toggle', function() {
                $( 'body' ).toggleClass( 'nav-active' );
            } )
            .on( 'click', '.submenu-toggle', function( e ) {
                e.stopPropagation();
                $( this ).parent().toggleClass( 'closed' );
            } );
        
        $( '.main-nav > ul > li.menu-item-has-children' ).prepend( '<button class="submenu-toggle" type="button" />' );
    } ( jQuery ) );
    
    // === Video Callout === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' ).on( 'click', '.video-callout-media-play-button', function() {
            var $button = $( this ),
                $media = $button.closest( '.video-callout-media' );
            
            $button.addClass( 'state-loading' );
            var $youtube = $media.find( '.video-callout-youtube' );
            if( $youtube.length > 0 ) {
                get_youtube_iframe( $youtube.data( 'id' ) ).appendTo( $youtube );
                $media.addClass( 'state-ready' );
                
                return;
            }
            
            var $video = $media.find( '.video-callout-video-el' );
            if( $video.length > 0 ) {
                $media.addClass( 'state-ready' );
                $video.get( 0 ).play();
            }
        } );
    } ( jQuery ) );
    
    // === Video === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' ).on( 'click', '.video-play-button', function() {
            var $button = $( this ),
                $container = $button.closest( '.video' );
                
            var $video = $container.find( '.video-el' );
            if( $video.length > 0 ) {
                $container.addClass( 'state-ready' );
                $video.get( 0 ).play();
                return;
            }
            
            var $youtube = $container.find( '.video-youtube' );
            if( $youtube.length > 0 ) {
                get_youtube_iframe( $youtube.data( 'id' ) ).appendTo( $youtube );
                $container.addClass( 'state-ready' );
            }
        } );
    } ( jQuery ) );
    
    // === Featured Reports === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' ).on( 'click', '.featured-reports-tabs li', function() {
            var $li = $( this );
            if( $li.is( '.active' ) ) {
                return;
            }
            
            var $contents = $li.closest( '.featured-reports' ).find( '.featured-reports-contents' );
            var index = $li.index();
            $contents.find( '.featured-reports-content.active' ).removeClass( 'active' );
            $li.siblings( '.active' ).removeClass( 'active' );
            $contents.find( '.featured-reports-content' ).eq( index ).addClass( 'active' );
            $li.addClass( 'active' );
        } );
        $( '.featured-reports-tabs li:first-child' ).trigger( 'click' );
        
        $( '.featured-reports-archive-link-container' ).each( function() {
            var $link = $( this );
            $link.clone().appendTo( $link.closest( '.featured-reports' ) );
        } );
    } ( jQuery ) );
    
    // === Loop | Filter Dropdowns === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' ).on( 'change', '.loop-filter-dropdown', function() {
            var $select = $( this ),
                val = $select.val();
                window.location.href = val;
                console.log( val );
        } );
    } ( jQuery ) );
    
    // === Custom Dropdowns === //
    ( function( $ ) {
        'use strict';
        
        $( '[data-custom-dropdown]' ).each( function() {
            var $dropdown = $( this ),
                val = $dropdown.val();
                
            var text = $dropdown.find( 'option[value="' + val + '"]' ).text();
            var $container = $( '<div class="dropdown-container" />' ).insertBefore( $dropdown );
            var $button = $( '<button type="button" class="dropdown-button" />' ).appendTo( $container );
            $button.text( text );
            $dropdown.appendTo( $container );
            
        } );
        
        $( 'body' ).on( 'change', '[data-custom-dropdown]', function() {
            var $dropdown = $( this ),
                val = $dropdown.val(),
                $button = $dropdown.prev();
            var text = $dropdown.find( 'option[value="' + val + '"]' ).text();
            $button.text( text );
        } );
    }( jQuery ) );
    
    // === Loop | Pagination === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' ).on( 'click', '.loop-next-link', function( e ) {
            e.preventDefault();
            
            var $link = $( this );
            var url = $link.get( 0 ).href;
            
            var $temp = $( '<div />' );
            $temp.load( url + ' .loop-inner', function() {
                var $blog_items = $( '.loop-items' );
                $temp.find( '.loop-item-container' ).appendTo( $blog_items );
                
                var $temp_pagination = $temp.find( '.loop-pagination' );
                var $pagination = $( '.loop-pagination' );
                if( $temp_pagination.length < 1 ) {
                    $pagination.remove();
                    return;
                } 
                $pagination.replaceWith( $temp_pagination );
            } );
        } );
    } ( jQuery ) );
    
    // === Tabs === //
    ( function( $ ) {
        'use strict';
        
        $( 'body' ).on( 'click', '.tab-titles li', function() {
            var $tab_title = $( this );
            var $container = $tab_title.closest( '.tabs-container' );
            var i = $tab_title.index();
            var $tab_content = $container.find( '.tab-contents .tab-content:eq(' + i + ')' );
            
            $tab_title.siblings( '.active' ).removeClass( 'active' );
            $tab_content.siblings( '.active' ).removeClass( 'active' );
            $tab_title.addClass( 'active' );
            $tab_content.addClass( 'active' );
            
        } );
        $( '.tab-titles li:first-child' ).trigger( 'click' );
    } ( jQuery ) );
} );