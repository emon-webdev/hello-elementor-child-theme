<?php
namespace Blackrockgp_Elemntor_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Blackrockgp_Featured_Image extends Widget_Base {

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
		return 'blackrockgp-featured-image';
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
		return __( 'Featured Image', 'elementor-hello-world' );
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
		return 'eicon-image';
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
				'label' => __( 'Image', 'elementor-hello-world' ),
			]
		);

      $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor-hello-world' ),
				'type' => Controls_Manager::MEDIA,
            'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

      $this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor-hello-world' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1E63A0',
				'selectors' => [
					'{{WRAPPER}} .blackrockgp__featured_image::before' => 'background: {{VALUE}}',
				]
			]
		);

      $this->add_responsive_control(
			'background_position',
			[
				'label' => esc_html__( 'Background Position', 'elementor-hello-world' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-hello-world' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-hello-world' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .blackrockgp__featured_image::before' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'left: 0',
					'right' => 'left: auto,right:0',
				],
				'default' => 'right',
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

      if ( empty( $settings['image']['url'] ) ) {
			return;
		}

      $className = ( $settings['background_position'] === 'left' ) ? ' bg-padding' : '';

   ?>   


		<div class="blackrockgp__featured_image<?php echo esc_attr( $className ); ?>">
         <div class="featured_image">
            <img src="<?php echo esc_url( $settings['image']['url'] ); ?>" class="img-fluid">
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
         if ( settings.image.url ) {
            var image = {
               id: settings.image.id,
               url: settings.image.url,
               size: settings.image_size,
               dimension: settings.image_custom_dimension,
               model: view.getEditModel()
            };

            var image_url = elementor.imagesManager.getImageUrl( image );

            if ( ! image_url ) {
               return;
            }
         } 

         var className = ( settings.background_position === 'left' ) ? 'bg-padding' : '';
      #>
        
      <div class="blackrockgp__featured_image {{ className }}">
         <div class="featured_image">
            <img src="{{ image_url }}" class="img-fluid">
         </div>
      </div>
		
		<?php
  }
}
