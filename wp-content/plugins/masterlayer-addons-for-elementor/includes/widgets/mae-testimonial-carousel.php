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

class MAE_Testimonial_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'flickity', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-testimonial-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Testimonial Carousel', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-carousel';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' ),
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'avatar',
                [
                    'label'   => __( 'Avatar', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
                ]
            );

            $repeater->add_control(
                'name',
                [
                    'label'   => __( 'Name', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'New Member', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'role',
                [
                    'label'   => __( 'Role', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'Manager', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'comment',
                [
                    'label'      => __( 'Comment', 'masterlayer' ),
                    'type'       => Controls_Manager::WYSIWYG,
                    'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );


            $this->add_control(
                'testimonials',
                [
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [
                            'name'  => __( 'Client #1', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Client #2', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Client #3', 'masterlayer' ),
                        ],
                    ],
                    'title_field' => '{{{ name }}}',
                ]
            );

            $this->add_control(
                'quotes',
                [
                    'label' => __( 'Quotes Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-quote',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                ]
            );

            $this->add_control(
                'star',
                [
                    'label' => __( 'Star Rating', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-star1',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                ]
            );

            $this->end_controls_section();

        // Carousel settings
            $this->start_controls_section( 'setting_carousel_section',
                [
                    'label' => __( 'Carousel', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_responsive_control(
                'column',
                [
                    'label' => __( 'Column', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'max' => 10,
                        ],
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'gap',
                [
                    'label' => __( 'Gap', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'stretch',
                [
                    'label'     => __( 'Stretch View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'        => __( 'No', 'masterlayer'),
                        'stretch-right'     => __( 'Stretch Right', 'masterlayer'),
                        'stretch-both'      => __( 'Full Width', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'outViewOpacity',
                [
                    'label'     => __( 'Outview Opacity', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 0.7,
                    'min'     => 0,
                    'max'     => 1,
                    'step'    => 0.1,
                    'condition'             => [
                        'stretch!'   => 'no',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .item-carousel' => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} .master-carousel-box .item-carousel.is-selected' => 'opacity: 1;',
                        '{{WRAPPER}} .master-carousel-box:hover .item-carousel' => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} .master-carousel-box:hover .item-carousel.is-selected' => 'opacity: 1;',
                    ],
                ]
            );

            $this->add_control(
                'autoPlay',
                [
                    'label'        => __( 'Auto Play', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'true',
                ]
            );

            $this->add_control(
                'prevNextButtons',
                [
                    'label'        => __( 'Show Arrows?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'separator'    => 'before',
                    'prefix_class' => 'arrows-'
                ]
            );
            
            $this->add_control(
                'arrowPosition',
                [
                    'label'     => __( 'Arrows Position', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'middle',
                    'options'   => [
                        'top'        => __( 'Top', 'masterlayer'),
                        'middle'     => __( 'Middle', 'masterlayer'),
                        'bottom'     => __( 'Bottom', 'masterlayer'),
                    ],
                    'condition' => [
                         'prevNextButtons' => 'true'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowMiddleOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button.previous' => 'left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .flickity-prev-next-button.next' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'middle'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowTopOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'top'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowBottomOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'bottom'
                    ]
                ]
            );

            $this->add_control(
                'pageDots',
                [
                    'label'        => __( 'Show Bullets?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'separator'    => 'before'
                ]
            );

            $this->add_control(
                'dotPosition',
                [
                    'label'     => __( 'Dots Position', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'center',
                    'options'   => [
                        'left'      => __( 'Left', 'masterlayer'),
                        'center'     => __( 'Center', 'masterlayer'),
                        'right'     => __( 'Right', 'masterlayer'),
                    ],
                    'condition' => [
                         'pageDots' => 'true'
                    ],
                    'prefix_class' => 'dot-'
                ]
            );

            $this->add_responsive_control(
                'dotOffset',
                [
                    'label' => __( 'Bullets Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'activeIndex',
                [
                    'label' => __( 'Active Index', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                    'separator' => 'before'
                ]
            ); 

            $this->end_controls_section();

        // Settings TAB
            $this->start_controls_section( 'setting_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'style',
                [
                    'label'     => __( 'Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'style-1',
                    'options'   => [
                        'style-1'      => __( 'Style 1', 'masterlayer'),
                        'style-2'      => __( 'Style 2', 'masterlayer'),
                        'style-3'      => __( 'Style 3', 'masterlayer'),
                        'style-4'      => __( 'Style 4', 'masterlayer'),
                    ],
                    'prefix_class' => 'testimonial-',
                    'render_type' => 'template'
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

            $this->start_controls_tabs( 'box' );

            // Normal
                $this->start_controls_tab(
                    'box_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'content_bg',
                    [
                        'label' => __( 'Content Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'name_color',
                    [
                        'label' => __( 'Name Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial .name' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'role_color',
                    [
                        'label' => __( 'Role Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial .role' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'desc_color',
                    [
                        'label' => __( 'Description Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial .comment' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'quotes_color',
                    [
                        'label' => __( 'Quotes Icon Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial .quote' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'star_color',
                    [
                        'label' => __( 'Star Rating Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial .star-rating' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'star_bgcolor',
                    [
                        'label' => __( 'Star Rating Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial .star-rating' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );
            $this->end_controls_tab();

            // Active
                $this->start_controls_tab(
                    'box_active',
                    [
                        'label' => __( 'Active', 'masterlayer' ),
                    ]
                );
                $this->add_control(
                    'content_bg_active',
                    [
                        'label' => __( 'Content Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial.active .inner' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'name_color_active',
                    [
                        'label' => __( 'Name Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial.active .name' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'role_color_active',
                    [
                        'label' => __( 'Role Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial.active .role' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'desc_color_active',
                    [
                        'label' => __( 'Description Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial.active .comment' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'quotes_color_active',
                    [
                        'label' => __( 'Quotes Icon Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial.active .quote' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'star_color_active',
                    [
                        'label' => __( 'Star Rating Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial.active .star-rating' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'star_bgcolor_active',
                    [
                        'label' => __( 'Star Rating Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial.active .star-rating' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );

            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();
          

        // Border & Shadow
            $this->start_controls_section( 'style_border_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => __( 'Border', 'masterlayer' ),
                    'selectors' => '{{WRAPPER}} .master-testimonial',
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
                        '{{WRAPPER}} .master-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'selectors' => '{{WRAPPER}} .master-testimonial',
                ]
            );

            $this->end_controls_section();

        // Spacing
            $this->start_controls_section( 'setting_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'avatar_bottom_margin',
                [
                    'label'      => __( 'Avatar', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .content-wrap' => 'padding-top: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'name_bottom_margin',
                [
                    'label'      => __( 'Name', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .name' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'role_bottom_margin',
                [
                    'label'      => __( 'Role', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .role' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'comment_bottom_margin',
                [
                    'label'      => __( 'Comment', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-testimonial .comment' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50
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
                'name' => 'name_typography',
                'label' => __('Name', 'masterlayer'),
                'selector' => '{{WRAPPER}} .name'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'role_typography',
                'label' => __('Role', 'masterlayer'),
                'selector' => '{{WRAPPER}} .role'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'comment_typography',
                'label' => __('Comment', 'masterlayer'),
                'selector' => '{{WRAPPER}} .comment'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $testimonials = $this->get_settings_for_display( 'testimonials' );

        // Data config for carousel
        if ( isset($settings['column']) )
            $config['column'] = $settings['column']['size'];
        if ( isset($settings['column_tablet']) )
            $config['columnTablet'] = $settings['column_tablet']['size'];
        if ( isset($settings['column_mobile']) )
            $config['columnMobile'] = $settings['column_mobile']['size'];
        if ( isset($settings['column_widescreen']) )
            $config['columnWidescreen'] = $settings['column_widescreen']['size'];
        if ( isset($settings['column_tablet_extra']) )
            $config['columnTabletExtra'] = $settings['column_tablet_extra']['size'];
        if ( isset($settings['column_mobile_extra']) )
            $config['columnMobileExtra'] = $settings['column_mobile_extra']['size'];
        if ( isset($settings['column_laptop']) )
            $config['columnLaptop'] = $settings['column_laptop']['size'];
        if ( isset($settings['gap']) )
            $config['gap'] = $settings['gap']['size'];
        if ( isset($settings['gap_tablet']) )
            $config['gapTablet'] = $settings['gap_tablet']['size'];
        if ( isset($settings['gap_mobile']) )
            $config['gapMobile'] = $settings['gap_mobile']['size'];
        if ( isset($settings['gap_widescreen']) )
            $config['gapWidescreen'] = $settings['gap_widescreen']['size'];
        if ( isset($settings['gap_tablet_extra']) )
            $config['gapTabletExtra'] = $settings['gap_tablet_extra']['size'];
        if ( isset($settings['gap_mobile_extra']) )
            $config['gapMobileExtra'] = $settings['gap_mobile_extra']['size'];
        if ( isset($settings['gap_laptop']) )
            $config['gapLaptop'] = $settings['gap_laptop']['size'];
        $config['arrowPosition'] = $settings['arrowPosition'];
        $config['arrowMiddleOffset'] = $settings['arrowMiddleOffset'];
        $config['arrowTopOffset'] = $settings['arrowTopOffset'];
        
        $config['activeIndex'] = $settings['activeIndex'];
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? true : false;
        $config['stretch'] = $settings['stretch'];
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-carousel-box" <?php echo $data; ?>>
            <?php
            foreach ( $testimonials as $index => $item ) { 
                $html = $name = $role = $comment = $avatar = $rating = $quotes = "";
                
                // Name
                if ($item['name'])
                    $name = sprintf('<h3 class="name">%1$s</h3>', 
                        esc_html( $item['name'] ) );

                // Role
                if ($item['role'])
                    $role = sprintf('<div class="role">%1$s</div>', 
                        esc_html( $item['role'] ) );

                // Comment
                if ($item['comment'])
                    $comment = sprintf('<div class="comment">%1$s</div>', 
                        $item['comment'] );

                // Avatar
                if ($item['avatar'])
                    $avatar = sprintf('<div class="avatar">%1$s</div>', 
                        wp_get_attachment_image( $item['avatar']['id'], 'full' ) );

                $cls1 = 'item-carousel ';
                $cls1 .= 'elementor-repeater-item-' . $item['_id']
                ?>
                <?php switch ($settings["style"]) {
                    case 'style-2': ?>
                        <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                            <div class="inner">
                             
                                <div class="author-wrap">
                                    <?php if ($settings['star']) { ?>
                                        <div class="star-rating">
                                            <?php
                                            Icons_Manager::render_icon( $settings['star'], [ 'aria-hidden' => 'true' ] ); 
                                            Icons_Manager::render_icon( $settings['star'], [ 'aria-hidden' => 'true' ] ); 
                                            Icons_Manager::render_icon( $settings['star'], [ 'aria-hidden' => 'true' ] ); 
                                            Icons_Manager::render_icon( $settings['star'], [ 'aria-hidden' => 'true' ] ); 
                                            Icons_Manager::render_icon( $settings['star'], [ 'aria-hidden' => 'true' ] ); 
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            
                                <div class="content-wrap">
                                    <?php 
                                    echo $comment;
                                    echo $name;
                                    echo $role; 
                                    ?>
                                </div>

                                <?php if ($settings['quotes']) {
                                    echo '<span class="quote">';
                                    Icons_Manager::render_icon( $settings['quotes'], [ 'aria-hidden' => 'true' ] ); 
                                    echo '</span>';
                                } ?>
                            </div>

                            <?php echo $avatar; ?>
                        </div>
                        <?php break;
                    case 'style-3': ?>
                        <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                            <div class="avatar-wrap">
                                <?php echo $avatar; ?>
                            </div>

                            <div class="content-wrap">
                                <span class="quote"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <path d="M224.001,74.328c5.891,0,10.667-4.776,10.667-10.667s-4.776-10.667-10.667-10.667
                                        c-123.653,0.141-223.859,100.347-224,224v64c-0.185,64.99,52.349,117.825,117.338,118.01
                                        c64.99,0.185,117.825-52.349,118.01-117.338c0.185-64.99-52.349-117.825-117.338-118.01c-38.374-0.109-74.392,18.499-96.506,49.861
                                        C23.48,163.049,113.514,74.485,224.001,74.328z"/>
                                    <path d="M394.667,223.662c-38.154,0.03-73.905,18.63-95.829,49.856
                                        c1.976-110.469,92.01-199.033,202.496-199.189c5.891,0,10.667-4.776,10.667-10.667s-4.776-10.667-10.667-10.667
                                        c-123.653,0.141-223.859,100.347-224,224v64c0,64.801,52.532,117.333,117.333,117.333S512,405.796,512,340.995
                                        S459.469,223.662,394.667,223.662z"/>
                                </svg></span>
                                
                                <?php 
                                echo $comment; 
                                ?>

                                <div class="author-wrap">
                                    <?php
                                    echo $name;
                                    echo $role;
                                    ?>
                                </div>

                                

                            </div>
                        </div>
                        <?php break;
                    default: ?>
                        <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                            <div class="avatar-wrap">
                                <?php echo $avatar; ?>
                            </div>

                            <div class="content-wrap">
                                <?php 
                                echo $comment; 
                                ?>

                                <div class="author-wrap">
                                    <?php
                                    echo $name;
                                    echo $role;
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            <?php } ?>
        </div>

        <?php
    }

    protected function render_icon( $icon ) {
        $icon_string = '';
        ob_start(); 

        Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );

        $icon_string = ob_get_clean();
        return $icon_string;
    }
}

