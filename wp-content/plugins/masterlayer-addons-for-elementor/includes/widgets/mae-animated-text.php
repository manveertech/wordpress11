<?php

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Animated_Text_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'splitting', 'gsap' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-animated-text';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Animated Text', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-animated-headline';
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

			$this->add_responsive_control(
				'max_width',
				[
					'label' => __( 'Max Width', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 300,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-animated-text' => 'max-width: {{SIZE}}{{UNIT}};',
					]
				]
			);

			$this->add_control(
				'before_text',
				[
					'label' => __( 'Text Before', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true
				]
			);

			$this->add_control(
				'after_text',
				[
					'label' => __( 'Text After', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true
				]
			);

			$this->add_control(
                'underline',
                [
                    'label'     => __( 'Underline', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'          => __( 'None', 'masterlayer'),
                        'color'         => __( 'Color', 'masterlayer'),
                        'image'         => __( 'Image', 'masterlayer')
                    ]
                ]
            );

            $this->add_responsive_control(
                'underline_height',
                [
                    'label'      => __( 'Underline Height', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .underline' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => ['underline!' => 'none']
                ]
            );

            $this->add_responsive_control(
                'underline_offset',
                [
                    'label'      => __( 'Underline Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .underline' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => ['underline!' => 'none']
                ]
            );

      		$this->add_control(
                'underline_image',
                [
                    'label'   => __( 'Underline Image', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ],
                    'condition' => ['underline' => 'image']
                ],
            );

            $this->add_control(
                'underline_color',
                [
                    'label' => __( 'Underline Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .underline' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => ['underline' => 'color']
                ]
            );

			$repeater = new Repeater();
				
			$repeater->add_control(
				'text',
				[
					'label' => __( 'Text', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true
				]
			);

			$this->add_control(
				'texts',
				[	
					'label' => __( 'Rotate Texts', 'masterlayer' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'text' => __( 'Text #1', 'masterlayer' )
						],
						[
							'text' => __( 'Text #2', 'masterlayer' )
						],
						[
							'text' => __( 'Text #3', 'masterlayer' ),
						]
					],
					'title_field' => '{{{ text }}}',
				]
			);

			$this->end_controls_section();

		// Settings
			$this->start_controls_section(
				'section__setting',
				[
					'label' => __( 'Settings', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_SETTINGS,
				]
			);

			$this->add_control(
                'event',
                [
                    'label' => __( 'Event', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'default'   => __( 'Default', 'masterlayer' ),
                        'hover'  	=> __( 'Hover', 'masterlayer' ),
                        'inview'  	=> __( 'In View', 'masterlayer' ),
                    ],
                ]
            );

            $this->add_control(
                'effect',
                [
                    'label' => __( 'Effect', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'fx1',
                    'options' => [
                        'fx1'   	=> __( 'Effect 01', 'masterlayer' ),
                        'fx2'   	=> __( 'Effect 02', 'masterlayer' ),
                        'fx3'   	=> __( 'Effect 03', 'masterlayer' ),
                        'fx4'   	=> __( 'Effect 04', 'masterlayer' ),
                        'fx5'   	=> __( 'Effect 05', 'masterlayer' ),
                        'fx15'   	=> __( 'Effect 06', 'masterlayer' ),
                    ],
                ]
            );

            $this->add_control(
                'split',
                [
                    'label' => __( 'Split', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'lines',
                    'options' => [
                        'chars'   	=> __( 'Character', 'masterlayer' ),
                        'words'  	=> __( 'Word', 'masterlayer' ),
                        'lines'  	=> __( 'Line', 'masterlayer' ),
                    ],
                ]
            );

            $this->add_control(
                'delay',
                [
                    'label' => __( 'Delay (ms)', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1000,
                    'max' => 20000,
                    'step' => 100,
                    'default' => 5000,
                    'condition' => [ 'event' => 'default' ]
                ]
            );

			$this->end_controls_section();
		// Color
			$this->start_controls_section(
				'section__style_color',
				[
					'label' => __( 'Color', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'text_color',
				[
					'label' => __( 'Text', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-animated-text' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_control(
				'text_effect_color',
				[
					'label' => __( 'Text Effect', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-animated-text .inner' => 'color: {{VALUE}};',
					]
				]
			);

			$this->end_controls_section();

		// Typo
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
					'name' => 'title_typography',
					'label' => __( 'Text', 'masterlayer' ),
					'selector' => '{{WRAPPER}} .master-animated-text',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'label' => __( 'Text Effect', 'masterlayer' ),
					'selector' => '{{WRAPPER}} .master-animated-text .inner',
				]
			);

			$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$texts = $this->get_settings_for_display('texts');

		$data = "";
		$config['event'] = $settings['event'];
		$config['split'] = $settings['split'];
		$config['delay'] = $settings['delay'];
		$config['effect'] = $settings['effect'];

		$data = 'data-config=\'' . json_encode( $config ) . '\'';
		?>

		<h2 class="master-animated-text" <?php echo $data; ?>>
			<?php if ( $settings['before_text'] ) echo $settings['before_text']; ?>
			<span class="inner">
				<?php foreach ( $texts as $text ) {
					echo '<span class="item">' . $text['text'] . '</span>';
				} 
				if ( $settings['underline'] == 'color' ) echo '<span class="underline color"></span>';
				if ( $settings['underline'] == 'image' ) echo '<span class="underline image">' . wp_get_attachment_image( $settings['underline_image']['id'], 'full' ) . '</span>';
				?>
			</span>
			<?php if ( $settings['after_text'] ) echo $settings['after_text']; ?>
	    </h2>

	    <?php
	}
}

