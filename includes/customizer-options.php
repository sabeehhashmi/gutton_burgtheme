<?php

return [
    'header' => [
        'title' => __( 'Header', 'onegroup' ),
        'sections' => [
            'logo' => [
                'title' => __( 'Logo', 'onegroup' ),
                'settings' => [
                    'image' => [
                        'title' => __( 'Logo', 'onegroup' ),
                        'type' => 'image'
                    ],
                ]
            ],
            'top_bar' => [
                'title' => __( 'Top Bar', 'onegroup' ),
                'settings' => [
                    'email' => [
                        'title' => __( 'Email', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'address' => [
                        'title' => __( 'Address', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'address_link' => [
                        'title' => __( 'Address Link', 'onegroup' ),
                        'type' => 'text'
                    ],

                ]
            ],
            'phone' => [
                'title' => __( 'Phone', 'onegroup' ),
                'settings' => [
                    'phone' => [
                        'title' => __( 'Phone Number', 'onegroup' ),
                        'type' => 'text'
                    ],
                ]
            ],
            'button' => [
                'title' => __( 'Button', 'onegroup' ),
                'settings' => [
                    'text' => [
                        'title' => __( 'Text', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'url' => [
                        'title' => __( 'URL', 'onegroup' ),
                        'type' => 'text'
                    ],
                ]
            ],

        ]
    ],
    'footer' => [
        'title' => __( 'Footer', 'onegroup' ),
        'sections' => [
            'logo' => [
                'title' => __( 'Logo', 'onegroup' ),
                'settings' => [
                    'image' => [
                        'title' => __( 'Logo', 'onegroup' ),
                        'type' => 'image'
                    ],
                ]
            ],
            'bottom' => [
                'title' => __( 'Bottom', 'onegroup' ),
                'settings' => [
                    'site_introduction' => [
                        'title' => __( 'Site Introduction', 'onegroup' ),
                        'type' => 'textarea'
                    ],
                     'site_address' => [
                        'title' => __( 'Site Address', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'site_address_link' => [
                        'title' => __( 'Site Address Link', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'phone' => [
                        'title' => __( 'Phone', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'email' => [
                        'title' => __( 'Email', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'face_book_url' => [
                        'title' => __( 'Facbook Url', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'copyright_text' => [
                        'title' => __( 'Copyright Text', 'onegroup' ),
                        'type' => 'textarea'
                    ],
                    'terms_link' => [
                        'title' => __( 'Terms and  Condition Url', 'onegroup' ),
                        'type' => 'text'
                    ]
                ]
            ]
        ]
    ],
    'general' => [
        'title' => __( 'General', 'onegroup' ),
        'sections' => [
            'job' => [
                'title' => __( 'Job', 'onegroup' ),
                'settings' => [
                    'job-short-code' => [
                        'title' => __( 'Job Form Shortcode', 'onegroup' ),
                        'type' => 'text'
                    ],

                ]
            ],
            'blog' => [
                'title' => __( 'Blog', 'onegroup' ),
                'settings' => [
                     'blog_page_heading' => [
                        'title' => __( 'Blog Page Heading', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'related_posts_title' => [
                        'title' => __( 'Related Posts Title', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'show_waitlist_banner' => [
                        'title' => __( 'Show Waitlist Banner', 'onegroup' ),
                        'type' => 'checkbox'
                    ],
                    'banner_title' => [
                        'title' => __( 'Banner Title', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'banner_subtitle' => [
                        'title' => __( 'Banner SubTitle', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'button_text' => [
                        'title' => __( 'Button Text', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'button_url' => [
                        'title' => __( 'Button Url', 'onegroup' ),
                        'type' => 'text'
                    ]
                ]
            ],
            'success_story' => [
                'title' => __( 'Success Story', 'onegroup' ),
                'settings' => [
                    'archive_page' => [
                        'title' => __( 'Archive Page', 'onegroup' ),
                        'type' => 'dropdown-pages'
                    ],
                    'single_bottom_section' => [
                        'title' => __( 'Single Story Bottom Section', 'onegroup' ),
                        'type' => 'dropdown-custom-post-type',
                        'post_type' => 'section'
                    ]
                ]
            ],
            'service' => [
                'title' => __( 'Service', 'onegroup' ),
                'settings' => [
                    'archive_page' => [
                        'title' => __( 'Archive Page', 'onegroup' ),
                        'type' => 'dropdown-pages'
                    ]
                ]
            ],
            'testimonial' => [
                'title' => __( 'Testimonial', 'onegroup' ),
                'settings' => [
                    'archive_page' => [
                        'title' => __( 'Archive Page', 'onegroup' ),
                        'type' => 'dropdown-pages'
                    ],
                    'item_headline' => [
                        'title' => __( 'Item Headline', 'onegroup' ),
                        'type' => 'text'
                    ]
                ]
            ],
            'team_member' => [
                'title' => __( 'Team Member', 'onegroup' ),
                'settings' => [
                    'archive_page' => [
                        'title' => __( 'Archive Page', 'onegroup' ),
                        'type' => 'dropdown-pages'
                    ],
                    'breadcrumps_text' => [
                        'title' => __( 'Breadcrumps Text', 'onegroup' ),
                        'type' => 'text'
                    ],
                    'single_bottom_section' => [
                        'title' => __( 'Single Team Member Bottom Section', 'onegroup' ),
                        'type' => 'dropdown-custom-post-type',
                        'post_type' => 'section'
                    ]
                ]
            ],
        ]
    ]
];
