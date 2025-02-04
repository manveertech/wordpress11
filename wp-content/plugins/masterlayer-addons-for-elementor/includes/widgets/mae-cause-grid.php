<?php

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Cause_Grid_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'cubeportfolio', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'cubeportfolio' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-cause-grid';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Cause Grid', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {
        // General
        $this->start_controls_section( 'setting_general_section',
            [
                'label' => __( 'General', 'masterlayer' ),
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
            'posts_per_page',
            [
                'label'     => __( 'Posts to show', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 6,
                'min'     => 2,
                'max'     => 20,
                'step'    => 1
            ]
        );

        $this->add_control(
            'id_slug',
            [
                'label'   => __( 'Select by ID (optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'description' => __( 'Seperate each cause by ",". Ex: 10, 11', 'masterlayer' )
            ]
        );

        $this->add_control(
            'cat_slug',
            [
                'label'   => __( 'Category Slug (optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'exclude_cat_slug',
            [
                'label'   => __( 'Exclude Cat Slug (optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        // Grid
        $this->start_controls_section( 'setting_grid_section',
            [
                'label' => __( 'Grid', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_control(
            'layoutMode',
            [
                'label'     => __( 'Layout Mode', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'      => __( 'Grid', 'masterlayer'),
                    'mosaic'      => __( 'Mosaic', 'masterlayer')
                ],
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __( 'Column', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'default' => [ 'size' => 3 ],
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'gapHorizontal',
            [
                'label'     => __( 'Gap Horizontal', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 30,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1
            ]
        );

        $this->add_control(
            'gapVertical',
            [
                'label'     => __( 'Gap Vertical', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 30,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1
            ]
        );

         $this->add_control(
            'pagination',
            [
                'label' => __( 'Pagination', 'masterlayer' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'masterlayer' ),
                'label_off' => __( 'Hide', 'masterlayer' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section(); 

        // Pagination
        $this->start_controls_section( 'setting_pagination_section',
            [
                'label' => __( 'Pagination', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
                'condition' => [ 'pagination' => 'yes' ]
            ]
        );

        $this->add_responsive_control(
            'pagination_space',
            [
                'label' => __( 'Top Spacing', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .congin-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_number_space',
            [
                'label' => __( 'Number Spacing', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .congin-pagination ul li' => 'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); 


        // Settings - Cause
            $this->start_controls_section( 'setting_cause_section',
                [
                    'label' => __( 'Cause', 'masterlayer' )
                ]
            );

            $this->add_control(
                'style',
                [
                    'label'     => __( 'tyle', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'style-1',
                    'options'   => [
                        'style-1'      => __( 'Style 1', 'masterlayer'),
                        'style-2'      => __( 'Style 2', 'masterlayer'),
                    ],
                    'prefix_class' => 'cause-',
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'url_heading',
                [
                    'label'     => __( 'URL', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'url_type',
                [
                    'label'     => __( 'URL Type', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'link',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'link'      => __( 'Link', 'masterlayer'),
                        'button'    => __( 'Button', 'masterlayer'),
                        'title'   => __( 'Title', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'url_text',
                [
                    'label'   => __( 'URL Text', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'Read More', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [ 'url_type!' => ['none', 'title'] ]
                ]
            );

            $this->add_control(
                'link_icon_position',
                [
                    'label'     => __( 'Has Icon ?', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'right',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'left'      => __( 'Icon Left', 'masterlayer'),
                        'right'     => __( 'Icon Right', 'masterlayer')
                    ],
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_icon',
                [
                    'label' => __( 'Link Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-right-arrow2',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'button_style',
                [
                    'label'     => __( 'Button Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'btn-accent',
                    'options'   => [
                        'btn-accent'      => __( 'Accent', 'masterlayer'),
                        'btn-white'       => __( 'White', 'masterlayer'),
                        'btn-outline'     => __( 'Outline', 'masterlayer')
                    ],
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_icon_position',
                [
                    'label'     => __( 'Has Icon ?', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'right',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'left'      => __( 'Icon Left', 'masterlayer'),
                        'right'     => __( 'Icon Right', 'masterlayer')
                    ],
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label' => __( 'Button Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-right-arrow2',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->end_controls_section();


    // Color
            $this->start_controls_section( 'setting_style_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );  

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'box_bg',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .master-cause .content-wrap',
                    'fields_options' => [
                        'background' => [ 'label' => __( 'Content Background', 'masterlayer' ) ],
                        'color' => [ 'label' => __( '- Color', 'masterlayer') ],
                        'image' => [ 'label' => __( '- Image', 'masterlayer') ],
                    ],
                ]
            );

            $this->add_control(
                'arrow_bg',
                [
                    'label' => __( 'Arrow Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause .arrow' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'arrow_color',
                [
                    'label' => __( 'Arrow Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause .arrow' => 'color: {{VALUE}};',
                    ]
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
                    'title_color',
                    [
                        'label' => __( 'Title', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-cause .headline-2' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'cat_color',
                    [
                        'label' => __( 'Category', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-cause .cat-item' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();
            
            //Hover 
                $this->start_controls_tab(
                    'cause_box_hover',
                    [
                        'label' => __( 'Text Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'title_color_hover',
                    [
                        'label' => __( 'Title', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-cause .headline-2:hover' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'cat_color_hover',
                    [
                        'label' => __( 'Category', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-cause .cat-item:hover' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();

        // Border & Shadow   
            $this->start_controls_section( 'border_style_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'arrow_border_radius',
                [
                    'label' => __('Arrow Border Radius', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-cause .arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

            $this->start_controls_tabs( 'box2' );

            // Normal
                $this->start_controls_tab(
                    'box2_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'border_heading',
                    [
                        'label' => __( 'Border', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selectors' => '{{WRAPPER}} .master-cause',
                    ]
                );

                $this->add_control(
                    'rounded_heading',
                    [
                        'label' => __( 'Rounded', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
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
                            '{{WRAPPER}} .master-cause' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                        ],
                    ]
                );

                $this->add_control(
                    'shadow_heading',
                    [
                        'label' => __( 'Box Shadow', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow',
                        'selectors' => '{{WRAPPER}} .master-cause',
                    ]
                );

                $this->end_controls_tab();

            // Hover
                $this->start_controls_tab(
                    'cause_box2_hover',
                    [
                        'label' => __( 'Active', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'border_heading_hover',
                    [
                        'label' => __( 'Border', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'border_hover',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selectors' => '{{WRAPPER}} .master-cause.active',
                    ]
                );

                $this->add_control(
                    'rounded_heading_hover',
                    [
                        'label' => __( 'Rounded', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
                    'border_radius_hover',
                    [
                        'label' => __('Rounded', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'selectors' => [
                            '{{WRAPPER}} .master-cause:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                        ],
                    ]
                );

                $this->add_control(
                    'shadow_heading_hover',
                    [
                        'label' => __( 'Box Shadow', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow_hover',
                        'selectors' => '{{WRAPPER}} .master-cause.active',
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // URL
            $this->start_controls_section( 'setting_url_section',
                [
                    'label' => __( 'URL', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_control(
                'url_title_color_hover',
                [
                    'label' => __( 'Title Hover Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause .headline-2:hover' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'title',
                    ]
                ]
            );

            // URL - Link
            $this->add_responsive_control(
                'link_icon_font_size',
                [
                    'label'      => __( 'Icon Font Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 50,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-link .icon ' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_margin',
                [
                    'label' => __('Icon Margin', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .master-link .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->start_controls_tabs( 'link_hover_tabs' );

            // Link normal
            $this->start_controls_tab(
                'link_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            // Box hover
            $this->start_controls_tab(
                'link_box_hover',
                [
                    'label' => __( 'Box Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color_box_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause:hover .master-link' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color_box_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause:hover .master-link .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            // Link hover
            $this->start_controls_tab(
                'link_hover',
                [
                    'label' => __( 'URL Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link:hover' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link:hover .icon' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            // URL - Button
            $this->add_responsive_control(
                'button_icon_font_size',
                [
                    'label'      => __( 'Icon Font Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 50,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-button .icon ' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_margin',
                [
                    'label' => __('Icon Margin', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .master-button .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->start_controls_tabs( 'button_hover_tabs' );

            // Button normal
            $this->start_controls_tab(
                'button_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button .content-base' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'selectors' => '{{WRAPPER}} .master-button',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            // Box hover
            $this->start_controls_tab(
                'button_box_hover',
                [
                    'label' => __( 'Box Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color_box_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause:hover .master-button .content-base' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color_box_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause:hover .master-button .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color_box_hover',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause:hover .master-button' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded_box_hover',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .master-cause:hover .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color_box_hover',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause:hover .master-button' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width_box_hover',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-cause:hover .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow_box_hover',
                    'selectors' => '{{WRAPPER}} .master-cause:hover .master-button',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            // Button hover
            $this->start_controls_tab(
                'button_hover',
                [
                    'label' => __( 'URL Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button:hover .content-base' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button:hover .icon' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color_hover',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause .master-button:hover' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded_hover',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .master-cause .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color_hover',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cause .master-button:hover' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width_hover',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-cause .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow_hover',
                    'selectors' => '{{WRAPPER}} .master-cause .master-button:hover',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

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
                        '{{WRAPPER}} .master-cause .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_spacing',
                [
                    'label'      => __( 'Title', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-cause .headline-2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'desc_spacing',
                [
                    'label'      => __( 'Description', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-cause .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'progress_bar_spacing',
                [
                    'label'      => __( 'Progress Bar', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .give-goal-progress .give-progress-bar' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'goal_spacing',
                [
                    'label'      => __( 'Goal', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .give-goal-progress .raised' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'percentage_spacing',
                [
                    'label'      => __( 'Percentage', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .give-goal-progress .percentage' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
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
                    'label' => __('Description', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .desc'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'goal_typography',
                    'label' => __('Goal', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .give-goal-progress .raised .income, {{WRAPPER}} .give-goal-progress .raised .goal-text'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'goal_number_typography',
                    'label' => __('Goal Number', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .give-goal-progress .raised .income .text, {{WRAPPER}} .give-goal-progress .raised .goal-text .text'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'percentage_typography',
                    'label' => __('Percentage', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .give-goal-progress .percentage'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'percentage_number_typography',
                    'label' => __('Percentage Number', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .give-goal-progress .percentage .give-percentage'
                ]
            );

            $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();

        if ( get_query_var('paged') ) {
           $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
           $paged = get_query_var('page');
        } else {
           $paged = 1;
        }

        $args = [
            'post_type' => 'give_forms',
            'posts_per_page' => $settings['posts_per_page'],
            'paged' => $paged
        ];

        if ( $settings['id_slug'] ) {
            $id = array_map('intval', explode(',', $settings['id_slug']));
            $args['post__in'] = $id;
        }

        if ( $settings['cat_slug'] ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'give_forms_category',
                    'field'    => 'slug',
                    'terms'    => $settings['cat_slug']
                ],
            ];
        }

        if ( $settings['exclude_cat_slug'] ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'give_forms_category',
                    'field' => 'slug',
                    'terms' => $settings['exclude_cat_slug'],
                    'operator' => 'NOT IN'
                ],
            ];
        }

        $query = new \WP_Query( $args );
        if ( ! $query->have_posts() ) { esc_html_e( 'Cause item not found!', 'masterlayer' ); return; }

        // Data config for grid
        if ( isset($settings['columns']) )
            $config['columns'] = $settings['columns']['size'];
        if ( isset($settings['columns_tablet']) )
            $config['columnsTablet'] = $settings['columns_tablet']['size'];
        if ( isset($settings['columns_mobile']) )
            $config['columnsMobile'] = $settings['columns_mobile']['size'];
        $config['gapHorizontal'] = $settings['gapHorizontal'];
        $config['gapVertical'] = $settings['gapVertical'];
        $config['layoutMode'] = $settings['layoutMode'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        $imageSize = '';
        $settings['imageSize'] == 'default' ? $imageSize = 'mae-news' : $imageSize = $settings['imageSize'];
        ?>

        <div class="master-portfolio" <?php echo $data; ?>>
            <div class="galleries cbp">
                <?php
                if ( $query->have_posts() ) { ?>
                    <?php while ( $query->have_posts() ) {
                    $query->the_post(); 
                    $url = $desc = $title = $arrow = $cats = '';
                    $attr = $width = $height ='';

                    $meta =  get_post_meta(get_the_ID());

                    // Title
                    $title = sprintf(
                        '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                        esc_html( get_the_title() ),
                        esc_url( get_the_permalink() ) );  

                    // Desciption
                    $excerpt = get_the_excerpt();
                    $desc = sprintf('<div class="desc"><div class="inner">%1$s</div></div>', $excerpt );
                  
                    //Image
                    $terms = get_the_terms( get_the_ID() , 'give_forms_category' );

                    if ($terms) {
                        if (array_key_exists(0, $terms)) 
                            $cats = '<a class="cat-item" href="' . 
                                esc_url( get_term_link( $terms[0]->slug, 'give_forms_category' ) ) . '">' . 
                                esc_html( $terms[0]->name) . '</a>';
                    }

                    if ( has_post_thumbnail() ) {
                        $image = sprintf(
                            '<a class="thumb" href="%2$s" aria-label="%3$s"><span class="inner">%1$s</span></a>',
                            get_the_post_thumbnail( get_the_ID(), $imageSize ),
                            esc_url( get_the_permalink() ),
                            esc_html( get_the_title() )
                        );
                    } else {
                        $image = sprintf( '<img src="%s" alt="%s" />', 
                            give_get_placeholder_img_src(), esc_attr__( 'Placeholder', 'give' ) );
                    }

                    // URL
                    if ( $settings['url_type'] == 'link' || 'button')
                        $url = mae_render_url(get_the_permalink(), $settings);
                       // $url = $this->render_link( get_the_permalink(), $settings['url_text'] );

                    $arrow = $this->render_arrow();

                    ?>
                    <div class="cbp-item">
                        <div class="master-cause">
                            <?php 
                            echo '<div class="image-wrap">';
                                echo $cats;
                                echo $image;
                            echo '</div>';

                            echo '<div class="content-wrap">';
                                echo $title;
                                echo $desc;
                                echo do_shortcode('[give_goal id="' . get_the_ID() . '" show_bar="true" show_text="true"]');
                                echo $url;
                            echo '</div>';
                            ?>

                        </div>
                    </div>
                <?php } ?>
            </div><!-- galleries -->
        </div><!-- master-portfolio -->
        <?php 
        if ( $settings['pagination'] == 'yes' ) congin_pagination($query);
            } \wp_reset_postdata(); 
    }

    public function render_link( $url, $text ) {
        $link = $this->get_settings_for_display();

        if ($link['url_type'] == 'link') {
            $cls = "";
            $cls .= ' icon-' . $link['link_icon_position'];

            $link_icon = '';
            if ($link['link_icon'])  {
                $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                    <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        } else if ($link['url_type'] == 'button') {
            $button = $link;
            $cls = "";
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'];

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button small <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                    <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        }
        
    }

    public function render_arrow() {
        $settings = $this->get_settings_for_display();

        ob_start(); ?>
        <a aria-label="button" class="arrow" href="<?php echo esc_url( get_the_permalink() ); ?>">
            <?php Icons_Manager::render_icon( $settings['arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </a>
        <?php 
        $return = ob_get_clean();
        return $return;
    }
}

