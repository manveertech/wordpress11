<?php

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Login_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-login';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Login', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-lock-user';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
        $this->start_controls_section( 'content_section',
            [
                'label' => __( 'Form', 'masterlayer' ),
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
            'type',
            [
                'label' => __( 'Type', 'masterlayer' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'login',
                'options' => [
                    'login'     => __( 'Login Form', 'masterlayer' ),
                    'logout'    => __( 'Logout Link', 'masterlayer' ),
                ],
            ]
        );

        // Login Content
            $this->add_control(
                'username_label',
                [
                    'label' => __( 'Username Label', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Username or Email Address', 'masterlayer'),
                    'label_block' => true,
                    'condition' => ['type' => 'login']
                ]
            );

            $this->add_control(
                'password_label',
                [
                    'label' => __( 'Password Label', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Password', 'masterlayer'),
                    'label_block' => true,
                    'condition' => ['type' => 'login']
                ]
            );

            $this->add_control(
                'remember',
                [
                    'label' => __( 'Remember password?', 'masterlayer' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'masterlayer' ),
                    'label_off' => __( 'No', 'masterlayer' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => ['type' => 'login']
                ]
            );

            $this->add_control(
                'remember_label',
                [
                    'label' => __( 'Remember Label', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Password', 'masterlayer'),
                    'label_block' => true,
                    'condition' => ['remember' => 'yes', 'type' => 'login']
                ]
            );

            $this->add_control(
                'lost_password',
                [
                    'label' => __( 'Forget Password?', 'masterlayer' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'masterlayer' ),
                    'label_off' => __( 'No', 'masterlayer' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => ['type' => 'login']
                ]
            );

            $this->add_control(
                'lost_label',
                [
                    'label' => __( 'Forget Password Text', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Forget password?', 'masterlayer'),
                    'label_block' => true,
                    'condition' => ['lost_password' => 'yes', 'type' => 'login']
                ]
            );

            $this->add_control(
                'submit_label',
                [
                    'label' => __( 'Log In', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Log in', 'masterlayer'),
                    'label_block' => true,
                    'condition' => ['type' => 'login']
                ]
            );

            $this->add_control(
                'redirect',
                [
                    'label' => __( 'Redirect', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Your Url', 'masterlayer' ),
                    'description' => __('URL to redirect to. Must be absolute, as in "<a href="https://example.com/mypage/">https://example.com/mypage/</a>". Default is to redirect back to the request URI.', 'masterlayer'),
                    'label_block' => true,
                    'condition' => ['type' => 'login']
                ]
            );

        // Logout Content
            $this->add_control(
                'logout_text',
                [
                    'label' => __( 'Text', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Logout', 'masterlayer'),
                    'label_block' => true,
                    'condition' => ['type' => 'logout']
                ]
            );

            $this->add_control(
                'logout_icon',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'default' => [
                        'value' => 'ci-user-circle1',
                        'library' => 'core',
                    ],
                    'condition' => ['type' => 'logout']
                ]
            );

            $this->add_control(
                'logout_redirect',
                [
                    'label' => __( 'Redirect', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Your Url', 'masterlayer' ),
                    'description' => __('URL to redirect to. Must be absolute, as in "<a href="https://example.com/mypage/">https://example.com/mypage/</a>". Default is to redirect back to the request URI.', 'masterlayer'),
                    'label_block' => true,
                    'condition' => ['type' => 'logout']
                ]
            );

            $this->end_controls_section();

        // Login Style
            // Form
                $this->start_controls_section(
                    'section__form_style',
                    [
                        'label' => __( 'Form', 'masterlayer' ),
                        'tab'   => Controls_Manager::TAB_STYLE,
                        'condition' => ['type' => 'login']
                    ]
                );

                $this->add_responsive_control(
                    'textalign',
                    [
                        'label' => __( 'Text Align', 'masterlayer' ),
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
                        'selectors' => ['{{WRAPPER}} form' => 'text-align:{{VALUE}};']
                    ]
                );

                $this->add_control(
                    'form_width',
                    [
                        'label' => __( 'Width', 'masterlayer' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}} form' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                );

                $this->end_controls_section();

            // Input
                $this->start_controls_section(
                    'section__input_style',
                    [
                        'label' => __( 'Input', 'masterlayer' ),
                        'tab'   => Controls_Manager::TAB_STYLE,
                        'condition' => ['type' => 'login']
                    ]
                );

                $this->add_control(
                    'label_heading',
                    [
                        'type'    => Controls_Manager::HEADING,
                        'label'   => __( 'Label', 'masterlayer' ),
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'label_typography',
                        'selector' => '{{WRAPPER}} label',
                    ]
                );

                $this->add_control(
                    'label_color',
                    [
                        'label' => __( 'Label', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} label' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'label_space',
                    [
                        'label' => __( 'Bottom Spacing', 'masterlayer' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_control(
                    'input_heading',
                    [
                        'type'    => Controls_Manager::HEADING,
                        'label'   => __( 'Input', 'masterlayer' ),
                        'separator' => 'after'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'input_typography',
                        'selector' => '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="password"]',
                    ]
                );

                $this->add_control(
                    'input_color',
                    [
                        'label' => __( 'Input Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="password"]' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'input_bg',
                    [
                        'label' => __( 'Input Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="password"]' => 'background-color: {{VALUE}}',
                        ],
                    ]
                );

                $this->add_control(
                    'input_rounded',
                    [
                        'label' => __('Rounded', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="password"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'padding',
                    [
                        'label' => __('Padding', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%', 'em'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="password"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'input_space',
                    [
                        'label' => __( 'Bottom Spacing', 'masterlayer' ),
                        'type' => Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} input[type="text"], {{WRAPPER}} input[type="password"]' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->end_controls_section();

            // Submit Button
                $this->start_controls_section(
                    'section__submit_style',
                    [
                        'label' => __( 'Submit Button', 'masterlayer' ),
                        'tab'   => Controls_Manager::TAB_STYLE,
                        'condition' => ['type' => 'login']
                    ]
                );

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'button_typography',
                        'selector' => '{{WRAPPER}} input[type="submit"]',
                    ]
                );

                $this->add_control(
                    'buttonwidth',
                    [
                        'label' => __( 'Width', 'masterlayer' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}} input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                );

                $this->start_controls_tabs( 'button_hover_tabs' );

                // Normal
                    $this->start_controls_tab(
                        'button_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => __( 'Text Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} input[type="submit"]' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => __( 'Background Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} input[type="submit"]' => 'background-color: {{VALUE}};',
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
                                '{{WRAPPER}} input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow',
                            'selector' => '{{WRAPPER}} input[type="submit"]',
                        ]
                    );

                    $this->end_controls_tab();

                // Button hover
                    $this->start_controls_tab(
                        'button_hover',
                        [
                            'label' => __( 'Button Hover', 'masterlayer' ),
                        ]
                    );

                    $this->add_control(
                        'button_color_hover',
                        [
                            'label' => __( 'Text Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} input[type="submit"]:hover' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_bg_color_hover',
                        [
                            'label' => __( 'Background Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} input[type="submit"]:hover' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_rounded_hover',
                        [
                            'label' => __('Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} input[type="submit"]:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow_hover',
                            'selector' => '{{WRAPPER}} input[type="submit"]:hover',
                        ]
                    );

                    $this->end_controls_tab();

                $this->end_controls_tabs();

                $this->add_responsive_control(
                    'btn_margin',
                    [
                        'label' => __('Margin', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%', 'em'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'btn_padding',
                    [
                        'label' => __('Margin', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%', 'em'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->end_controls_section();

        // Logout Style
            $this->start_controls_section(
                'logout_section__input_style',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                    'condition' => ['type' => 'logout']
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'logout_text_typography',
                    'selector' => '{{WRAPPER}} a',
                ]
            );

            $this->add_control(
                'logout_text_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'logout_text_hover_color',
                [
                    'label' => __( 'Hover Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_section();
    }    

    protected function render() {
        $settings = $this->get_settings_for_display();
        $args = array();
        switch ($settings['type']) {
            case 'login':
                $id = rand();
                $args['form_id'] = 'loginform-' . $id;
                $args['id_password'] = 'user_pass-' . $id;
                $args['id_username'] = 'user_login-' . $id;
                $args['id_remember'] = 'rememberme-' . $id;
                $args['id_submit'] = 'wp-submit-' . $id;
                if ($settings['username_label']) $args['label_username'] = $settings['username_label'];
                if ($settings['password_label']) $args['label_password'] = $settings['password_label'];
                if ($settings['remember_label']) $args['label_remember'] = $settings['remember_label'];
                if ($settings['submit_label']) $args['label_log_in'] = $settings['submit_label'];
                $settings['remember'] == 'yes' ? $args['remember'] = true : $args['remember'] = false;
                if ($settings['redirect']) $args['redirect'] = $settings['redirect'];
                if ($settings['lost_password'] == 'yes') {
                    $settings['lost_label'] ? $args['lost_label'] = $settings['lost_label'] : $args['lost_label'] = __('Forget password?', 'masterlayer');
                    
                    add_filter('login_form_middle', function( $content, $args ) { 
                        return '<a class="forget-passwork-link" href="/wp-login.php?action=lostpassword">' . $args['lost_label'] . '</a>'; 
                    }, 10, 2 );
                }
                
                echo '<div class="master-login-form">';
                wp_login_form($args);
                echo '</div>';
                break;
            
            case 'logout':
                $redirect = '';
                if ($settings['logout_redirect']) $redirect = $settings['logout_redirect'];

                echo '<a class="master-logout-url" href="' . wp_logout_url($redirect) . '">';
                \Elementor\Icons_Manager::render_icon( $settings['logout_icon'], [ 'aria-hidden' => 'true' ] );
                echo esc_html($settings['logout_text']) . '</a>';
                break;
            default:
                # code...
                break;
        }
        
    }
}

