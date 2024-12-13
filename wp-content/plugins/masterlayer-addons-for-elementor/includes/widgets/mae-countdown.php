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

class MAE_Countdown_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'plugin', 'countdown' ];
    }

    public function get_style_depends() {
        return [ 'countdown' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-countdown';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Countdown', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-countdown';
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
                'count',
                [
                    'label'     => __( 'Type', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'countdown',
                    'options'   => [
                        'countdown' => __( 'Count down', 'masterlayer'),
                        'countup'        => __( 'Count Up', 'masterlayer')
                    ],
                ]
            );

			$this->add_control(
				'date',
				[
					'label' => __( 'Date', 'masterlayer' ),
					'type' => Controls_Manager::DATE_TIME,
				]
			);

			$this->add_control(
                'format',
                [
                    'label'     => __( 'Format', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => __( 'DHMS', 'masterlayer'),
                    'description' => __( 'Format for display - upper case for always, lower case only if non-zero, "Y" years, "O" months, "W" weeks, "D" days, "H" hours, "M" minutes, "S" seconds.')
                ]
            );

            $this->add_control(
                'timezone',
                [
                    'label'     => __( 'Time Zone', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '+0',
                    'options'   => [
						  '-12' => __( '[UTC-12] Niue Time', 'masterlayer'),
						  '-12' => __( '[UTC-12] Samoa Standard Time', 'masterlayer'),
						  '-11' => __( '[UTC-11] Hawaii-Aleutian Standard Time', 'masterlayer'),
						  '-11' => __( '[UTC-11] Cook Island Time', 'masterlayer'),
						  '-570' => __( '[UTC-9:30] Marquesas Islands Time', 'masterlayer'),
						  '-9' 	=> __( '[UTC-9] Alaska Standard Time', 'masterlayer'),
						  '-9' 	=> __( '[UTC-9] Gambier Island Time', 'masterlayer'),
						  '-8' 	=> __( '[UTC-8] Pacific Standard Time', 'masterlayer'),
						  '-7' 	=> __( '[UTC-7] Mountain Standard Time', 'masterlayer'),
						  '-6' 	=> __( '[UTC-6] Central Standard Time', 'masterlayer'),
						  '-5' 	=> __( '[UTC-5] Eastern Standard Time', 'masterlayer'),
						  '-270' => __( '[UTC-4:30] Venezuelan Standard Time', 'masterlayer'),
						  '-4' 	=> __( '[UTC-4] Atlantic Standard Time', 'masterlayer'),
						  '-210' => __( '[UTC-3:30] Newfoundland Standard Time', 'masterlayer'),
						  '-3' 	=> __( '[UTC-3] Amazon Standard Time', 'masterlayer'),
						  '-3' 	=> __( '[UTC-3] Central Greenland Time', 'masterlayer'),
						  '-2'	=> __( '[UTC-2] Fernando de Noronha Time', 'masterlayer'),
						  '-2' 	=> __( '[UTC-2] South Sandwich Islands Time', 'masterlayer'),
						  '-1' 	=> __( '[UTC-1] Azores Standard Time', 'masterlayer'),
						  '-1' 	=> __( '[UTC-1] Cape Verde Time', 'masterlayer'),
						  '-1' 	=> __( '[UTC-1] Eastern Greenland Time', 'masterlayer'),
						  '+0' 	=> __( '[UTC] Western European Time', 'masterlayer'),
						  '+0' 	=> __( '[UTC] Greenwich Mean Time', 'masterlayer'),
						  '+1' 	=> __( '[UTC+1] Central European Time', 'masterlayer'),
						  '+1' 	=> __( '[UTC+1] West African Time', 'masterlayer'),
						  '+2' 	=> __( '[UTC+2] Eastern European Time', 'masterlayer'),
						  '+2' 	=> __( '[UTC+2] Central African Time', 'masterlayer'),
						  '+3' 	=> __( '[UTC+3] Moscow Standard Time', 'masterlayer'),
						  '+3' 	=> __( '[UTC+3] Eastern African Time', 'masterlayer'),
						  '+210' 	=> __( '[UTC+3:30] Iran Standard Time', 'masterlayer'),
						  '+4' 	=> __( '[UTC+4] Gulf Standard Time', 'masterlayer'),
						  '+4' 	=> __( '[UTC+4] Samara Standard Time', 'masterlayer'),
						  '+270' 	=> __( '[UTC+4:30] Afghanistan Time', 'masterlayer'),
						  '+5' 	=> __( '[UTC+5] Yekaterinburg Standard Time', 'masterlayer'),
						  '+5' 	=> __( '[UTC+5] Yekaterinburg Standard Time', 'masterlayer'),
						  '+330' 	=> __( '[UTC+5:30] Indian Standard Time', 'masterlayer'),
						  '+330' 	=> __( '[UTC+5:30] Sri Lanka Time', 'masterlayer'),
						  '+345' 	=> __( '[UTC+5:45] Nepal Time', 'masterlayer'),
						  '+6' 	=> __( '[UTC+6] Bangladesh Time', 'masterlayer'),
						  '+6' 	=> __( '[UTC+6] Bhutan Time', 'masterlayer'),
						  '+6' 	=> __( '[UTC+6] Novosibirsk Standard Time', 'masterlayer'),
						  '+390' 	=> __( '[UTC+6:30] Cocos Islands Time', 'masterlayer'),
						  '+390' 	=> __( '[UTC+6:30] Myanmar Time', 'masterlayer'),
						  '+7' 		=> __( '[UTC+7] Krasnoyarsk Standard Time', 'masterlayer'),
						  '+7' 		=> __( '[UTC+7] Indochina Time', 'masterlayer'),
						  '+8' 		=> __( '[UTC+8] Chinese Standard Time', 'masterlayer'),
						  '+8' 		=> __( '[UTC+8] Australian Western Standard Time', 'masterlayer'),
						  '+8' 		=> __( '[UTC+8] Irkutsk Standard Time', 'masterlayer'),
						  '+525' 	=> __( '[UTC+8:45] Southeastern Western Australian Standard Time', 'masterlayer'),
						  '+9' 	=> __( '[UTC+9] Japan Standard Time', 'masterlayer'),
						  '+9' 	=> __( '[UTC+9] Korea Standard Time', 'masterlayer'),
						  '+9' 	=> __( '[UTC+9] Chita Standard Time', 'masterlayer'),
						  '+570' 	=> __( '[UTC+9:30] Australian Central Standard Time', 'masterlayer'),
						  '+10' 	=> __( '[UTC+10] Australian Eastern Standard Time', 'masterlayer'),
						  '+10' 	=> __( '[UTC+10] Vladivostok Standard Time', 'masterlayer'),
						  '+630' 	=> __( '[UTC+10:30] Lord Howe Standard Time', 'masterlayer'),
						  '+11' 	=> __( '[UTC+11] Solomon Island Time', 'masterlayer'),
						  '+11' 	=> __( '[UTC+11] Magadan Standard Time', 'masterlayer'),
						  '+690' 	=> __( '[UTC+11:30] Norfolk Island Time', 'masterlayer'),
						  '+12' 	=> __( '[UTC+12] New Zealand Time', 'masterlayer'),
						  '+12' 	=> __( '[UTC+12] Fiji Time', 'masterlayer'),
						  '+12' 	=> __( '[UTC+12] Kamchatka Standard Time', 'masterlayer'),
						  '+765' 	=> __( '[UTC+12:45] Chatham Islands Time', 'masterlayer'),
						  '+13' 	=> __( '[UTC+13] Tonga Time', 'masterlayer'),
						  '+13' 	=> __( '[UTC+13] Phoenix Islands Time', 'masterlayer'),
						  '+14' 	=> __( '[UTC+14] Line Island Time', 'masterlayer'),
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
                'time_color',
                [
                    'label' => __( 'Time', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .countdown-amount' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'period_color',
                [
                    'label' => __( 'Period', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .countdown-period' => 'color: {{VALUE}};',
                    ],
                ]
            );

			$this->add_control(
                'background_color',
                [
                    'label' => __( 'Column Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .countdown-section' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'c_border',
                    'label' => esc_html__( 'Column Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .countdown-section'
                ]
            );

            $this->add_control(
                'content_rounded',
                [
                    'label' => __('Column Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .countdown-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

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
                'content_padding',
                [
                    'label' => __('Column Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .countdown-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'label' => __( 'Time', 'masterlayer' ),
                    'name' => 'time_typography',
                    'selector' => '{{WRAPPER}} .countdown-amount'
                ]
            );

			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => __( 'Period', 'masterlayer' ),
                    'name' => 'time_typography',
                    'selector' => '{{WRAPPER}} .countdown-period'
                ]
            );

			$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$config = array();

		$due_date = strtotime( $this->get_settings( 'date' ) );

		$config['count'] = $settings['count'];
		$config['date'] = $settings['date'];
		$config['format'] = $settings['format'];
		$config['serverSync'] = true;
		$config['timezone'] = $settings['timezone'];
		$config['labels'] = [
			__('Years', 'masterlayer'),
			__('Months', 'masterlayer'),
			__('Weeks', 'masterlayer'),
			__('Days', 'masterlayer'),
			__('Hours', 'masterlayer'),
			__('Minutes', 'masterlayer'),
			__('Seconds', 'masterlayer')
		];
		$config['labels1'] = [
			__('Year', 'masterlayer'),
			__('Month', 'masterlayer'),
			__('Week', 'masterlayer'),
			__('Day', 'masterlayer'),
			__('Hour', 'masterlayer'),
			__('Minute', 'masterlayer'),
			__('Second', 'masterlayer')
		];

		$data = 'data-config=\'' . json_encode( $config ) . '\'';
		?>
		<div class="master-countdown" <?php echo $data; ?>>

	    </div>
	<?php }

	
}

