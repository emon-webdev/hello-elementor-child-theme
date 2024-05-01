<?php
namespace My_Elemntor_Addons\Addons;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Land_CTA extends Widget_Base {

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
        return 'land-cta';
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
        return __( 'CTA', 'hello-elementor-child' );
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
        return 'eicon-call-to-action';
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
                'label' => __( 'Content', 'hello-elementor-child' ),
            ]
        );



        $this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Select Layout', 'hello-elementor-child' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout_1',
				'options' => [
					'layout_1'  => esc_html__( 'CTA Layout 1', 'hello-elementor-child' ),
					'layout_2' => esc_html__( 'CTA Layout 2', 'hello-elementor-child' ),
					'layout_3' => esc_html__( 'CTA Layout 3', 'hello-elementor-child' ),
				]
			]
		);

        $this->add_control(
            'cta_image',
            [
                'label' => esc_html__( 'CTA Image', 'hello-elementor-child' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
						[
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_2',
                        ],
                        [
                            'name' => 'layout',
                            'operator' => '!==',
                            'value' => 'layout_3',
                        ]
                    ]
                ]
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __( 'Content', 'hello-elementor-child' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Start Earning Today!', 'hello-elementor-child' ),
            ]
        );

        

        $this->add_control(
            'button_title',
            [
                'label' => __( 'Button Title', 'hello-elementor-child' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Sign Up as an Affiliate Now!', 'hello-elementor-child' ),
                'label_block' => true,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
						[
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_1',
                        ],
						[
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_3',
                        ]
                    ]
                ]
            ]
        );

        $this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'hello-elementor-child' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'hello-elementor-child' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
						[
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_1',
                        ],
						[
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_3',
                        ]
                    ]
                ]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Background Style', 'hello-elementor-child' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( 'Background Color', 'hello-elementor-child' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#76B762',
				'selectors' => [
					'{{WRAPPER}} .cta-boxed-wrapper' => 'background-color: {{VALUE}}',
				],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_1',
                        ]
                    ]
                ]
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_gradient',
				'types' => ['gradient'],
                'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .cta-boxed-wrapper.gradient',
                'fields_options' => [
					'color' => [
						'label' => esc_html__( 'Background Color', 'hello-elementor-child' ),
					],
				],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_2',
                        ]
                    ]
                ]
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

        if( $settings['layout'] === 'layout_3'  ){
            $className = ' bg-trtransparent';
        }elseif( $settings['layout'] === 'layout_2' ){
            $className = ' gradient';
        }else{
            $className = '';
        }

        ?>


        <div class="cta-boxed-wrapper<?php echo esc_attr( $className ); ?>">
            <?php 
                echo wpautop( $settings['content'] );

                if( $settings['layout'] === 'layout_2' && $settings['cta_image']['url'] ){
                    echo'<div class="cta-image"><img src="'.esc_url( $settings['cta_image']['url'] ).'" /></div>';
                }else{
                    echo'
                    <a class="btn filled__btn" '.$this->get_render_attribute_string( 'website_link' ).'>'.esc_html( $settings['button_title'] ).'</a>
                    ';
                }
            ?>
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
