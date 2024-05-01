<?php
namespace Blackrockgp_Elemntor_Addons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Blackrockgp_Button extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'blackrockgp-button';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'GP Button', 'elementor-hello-world' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'blackrockgp' ];
	}



	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Button', 'elementor-hello-world' ),
			]
		);


		$this->add_control(
			'title',
			[
				'label' => __( 'Button Title', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => esc_html__('Book Online','elementor-hello-world')
			]
		);

      $this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'elementor-hello-world' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#'
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'elementor-hello-world' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => [
					'md' => esc_html__( 'Medium', 'elementor-hello-world' ),
					'lg' => esc_html__( 'Large', 'elementor-hello-world' ),
					'xl' => esc_html__( 'Fluid', 'elementor-hello-world' ),
					'custom' => esc_html__( 'Custom', 'elementor-hello-world' ),
				]
			]
		);


      $this->add_responsive_control(
			'horizontal_position',
			[
				'label' => esc_html__( 'Horizontal Position', 'elementor-hello-world' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-hello-world' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-hello-world' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-hello-world' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .site__btns' => 'justify-content:{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'flex-start',
					'center' => 'center',
					'right' => 'flex-end',
				],
				'default' => 'center',
				'conditions' => [
					'terms' => [
						[
							'name' => 'size',
							'operator' => '!==',
							'value' => 'xl',
						],
					],
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__( 'Custom Width', 'elementor-hello-world' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 500,
						'step' => 2,
					],
					'em' => [
						'min' => 10,
						'max' => 32,
						'step' => 1,
					],
					'rem' => [
						'min' => 10,
						'max' => 32,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .site__btns .btn-filled' => 'width: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'size',
							'operator' => '===',
							'value' => 'custom',
						],
					],
				],
			]
		);
	
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .site__btns .btn-filled',
				'condition' => [
					'title!' => '',
				],
				'default' => [
					'font_family' => 'Proxima-N-W01-Reg',
				],
			]
		);

		

		
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-hello-world' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .site__btns .btn-filled' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .site__btns .btn-filled',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#1E63A0',
						
					],
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-hello-world' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1E63A0',
				'selectors' => [
					'{{WRAPPER}} .site__btns .btn-filled' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .site__btns .btn-filled:hover',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#fff',
						
					],
				],
			]
		);

		$this->end_controls_tab();


		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['website_link']['url'] ) ) {
			$this->add_link_attributes( 'website_link', $settings['website_link'] );
		}

		if( $settings['size'] === 'xl' ){
			$className = " btn-fluid";
		}elseif( $settings['size'] === 'lg' ){
			$className = " btn-large";
		}else{
			$className = "";
		}

   ?>   

		<div class="site__btn_wrapper">
			<div class="site__btns">
				<a class="btn-filled<?php echo esc_attr( $className ); ?>" <?php echo $this->get_render_attribute_string( 'website_link' ); ?>>
					<?php echo esc_html($settings['title']); ?>
				</a>
			</div>
		</div>
		

   <?php   
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>

		<#
		if( settings.size === 'xl' ){
			var className = "btn-fluid";
		}else if( settings.size === 'lg' ){
			var className = "btn-large";
		}else{
			var className = "";
		}
		#>

		<div class="site__btn_wrapper">
			<div class="site__btns">
				<a class="btn-filled {{ className }}" href="{{ settings.website_link.url }}">
				{{{ settings.title }}}
				</a>
			</div>
		</div>

		<?php
  }
}
