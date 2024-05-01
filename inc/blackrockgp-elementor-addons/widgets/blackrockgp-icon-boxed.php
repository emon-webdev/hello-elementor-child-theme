<?php
namespace Blackrockgp_Elemntor_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Blackrockgp_Icon_Boxed extends Widget_Base {

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
		return 'blackrockgp-icon';
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
		return __( 'Icon Boxed', 'elementor-hello-world' );
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
		return 'eicon-posts-ticker';
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
				'label' => __( 'Content', 'elementor-hello-world' ),
			]
		);

      $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa-solid fa-stethoscope',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default' => esc_html__('Services','elementor-hello-world')
			]
		);

      $this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'elementor-hello-world' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);


		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'elementor-hello-world' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
				],
				'default' => 'h5',
				'condition' => [
					'title!' => '',
				],
			]
		);

	
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'elementor-hello-world' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#0063a0',
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper a .icon__title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title!' => '',
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .icon-wrapper a h3',
				'condition' => [
					'title!' => '',
				],
				'default' => [
					'font_family' => '"Roboto", sans-serif',
					'font_size' => '21px',
					'font_weight' => '300',
			],
			]
		);
	  

		$this->add_responsive_control(
			'horizontal_position',
			[
				'label' => esc_html__( 'Horizontal Position', 'elementor-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-pro' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-pro' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
				'default' => 'center',
			]
		);
	  

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

		$title_tag = Utils::validate_html_tag( $settings['title_tag'] );
		$this->add_render_attribute('title_tag', 'class', 'icon__title');

   ?>   

		<div class="icon-wrapper">
			<a <?php echo $this->get_render_attribute_string( 'website_link' ); ?>>
			<?php if ( ! empty( $settings['icon']['value'] ) ) : ?>
				<div class="icon">
						<?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
			<?php endif; ?>
			<<?php Utils::print_validated_html_tag($title_tag); ?> <?php echo $this->get_render_attribute_string('title_tag'); ?>><?php echo esc_html($settings['title']); ?></<?php Utils::print_validated_html_tag($title_tag); ?>>
			</a>
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
			 var iconHTML = elementor.helpers.renderIcon(view, settings.icon, { 'aria-hidden': true }, 'i', 'object'),
				  titleTag = elementor.helpers.validateHTMLTag(settings.title_tag);
  
			 view.addRenderAttribute('title_tag', 'class', 'icon__title');
		#>
		<div class="icon-wrapper">
			 <a href="{{ settings.website_link.url }}">
				  <# if (iconHTML.value) { #>
						<div class="icon">{{{ iconHTML.value }}}</div>
				  <# } #>
				  <# if (settings.title) { #>
						<{{ titleTag }} {{{ view.getRenderAttributeString('title_tag') }}}>{{{ settings.title }}}</{{ titleTag }}>
				  <# } #>
			 </a>
		</div>
		<?php
  }
}
