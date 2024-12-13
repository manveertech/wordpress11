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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Event Listing
 *
 * Elementor widget for event lising.
 *
 */
class MAE_Event_Listing_Widget extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mae-event-listing';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'MAE - Event Listing', 'masterlayer' );
	}
	/**	
	 * Get widget icon.
	 *
	 * Retrieve shortcode widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-list';
	}
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'event-listing', 'code' ];
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'masterlayer-categories' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_shortcode',
			[
				'label' => __( 'Event Listing', 'masterlayer' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all' =>  __( 'All', 'masterlayer' ),
					'box' =>  __( 'Box', 'masterlayer' ),
					'list' => __( 'List', 'masterlayer' ),
				],
			]
		);
	
		$this->add_control(
			'show_pagination',
			[
				'label' => __( 'Show Pagination', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' => __( 'False', 'masterlayer' ),
					'true' => __( 'True', 'masterlayer' ),
				],
			]
		);

		$this->add_control(
			'show_loadmore',
			[
				'label' => __( 'Show Load More Button', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' => __( 'False', 'masterlayer' ),
					'true' => __( 'True', 'masterlayer' ),
				],
				'condition' => [ 'show_pagination' => 'false'],
				'prefix_class' => 'loadmore-'
			]
		);

		$this->add_control(
			'per_page',
			[
				'label'       => __( 'Post Per Page', 'masterlayer' ),
				'type'        => Controls_Manager::NUMBER,
				'dynamic'     => [
								'active' => true,
				],
				'default'     => '10',
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
			'featured',
			[
				'label' => __( 'Show Featured', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'All Events', 'masterlayer' ),
					'false' => __( 'False', 'masterlayer' ),
					'true' => __( 'True', 'masterlayer' ),
				],
			]
		);

		$this->add_control(
			'cancelled',
			[
				'label' => __( 'Show Cancelled', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'All Events', 'masterlayer' ),
					'false' => __( 'False', 'masterlayer' ),
					'true' => __( 'True', 'masterlayer' ),
				],
			]
		);

		$this->add_control(
			'show_filters',
			[
				'label' => __( 'Show Filter', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'false' => __( 'False', 'masterlayer' ),
					'true' => __( 'True', 'masterlayer' ),
				],
			]
		);
		
		$this->add_control(
			'show_categories',
			[
				'label' => __( 'Category Filter', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'false' => __( 'False', 'masterlayer' ),
					'true' => __( 'True', 'masterlayer' ),
				],
				'condition' => ['show_filters' => 'true']
			]
		);
		
		$this->add_control(
			'show_event_types',
			[
				'label' => __( 'Event Types Filter', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'false' => __( 'False', 'masterlayer' ),
					'true' => __( 'True', 'masterlayer' ),
				],
				'condition' => ['show_filters' => 'true']
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

		// General
        $this->start_controls_section( 'style_general_section',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'grid_heading',
            [
                'type'    => Controls_Manager::HEADING,
                'label'   => __( 'Box', 'masterlayer' ),
                'separator' => 'after',
				'condition' => ['layout!' => 'list']
            ]
        );

        $this->add_control(
			'style_grid',
			[
				'label' => __( 'Style', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => __( 'Style 1', 'masterlayer' ),
					'style-2' => __( 'Style 2', 'masterlayer' )
				],
				'condition' => ['layout!' => 'list'],
				'prefix_class' => 'event-',
			]
		);

        $this->add_responsive_control(
            'column_grid',
            [
                'label' => __( 'Column', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1
                    ],
                ],
                'default' => [
                	'unit' => 'px',
                	'size' => 3
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpem-event-listings.wpem-event-listing-box-view .wpem-event-box-col' => '-webkit-box-flex: 0; -ms-flex: 0 0 calc(100% / {{SIZE}}); flex: 0 0 calc(100% / {{SIZE}});max-width:calc(100% / {{SIZE}});',
                ],
                'condition' => ['layout!' => 'list']
            ]
        );

        $this->add_control(
            'list_heading',
            [
                'type'    => Controls_Manager::HEADING,
                'label'   => __( 'List', 'masterlayer' ),
                'separator' => 'after',
				'condition' => ['layout!' => 'box']
            ]
        );

        $this->add_control(
			'style_list',
			[
				'label' => __( 'Style', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => __( 'Style 1', 'masterlayer' ),
					'style-2' => __( 'Style 2', 'masterlayer' )
				],
				'condition' => ['layout!' => 'box'],
				'prefix_class' => 'list-',
			]
		);

        $this->add_responsive_control(
            'column_list',
            [
                'label' => __( 'Column List', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1
                    ],
                ],
                'default' => [
                	'unit' => 'px',
                	'size' => 1
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpem-event-listing-list-view .wpem-event-box-col' => '-webkit-box-flex: 0; -ms-flex: 0 0 calc(100% / {{SIZE}}); flex: 0 0 calc(100% / {{SIZE}});max-width:calc(100% / {{SIZE}});',
                ],
                'condition' => ['layout!' => 'box']
            ]
        );

        $this->add_control(
            'img_width',
            [
                'label' => __( 'Image Width', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [ 
                    '{{WRAPPER}} .wpem-event-banner-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['layout!' => 'box']
            ]
        );

        $this->add_control(
            'img_height',
            [
                'label' => __( 'Image Height', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [ 
                    '{{WRAPPER}} .wpem-event-banner-img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['layout!' => 'box']
            ]
        );

        $this->add_control(
            'img_border_radius',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpem-event-banner-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition' => ['layout!' => 'box']
            ]
        );

        $this->add_control(
            'info_heading',
            [
                'type'    => Controls_Manager::HEADING,
                'label'   => __( 'Information', 'masterlayer' ),
                'separator' => 'after'
            ]
        );

        $this->add_control(
			'show_date_decor',
			[
				'label' => __( 'Show Date Decoration', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'false' => __( 'False', 'masterlayer' ),
					'true' => __( 'True', 'masterlayer' ),
				],
				'prefix_class' => 'date-decor-'
			]
		);

        $this->add_control(
			'date_format',
			[
				'label' => __( 'Event Date Format', 'masterlayer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'masterlayer' ),
					'time' => __( 'Only Time', 'masterlayer' ),
				],
				'prefix_class' => 'date-format-'
			]
		);
        

        $this->end_controls_section();

        // Style - Color & Background
            $this->start_controls_section( 'style_cbg_section',
                [
                    'label' => __( 'Color & Background', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'box_bg',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .wpem-event-layout-wrapper',
                    'fields_options' => [
                        'background' => [ 'label' => __( 'Box Background', 'masterlayer' ) ],
                        'color' => [ 'label' => __( '- Color', 'masterlayer') ],
                        'image' => [ 'label' => __( '- Image', 'masterlayer') ],
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'box_bg_content',
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .wpem-event-layout-wrapper .wpem-event-infomation',
                    'fields_options' => [
                        'background' => [ 'label' => __( 'Box Content Background', 'masterlayer' ) ],
                        'color' => [ 'label' => __( '- Color', 'masterlayer') ],
                        'image' => [ 'label' => __( '- Image', 'masterlayer') ],
                    ],
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpem-event-listings .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details .wpem-event-title .wpem-heading-text' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'info_color',
                [
                    'label' => __( 'Information Text', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpem-event-listings.wpem-event-listing-list-view .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details .wpem-event-date-time, {{WRAPPER}}  .wpem-event-listings.wpem-event-listing-list-view .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details .wpem-event-location' => 'color: {{VALUE}};',
                    ]
                ]
            ); 

            $this->add_control(
                'info_icon_color',
                [
                    'label' => __( 'Information Icon', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpem-event-listings.wpem-event-listing-list-view .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details .wpem-event-date-time:before, {{WRAPPER}}  .wpem-event-listings.wpem-event-listing-list-view .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details .wpem-event-location:before' => 'color: {{VALUE}};',
                    ]
                ]
            );  
     
            $this->end_controls_section();

        // Style - Spacing
            $this->start_controls_section( 'style_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'padding',
                [
                    'label' => __('Box Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpem-event-layout-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpem-event-layout-wrapper .wpem-event-infomation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .wpem-event-listings .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details .wpem-event-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section();

        // Style - Typography
            $this->start_controls_section( 'style_typo_section',
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
                    'selector' => '{{WRAPPER}} .wpem-event-listings .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details .wpem-event-title .wpem-heading-text'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'info_typography',
                    'label' => __('Information', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .wpem-event-listings .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details, {{WRAPPER}} .wpem-event-listings .wpem-event-layout-wrapper .wpem-event-infomation .wpem-event-details'
                ]
            );

            $this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		
		if(strlen($settings['location'])>0)
		    $location = 'location="'.esc_attr($settings['location']).'"';
	    else
	        $location = '';
	        
        if(strlen($settings['keywords'])>0)
            $keywords = 'keywords="'.esc_attr($settings['keywords']).'"';
        else
            $keywords = '';
            
        if(strlen($settings['categories'])>0)
            $categories = 'selected_category="'.esc_attr($settings['categories']).'"';
        else
            $categories = '';
            
        if(strlen($settings['event_types'])>0)
            $event_types = 'selected_event_type="'.esc_attr($settings['event_types']).'"';
        else
            $event_types = '';

        if(strlen($settings['selected_datetime'])>0)
            $selected_datetime = 'selected_datetime="'.esc_attr($settings['selected_datetime']).'"';
        else
            $selected_datetime = '';
          
        $featured = !empty($settings['featured']) ? ' featured="'.esc_attr($settings['featured']).'"' : '';
        $cancelled = !empty($settings['cancelled']) ? ' cancelled="'.esc_attr($settings['cancelled']).'"' : '';
            
        $shortcode = '[events show_pagination="'.esc_attr($settings['show_pagination']).'" per_page="'.esc_attr($settings['per_page']).'" order="'.esc_attr($settings['order']).'" orderby="'.esc_attr($settings['orderby']).'" '.$featured.' '.$cancelled.' show_filters="'.esc_attr($settings['show_filters']).'" show_categories="'.esc_attr($settings['show_categories']).'" show_event_types="'.esc_attr($settings['show_event_types']).'" '.$location.' '.$keywords.' '.$categories.' '.$event_types.' '.$selected_datetime.' layout_type="' . esc_attr($settings['layout']) . '"]';
        
        echo do_shortcode($shortcode);
	}
}
