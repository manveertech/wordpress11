<?php
/*
Widget Name: Testimonial Carousel
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Testimonial_Vertical_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'flickity', 'waitforimages', 'gsap' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-testimonial-vertical-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Testimonial Vertical Carousel', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-testimonial-carousel';
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
                        [
                            'name'  => __( 'Client #4', 'masterlayer' ),
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
                    'separator'    => 'before'
                ]
            );

            $this->add_control(
                'arrowPosition',
                [
                    'label'     => __( 'Arrows Position', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'middle',
                    'options'   => [
                        'top'      => __( 'Top', 'masterlayer'),
                        'middle'     => __( 'Middle', 'masterlayer'),
                    ],
                    'condition' => [
                         'prevNextButtons' => 'true'
                    ]
                ]
            );

            $this->add_control(
                'arrowMiddleOffset',
                [
                    'label'     => __( 'Arrows Offset', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '60px',
                    'options'   => [
                        '0px'      => __( '0px', 'masterlayer'),
                        '10px'      => __( '10px', 'masterlayer'),
                        '20px'      => __( '20px', 'masterlayer'),
                        '30px'      => __( '30px', 'masterlayer'),
                        '40px'      => __( '40px', 'masterlayer'),
                        '50px'      => __( '50px', 'masterlayer'),
                        '60px'      => __( '60px', 'masterlayer'),
                        '70px'      => __( '70px', 'masterlayer'),
                        '80px'      => __( '80px', 'masterlayer'),
                        '90px'      => __( '90px', 'masterlayer'),
                        '100px'      => __( '100px', 'masterlayer'),

                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'middle'
                    ]
                ]
            );

            $this->add_control(
                'arrowTopOffset',
                [
                    'label'     => __( 'Arrows Offset', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '60px',
                    'options'   => [
                        '0px'      => __( '0px', 'masterlayer'),
                        '10px'      => __( '10px', 'masterlayer'),
                        '20px'      => __( '20px', 'masterlayer'),
                        '30px'      => __( '30px', 'masterlayer'),
                        '40px'      => __( '40px', 'masterlayer'),
                        '50px'      => __( '50px', 'masterlayer'),
                        '60px'      => __( '60px', 'masterlayer'),
                        '70px'      => __( '70px', 'masterlayer'),
                        '80px'      => __( '80px', 'masterlayer'),
                        '90px'      => __( '90px', 'masterlayer'),
                        '100px'      => __( '100px', 'masterlayer'),

                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'top'
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
        $config['column'] = 1;
        $config['columnTablet'] = 1;
        $config['columnMobile'] = 1;
        $config['gap'] = 0;
        $config['gapTablet'] = 0;

        $config['gapMobile'] = 0;
        $config['arrowPosition'] = $settings['arrowPosition'];
        $config['arrowMiddleOffset'] = $settings['arrowMiddleOffset'];
        $config['arrowTopOffset'] = $settings['arrowTopOffset'];
        
        $config['activeIndex'] = $settings['activeIndex'];
        $config['draggable'] = true;
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? true : false;

        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;
        $config['fade'] = true;

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-vertical-carousel">
            <div class="master-carousel-box carousel-content" <?php echo $data; ?>>
                <?php
                foreach ( $testimonials as $index => $item ) { 
                    $html = $name = $role = $comment = $avatar = $rating = $quotes = $cls1 = "";
                    
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

                    $cls1 = 'elementor-repeater-item-' . $item['_id']
                    ?>
                    <div class="master-testimonial item-carousel <?php echo $cls1; ?>">
                        <div class="content-wrap">

                            <div class="rating-wrap">
                                <?php if ($settings['quotes']) {
                                    echo '<span class="quote">';
                                    Icons_Manager::render_icon( $settings['quotes'], [ 'aria-hidden' => 'true' ] ); 
                                    echo '</span>';
                                } ?>

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
                            <?php echo $comment; ?>
                            <div class="info-wrap">
                                <?php echo $name; ?>
                                <?php echo $role; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="carousel-nav">
                <?php
                foreach ( $testimonials as $index => $item ) { 
                    ?>
                    <div class="nav-item item-carousel <?php echo 'nav' . $index; ?>" style="background-image: url(<?php echo esc_url($item['avatar']['url']) ?>);"></div>
                <?php } ?>
            </div>
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

