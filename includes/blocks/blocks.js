// === Blocks === //
( function( blocks, editor, blockEditor, element, components ) {
    var el = element.createElement;
    var TextControl = components.TextControl;
    var MediaUpload = blockEditor.MediaUpload;
    var RichText = blockEditor.RichText;
    var InnerBlocks = blockEditor.InnerBlocks;
    var AlignmentToolbar = editor.AlignmentToolbar;
    var BlockControls = editor.BlockControls;

    function get_title_el( title ){
        return el( 'h2', { className: 'turtletot-block-title' }, 'Block: ' + title );
    }

    function text_field( props, attribute, label, callback ){
        callback = callback || false;
        return el( TextControl, {
            label: label,
            value: props.attributes[ attribute ],
            onChange: function( val ){
                if( false !== callback ) {
                    val = callback( val );
                }
                var value_obj = {};
                value_obj[ attribute ] = val;
                props.setAttributes( value_obj );
            }
        } );
    }

    function select_field( props, attribute, label, options ) {
        var select_options = [
        {
            label: '- Select -',
            value: ''
        }
        ];
        Object.keys( options ).forEach( function( option_value ) {
            select_options.push( {
                label: options[ option_value ],
                value: option_value
            } );
        } );

        return el( components.SelectControl, {
            label: label,
            value: props.attributes[ attribute ],
            options: select_options,
            onChange: function( val ){
                var value_obj = {};
                value_obj[ attribute ] = val;
                props.setAttributes( value_obj );
            }
        } );
    }

    function inner_block( block_name ) {
        var block_names = Array.isArray( block_name ) ? block_name : [ block_name ];
        return el( InnerBlocks, {
            allowedBlocks: block_names
        } );
    }

    function _file_field( type, props, attribute_base, label ){
        return el( 'div', { className: 'turtletot-video-block-container' },
            el( components.BaseControl , {
                id: 'turtletot'
            }, label ),
            el( MediaUpload, {
                onSelect: function( media ) {
                    var attributes = {};
                    if( 'image' === type ) {
                        var url = ( 'thumbnail' in media.sizes ) ? media.sizes.thumbnail.url : media.url;
                        attributes[ attribute_base + '_id' ] = media.id;
                        attributes[ attribute_base + '_url' ] = url;
                    }
                    else{
                        attributes[ attribute_base + '_id' ] = media.id;
                        attributes[ attribute_base + '_url' ] = media.image.src;
                    }
                    props.setAttributes( attributes );
                },
                allowedTypes: type,
                value: props.attributes[ attribute_base + '_id' ],
                render: function( obj ) {
                    var button_text = ( 'image' === type ) ? 'Image' : 'Video';
                    return el( 'div', {
                        className: 'turtletot-image-block'
                    },
                    el( 'div', {
                        className: 'turtletot-image-preview'
                    },
                    props.attributes[ attribute_base + '_id' ]
                    ? el( 'img', { src: props.attributes[ attribute_base + '_url' ] } )
                    : '' ),
                    el( components.Button, {
                        className: 'button button-large',
                        onClick: ! props.attributes[ attribute_base + '_id' ]
                        ? obj.open
                        : function(){
                            var attributes = {};
                            attributes[ attribute_base + '_id' ] = 0;
                            attributes[ attribute_base + '_url' ] = '';
                            props.setAttributes( attributes );
                        } },
                        ! props.attributes[ attribute_base + '_id' ]  ? 'Upload ' + button_text : 'Remove ' + button_text
                        )
                    );
                }
            } )
            );
    }

    function video_field( props, attribute_base, label ){
        return _file_field( 'video', props, attribute_base, label );
    }

    function image_field( props, attribute_base, label ){
        return _file_field( 'image', props, attribute_base, label );
    }

    function rich_text_field( props, attribute, label, inline, tag ){
        tag = tag || 'div';
        inline = inline || false;
        return el( RichText, {
            tagName: tag,
            inline: inline,
            placeholder: label,
            value: props.attributes[ attribute ],
            onChange: function( value ) {
                var attrs = {};
                attrs[ attribute ] = value;
                props.setAttributes( attrs );
            }
        } );
    }

    function title_field( props, attribute, label, tag ) {
        tag = tag || 'h2';
        return rich_text_field( props, attribute, label, true, tag );
    }

    function register_block( name, title, attributes, render_callback, parent, has_children ){
        var block_attributes = {};
        jQuery.each( attributes, function( attribute_id, attribute_type ) {
            if( 'file' === attribute_type ) {
                block_attributes[ attribute_id + '_id' ] = {
                    type: 'number'
                };
                block_attributes[ attribute_id + '_url' ] = {
                    type: 'string'
                };
                return true;
            }
            block_attributes[ attribute_id ] = {
                type: attribute_type
            };
        } );
        parent = parent || '';
        if( '' !== parent ) {
            if( 'string' === typeof parent ) {
                parent = [ parent ];
            }
            jQuery.each( parent, function( i, parent_block_name ) {
                parent[ i ] = 'turtletot/' + parent_block_name;
            } );
        }
        has_children = has_children || false;

        blocks.registerBlockType( 'turtletot/' + name, {
            title: title,
            icon: 'image-filter',
            category: 'turtletot',
            parent: parent,
            attributes: block_attributes,
            edit: function( props  ) {
                return el( 'div', { className: props.className},
                    get_title_el( title ),
                    render_callback( props )
                    );
            },
            save: function( props ) {
                if( has_children ) {
                    return el(
                        'div',
                        { className: props.className },
                        el( InnerBlocks.Content )
                        );
                }
            }
        } );
    }

    function register_parent_block( name, title, attributes, render_callback ){
        register_block( name, title, attributes, render_callback, '', true );
    }

    function register_child_block( parent, name, title, attributes, render_callback ){
        register_block( name, title, attributes, render_callback, parent, false );
    }

    // === Hero === //
    register_child_block( 'hero', 'agegroup', 'Age Group', {
        id: 'string'
    }, function( props ) {
        return el( 'div', {},
            select_field( props, 'id', 'Age Group', turtletotData.agegroups )
            );
    } );

    register_parent_block( 'hero', 'Hero', {
        bg_image: 'file',
        title: 'string',
        after_title: 'string',
        button_text: 'string',
        button_url: 'string'
    }, function( props ) {
        return el( 'div', {},

           title_field( props, 'title', 'Title' ),
           title_field( props, 'after_title', 'After Title' ),

           el( 'div', { className: 'turtletot-row' },
            el( 'div', { className: 'turtletot-col-auto' },
                image_field( props, 'bg_image', 'Background Image' )
                ),

            el( 'div', { className: 'turtletot-col' },
                text_field( props, 'button_text', 'Button Text' ),
                text_field( props, 'button_url', 'Button URL' )
                ),
            ),
           inner_block( 'turtletot/agegroup' )
           );
    } );
    // === Site Introduction === //
    register_child_block( 'site-introduction', 'feature', 'Feature', {
        title: 'string',
        description: 'string',
        image: 'file',
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'title', 'Title' ),
                    rich_text_field( props, 'description', 'Description' ),
                    image_field( props, 'image', 'Icon' )
                    ),

                )
            );
    } );
    register_parent_block( 'site-introduction', 'Site Introduction', {
        side_image: 'file',
        title: 'string',
        feature_title: 'string',
        description: 'string',
        button_text: 'string',
        button_url: 'string',
    }, function( props ) {
        return el( 'div', {},

           title_field( props, 'title', 'Title' ),

           el( 'div', { className: 'turtletot-row' },
            el( 'div', { className: 'turtletot-col-auto' },
                image_field( props, 'side_image', 'Side Image' )
                ),

            el( 'div', { className: 'turtletot-col' },
                rich_text_field( props, 'description', 'Description' ),
                text_field( props, 'button_text', 'Button Text' ),
                text_field( props, 'button_url', 'Button URL' ),
                text_field( props, 'feature_title', 'Features Section Title' )
                ),
            ),
           inner_block( 'turtletot/feature' )
           );
    } );

    // === Parents === //
    register_child_block( 'parents', 'parent-slider', 'Parent Slider', {
        title: 'string',
        description: 'string',
        parent_name: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'title', 'Title' ),
                    rich_text_field( props, 'description', 'Description' ),
                    text_field( props, 'parent_name', 'Parent Name' )
                    ),

                )
            );
    } );
    register_parent_block( 'parents', 'Parents', {
        title: 'string',
        bg_image: 'file',

    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'Title' ),
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    image_field( props, 'bg_image', 'Background Image' ),
                    ),
                ),
            inner_block( 'turtletot/parent-slider' )
            );
    } );

    // === kinder === //
    register_block( 'kinder', 'Kinder M8', {
        title: 'string',
        description: 'string',
        button_text: 'string',
        button_url: 'string',
        side_image: 'file',
        section_logo: 'file'
    }, function( props ) {
        return el( 'div', {},

           title_field( props, 'title', 'Title' ),
           el( 'div', { className: 'turtletot-col' },
            image_field( props, 'section_logo', 'Kinder Logo' ),
            rich_text_field( props, 'description', 'Description' ),
            text_field( props, 'button_text', 'Button Text' ),
            text_field( props, 'button_url', 'Button URL' )
            ),
           el( 'div', { className: 'turtletot-row' },
            el( 'div', { className: 'turtletot-col-auto' },
                image_field( props, 'side_image', 'Side Image' )
                ),


            ),
           );
    } );

    // ===Our Parents === //
    register_child_block( 'our-parents', 'parent-list', 'Parent Slider', {
        title: 'string',
        description: 'string',
        parent_name: 'string',
        icon: 'file',
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'title', 'Title' ),
                    rich_text_field( props, 'description', 'Description' ),
                    text_field( props, 'parent_name', 'Parent Name' ),
                    image_field( props, 'icon', 'Icon' )
                    ),

                )
            );
    } );
    register_parent_block( 'our-parents', 'Our Parents', {
        title: 'string',


    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'Title' ),

            inner_block( 'turtletot/parent-list' )
            );
    } );
    // === Our waitlist === //
    register_block( 'our-waitlist', 'Our waitlist', {
        title: 'string',
        sub_title: 'string',
        button_text: 'string',
        button_url: 'string',

    }, function( props ) {
        return el( 'div', {},

         title_field( props, 'title', 'Title' ),
         el( 'div', { className: 'turtletot-col' },
            text_field( props, 'sub_title', 'SubTitle' ),
            text_field( props, 'button_text', 'Button Text' ),
            text_field( props, 'button_url', 'Button URL' )
            ),

         );
    } );
    // === Turtletot story === //
    register_block( 'turtletot-story', 'Turtletot story', {
        title: 'string',
        sub_title: 'string',
        description: 'string',
        bg_image:'file'

    }, function( props ) {
        return el( 'div', {},

         title_field( props, 'title', 'Title' ),
         el( 'div', { className: 'turtletot-col' },
            image_field( props, 'bg_image', 'Background Image' ),
            text_field( props, 'sub_title', 'SubTitle' ),
            rich_text_field( props, 'description', 'Description' ),

            ),

         );
    } );
    // ===Our Parents === //
    register_child_block( 'turtletot-came-to-be', 'turtletot-came-to-be-image', 'Parent Slider', {
        image: 'file',
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    image_field( props, 'image', 'Image' ),
                    ),

                )
            );
    } );
    register_parent_block( 'turtletot-came-to-be', 'Turtletot Came To Be', {
        title: 'string',
        description: 'string',


    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'Title' ),
            rich_text_field( props, 'description', 'Description' ),

            inner_block( 'turtletot/turtletot-came-to-be-image' )
            );
    } );
    // === Arrow Straight === //
    register_block( 'arrow-straight', 'Arrow Straight', {


    }, function( props ) {
        return el( 'div', {},


         );
    } );
    // === Arrow Curly === //
    register_block( 'arrow-curly', 'Arrow curly', {


    }, function( props ) {
        return el( 'div', {},


         );
    } );
    // === Day Care Age Groups === //
    register_parent_block( 'day-care-age-groups', 'Day Care Age Groups', {
        title: 'string',
        description: 'string',


    }, function( props ) {
        return el( 'div', {},

         title_field( props, 'title', 'Title' ),
         el( 'div', { className: 'turtletot-col' },
            rich_text_field( props, 'description', 'Description' ),

            ),
         inner_block( 'turtletot/agegroup' )
         );
    } );
    // === Text with left Image === //
    register_block( 'text-with-left-image', 'Text with left Image', {
        title: 'string',
        description: 'string',
        image:'file'


    }, function( props ) {
        return el( 'div', {},

         title_field( props, 'title', 'Title' ),
         el( 'div', { className: 'turtletot-col' },
            image_field( props, 'image', 'Image' ),
            rich_text_field( props, 'description', 'Description' ),

            ),

         );
    } );
    // === Text with right Image === //
    register_block( 'text-with-right-image', 'Text with Right Image', {
        title: 'string',
        description: 'string',
        image:'file'


    }, function( props ) {
        return el( 'div', {},

         title_field( props, 'title', 'Title' ),
         el( 'div', { className: 'turtletot-col' },
            image_field( props, 'image', 'Image' ),
            rich_text_field( props, 'description', 'Description' ),

            ),

         );
    } );
    // === Text with right Image === //
    register_block( 'get-in-touch-banner', 'Get in touch banner', {
        title: 'string',
        sub_title: 'string',
        image:'file'


    }, function( props ) {
        return el( 'div', {},

         title_field( props, 'title', 'Title' ),
         el( 'div', { className: 'turtletot-col' },
            image_field( props, 'image', 'Backgroud Image' ),
            title_field( props, 'sub_title', 'SubTitle' ),

            ),

         );
    } );
    // === Contact Form === //
    register_block( 'contact-form', 'Contact Form', {
        title: 'string',
        shortcode: 'string',
        phone: 'string',
        email: 'string',
        adress: 'string',
        adress_link: 'string',
        facebook: 'string',
        map_image:'file'


    }, function( props ) {
        return el( 'div', {},

         title_field( props, 'title', 'Title' ),
         el( 'div', { className: 'turtletot-row' },
            el( 'div', { className: 'turtletot-col' },
                text_field( props, 'shortcode', 'Contact Form Shortcode' )
                ),
            el( 'div', { className: 'turtletot-col' },
                text_field( props, 'phone', 'Phone' ),
                text_field( props, 'email', 'Email' ),
                text_field( props, 'adress', 'Adress' ),
                text_field( props, 'adress_link', 'Adress Link' ),
                text_field( props, 'facebook', 'Facebook' ),
                image_field( props, 'map_image', 'Backgroud Image' ),
                ),
            )


         );
    } );

    // === Age Group Title Section === //
    register_block( 'age-group-title-section', 'Age Group Title Section', {
        tag_line: 'string',
        description: 'string',
        icon: 'file',


    }, function( props ) {
        return el( 'div', {},


         el( 'div', { className: 'turtletot-row' },
            el( 'div', { className: 'turtletot-col' },
                text_field( props, 'tag_line', 'Tag Line' ),
                rich_text_field( props, 'description', 'Description' ),
                image_field( props, 'icon', 'Icon Image' ),
                ),
            )


         );
    } );
    // ===Our Parents === //
    register_child_block( 'room-features', 'feature', 'Feature', {
        icon: 'file',
        title: 'string',
        description: 'string',
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    image_field( props, 'icon', 'Icon' ),
                    title_field( props, 'title', 'Title' ),
                    rich_text_field( props, 'description', 'Description' ),
                    ),

                )
            );
    } );
    register_parent_block( 'room-features', 'Room Features', {
        title: 'string',

    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'Title' ),
            inner_block( 'turtletot/feature' )
            );
    } );
    // === Bembul Banner === //
    register_block( 'bembul-banner', 'Bembul Banner', {
        tag_line: 'string',
        description: 'string',
        side_image: 'file',


    }, function( props ) {
        return el( 'div', {},


         el( 'div', { className: 'turtletot-row' },
            el( 'div', { className: 'turtletot-col' },
                text_field( props, 'tag_line', 'Tag Line' ),
                rich_text_field( props, 'description', 'Description' ),
                image_field( props, 'side_image', 'Side Image' ),
                ),
            )


         );
    } );
    // === Partners === //
    register_child_block( 'partners', 'partner', 'Partner', {
        title: 'string',
        description: 'string',
        layout: 'string',
        button_text: 'string',
        button_url: 'string',
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'title', 'Title' ),
                    rich_text_field( props, 'description', 'Description' ),
                    text_field( props, 'button_text', 'Button Text' ),
                    text_field( props, 'button_url', 'Button Url' ),
                    ),
                el( 'div', { className: 'turtletot-col' },
                    select_field( props, 'layout', 'Layout', {
                        green: 'Green',
                        blue: 'Blue'
                    } ),
                    ),
                )
            );
    } );
    register_parent_block( 'partners', 'Partners', {

    }, function( props ) {
        return el( 'div', {},

            inner_block( 'turtletot/partner' )
            );
    } );
    // === Careers === //
    register_block( 'careers', 'Careers', {
        tag_line: 'string',
        title: 'string',
        description: 'string',
        bg_image: 'file',


    }, function( props ) {
        return el( 'div', {},


         el( 'div', { className: 'turtletot-row' },
            el( 'div', { className: 'turtletot-col' },
                text_field( props, 'tag_line', 'Tag Line' ),
                text_field( props, 'title', 'Title' ),
                rich_text_field( props, 'description', 'Description' ),
                image_field( props, 'bg_image', 'Background Image' ),

                ),
            )


         );
    } );
     // === jobs === //

     register_child_block( 'jobs', 'job', 'Job', {
        id: 'string'
    }, function( props ) {
        return el( 'div', {},
            select_field( props, 'id', 'Job', turtletotData.jobs )
            );
    } );
     register_parent_block( 'jobs', 'Jobs', {

     }, function( props ) {
        return el( 'div', {},

            inner_block( 'turtletot/job' )
            );
    } );
    // === Services === //
    register_child_block( 'services', 'service-tab', 'Service Tab', {
        title: 'string',
        category_id: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'title', 'Title' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    select_field( props, 'category_id', 'Category', turtletotData.service_categories )
                    ),
                )
            );
    } );
    register_parent_block( 'services', 'Services', {
        title: 'string',
        quantity: 'string',
        button_text: 'string',
        layout: 'string'
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'Title' ),
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'quantity', 'Quantity' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'button_text', 'Button Text' ),
                    ),
                el( 'div', { className: 'turtletot-col' },
                    select_field( props, 'layout', 'Layout', {
                        standard: 'Standard',
                        wide: 'Wide'
                    } ),
                    ),
                ),
            inner_block( 'turtletot/service-tab' )
            );
    } );

    // === Featured Success Stories === //
    register_child_block( 'featured-success-stories', 'success-story', 'Success Story', {
        id: 'string'
    }, function( props ) {
        return el( 'div', {},
            select_field( props, 'id', 'Success Story', turtletotData.success_stories )
            );
    } );
    register_parent_block( 'featured-success-stories', 'Featured Success Stories', {
        background: 'string',
        tagline: 'string',
        archive_link_text: 'string',
        read_more_text: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    select_field( props, 'background', 'Background', {
                        white: 'White',
                        none: 'None'
                    } )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'tagline', 'Tagline' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'archive_link_text', 'Archive Link Text' ),
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'read_more_text', 'Read More Link Text' ),
                    ),
                ),
            inner_block( 'turtletot/success-story' )
            );
    } );

    // === Featured Testimonials === //
    register_child_block( 'featured-testimonials', 'testimonial', 'Testimonial', {
        id: 'string'
    }, function( props ) {
        return el( 'div', {},
            select_field( props, 'id', 'Testimonial', turtletotData.testimonials )
            );
    } );
    register_parent_block( 'featured-testimonials', 'Featured Testimonials', {
        tagline: 'string',
        archive_link_text: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'tagline', 'Tagline' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'archive_link_text', 'Archive Link Text' ),
                    ),
                ),
            inner_block( 'turtletot/testimonial' )
            );
    } );

    // === Visit Cards === //
    register_child_block( 'visit-cards', 'visit-card', 'Visit Card', {
        bg_image: 'file',
        title: 'string',
        subtitle: 'string',
        link_text: 'string',
        link_url: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col-auto' },
                    image_field( props, 'bg_image', 'Background Image' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    title_field( props, 'title', 'Title', 'h3' ),
                    text_field( props, 'subtitle', 'Subtitle' ),
                    ),
                ),
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'link_text', 'Link Text' ),
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'link_url', 'Link URL' ),
                    ),
                ),
            );
    } );
    register_parent_block( 'visit-cards', 'Visit Cards', {
        style: 'string',
        title: 'string',
    }, function( props ) {
        return el( 'div', {},
            select_field( props, 'style', 'Style', {
                'top-border': 'Top Border'
            } ),
            title_field( props, 'title', 'Title' ),
            inner_block( 'turtletot/visit-card' )
            );
    } );

    // === Callout === //
    register_block( 'callout', 'Callout', {
        bg_image: 'file',
        title: 'string',
        button_text: 'string',
        button_url: 'string'
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'Title' ),
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col-auto' },
                    image_field( props, 'bg_image', 'Background Image' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'button_text', 'Button Text' ),
                    text_field( props, 'button_url', 'Button URL' )
                    ),
                ),
            );
    } );

    // === Video Callout === //
    register_block( 'video-callout', 'Video Callout', {
        headline: 'string',
        title: 'string',
        content: 'string',
        button_text: 'string',
        button_url: 'string',
        video_thumbnail: 'file',
        video: 'file',
        youtube_url: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col-auto' },
                    el( 'div', { className: 'turtletot-row' },
                        el( 'div', { className: 'turtletot-col' },
                            image_field( props, 'video_thumbnail', 'Video Thumbnail' ),
                            ),
                        el( 'div', { className: 'turtletot-col' },
                            video_field( props, 'video', 'Video' )
                            )
                        ),
                    text_field( props, 'youtube_url', 'YouTube URL' ),
                    ),
                el( 'div', { className: 'turtletot-col' },
                    title_field( props, 'headline', 'Headline', 'h4' ),
                    title_field( props, 'title', 'Title' ),
                    rich_text_field( props, 'content', 'Content' ),
                    el( 'div', { className: 'turtletot-row' },
                        el( 'div', { className: 'turtletot-col' },
                            text_field( props, 'button_url', 'Button URL' ),
                            ),
                        el( 'div', { className: 'turtletot-col' },
                            text_field( props, 'button_text', 'Button Text' ),
                            )
                        )
                    ),
                ),
            );
    } );

    // === Reports === //
    register_child_block( 'reports', 'report-tab', 'Report Tab', {
        category_id: 'string',
        report_id: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    select_field( props, 'category_id', 'Location', turtletotData.locations )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    ( props.attributes['category_id'] in turtletotData.location_reports
                        ? select_field( props, 'report_id', 'Report', turtletotData.location_reports[ props.attributes['category_id'] ] )
                        : ''
                        )
                    ),
                )
            );
    } );
    register_parent_block( 'reports', 'Reports', {
        link_text: 'string',
    }, function( props ) {
        return el( 'div', {},
            text_field( props, 'link_text', 'Link Text' ),
            inner_block( 'turtletot/report-tab' )
            );
    } );

    // === Angled Hero === //
    register_block( 'angled-hero', 'Angled Hero', {
        image: 'file',
        headline: 'string',
        title: 'string',
        content: 'string',
        style: 'string',
        button_url: 'string',
        button_text: 'string'
    }, function( props ) {
        return el( 'div', {},
            select_field( props, 'style', 'Style', {
                diagonal: 'Diagonal',
                'diagonal-reverse': 'Diagonal Reverse',
                angled: 'Angled'
            } ),
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col-auto' },
                    image_field( props, 'image', 'Image' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    title_field( props, 'headline', 'Headline', 'h4' ),
                    title_field( props, 'title', 'Title' ),
                    rich_text_field( props, 'content', 'Content' ),
                    el( 'div', { className: 'turtletot-row' },
                        el( 'div', { className: 'turtletot-col' },
                            text_field( props, 'button_url', 'Button URL' )
                            ),
                        el( 'div', { className: 'turtletot-col' },
                            text_field( props, 'button_text', 'Button Text' )
                            ),
                        ),
                    ),
                ),
            );
    } );

    // === Content === //
    register_block( 'content', 'Content', {
        title: 'string',
        content: 'string',
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'Title' ),
            rich_text_field( props, 'content', 'Content' ),
            );
    } );

    // === Video Callout === //
    register_block( 'video', 'Video', {
        title: 'string',
        video_thumbnail: 'file',
        video: 'file',
        youtube_url: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col-auto' },
                    image_field( props, 'video_thumbnail', 'Video Thumbnail' ),
                    ),
                el( 'div', { className: 'turtletot-col-auto' },
                    video_field( props, 'video', 'Video' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    title_field( props, 'title', 'Title' ),
                    text_field( props, 'youtube_url', 'YouTube URL' ),
                    ),
                ),
            );
    } );

    // === Featured Testimonials === //
    register_child_block( 'featured-team', 'team-member', 'Team Member', {
        id: 'string'
    }, function( props ) {
        return el( 'div', {},
            select_field( props, 'id', 'Team Member', turtletotData.team_members )
            );
    } );
    register_parent_block( 'featured-team', 'Featured Team', {
        headline: 'string',
        title: 'string',
        button_text: 'string',
        background: 'string'
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'Title' ),
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col' },
                    select_field( props, 'background', 'Background', {
                        angled: 'Angled White'
                    } )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'headline', 'Headline' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    text_field( props, 'button_text', 'Button Text' ),
                    ),
                ),
            inner_block( 'turtletot/team-member' )
            );
    } );

    // === Iconics === //
    register_child_block( 'iconics', 'iconic', 'Iconic', {
        icon: 'file',
        title: 'string',
        content: 'string'
    }, function( props ) {
        return el( 'div', {},
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col-auto' },
                    image_field( props, 'icon', 'Icon' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    title_field( props, 'title', 'Title' ),
                    rich_text_field( props, 'content', 'Content' )
                    ),
                ),
            );
    } );
    register_parent_block( 'iconics', 'Iconics', {
        headline: 'string',
        title: 'string',
        style: 'string'
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'headline', 'Headline', 'h5' ),
            title_field( props, 'title', 'Title' ),
            select_field( props, 'style', 'Style', {
                'white-boxed': 'White Boxed'
            } ),
            inner_block( 'turtletot/iconic' )
            );
    } );

    // === Loop === //
    register_block( 'loop', 'Loop', {
        type: 'string',
        headline: 'string',
        title: 'string',
        description: 'string'
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'headline', 'Headline', 'h4' ),
            title_field( props, 'title', 'Title' ),
            rich_text_field( props, 'description', 'Description' ),
            select_field( props, 'type', 'Type', {
                blog: 'Insights',
                report: 'Reports',
                success_story: 'Success Stories',
                testimonial: 'Testimonials'
            } )
            );
    } );

    // === White Box === //
    register_parent_block( 'white-box', 'White Box', {
    }, function( props ) {
        return el( 'div', {},
            inner_block( ['core/heading', 'core/paragraph', 'core/image'] )
            );
    } );

    // === Tabs === //
    register_child_block( 'tabs', 'tab', 'Tab', {
        tab_icon: 'file',
        tab_title: 'string',
        content_title: 'string',
        content_text: 'string',
        content_button_url: 'string',
        content_button_text: 'string'
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'tab_title', 'Tab Title', 'h3' ),
            el( 'div', { className: 'turtletot-row' },
                el( 'div', { className: 'turtletot-col-auto' },
                    image_field( props, 'tab_icon', 'Icon' )
                    ),
                el( 'div', { className: 'turtletot-col' },
                    title_field( props, 'content_title', 'Content Title', 'h4' ),
                    rich_text_field( props, 'content_text', 'Content Text' ),
                    el( 'div', { className: 'turtletot-row' },
                        el( 'div', { className: 'turtletot-col' },
                            text_field( props, 'content_button_url', 'Content Button URL' )
                            ),
                        el( 'div', { className: 'turtletot-col' },
                            text_field( props, 'content_button_text', 'Content Button Text' )
                            ),
                        ),
                    ),
                ),
            );
    } );
    register_parent_block( 'tabs', 'Tabs', {
        headline: 'string',
        title: 'string',
        style: 'string'
    }, function( props ) {
        return el( 'div', {},
            select_field( props, 'style', 'Style', {
                standard: 'Standard',
                'white-skewed': 'White Skewed'
            } ),
            title_field( props, 'headline', 'Headline', 'h5' ),
            title_field( props, 'title', 'Title' ),
            inner_block( 'turtletot/tab' )
            );
    } );

    // === Header === //
    register_block( 'header', 'Header', {
        headline: 'string',
        title: 'string',
        description: 'string'
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'headline', 'Headline', 'h3' ),
            title_field( props, 'title', 'title' ),
            rich_text_field( props, 'description', 'Description' )
            );
    } );

    // === Team Members === //
    register_block( 'team-members', 'Team Members', {
        title: 'string',
        group_id: 'string',
        display: 'string',
        layout: 'string'
    }, function( props ) {
        return el( 'div', {},
            title_field( props, 'title', 'title' ),
            el( 'div', { className: 'turtletot-col' },
                el( 'div', { className: 'turtletot-row' },
                    el( 'div', { className: 'turtletot-col' },
                        select_field( props, 'group_id', 'Group', turtletotData.team_groups ),
                        ),
                    el( 'div', { className: 'turtletot-col' },
                        select_field( props, 'display', 'Display', {
                            'with-bio' : 'With Bio'
                        } ),
                        ),
                    el( 'div', { className: 'turtletot-col' },
                        select_field( props, 'layout', 'Layout', {
                            '2-cols' : '2 Columns'
                        } ),
                        ),
                    ),
                ),
            );
    } );
} )( window.wp.blocks, window.wp.editor, wp.blockEditor, window.wp.element, window.wp.components );
