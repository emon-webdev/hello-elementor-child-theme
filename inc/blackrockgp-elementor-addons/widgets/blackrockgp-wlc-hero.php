<?php
namespace Blackrockgp_Elemntor_Addons\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Group;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Blackrockgp_Wlc_Hero extends Widget_Base {

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
		return 'wlc-hero';
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
		return __( 'Hero', 'isbs' );
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
		return 'eicon-elementor';
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
				'label' => __( 'Content', 'hello-elementor-child' ),
			]
		);

        $this->add_control(
			'hero_image',
			[
				'label' => esc_html__( 'Hero Image', 'hello-elementor-child' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
			]
		);

		$this->add_control(
			'hero_description',
			[
				'label' => esc_html__( 'Description', 'hello-elementor-child' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '<h1>'.esc_html__( "Blackrock GP Family Doctor", "isbs" ).'</h1>',
			]
		);


		$this->add_control(
			'button_title',
			[
				'label' => esc_html__( 'Button Text', 'hello-elementor-child' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Get in Touch', 'hello-elementor-child' ),
                'label_block' => true,
			]
		);

		$this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'textdomain' ),
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
			'book_button_title',
			[
				'label' => esc_html__( 'Button Text', 'hello-elementor-child' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Book Online', 'hello-elementor-child' ),
                'label_block' => true,
			]
		);

		$this->add_control(
			'book_website_link',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'textdomain' ),
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


		

		$this->end_controls_section();

        $this->start_controls_section(
			'background_tab',
			[
				'label' => __( 'Background', 'plugin-name' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'plugin-domain' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(173, 209, 231, 1)',
				'selectors' => [
					'{{WRAPPER}} .wlc__hero_area' => 'background-color: {{VALUE}}',
				],
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
		if ( ! empty( $settings['book_website_link']['url'] ) ) {
			$this->add_link_attributes( 'book_website_link', $settings['book_website_link'] );
		}
    ?>    

        <div class="wlc__hero_area d-flex align-items-center">
				<?php
					if( !empty( $settings['hero_image']['url'] ) ){
						echo'<div class="hero-bg-image" style="background-image:url('.esc_url( $settings['hero_image']['url'] ).')"></div>';
					}
				?>
            <div class="container-fluid">
                <div class="row">
						<div class="col-md-5 offset-md-7">
							<div class="wlc__content text-center">
									<?php echo wpautop( $settings['hero_description'] ); ?>    
									<div class="site__btns">
										<a  class="btn-filled btn-signup" <?php echo $this->get_render_attribute_string( 'website_link' ); ?> ><?php echo esc_html( $settings['button_title'] ); ?></a>
										<a  class="btn-filled btn-online" <?php echo $this->get_render_attribute_string( 'book_website_link' ); ?> ><?php echo esc_html( $settings['book_button_title'] ); ?></a>
									</div>
										
							</div>
						</div>
                </div>
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
	/* protected function content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	} */
}
