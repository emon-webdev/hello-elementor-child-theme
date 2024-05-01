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
class Land_Featured_Service extends Widget_Base {

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
        return 'featured-service';
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
        return __( 'Featured Service', 'hello-elementor-child' );
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
					'layout_1'  => esc_html__( 'Layout 1', 'hello-elementor-child' ),
					'layout_2' => esc_html__( 'Layout 2', 'hello-elementor-child' ),
					'layout_3' => esc_html__( 'Layout 3', 'hello-elementor-child' ),
				]
			]
		);

        $this->add_control(
			'number',
			[
				'label' => esc_html__( 'Number', 'hello-elementor-child' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '1', 'textdomain' ),
				'placeholder' => esc_html__( 'Type your number here', 'hello-elementor-child' ),
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
						[
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_2',
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
            'icon_image',
            [
                'label' => esc_html__( 'Icon Image', 'hello-elementor-child' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
						[
                            'name' => 'layout',
                            'operator' => '===',
                            'value' => 'layout_1',
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
            'title',
            [
                'label' => __( 'Title', 'hello-elementor-child' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Simple & Fast Start:', 'hello-elementor-child' ),
                'label_block' => true,
                'conditions' => [
                    'terms' => [
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
                'default' => esc_html__( 'Get started with just 2 hours of easy-to-follow training.', 'hello-elementor-child' ),
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

        if( $settings['layout'] === 'layout_3' ){
            $className = ' featured-wraper-list';
        }elseif( $settings['layout'] === 'layout_2' ){
            $className = ' featured-wraper-crave';
        }else{
            $className = '';
        }

        ?>

        <div class="featured-service-wraper<?php echo esc_attr( $className ); ?>">
            <?php 
                if( $settings['layout'] === 'layout_1' && !empty( $settings['icon_image']['url'] ) ){
                    echo '
                    <div class="icon">
                        <img src="' . esc_url( $settings['icon_image']['url'] ) . '" />
                    </div>
                    ';
                }
                
                if( $settings['layout'] === 'layout_2' || $settings['layout'] === 'layout_3' ){
                    echo '
                    <div class="number">
                        <h2>'.esc_html( $settings['number'] ).'</h2>
                    </div>
                    ';
                }
            ?>
            
            <div class="featured-service-content">
                <?php
                    if( $settings['layout'] === 'layout_1' || $settings['layout'] === 'layout_2' ){
                        echo '<h5>'.$settings['title'].'</h5>';
                    }
                ?>
                <?php echo wpautop( $settings['content'] ); ?>
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
            if( settings.layout === 'layout_3' ){
                className = 'featured-wraper-list';
            }else if( settings.layout === 'layout_2' ){
                className = 'featured-wraper-crave';
            }else{
                className = '';
            }
        #>

        <div class="featured-service-wraper {{className}}">
            <# if ( settings.layout === 'layout_1' && settings.icon_image.url ) { #> 
                <div class="icon">
                    <img src="{{{ settings.icon_image.url }}}" />
                </div>
            <# } #>  
              
            <# if ( settings.layout === 'layout_2' || settings.layout === 'layout_3' ) { #> 
                <div class="number">
                    <h2>{{{ settings.number }}}</h2>
                </div>
            <# } #> 
            
            <div class="featured-service-content">
                <# if ( settings.layout === 'layout_1' || settings.layout === 'layout_2' ) { #> 
                    <h5>{{{ settings.title }}}</h5>
                <# } #>     
                <p>{{{ settings.content }}}</p>
            </div>
        </div>

        <?php
    }
}
