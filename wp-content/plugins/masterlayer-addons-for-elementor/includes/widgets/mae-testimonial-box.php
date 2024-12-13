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

class MAE_Testimonial_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-testimonial-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Testimonial', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-testimonial';
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

            $this->add_control(
                'avatar',
                [
                    'label'   => __( 'Avatar', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
                ]
            );

            $this->add_control(
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

            $this->add_control(
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

            $this->add_control(
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
                    'default'   => 'default',
                    'options'   => [
                        'default'      => __( 'Default', 'masterlayer'),
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

            $this->end_controls_section();
          

        // Border & Shadow
            $this->start_controls_section( 'style_border_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'tabs_title_style' );

            $this->start_controls_tab(
                'tab_title_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} .master-testimonial',
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
                        'selector' => '{{WRAPPER}} .master-testimonial',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'tab_title_hover',
                [
                    'label' => __( 'Hover', 'masterlayer' ),
                ]
            );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'border_hover',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} .master-testimonial:hover',
                    ]
                );

                $this->add_control(
                    'border_radius_hover',
                    [
                        'label' => __('Rounded', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .master-testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'box_shadow_hover',
                        'selector' => '{{WRAPPER}} .master-testimonial:hover',
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

        ?>

        <?php
        $html = $name = $role = $comment = $avatar = $rating = $quotes = "";
        
        // Name
        if ($settings['name'])
            $name = sprintf('<h3 class="name">%1$s</h3>', 
                esc_html( $settings['name'] ) );

        // Role
        if ($settings['role'])
            $role = sprintf('<div class="role">%1$s</div>', 
                esc_html( $settings['role'] ) );

        // Comment
        if ($settings['comment'])
            $comment = sprintf('<div class="comment">%1$s</div>', 
                $settings['comment'] );

        // Avatar
        if ($settings['avatar']) {
            if ($settings['avatar']['id']) {
                $avatar = sprintf('<div class="avatar">%1$s</div>', 
                    wp_get_attachment_image( $settings['avatar']['id'], 'full' ) );
            } else {
                $avatar = sprintf('<div class="avatar"><img alt="Image" src="%1$s" /></div>', 
                    $settings['avatar']['url'] );
            }
        }

        switch ($settings["style"]) {
            case 'style-2': ?>
                <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                    <div class="avatar-wrap">
                        <?php echo $avatar; ?>
                    </div>

                    <div class="content-wrap">
                        <?php echo $comment; ?>

                        <div class="author-wrap">
                            <?php
                            echo $name;
                            echo $role;
                            ?>
                        </div>
                    </div>
                </div>
                <?php break;
            case 'style-3': ?>
                <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                    <div class="content-wrap">
                        <?php 
                        echo $comment; 
                        ?>
                        <div class="info-wrap">
                            <div class="author-wrap">
                                <?php
                                echo $name;
                                echo $role;
                                ?>
                            </div>
                            <div class="star-rating">
                                <span class="ci-star1"></span>
                                <span class="ci-star1"></span>
                                <span class="ci-star1"></span>
                                <span class="ci-star1"></span>
                                <span class="ci-star1"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="avatar-wrap">
                        <?php echo $avatar; ?>
                        <span class="icon ci-quote-right"></span>
                    </div>
                </div>
                <?php break;
            default: ?>
                <div class="master-testimonial <?php echo esc_attr( $cls1 ); ?>">
                    <div class="avatar-wrap">
                        <?php echo $avatar; ?>

                        <div class="author-wrap">
                            <?php
                            echo $name;
                            echo $role;
                            ?>
                        </div>

                        <div class="star-rating">
                            <span class="ci-star1"></span>
                            <span class="ci-star1"></span>
                            <span class="ci-star1"></span>
                            <span class="ci-star1"></span>
                            <span class="ci-star1"></span>
                        </div>
                    </div>

                    <div class="content-wrap">
                        <?php 
                        echo $comment; 
                        ?>
                    </div>
                </div>
        <?php }

    }

    protected function render_icon( $icon ) {
        $icon_string = '';
        ob_start(); 

        Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );

        $icon_string = ob_get_clean();
        return $icon_string;
    }
}

