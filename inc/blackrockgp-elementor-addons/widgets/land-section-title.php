<?php
namespace My_Elemntor_Addons\Addons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Land_Section_Title extends Widget_Base {

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
		return 'section-title';
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
		return __( 'Title', 'elementor-hello-world' );
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
		return 'eicon-heading';
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
		return [ 'landaffiliates' ];
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
			'image',
			[
				'label' => esc_html__( 'Choose Icon Image', 'elementor-hello-world' ),
				'type' => Controls_Manager::MEDIA,
                'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor-hello-world' ),
				'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'How It Works:', 'elementor-hello-world' ),
                'label_block' => true,
			]
		);

        $this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'elementor-hello-world' ),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your description here', 'elementor-hello-world' ),
                'default' => '<h3>'.esc_html__( "Simple Steps to Big Earnings", "elementor-hello-world" ).'</h3>',
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
    ?>    

        <div class="section-title-wrapper">
            <?php
                if( $settings['image']['url'] ){
                    echo'
                        <div class="icon-image"><img src="'.esc_url( $settings['image']['url'] ).'" /></div>
                    ';
                }
            ?>
            
            <div class="section-content">
                <h2><?php echo esc_html( $settings['title'] ); ?></h2>
                <?php echo wpautop( $settings['description'] ); ?>
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

        <div class="section-title-wrapper">
            <# if( settings.image.url ){ #>
                 <div class="icon-image"><img src="{{{ settings.image.url }}}" /></div> 
            <#  } #>
            
            <div class="section-content">
                <h2>{{{ settings.title }}}</h2>
                {{{ settings.description }}}
            </div>
        </div>
		<?php
	}
}
