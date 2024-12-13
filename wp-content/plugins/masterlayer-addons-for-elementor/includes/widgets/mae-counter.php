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

class MAE_Counter_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'countto' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-counter';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Counter', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-counter';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		// Content
			$this->start_controls_section(
				'section__content',
				[
					'label' => __( 'Content', 'masterlayer' ),
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

			$this->add_control(
                'icon_position',
                [
                    'label' => __( 'Icon Position', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'right' => [
                            'title' => __( 'Left', 'masterlayer' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'top' => [
                            'title' => __( 'Top', 'masterlayer' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'left' => [
                            'title' => __( 'Right', 'masterlayer' ),
                            'icon' => 'eicon-h-align-right',
                        ]
                    ],
                    'default' => 'top',
                    'prefix_class' => 'icon-position-',
                    'render_type' => 'template'
                ]
            );

			$this->add_control(
				'icon_font',
				[
					'label' => __( 'Icon', 'masterlayer' ),
					'type' => Controls_Manager::ICONS,
					'label_block' => true,
					'fa4compatibility' => 'icon',
					'default' => [
						'value' => 'far fa-chart-bar',
						'library' => 'fa-regular',
					],
				]
			);

	 		$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Projects Done', 'masterlayer' ),
				]
			);

			$this->add_control(
				'number',
				[
					'label' => 'Number',
					'type' => Controls_Manager::TEXT,
					'default' => __( '7200', 'masterlayer' ),
				]
			);

			$this->add_control(
                'number_format',
                [
                    'label'     => __( 'Number Fortmat', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => [
                        'default'    	=> __( 'Default', 'masterlayer'),
                        'separator'     => __( '1,000', 'masterlayer'),
                        'decimal'      	=> __( '1000.00', 'masterlayer'),
                        'both'      	=> __( '1,000.00', 'masterlayer'),
                    ],
                    'prefix_class' => 'icon-',
                    'render_type' => 'template'
                ]
            );


			$this->add_control(
				'suffix',
				[
					'label' => __( 'Number Suffix', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'duration',
				[
					'label' => __( 'Duration', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min'  => 1000,
							'max'  => 10000,
							'step' => 1000,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 2000,
					],
				]
			);

			$this->end_controls_section();

		// Style
			$this->start_controls_section(
				'section_style_general',
				[
					'label' => __( 'General', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
                'icon_view',
                [
                    'label'     => __( 'Icon View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'has-bg',
                    'options'   => [
                        ''            => __( 'Default', 'masterlayer'),
                        'has-bg'      => __( 'Has background', 'masterlayer'),
                    ],
                    'prefix_class' => 'icon-',
                ]
            );

            $this->add_control(
                'icon_rounded',
                [
                    'label' => __('Icon Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-counter .master-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 'icon_view' => 'has-bg' ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'icon_border',
                    'label' => __( 'Icon Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .master-icon',
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label'      => __( 'Icon Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 60,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

			$this->add_responsive_control(
                'bg_icon_size',
                [
                    'label'      => __( 'Background Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 100,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => ['icon_view' => 'has-bg'],
                    50
                ]
            );

            $this->end_controls_section();

        // Color
			$this->start_controls_section(
				'section_style_color',
				[
					'label' => __( 'Color', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
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
					'icon_bg',
					[
						'label' => __( 'Icon Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-icon' => 'background-color: {{VALUE}};',
						],
						'condition' => [ 'icon_view' => 'has-bg' ]
					]
				);

				$this->add_control(
					'icon_color',
					[
						'label' => __( 'Icon Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-icon' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'number_color',
					[
						'label' => __( 'Number Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .number-wrap span' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'title_color',
					[
						'label' => __( 'Title Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .title' => 'color: {{VALUE}};',
						]
					]
				);

				$this->end_controls_tab();

			// Hover
				$this->start_controls_tab(
		            'box_hover',
		            [
		                'label' => __( 'Hover', 'masterlayer' ),
		            ]
		        );
	        	
	        	$this->add_control(
					'icon_bg_hover',
					[
						'label' => __( 'Icon Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-counter:hover .master-icon' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'icon_color_hover',
					[
						'label' => __( 'Icon Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-counter:hover .master-icon' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_control(
					'number_color_hover',
					[
						'label' => __( 'Number Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-counter:hover .number-wrap span' => 'color: {{VALUE}};',
						]
					]
				);
				$this->add_control(
					'title_color_hover',
					[
						'label' => __( 'Title Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-counter:hover .title' => 'color: {{VALUE}};',
						]
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

		// Background & Border
			$this->start_controls_section(
				'section_style_bg',
				[
					'label' => __( 'Backround & Border', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'box_bg' );

			// Normal
				$this->start_controls_tab(
		            'bg_normal',
		            [
		                'label' => __( 'Normal', 'masterlayer' ),
		            ]
		        );

		        $this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'background',
						'label' => esc_html__( 'Background', 'masterlayer' ),
						'types' => [ 'classic', 'gradient', 'video' ],
						'selector' => '{{WRAPPER}} .master-counter:before',
					]
				);

				$this->add_control(
                    'bg_rounded',
                    [
                        'label' => __('Border Radius', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}} .master-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'bg_border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} .master-counter',
                    ]
                );

		    $this->end_controls_tab();

		    // Hover
				$this->start_controls_tab(
		            'bg_hover',
		            [
		                'label' => __( 'Hover', 'masterlayer' ),
		            ]
		        );

		        $this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'background_hover',
						'label' => esc_html__( 'Background', 'masterlayer' ),
						'types' => [ 'classic', 'gradient', 'video' ],
						'selector' => '{{WRAPPER}}:hover .master-counter:after',
					]
				);

				$this->add_control(
                    'bg_rounded_hover',
                    [
                        'label' => __('Border Radius', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}}:hover .master-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'bg_border_hover',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}}:hover .master-counter',
                    ]
                );

		    $this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

		// Spacing
			$this->start_controls_section(
				'section__style',
				[
					'label' => __( 'Spacing', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
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
                        '{{WRAPPER}} .master-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_margin',
                [
                    'label' => __('Icon Spacing', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-counter .icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
			

			$this->add_responsive_control(
				'number_spacing',
				[
					'label' => __( 'Number', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 7
					],
					'selectors' => [
						'{{WRAPPER}} .number-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_left_spacing',
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
						'{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

		// Typography
			$this->start_controls_section(
				'section__style_typo',
				[
					'label' => __( 'Typography', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	
					'label' => __( 'Number', 'masterlayer' ),
					'name' => 'number_typography',
					'selector' => '{{WRAPPER}} .number-wrap span',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	
					'label' => __( 'Title', 'masterlayer' ),
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .title',
				]
			);

			$this->end_controls_section();

		// Decoration
        $this->start_controls_section(
            'section__decor',
            [
                'label' => __( 'Decoration', 'masterlayer' )
            ]
        );

        $rd = new Repeater();

        $rd->start_controls_tabs( 'tab_decor' );
        $rd->start_controls_tab( 
            'tab_content',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ] 
        );

        $rd->add_control(
            'decor_title', [
                'label' => esc_html__( 'Title', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Decoration Item #01' , 'masterlayer' ),
                'label_block' => true,
            ]
        );

        $rd->add_control(
            'decor_type',
            [
                'label' => __( 'Item Type', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none'    => [
                        'title' => __( 'None', 'masterlayer' ),
                        'icon' => 'eicon-ban',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'masterlayer' ),
                        'icon' => 'eicon-image',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'masterlayer' ),
                        'icon' => 'eicon-favorite',
                    ],
                    'html' => [
                        'title' => __( 'HTML', 'masterlayer' ),
                        'icon' => 'eicon-editor-code',
                    ],
                ],
                'default' => 'none'
            ]
        );

        $rd->add_control(
            'decor_image',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ],
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_control(
            'decor_image_rounded',
            [
                'label' => __('Image Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_control(
            'decor_icon',
            [
                'label' => __( 'Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
                'condition' => [ 'decor_type' => 'icon' ]
            ]
        );

        $rd->add_responsive_control(
            'decor_icon_size',
            [
                'label'      => __( 'Icon Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_type' => 'icon' ]
            ]
        );

        $rd->add_control(
            'decor_icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'decor_type' => 'icon' ]
            ]
        );

        $rd->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'decor_image_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_control(
            'decor_html',
            [
                'label' => __( 'HTML', 'masterlayer' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your HTML', 'masterlayer' ),
                'label_block' => true,
                'condition' => [ 'decor_type' => 'html' ]
            ]
        );

        $rd->end_controls_tab();

        $rd->start_controls_tab( 
            'tab_style',
            [
                'label' => __( 'Style', 'masterlayer' ),
            ] 
        );

        $rd->add_control(
            'decor_width',
            [
                'label' => __( 'Width', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [ 
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );


        $rd->add_responsive_control(
            'decor_visibility',
            [
                'label'     => __( 'Visibility', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'visible',
                'options'   => [
                    'visible' =>  __( 'Visible', 'masterlayer'),
                    'hidden' =>  __( 'Hidden', 'masterlayer'),
                ],
                'selectors' => [
                    '{{CURRENT_ITEM}}.master-decor' => 'visibility: {{VALUE}};',
                ],
            ]
        );

        $rd->add_control(
            'decor_index',
            [
                'label' => __( 'Z-index', 'masterlayer' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -10,
                'max' => 100,
                'step' => 1,
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'z-index: {{VALUE}}',
                ],
            ]
        ); 

        $rd->add_responsive_control(
            'decor_align',
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
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $rd->add_responsive_control(
            'decor_left_offset',
            [
                'label'      => __( 'Left Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'left: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_align' => 'left', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_right_offset',
            [
                'label'      => __( 'Right Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                ],
                50,
                'condition' => [ 'decor_align' => 'right', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_valign',
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
                'default' => 'top'
            ]
        );

        $rd->add_responsive_control(
            'decor_top_offset',
            [
                'label'      => __( 'Top Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'top: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_valign' => 'top', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_bottom_offset',
            [
                'label'      => __( 'Bottom Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_valign' => 'bottom', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_control(
            'decor_class',
            [
                'label' => __( 'CSS Classes', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $rd->end_controls_tab();
        $rd->end_controls_tabs();

        $this->add_control(
            'decors',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $rd->get_controls(),
                'default'     => [
                    [
                        'decor_title'  => __( 'Decoration Item #01', 'masterlayer' )
                    ]
                ],
                'title_field' => '{{{ decor_title }}}'
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<?php if ( $settings['decors'][0]['decor_type'] !== 'none' ) echo $this->render_decor(); ?>
		<div class="master-counter" data-format="<?php echo $settings['number_format']; ?>">
			<?php if ($settings['icon_position'] !== 'left') {
				if ($settings['icon_font']['library']) { ?>
				<div class="icon-wrap">
			        <div class="master-icon">
	                    <?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
	                </div>
		        </div>
		    <?php } 
				} ?>

			<div class="inner">
				<div class="number-wrap">
					<span class="number" data-to="<?php echo $settings['number']; ?>" data-time= "<?php echo $settings['duration']['size']; ?>"></span>
					<?php if ($settings['suffix']) echo '<span>' . $settings['suffix'] . '</span>'; ?>
				</div>

				<?php if ($settings['title']) echo '<span class="title">' . $settings['title'] . '</span>'; ?>
			</div>

			<?php if ($settings['icon_position'] == 'left') {
				if ($settings['icon_font']['library']) { ?>
				<div class="icon-wrap">
			        <div class="master-icon">
	                    <?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
	                </div>
		        </div>
		    <?php } 
				} ?>
	    </div>

	    <?php if ( $settings['decors'][0]['decor_type'] !== 'none' ) echo '</div>';
	}

	public function render_decor() {
        $settings = $this->get_settings_for_display( 'decors' );

        ob_start(); ?>
        <div class="master-wrap">
            <?php foreach ($settings as $item) {
                $cls = 'elementor-repeater-item-' . $item['_id'] . ' ' . $item['decor_class'];

                if ( $item['decor_type'] == 'image' ) { ?>
                    <div class="master-decor image <?php echo $cls; ?>">
                        <?php echo wp_get_attachment_image( $item['decor_image']['id'], 'full' ); ?>
                    </div>
                <?php }

                if ( $item['decor_type'] == 'html' ) { ?>
                    <div class="master-decor html <?php echo $cls; ?>">
                        <?php echo $item['decor_html']; ?>
                    </div>
                <?php }

                if ( $item['decor_type'] == 'icon' ) { ?>
                    <div class="master-decor icon <?php echo $cls; ?>">
                        <span class="icon <?php echo $item['decor_icon']['value']; ?>"></span>
                    </div>
                <?php }
            }

        $return = ob_get_clean();
        return $return;
    }
}

