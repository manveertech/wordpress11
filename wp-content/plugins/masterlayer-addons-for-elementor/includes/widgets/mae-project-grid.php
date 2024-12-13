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

class MAE_Project_Grid_Widget extends Widget_Base {

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
        return 'mae-project-grid';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Project Grid', 'masterlayer' );
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
            'cat_slug',
            [
                'label'   => __( 'Category Slug (optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'exclude_cat_slug',
            [
                'label'   => __( 'Exclude Cat Slug (Optional)', 'masterlayer' ),
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
            'filter_pagination_heading',
            [
                'label'     => __( 'Filter & Pagination', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        
        $this->add_control(
            'filter',
            [
                'label'        => __( 'Filter ?', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
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
        
        // Filter
            $this->start_controls_section( 'setting_filter_section',
                [
                    'label' => __( 'Filter', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                    'condition' => ['filter' => 'true']
                ]
            );
            
            $this->add_control(
                'all_btn',
                [
                    'label'        => __( 'All Button ?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'true',
                ]
            );
            
            $this->add_control(
                'all_btn_text',
                [
                    'label'     => __( 'All Button  Text', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => __( 'All', 'masterlayer'),
                    'condition' => [ 'all_btn' => 'true' ]
                ]
            );
            
            $this->add_control(
                'animationType',
                [
                    'label'     => __( 'Animation Type', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'fadeOut',
                    'options'   => [
                        'fadeOut'       => __( 'Fade Out', 'masterlayer'),
                        'quicksand'     => __( 'Quicksand', 'masterlayer'),
                        'bounceLeft'    => __( 'BounceL eft', 'masterlayer'),
                        'bounceTop'     => __( 'Bounce Top', 'masterlayer'),
                        'bounceBottom'  => __( 'Bounce Bottom', 'masterlayer'),
                        'moveLeft'      => __( 'Move Left', 'masterlayer'),
                        'slideLeft'     => __( 'Slide Left', 'masterlayer'),
                        'fadeOutTop'    => __( 'Fade Out Top', 'masterlayer'),
                        'sequentially'  => __( 'Sequentially', 'masterlayer'),
                        'skew'          => __( 'Skew', 'masterlayer'),
                        'slideDelay'    => __( 'Slide Delay', 'masterlayer'),
                        'rotateSides'   => __( 'Rotate Sides', 'masterlayer'),
                        'flipOutDelay'  => __( 'Flip Out Delay', 'masterlayer'),
                        'flipOut'       => __( 'Flip Out', 'masterlayer'),
                        'unfold'        => __( 'Unfold', 'masterlayer'),
                        'foldLeft'      => __( 'Fold Left', 'masterlayer'),
                        'scaleDown'     => __( 'Scale Down', 'masterlayer'),
                        'scaleSides'    => __( 'Scal Sides', 'masterlayer'),
                        'frontRow'      => __( 'Front Row', 'masterlayer'),
                        'flipBottom'    => __( 'Flip Bottom', 'masterlayer'),
                        'rotateRoom'    => __( 'Rotate Room', 'masterlayer'),
                    ],
                    'render_type' => 'template'
                ]
            );
            
            $this->add_control(
                'filter_pos_heading',
                [
                    'type'    => Controls_Manager::HEADING,
                    'label'   => __( 'Position', 'masterlayer' ),
                    'separator' => 'after'
                ]
            );
            
            $this->add_control(
                'filter_pos',
                [
                    'label'     => __( 'Position', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'relative',
                    'options'   => [
                        'relative'       => __( 'Relative', 'masterlayer'),
                        'absolute'     => __( 'Absolute', 'masterlayer'),
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .projects-filter' => 'position: {{VALUE}};',
                    ],
                    'render_type' => 'template'
                ]
            );
            
            $this->add_responsive_control(
                'filter_align',
                [
                    'label' => __( 'Horizontal Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'masterlayer' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'masterlayer' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [ 'filter_pos' => 'absolute' ],
                    'default' => 'left'
                ]
            );
    
            $this->add_responsive_control(
                'filter_left_offset',
                [
                    'label'      => __( 'Left Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .projects-filter' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'filter_align' => 'left', 'filter_pos' => 'absolute' ],
                    'render_type' => 'template'
                ]
            );
    
            $this->add_responsive_control(
                'filter_right_offset',
                [
                    'label'      => __( 'Right Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .projects-filter' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'filter_align' => 'right', 'filter_pos' => 'absolute' ],
                    'render_type' => 'template'
                ]
            );
    
            $this->add_responsive_control(
                'filter_valign',
                [
                    'label' => __( 'Vertical Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'masterlayer' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'masterlayer' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'condition' => [ 'filter_pos' => 'absolute' ],
                    'default' => 'top'
                ]
            );
    
            $this->add_responsive_control(
                'filter_top_offset',
                [
                    'label'      => __( 'Top Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .projects-filter' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'filter_valign' => 'top', 'filter_pos' => 'absolute' ],
                    'render_type' => 'template'
                ]
            );
    
            $this->add_responsive_control(
                'filter_bottom_offset',
                [
                    'label'      => __( 'Bottom Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .projects-filter' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'filter_valign' => 'bottom', 'filter_pos' => 'absolute' ],
                    'render_type' => 'template'
                ]
            );
            
            $this->add_control(
                'filter_color',
                [
                    'label' => __( 'Color', 'rieckermann' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .projects-filter .cbp-filter-item' => 'color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->add_control(
                'filter_active_color',
                [
                    'label' => __( 'Active Color', 'rieckermann' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .projects-filter .cbp-filter-item.cbp-filter-item-active' => 'color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->add_responsive_control(
                'filterpadding',
                [
                    'label' => __('Filter Spacing', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .projects-filter .cbp-filter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'filter_typography',
                    'label' => __('Typography', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .projects-filter .cbp-filter-item'
                ]
            );
    
            $this->end_controls_section(); 

        $this->start_controls_section( 'setting_project1_section',
            [
                'label' => __( 'Project', 'masterlayer' ),
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
                    'thumb'      => __( 'Only Thumb', 'masterlayer'),
                ],
                'prefix_class' => 'project-',
                'render_type' => 'template'
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
            'arrow_heading',
            [
                'label'     => __( 'Arrow/Button', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'arrow_icon',
            [
                'label' => __( 'Arrow Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'ci-right-arrow2',
                    'library' => 'core',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
            ]
        );

        $this->add_control(
            'arrow_text',
            [
                'label' => __( 'Button Text', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'meta_heading',
            [
                'label'     => __( 'Meta', 'masterlayer'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'show_cat',
            [
                'label'        => __( 'Show Categories', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'show_desc',
            [
                'label'        => __( 'Show Description', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'true',
            ]
        );
        
        $this->add_control(
                'overlay_custom',
                [
                    'label' => esc_html__( 'Custom Overlay', 'masterlayer' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'masterlayer' ),
                    'label_off' => esc_html__( 'No', 'masterlayer' ),
                    'return_value' => 'yes',
                    'default' => '',
                    'prefix_class' => 'custom-overlay-'
                ]
            );

            $this->add_control(
                'overlay_image',
                [
                    'label'   => __( 'Overlay Image', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ],
                    'condition' => ['overlay_custom' => 'yes']
                ],
            );

            $this->add_responsive_control(
                'overlay_align',
                [
                    'label' => __( 'Horizontal Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'masterlayer' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'masterlayer' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'condition' => ['overlay_custom' => 'yes']
                ]
            );

            $this->add_responsive_control(
                'overlay_left_offset',
                [
                    'label'      => __( 'Left Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .overlay' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'overlay_align' => 'left', 'overlay_custom' => 'yes'],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'overlay_right_offset',
                [
                    'label'      => __( 'Right Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .overlay' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                    ],
                    50,
                    'condition' => [ 'overlay_align' => 'right', 'overlay_custom' => 'yes'],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'overlay_valign',
                [
                    'label' => __( 'Vertical Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'masterlayer' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'masterlayer' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'top',
                    'condition' => ['overlay_custom' => 'yes']
                ]
            );

            $this->add_responsive_control(
                'overlay_top_offset',
                [
                    'label'      => __( 'Top Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .overlay' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'overlay_valign' => 'top', 'overlay_custom' => 'yes'],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'overlay_bottom_offset',
                [
                    'label'      => __( 'Bottom Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .overlay' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'overlay_valign' => 'bottom', 'overlay_custom' => 'yes'],
                    'render_type' => 'template'
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
                'selector' => '{{WRAPPER}} .master-project .content-wrap',
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
                    '{{WRAPPER}} .master-project .arrow' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __( 'Arrow Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-project .arrow' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}} .master-project .headline-2' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'cat_color',
                [
                    'label' => __( 'Category', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .cat-item' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->end_controls_tab();
        
        //Hover 
            $this->start_controls_tab(
                'project_box_hover',
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
                        '{{WRAPPER}} .master-project .headline-2:hover' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'cat_color_hover',
                [
                    'label' => __( 'Category', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .cat-item:hover' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .master-project .arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
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
                    'selector' => '{{WRAPPER}} .master-project',
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
                        '{{WRAPPER}} .master-project' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
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
                    'selector' => '{{WRAPPER}} .master-project',
                ]
            );

            $this->end_controls_tab();

        // Hover
            $this->start_controls_tab(
                'project_box2_hover',
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
                    'selector' => '{{WRAPPER}} .master-project.active',
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
                        '{{WRAPPER}} .master-project:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
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
                    'selector' => '{{WRAPPER}} .master-project.active',
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
                    '{{WRAPPER}} .master-project .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cat_spacing',
            [
                'label'      => __( 'Category Bottom Spacing', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-project .cat-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                'name' => 'cat_typography',
                'label' => __('Category', 'masterlayer'),
                'selector' => '{{WRAPPER}} .cat-item'
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

        $args = array(
            'post_type' => 'project',
            'posts_per_page' => $settings['posts_per_page'],
            'paged' => $paged
        );

        if ( $settings['cat_slug'] ) {
            $arr = explode(',',$settings['cat_slug'],10);
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'project_category',
                    'field'    => 'slug',
                    'operator' => 'IN',
                    'terms'    => $arr
                ),
            );
        }

        if ( $settings['exclude_cat_slug'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'project_category',
                    'field' => 'slug',
                    'terms' => $settings['exclude_cat_slug'],
                    'operator' => 'NOT IN'
                ),
            );
        }

        $query = new \WP_Query( $args );
        if ( ! $query->have_posts() ) { esc_html_e( 'Project item not found!', 'masterlayer' ); return; }

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
        $config['animationType'] = $settings['animationType'];
        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        $imageSize = 'mae-project';
        if ( $settings['imageSize'] !== 'default' ) $imageSize = $settings['imageSize'];
        $idx = 0;
        ?>
        <?php if ($settings['filter'] == 'true') { 
            $filter_cat = [];
            $filter_args = array('taxonomy' => 'project_category');
            $filter_cat = get_terms($filter_args);
            
            if ( $settings['cat_slug'] ) {
                $arr = explode(',',$settings['cat_slug'],10);
                foreach($filter_cat as $key=>$filter) {
                    if (!in_array($filter->slug, $arr) ) {
                        unset($filter_cat[$key]);
                    }
                }
            }
            
            if ( $settings['exclude_cat_slug'] ) {
                $arr = explode(',',$settings['exclude_cat_slug'],10);
                foreach($filter_cat as $key=>$filter) {
                    if (in_array($filter->slug, $arr) ) {
                        unset($filter_cat[$key]);
                    }
                }
            } ?>
            <div class="projects-filter">
                <?php if ($settings['all_btn'] == 'true') { ?>
                    <div data-filter="*" class="cbp-filter-item cbp-filter-item-active"><?php echo $settings['all_btn_text']; ?></div>
                <?php } 
                foreach ($filter_cat as $filter) { ?>
                    <div data-filter=".<?php echo $filter->slug; ?>" class="cbp-filter-item"><?php echo $filter->name; ?></div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="master-portfolio" <?php echo $data; ?>>
            <div class="galleries cbp">
                <?php
                if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); 
                        $overlay = '';
                        // Different image size
                        if ( $settings['imageSize'] == 'default'  && $settings['style'] == 'style-3' ) {
                            switch ($idx ) {
                                case 0:
                                case 2:
                                case 3:
                                    $imageSize = 'mae-project-2';
                                    break;
                                default:
                                    $imageSize = 'mae-project-3';
                                    break;
                            }
                            $idx++;
                        }
                        
                        $url = $desc = $title = $arrow = $cats = $cls = '';

                        // Title
                        $title = sprintf(
                            '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                            esc_html( get_the_title() ),
                            esc_url( get_the_permalink() ) );  

                        // Desciption
                        if ( mae_get_mod('project_desc') ) {
                            $desc = sprintf('<div class="desc"><div class="inner">%1$s</div></div>', mae_get_mod('project_desc'));
                        } else {
                            $excerpt = get_the_excerpt();
                            $excerpt = substr($excerpt, 0, 50);
                            $desc = sprintf('<div class="desc"><div class="inner">%1$s</div></div>', $excerpt );
                        }

                        // URL
                        $arrow = $this->render_arrow();

                        // Image
                        $image = sprintf(
                            '<a class="thumb" href="%2$s" aria-label="%3$s"><span class="inner">%1$s</span></a>',
                            get_the_post_thumbnail( get_the_ID(), $imageSize ),
                            esc_url( get_the_permalink() ),
                            esc_html( get_the_title() )
                        );
                        

                        // Category
                        $terms = get_the_terms( get_the_ID() , 'project_category' );

                        if ($terms) {
                            $cats .= '<div class="cat-wrap">';
                            if (array_key_exists(0, $terms)) 
                                $cats .= '<a class="cat-item" href="' . 
                                    esc_url( get_term_link( $terms[0]->slug, 'project_category' ) ) . '">' . 
                                    esc_html( $terms[0]->name) . '</a>';
                                    
                             if (array_key_exists(1, $terms)) 
                                $cats .= '<span class="cat-sep">/</span><a class="cat-item" href="' . 
                                    esc_url( get_term_link( $terms[1]->slug, 'project_category' ) ) . '">' . 
                                    esc_html( $terms[1]->name) . '</a>';
                            $cats .= '</div>';
                            
                            foreach($terms as $term) {
                                $cls .= ' ' . $term->slug;
                            }
                        }
                        
                        // Overlay
                        if ($settings['overlay_custom'] == 'yes') {
                            if ($settings['overlay_image']['id']) {
                                $overlay = sprintf('<div class="overlay">%1$s</div>', 
                                    wp_get_attachment_image( $settings['overlay_image']['id'], 'full' ));
                            } else {
                                $overlay = sprintf('<div class="overlay"><img alt="Image" src="%1$s" ></div>', 
                                    esc_url( $settings['overlay_image']['url'] ) );
                            }
                        }

                        ?>

                        <div class="cbp-item <?php echo $cls; ?>">
                            <div class="master-project">
                                <?php 
                                echo $overlay;
                                echo $image;
        
                                echo '<div class="content-wrap">';
                                    echo $arrow;
                                    if ($settings['show_cat'] == 'true') echo $cats;
                                    echo $title;
                                    if ($settings['show_desc'] == 'true') echo $desc;
                                echo '</div>';
                                ?>
        
                            </div>
                        </div>
                    <?php endwhile; 
                endif; wp_reset_postdata(); ?>
            </div><!-- galleries -->
        </div><!-- master-portfolio -->
        <?php 
        if ( $settings['pagination'] == 'yes' ) congin_pagination($query);
    }

    public function render_arrow() {
        $settings = $this->get_settings_for_display();

        ob_start(); ?>
        <a aria-label="button" class="arrow" href="<?php echo esc_url( get_the_permalink() ); ?>">
            <?php if ( $settings['arrow_text'] ) echo $settings['arrow_text']; ?>
            <?php Icons_Manager::render_icon( $settings['arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </a>
        <?php 
        $return = ob_get_clean();
        return $return;
    }
}

