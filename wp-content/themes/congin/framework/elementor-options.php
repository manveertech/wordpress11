<?php
namespace congin\Settings;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Congin_Settings
{

    public function __construct()
    {	
    	add_action('elementor/documents/register_controls', [$this, 'congin_register_settings'], 10);
    }

    public function congin_register_settings($element)
    {	 	
    	$post_id = $element->get_id();
    	$post_type = get_post_type($post_id);

        $this->congin_general_settings($element);

    	if ( $post_type == 'page' )
    		$this->congin_page_settings($element);

    	if ( is_singular( 'project' ) ) 
    		$this->congin_project_settings($element);

        if ( is_singular( 'post' ) ) {
            $this->congin_post_settings($element);
        }

        if ( is_singular( 'event_listing' ) ) {	
            $this->congin_event_settings($element);
        }
    }

    public function congin_general_settings($element) {
        $element->start_controls_section(
            'congin_general_settings',
            [
                'label' => esc_html__('Page Settings', 'congin'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'page_accent_color',
            [
                'label' => esc_html__( 'Accent Color', 'congin' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--e-global-color-congin_accent: {{VALUE}}'
                ]
            ]
        );

        $element->add_control(
            'layout',
            [
                'label'     => esc_html__( 'Layout', 'congin'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'site_layout_position',
            [
                'label' => esc_html__( 'Sidebar Position', 'congin' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'sidebar-left' => [
                        'title' => esc_html__( 'Sidebar Left', 'congin' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'no-sidebar' => [
                        'title' => esc_html__( 'No Sidebar', 'congin' ),
                        'icon' => 'eicon-ban',
                    ],
                    'sidebar-right' => [
                        'title' => esc_html__( 'Sidebar Right', 'congin' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
            ]
        );

        // Featured Title
        $element->add_control(
            'featured_title_heading',
            [
                'label'     => esc_html__( 'Featured Title', 'congin'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'hide_featured_title',
            [
                'label'     => esc_html__( 'Hide?', 'congin'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => esc_html__( 'Yes', 'congin'),
                    'block'      => esc_html__( 'No', 'congin'),
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'featured_title_bg',
                'label' => esc_html__( 'Background', 'congin' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #featured-title',
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->add_control(
            'custom_featured_title',
            [
                'label'   => esc_html__( 'Custom Title', 'congin' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->add_control(
            'main_content_heading',
            [
                'label'     => esc_html__( 'Main Content', 'congin'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Content Padding', 'congin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [ 
                    '{{WRAPPER}} #page #main-content' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_content_bg',
                'label' => esc_html__( 'Background', 'congin' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #main-content',
            ]
        );

        $element->end_controls_section();
    }

    public function congin_page_settings($element) {
        $header_style = array( 
            '0'      => esc_html__( 'Default', 'congin'),
        );
        $header_fixed = array( 
            '0'      => esc_html__( 'Default', 'congin'),
            '1'      => esc_html__( 'None', 'congin' ) 
        );
        $args = array(  
            'post_type' => 'header',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );

        $loop = new \WP_Query( $args ); 
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $header_style[get_the_id()] = get_the_title();
            $header_fixed[get_the_id()] = get_the_title();
        endwhile;
        wp_reset_postdata();

        $footer_style = array( 
            '0'      => esc_html__( 'Default', 'congin'), 
        );
        $args = array(  
            'post_type' => 'footer',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );

        $loop = new \WP_Query( $args ); 
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $footer_style[get_the_id()] = get_the_title();
        endwhile;
        wp_reset_postdata();

        // Header
        $element->start_controls_section(
            'congin_hf_settings',
            [
                'label' => esc_html__('Header & Footer', 'congin'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'header_heading',
            [
                'label'     => esc_html__( 'Header', 'congin'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $element->add_control(
            'header_hide',
            [
                'label' => esc_html__( 'Hide Header', 'congin' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'congin' ),
                'label_off' => esc_html__( 'No', 'congin' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'header_float',
            [
                'label' => esc_html__( 'Header Transparent (float)?', 'congin' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'congin' ),
                'label_off' => esc_html__( 'No', 'congin' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [ 'header_hide!' => 'yes' ]
            ]
        );

        $element->add_control(
            'header_style',
            [
                'label'     => esc_html__( 'Header Style', 'congin'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $header_style,
                'render_type' => 'template',
                'condition' => [ 'header_hide!' => 'yes' ]
            ]
        );

        $element->add_control(
            'header_fixed',
            [
                'label'     => esc_html__( 'Header Fixed', 'congin'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $header_style,
                'condition' => [ 'header_hide!' => 'yes' ]
            ]
        );

        $element->add_control(
            'footer_heading',
            [
                'label'     => esc_html__( 'Footer', 'congin'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'footer_hide',
            [
                'label' => esc_html__( 'Hide Footer', 'congin' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'congin' ),
                'label_off' => esc_html__( 'No', 'congin' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'footer_fixed',
            [
                'label' => esc_html__( 'Footer Fixed ?', 'congin' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'congin' ),
                'label_off' => esc_html__( 'No', 'congin' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [ 'footer_hide!' => 'yes' ]
            ]
        );

        $element->add_control(
            'footer_style',
            [
                'label'     => esc_html__( 'Footer Style', 'congin'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $footer_style,
                'condition' => [ 'footer_hide!' => 'yes' ]
            ]
        );

        $element->end_controls_section();
    }

    public function congin_project_settings($element) {
    	$element->start_controls_section(
            'congin_project_settings',
            [
                'label' => esc_html__('Project Settings', 'congin'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'project_desc',
            [
                'label'      => esc_html__( 'Short Description', 'congin' ),
                'type'       => Controls_Manager::WYSIWYG,
            ]
        );

        $element->end_controls_section();
    }

    public function congin_post_settings($element) {

        $element->start_controls_section(
            'congin_post_settings',
            [
                'label' => esc_html__('Post Settings', 'congin'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );


        $element->add_control(
            'video_url',
            [
                'label'     => esc_html__( 'Video URL or Embeded Code', 'congin'),
                'type'      => Controls_Manager::TEXT,
                'default'   => '',
            ]
        );

        $element->add_control(
            'gallery_images',
            [
                'label' => esc_html__( 'Add Images', 'congin' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $element->end_controls_section();
    }

    public function congin_event_settings($element) {
        $element->start_controls_section(
            'congin_event_settings',
            [
                'label' => esc_html__('Event Settings', 'congin'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'event_builder',
            [
                'label' => esc_html__( 'Elementor Builder', 'congin' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'congin' ),
                'label_off' => esc_html__( 'No', 'congin' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__( '*Enable this option will hide default template. Use Elementor Widgets to build your own single Event with flexible layout.', 'congin' ),
            ]
        );

        $element->end_controls_section();
    }
}

new Congin_Settings();