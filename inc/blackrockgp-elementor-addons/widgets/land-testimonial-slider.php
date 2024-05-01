<?php
namespace My_Elemntor_Addons\Addons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Land_Testimonial_Slider extends Widget_Base {

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
        return 'land-testimonial-slider';
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
        return __( 'Testimonial Slider', 'hello-elementor-child' );
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
        return 'eicon-testimonial-carousel';
    }

    /**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	/* public function get_script_depends() {
        return [ 'land-owl-carousel-js', 'testimonial-slider-active',  ];
    } */

    /* public function get_style_depends() {
        return [ 'land-owl-carousel-style' ];
    } */

	public function get_keywords() {
		return [ 'slides', 'carousel', 'slider' ];
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
                'label' => __( 'Slider Content', 'hello-elementor-child' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
			'rating_image',
			[
				'label' => esc_html__( 'Rating Image', 'hello-elementor-child' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'slider_title',
			[
				'label' => esc_html__( 'Title', 'hello-elementor-child' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Slider Title' , 'hello-elementor-child' ),
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'slider_content',
			[
				'label' => esc_html__( 'Content', 'hello-elementor-child' ),
				'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Slider Content' , 'hello-elementor-child' ),
                'show_label' => false,
			]
		);

        $repeater->add_control(
			'auhtor_name',
			[
				'label' => esc_html__( 'Author Name', 'hello-elementor-child' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Name' , 'hello-elementor-child' ),
                'label_block' => true,
			]
		);

        $this->add_control(
			'sliders',
			[
				'label' => esc_html__( 'Slider List', 'hello-elementor-child' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'slider_title' => esc_html__( 'Title #1', 'hello-elementor-child' ),
						'slider_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'hello-elementor-child' ),
					]
				],
				'title_field' => '{{{ slider_title }}}',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'slider_options',
			[
				'label' => __( 'Slider Options', 'self-summit' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label' => __( 'Dots', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'self-summit' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
        $rand_id =  rand(155500,999999);; // Generate a unique ID for the Swiper container

        if($settings['navigation'] == 'yes') {
			$nav = 'true';
		} else {
			$nav  = 'false';
		}                
		  
		if($settings['pause_on_hover'] == 'yes') {
			$pause = 'true';
		} else {
			$pause = 'false';
		}
		  
		if($settings['autoplay'] == 'yes') {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}                
		  
		if($settings['infinite'] == 'yes') {
			$loop = 'true';
		} else {
			$loop = 'false';
		}

		if($settings['dots'] == 'yes') {
			$dots = 'true';
		} else {
			$dots = 'false';
		} 			
        
        ?>
    
        <?php if( $settings['sliders'] ) : ?>
            <div class="testimonial-slider owl-carousel" id="testimonialSlider-<?php echo esc_attr( $rand_id ); ?>">
                <?php foreach ($settings['sliders'] as $testimonial) : ?>
                    <div class="single-slide item-<?php echo esc_attr( $testimonial['_id'] ); ?>">
                        <div class="testimonial-content">
                            <?php 
                                if( $testimonial['rating_image']['url'] ){
                                    echo'<div class="rating"><img src="'.esc_url( $testimonial['rating_image']['url'] ).'" /></div>';
                                } 
                            ?>
                            <h4><?php echo esc_html($testimonial['slider_title']); ?></h4>
                            <p><?php echo esc_html($testimonial['slider_content']); ?></p>
                        </div>
                        <div class="testimonial-author">
                            <h4><?php echo esc_html($testimonial['auhtor_name']); ?></h4>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <script>
            (function ($) {
                jQuery(document).ready(function($) {
                    $('#testimonialSlider-<?php echo esc_attr( $rand_id ); ?>').owlCarousel({
                        items:1,
                        loop: <?php echo $loop; ?>,
                        nav: <?php echo $nav; ?>,
                        dots: <?php echo $dots; ?>,
                        autoplay: <?php echo $autoplay; ?>,
                        <?php if( $autoplay === 'yes' ) : ?>
                        autoplayTimeout: <?php echo $settings['autoplay_speed']; ?>
                        <?php endif; ?>
                        autoplayHoverPause:<?php echo $pause; ?>,
                    });
                });
            })(jQuery);
        </script>


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
    /*protected function content_template() {
        ?>

       <!--  <div class="featured-service-wraper">
            <# if ( settings.icon_image.url ) { #> 
                <div class="icon">
                    <img src="{{{ settings.icon_image.url }}}" />
                </div>
            <# } #> 
            
            <div class="featured-service-content">
                <h5>{{{ settings.title }}}</h5>
                <p>{{{ settings.content }}}</p>
            </div>
        </div> -->

        <?php
    }*/
}
