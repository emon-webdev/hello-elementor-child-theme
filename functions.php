<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	
	wp_enqueue_style( 'museo-sans-css', get_stylesheet_directory_uri() . '/assets/css/museo-sans-cyrl-fonts.css', array(), HELLO_ELEMENTOR_CHILD_VERSION );
	wp_enqueue_style( 'land-owl-carousel-style', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.3.4', 'all' );
	wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(), HELLO_ELEMENTOR_CHILD_VERSION );
	wp_enqueue_style( 'hello-elementor-child-style', get_stylesheet_directory_uri() . '/style.css', [ 'hello-elementor-theme-style' ], HELLO_ELEMENTOR_CHILD_VERSION );
	wp_enqueue_style( 'hello-theme-style', get_stylesheet_directory_uri() . '/assets/css/theme-style.css', array(), HELLO_ELEMENTOR_CHILD_VERSION );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'land-owl-carousel-js', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '2.3.4', true );
	wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), HELLO_ELEMENTOR_CHILD_VERSION, true );
	wp_enqueue_script( 'active-js', get_stylesheet_directory_uri() . '/assets/js/active.js', array(), HELLO_ELEMENTOR_CHILD_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hello_elementor_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'hello-elementor-child' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'hello-elementor-child' ),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Emergencies Text Number', 'hello-elementor-child' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'hello-elementor-child' ),
			'before_widget' => '<div id="%1$s" class="widget site-info text-center %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" style="display:none">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Copyright', 'hello-elementor-child' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'hello-elementor-child' ),
			'before_widget' => '<div id="%1$s" class="widget site-info text-center %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title" style="display:none">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'hello_elementor_widgets_init' );



if ( ! function_exists( 'hello_elementor_widget_classes' ) ) {
	
	function hello_elementor_widget_classes( $params ) {

		global $sidebars_widgets;

		/*
		 * When the corresponding filter is evaluated on the front end
		 * this takes into account that there might have been made other changes.
		 */
		$sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets );

		// Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
		if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
			$sidebar_id   = $params[0]['id'];
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );

			$widget_classes = 'widget-count-' . $widget_count;
			if ( 0 === $widget_count % 4 || $widget_count > 6 ) {
				// Four widgets per row if there are exactly four or more than six.
				$widget_classes .= ' col-md-3';
			} elseif ( 6 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-2';
			} elseif ( $widget_count >= 3 ) {
				// Three widgets per row if there's three or more widgets.
				$widget_classes .= ' col-md-4';
			} elseif ( 2 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-6';
			} elseif ( 1 === $widget_count ) {
				// If just on widget is active.
				$widget_classes .= ' col-md-12';
			}

			// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
			$params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
		}

		return $params;

	}
}
add_filter( 'dynamic_sidebar_params', 'hello_elementor_widget_classes' );


add_filter('use_block_editor_for_post', '__return_false');

// Disable Gutenberg for widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );


require_once( __DIR__ . '/inc/class-wp-bootstrap-navwalker.php' );
require_once( __DIR__ . '/inc/blackrockgp-elementor-addons/blackrock-addons-function.php' );
require_once( __DIR__ . '/inc/kirki_customizer.php' );

/* require get_stylesheet_directory() . '/inc/santrygp-elementor-addons/santry-addons-function.php';
require get_stylesheet_directory() . '/inc/kirki_customizer.php'; */




