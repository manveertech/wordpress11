<?php

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

if (!class_exists('WP_Event_Manager'))
    exit;

class MAE_Event_Vertical_Slider_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'swiper', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'swiper' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-event-vertical-slider';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Event Vertical Carousel', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-post-list';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
            $this->start_controls_section( 'query_section',
                [
                    'label' => __( 'Query', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'posts_per_page',
                [
                    'label'     => __( 'Posts to show', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 6,
                    'min'     => 1,
                    'max'     => 20,
                    'step'    => 1
                ]
            );

            $this->add_control(
                'status',
                [
                    'label' => __( 'Status', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'all',
                    'options' => [
                        'all'       => __( 'All', 'masterlayer' ),
                        'publish'   => __( 'Upcoming', 'masterlayer' ),
                        'expired'   => __( 'Past', 'masterlayer' ),
                    ],
                ]
            );

            $this->add_control(
                'order',
                [
                    'label' => __( 'Order', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'ASC' => __( 'Ascending (ASC)', 'masterlayer' ),
                        'DESC' => __( 'Descending  (DESC)', 'masterlayer' ),
                    ],
                ]
            );
        
            $this->add_control(
                'orderby',
                [
                    'label' => __( 'Order By', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'event_start_date',
                    'options' => [
                        'title' => __( 'Title', 'masterlayer' ),
                        'ID' => __( 'ID', 'masterlayer' ),
                        'name' => __( 'Name', 'masterlayer' ),
                        'modified' => __( 'Modified', 'masterlayer' ),
                        'parent' => __( 'Parent', 'masterlayer' ),
                        'event_start_date' => __( 'Event Start Date', 'masterlayer' ),
                        'rand' => __( 'Rand', 'masterlayer' ),
                    ],
                ]
            );

            $this->add_control(
                'location',
                [
                    'label'       => __( 'Location', 'masterlayer' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter Location', 'masterlayer' ),
                    'default'     => '',
                ]
            );

            $this->add_control(
                'keywords',
                [
                    'label'       => __( 'Keywords ', 'masterlayer' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter Keywords ', 'masterlayer' ),
                    'default'     => '',
                ]
            );
            
            $this->add_control(
                'selected_datetime',
                [
                    'label'       => __( 'Selected Date', 'masterlayer' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter Date', 'masterlayer' ),
                    'default'     => '',
                    'description' => '"2021-12-15,2021-12-20" OR "today,2021-12-20" OR "tomorrow,2021-12-20"'
                ]
            );
            
            $this->add_control(
                'categories',
                [
                    'label'       => __( 'Categories ', 'masterlayer' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'Enter Categories by comma separate', 'masterlayer' ),
                    'default'     => '',
                ]
            );

            $this->add_control(
                'event_types',
                [
                    'label'       => __( 'Event Types ', 'masterlayer' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'Enter Event Types by comma separate', 'masterlayer' ),
                    'default'     => '',
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'imageSize',
                [
                    'label'     => __( 'Image Size', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => mae_get_image_sizes(),
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label'        => __( 'Date Start (Decoration)', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->add_control(
                'date_format',
                [
                    'label'         => __( 'Date Format', 'masterlayer' ),
                    'description'   => __( 'Ex: F j, Y (December 19, 2022)', 'masterlayer' ),
                    'default'       => 'F j, Y',
                    'type'          => Controls_Manager::TEXT,
                    'condition'     => ['show_date' => 'true']
                ]
            );

            $this->add_control(
                'show_excerpt',
                [
                    'label'        => __( 'Excerpt', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                ]
            );

            $this->add_control(
                'num_words',
                [
                    'label'     => __( 'Excerpt: Num Words', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'step'    => 1,
                    'condition' => ['show_excerpt' => 'true']
                ]
            );

            //Meta

            $this->add_control(
                'meta_heading',
                [
                    'type'    => Controls_Manager::HEADING,
                    'label'   => __( 'Meta', 'masterlayer' ),
                    'separator' => 'before'
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'meta_title',
                [
                    'label'     => __( 'Meta', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => mae_event_list_meta()
                ]
            );

            $repeater->add_control(
                'meta_custom',
                [
                    'label'   => __( 'Meta Key', 'masterlayer' ),
                    'description' => __( 'Ex: _event_start_date for Start Date', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'condition' => ['meta_title' => 'custom']
                ]
            );

            $repeater->add_control(
                'meta_icon',
                [
                    'label' => __( 'Button Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => ['meta_title!' => '']
                ]
            );

            $repeater->add_control(
                'meta_date_format',
                [
                    'label'   => __( 'Date & Time Format', 'masterlayer' ),
                    'description' => __( '*Only use it option if the meta is a date or time. Ex: F j, Y (December 19, 2022)', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'condition' => ['meta_title!' => '']
                ]
            );

            $labels_json = json_encode(mae_event_list_meta());

            $this->add_control(
                'meta',
                [
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        'meta_title' => ''                     
                    ],  
                    'title_field' => "<# "
                        . "let labels = $labels_json; " // Now the labels are available to the javascript
                        . "let label = labels[meta_title]; "// Get the value of the selected page
                        . "#>"
                        . "{{{ label }}}",//Show the value at the repeater title section
                    ]
            );


            $this->end_controls_section();

        // Setting - Slider
            $this->start_controls_section( 'setting_carousel_section',
                [
                    'label' => __( 'Slider', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_control(
                'row',
                [
                    'label' => __( 'Row', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 10,
                        ],
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'gap',
                [
                    'label' => __( 'Gap', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .swiper-slide > div' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template',

                ]
            );

            $this->add_control(
                'show_arrow',
                [
                    'label'        => __( 'Show Arrows', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'prefix_class' => 'arrows-'
                ]
            );

            $this->add_control(
                'show_dots',
                [
                    'label'        => __( 'Show Dots', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'prefix_class' => 'dots-'
                ]
            );

            $this->end_controls_section();

        // General
            $this->start_controls_section( 'style_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'border_radius',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-event-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'label' => __('Icon Shadow', 'masterlayer'),
                    'selectors' => '{{WRAPPER}} .master-event-list',
                ]
            );

            $this->end_controls_section();

        // Color
            $this->start_controls_section( 'style_color_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

             $this->start_controls_tabs( 'tabs_cbg' );

                // Normal
                    $this->start_controls_tab(
                        'tab_cbg_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );

                    $this->add_control(
                        'box_bg',
                        [
                            'label' => __( 'Box Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'title_color',
                        [
                            'label' => __( 'Title', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list .headline-2' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'desc_color',
                        [
                            'label' => __( 'Excerpt', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list .desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'date_color',
                        [
                            'label' => __( 'Date Decoration', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list .meta-decor' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'date_bgcolor',
                        [
                            'label' => __( 'Date Decoration Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list .meta-decor' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'meta_color',
                        [
                            'label' => __( 'Meta', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list .meta-wrap' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'meta_icon_color',
                        [
                            'label' => __( 'Meta Icon', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list .meta-decor .icon' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->end_controls_tab();

                // Hover
                    $this->start_controls_tab(
                        'tab_cbg_hover',
                        [
                            'label' => __( 'Hover', 'masterlayer' ),
                        ]
                    );

                    $this->add_control(
                        'box_bg_hover',
                        [
                            'label' => __( 'Box Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list:hover' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'title_color_hover',
                        [
                            'label' => __( 'Title', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list:hover .headline-2' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'desc_color_hover',
                        [
                            'label' => __( 'Excerpt', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list:hover .desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'date_color_hover',
                        [
                            'label' => __( 'Date Decoration', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list:hover .meta-decor' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'date_bgcolor_hover',
                        [
                            'label' => __( 'Date Decoration Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list:hover .meta-decor' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'meta_color_hover',
                        [
                            'label' => __( 'Meta', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list:hover .meta-wrap' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'meta_icon_color_hover',
                        [
                            'label' => __( 'Meta Icon', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-event-list:hover .meta-decor .icon' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->end_controls_tab();
            $this->end_controls_section();

        // Spacing
            $this->start_controls_section( 'setting_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-event-list .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_space',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .headline-2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_space',
                [
                    'label' => __( 'Meta', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .meta-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_item_space',
                [
                    'label' => __( 'Meta Item', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .meta-wrap .item' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_icon',
                [
                    'label' => __( 'Meta Icon', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .meta-wrap .item .icon' => 'padding-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->end_controls_section();

        // Typography
            $this->start_controls_section( 'setting_typography_section',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'headline_typography',
                    'label' => __('Title', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .headline-2'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Excerpt', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .desc'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'meta_typography',
                    'label' => __('Meta', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .meta-wrap'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'meta_icon_typography',
                    'label' => __('Meta Icon', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .meta-wrap .icon'
                ]
            );
          
            $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $meta_arr = $this->get_settings_for_display('meta');

        // Query Event
        ( $settings['status'] == 'all' ) ? $status = array('publish', 'expired', 'pending') : $status = array($settings['status']);
        $args = [
            'post_type'           => 'event_listing',
            'post_status'         => $status,
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $settings['posts_per_page'],
            'offset'              => (max(1, get_query_var('paged')) - 1) * $settings['posts_per_page'],
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'author'              => get_current_user_id()
        ];

        if (!empty($settings['keywords'])) {
            $args['s'] = $settings['keywords'];
        }

        if (!empty($settings['categories'])) {
            $categories = explode(',', sanitize_text_field($settings['categories']));

            $args['tax_query'][] = [
                'taxonomy'  => 'event_listing_category',
                'field'     => 'slug',
                'terms'     => $categories,
            ];
        }
        
        if (!empty($settings['event_types'])) {
            $event_types = explode(',', sanitize_text_field($settings['event_types']));

            $args['tax_query'][] = [
                'taxonomy'  => 'event_listing_type',
                'field'     => 'slug',
                'terms'     => $event_types,
            ];
        }

        if (!empty($settings['selected_datetime'])) {
            $datetimes = explode(',', $settings['selected_datetime']);

            $args['meta_query'][] = [
                'key' => '_event_start_date',
                'value'   => $datetimes,
                'compare' => 'BETWEEN',
                'type'    => 'date'
            ];
        }

        if (!empty($settings['location'])) {
            $args['meta_query'][] = [
                'key'       => '_event_location',
                'value'     => $settings['location'],
                'compare'   => 'LIKE'
            ];
        }

        if ('event_start_date' === $args['orderby']) {
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = '_event_start_date';
            $args['meta_type'] = 'DATETIME';
        }

        $query = new \WP_Query( $args );


        // Data       
        $config['row'] = $settings['row']['size'];
        $config['gap'] = $settings['gap']['size'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        $size = '';
        $settings['imageSize'] == 'default' ? $size = 'mae-event-thumb' : $size = $settings['imageSize'];
        ?>

        <div class="master-vertical-slider" <?php echo $data; ?>>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php 
                    if ( $query->have_posts() ) { 
                        while ( $query->have_posts() ) { 
                            $query->the_post(); 
                            $post = get_post(get_the_ID());

                            // Single Event Data
                            $image = $date_decor = $format = $meta_html = $title = $desc = '';
                            $metas = get_post_meta(get_the_ID());
                            $url = get_permalink( get_the_ID() );

                            // Image
                            
                            $image = sprintf('<a class="thumb" href="%2$s" aria-label="%3$s" style="background-image:url(%1$s);"><img src="%1$s" alt="" /></a>', 
                                esc_url( get_event_thumbnail( get_the_ID(), $size) ),
                                esc_url($url),
                                esc_html( get_the_title() )
                            );

                            // Title
                            $title = sprintf(
                                '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                                esc_html( get_the_title() ),
                                esc_url( get_the_permalink() ) );  

                            // Excerpt
                            if ( $settings['show_excerpt'] == 'true' ) {
                                $excerpt = '';
                                if ($post->post_excerpt) {
                                    $excerpt = $post->post_excerpt;
                                } 
                                
                                if ( is_numeric( $settings['num_words' ] ) && $settings['num_words' ] > 0 ) {

                                    $desc = sprintf('<div class="desc">%1$s</div>', 
                                        wp_trim_words($excerpt, $settings['num_words'], '') );
                                } else {
                                    $desc = sprintf('<div class="desc">%1$s</div>', $excerpt );
                                }
                            }

                            // Date Decoration
                            if ($settings['show_date'] == 'true') {
                                isset($settings['date_format']) ? $format = $settings['date_format'] : $format = 'F j, Y';
                                $date_decor = sprintf('<div class="meta-decor">%1$s</div>',
                                        date( $format, strtotime($metas['_event_start_date'][0]) )
                                    );   
                            }

                            // Meta Data
                            if ( !empty($meta_arr) ) {
                                $meta_html = '<div class="meta-wrap">';
                                foreach ($meta_arr as $item) {
                                    $key = $text = '';
                                    $meta_html .= '<span class="item">';
                                    if ( isset($item['meta_icon']['value']) ) {
                                        $meta_html .= '<span class="icon ' . $item['meta_icon']['value'] . '"></span>';
                                    }
                                    $key = $item['meta_title'];
                                    if ($key == 'cat') {
                                        $terms = get_the_terms( get_the_ID() , 'event_listing_category' );

                                        if ( !empty($terms) && is_array($terms) ) {
                                            if (array_key_exists(0, $terms)) 
                                                $text .= '<a class="cat-item" href="' . 
                                                    esc_url( get_term_link( $terms[0]->slug, 'event_listing_category' ) ) . '">' . 
                                                    esc_html( $terms[0]->name) . '</a>';
                                                    
                                            if (array_key_exists(1, $terms)) 
                                                $text .= ',<a class="cat-item" href="' . 
                                                    esc_url( get_term_link( $terms[1]->slug, 'event_listing_category' ) ) . '">' . 
                                                    esc_html( $terms[1]->name) . '</a>';
                                        }
                                    } else {
                                        if (isset($metas[$key])) {
                                            $text = $metas[$key][0];
                                            if ( $item['meta_date_format'] ) {
                                                $text = date($item['meta_date_format'], strtotime($text));
                                            }
                                        }
                                    }
                                    $meta_html .= $text;
                                    $meta_html .= '</span>';

                                }
                                $meta_html .= '</div>';
                            }

                            ?>
                            <div class="swiper-slide">
                                <div class="master-event-list">
                                    <div class="image-wrap">
                                        <?php echo $image; ?>
                                        <?php echo $date_decor; ?>
                                    </div>

                                    <div class="content-wrap">
                                        <?php echo $meta_html; ?>
                                        <?php echo $title; ?>
                                        <?php echo $desc; ?>
                                    </div>
                                </div>
                            </div>
                        <?php }  \wp_reset_postdata();

                    }
                    ?>
                </div>  
            </div>
            <div class="swiper-control">
                <div class="swiper-button swiper-button-next"></div>
                <div class="swiper-button swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <?php
    } 
}

