jQuery( document ).ready( function() {
    // === Upload == //
    ( function( $ ) {
        'use strict';
        
        $( '.ogr-upload-input' ).each( function() {
            
        } );
        
        $( 'body' ).on( 'click', '.ogr-upload-button', function() {
            var $button = $( this ),
                $container = $button.closest( '.ogr-upload' ),
                $preview = $container.find( '.ogr-upload-preview' ),
                $input = $container.find( '.ogr-upload-input' ),
                value = $input.val();
            if( ! value ) {
                var media_args = {
                    title: 'Insert',
                    button: {
                        text: 'Use'
                    },
                    multiple: false
                };
                var type = $button.is( '[data-type]' ) ? $button.data( 'type' ) : 'image';
                if( 'all' !== type ) {
                    media_args['library'] = {
                        type: type
                    };
                }
                var uploader = wp.media( media_args )
                .on( 'select', function() {
                    var attachment = uploader.state().get( 'selection' ).first().toJSON();
                    if( 'image' === type ) {
                        var url = ( 'sizes' in attachment && 'thumbnail' in attachment.sizes ) 
                            ? attachment.sizes.thumbnail.url : attachment.url; 
                    }
                    else{
                        var url = attachment.icon;
                    }
                    $preview.empty();
                    $( '<img />', {
                        src: url
                    } ).appendTo( $preview );
                    $input.val( attachment.id );
                    $button.text( $button.data( 'removeText' ) );
                } )
                .open();
            }
            else{
                $preview.empty();
                $input.val( '' );
                $button.text( $button.data( 'uploadText' ) );
            }
        } );
    } ( jQuery ) );
} );