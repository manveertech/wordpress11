<?php
namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Carousel_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'magnific', 'flickity' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-carousel-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Carousel Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-carousel';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    //protected function register_controls() {
    protected function register_controls() {
        //----------------------------------------------//
        // CONTENT TAB                                  //
        //----------------------------------------------//
        // Content Section
        $this->start_controls_section( 'content_section',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'content_type',
            [
                'label'     => __( 'Content Type', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default'      => __( 'Default', 'masterlayer'),
                    'html'         => __( 'HTML', 'masterlayer'),
                    'template'     => __( 'Template', 'masterlayer')
                ],
            ]
        );

        $repeater->add_control(
            'html',
            [
                'label' => esc_html__( 'HTMK', 'masterlayer' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 20,
                'placeholder' => esc_html__( 'Type your HTML here', 'masterlayer' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
                'condition' => ['content_type' => 'default']
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'   => __( 'Title', 'masterlayer' ),
                'label_block' => true,
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Box Title', 'masterlayer' ),
                'condition' => ['content_type' => 'default']
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label'      => __( 'Description', 'masterlayer' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
                'condition' => ['content_type' => 'default']
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label'     => __( 'Choose Templates', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => mae_get_templates(),
                'condition' => ['content_type' => 'template']
            ]
        );

        $this->add_control(
            'templates',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Item #1', 'masterlayer' )
                    ],
                    [
                        'title' => __( 'Item #2', 'masterlayer' )
                    ],
                    [
                        'title' => __( 'Item #3', 'masterlayer' )
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        //----------------------------------------------//
        // SETTINGS TAB                                 //
        //----------------------------------------------//
        // Carousel
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
                            'min' => 1,
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
                ],
                'prefix_class' => 'arrow-position-'
            ]
        );

        $this->add_responsive_control(
            'arrowMiddleOffset',
            [
                'label' => __( 'Arrows Offset', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'render_type' => 'template',
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
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                    'prefix_class' => 'bullets-'
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

        $this->end_controls_section();

        // Style - General
            $this->start_controls_section( 'style_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            if ( is_rtl() ) {
                $this->add_responsive_control(
                    'align',
                    [
                        'label' => __( 'Alignment', 'masterlayer' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'right'    => [
                                'title' => __( 'Left', 'masterlayer' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => __( 'Center', 'masterlayer' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'left' => [
                                'title' => __( 'Right', 'masterlayer' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                        ],
                        'prefix_class' => 'align-%s'
                    ]
                );
            } else {
                $this->add_responsive_control(
                    'align',
                    [
                        'label' => __( 'Alignment', 'masterlayer' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'left'    => [
                                'title' => __( 'Left', 'masterlayer' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => __( 'Center', 'masterlayer' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'right' => [
                                'title' => __( 'Right', 'masterlayer' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                        ],
                        'prefix_class' => 'align-%s'
                    ]
                );
            }

            $this->end_controls_section();

        // Style - Color
            $this->start_controls_section( 'style_color_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'box_bg',
                [
                    'label' => __( 'Box Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box' => 'background-color: {{VALUE}};',
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
                        'label' => __( 'Title Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-image-box .headline-2' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'desc_color',
                    [
                        'label' => __( 'Description Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-image-box .desc' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();

            // Hover
                $this->start_controls_tab(
                    'service_box_hover',
                    [
                        'label' => __( 'Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'title_color_hover',
                    [
                        'label' => __( 'Title Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-image-box:hover .headline-2' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'desc_color_hover',
                    [
                        'label' => __( 'Description Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-image-box:hover .desc' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // Border & Shadow
            $this->start_controls_section( 'bs_style_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'img_border',
                    'label' => __( 'Image Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .master-image-box .thumb .inner',
                ]
            );

            $this->add_control(
                'img_border_radius',
                [
                    'label' => __('Image Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'img_box_shadow',
                    'label' => __('Image Shadow', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-image-box .thumb',
                ]
            );

            $this->start_controls_tabs( 'box1' );
                // Normal
                    $this->start_controls_tab(
                        'box1_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border',
                            'label' => __( 'Box Border', 'masterlayer' ),
                            'selector' => '{{WRAPPER}} .master-image-box',
                        ]
                    );

                    $this->add_control(
                        'border_radius',
                        [
                            'label' => __('Box Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'label' => __('Box Shadow', 'masterlayer'),
                            'selector' => '{{WRAPPER}} .master-image-box',
                        ]
                    );

                    $this->end_controls_tab();

                // Hover
                    $this->start_controls_tab(
                        'box1_hover',
                        [
                            'label' => __( 'Hover', 'masterlayer' ),
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border_hover',
                            'label' => __( 'Box Border', 'masterlayer' ),
                            'selector' => '{{WRAPPER}} .master-image-box:hover',
                        ]
                    );

                    $this->add_control(
                        'border_radius_hover',
                        [
                            'label' => __('Box Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-image-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow_hover',
                            'label' => __( 'Box Shadow', 'masterlayer' ),
                            'selector' => '{{WRAPPER}} .master-image-box:hover',
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

            $this->add_responsive_control(
                'image_space',
                [
                    'label' => __( 'Image', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'defautl' => [
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ]
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
                    'defautl' => [
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .headline-2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'desc_space',
                [
                    'label' => __( 'Description', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'defautl' => [
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ]
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
                    'label' => __('Heading', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .headline-2'
                ],
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Description', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .desc'
                ],
            );

            $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $templates = $this->get_settings_for_display( 'templates' );

        // Data config for carousel
        if ( isset($settings['column']) )
            $config['column'] = $settings['column']['size'];
        if ( isset($settings['column_tablet']) )
            $config['columnTablet'] = $settings['column_tablet']['size'];
        if ( isset($settings['column_mobile']) )
            $config['columnMobile'] = $settings['column_mobile']['size'];
        if ( isset($settings['gap']) )
            $config['gap'] = $settings['gap']['size'];
        if ( isset($settings['gap_tablet']) )
            $config['gapTablet'] = $settings['gap_tablet']['size'];
        if ( isset($settings['gap_mobile']) )
            $config['gapMobile'] = $settings['gap_mobile']['size'];
        $config['arrowPosition'] = $settings['arrowPosition'];
        $config['arrowMiddleOffset'] = $settings['arrowMiddleOffset'];
        $config['arrowTopOffset'] = $settings['arrowTopOffset'];
        
        $config['stretch'] = $settings['stretch'];
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? true : false;
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;
        $config['groupCells'] = false;
        if ( $settings['column'] == 'custom' ) {
            $config['cellAlign'] = 'center';
            $config['wrapAround'] = true;
            $cls .= ' full-screen-true';
        } 

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-carousel-box" <?php echo $data; ?>>
            <?php
            foreach ( $templates as $index => $item ) { 
                ?>
                <div class="item-carousel">
                    <?php
                    if ($item['content_type'] == 'template') {
                        if (!empty($item['template'])) {
                            echo Plugin::$instance->frontend->get_builder_content($item['template'], true);
                        }
                    } elseif ($item['content_type'] == 'html') {
                        echo $item['html'];
                    } else {
                        $image = $title = $desc = '';

                        // Image
                        if ( $item['image']['url'] ) {
                            if ($item['image']['id']) {
                                $image = sprintf('<div class="thumb"><div class="inner">%1$s</div></div>', 
                                    wp_get_attachment_image( $item['image']['id'], 'full' ) );
                            } else {
                                $image = sprintf('<div class="thumb"><img alt="Image" src="%1$s" ></div>', 
                                    esc_url( $item['image']['url'] ) );
                            }
                        }

                        // Title
                        if ($item['title']) {
                            $title = sprintf('<h3 class="headline-2">%1$s</h3>', 
                                $item['title'] );
                        }

                        // Description
                        if ($item['desc'])
                            $desc = sprintf('<div class="desc">%1$s</div>', 
                                $item['desc'] );

                        ?>
                        <div class="master-image-box">
                            <?php
                                echo $image;
                                echo $title;
                                echo $desc;
                            ?>
                        </div> 
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <?php
    }
}

