<?php
namespace Blackrockgp_Elemntor_Addons;

// Elementor plugin is active
if (in_array('elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    // Register New Category
    function blackrockgp_widget_add_category($elements_manager) {
        $categories = [];
        $categories = [
            'blackrockgp' => [
                'title' => 'Blackrock GP',
                'icon' => 'eicon-plug',
            ]
        ];

        $old_categories = $elements_manager->get_categories();
		$categories = array_merge($categories, $old_categories);
    
        $set_categories = function($categories) {
			$this->categories = $categories;
		};
	
		$set_categories->call($elements_manager, $categories);
    }
    add_action('elementor/elements/categories_registered', 'Blackrockgp_Elemntor_Addons\blackrockgp_widget_add_category', 5);
    
    // All Addons Register 
    function blackrockgp_addons_register_widget($widgets_manager) {
        //require_once( __DIR__ . '/widgets/Hello-World.php' ); // Correct the filename to match your class
        require_once( __DIR__ . '/widgets/blackrockgp-wlc-hero.php' ); 
        require_once( __DIR__ . '/widgets/blackrockgp-icon-boxed.php' ); 
        require_once( __DIR__ . '/widgets/blackrockgp-button.php' ); 
        require_once( __DIR__ . '/widgets/blackrockgp-featured-image.php' ); 
       /*  require_once( __DIR__ . '/addons/land-wlc-hero.php' );
        require_once( __DIR__ . '/addons/land-featured-service.php' );
        require_once( __DIR__ . '/addons/land-cta.php' );
        require_once( __DIR__ . '/addons/land-testimonial-slider.php' );
        require_once( __DIR__ . '/addons/land-section-title.php' ); */

        //$widgets_manager->register_widget_type(new \Blackrockgp_Elemntor_Addons\Widgets\Hello_World()); 
        $widgets_manager->register_widget_type(new \Blackrockgp_Elemntor_Addons\Widgets\Blackrockgp_Wlc_Hero()); 
        $widgets_manager->register_widget_type(new \Blackrockgp_Elemntor_Addons\Widgets\Blackrockgp_Icon_Boxed()); 
        $widgets_manager->register_widget_type(new \Blackrockgp_Elemntor_Addons\Widgets\Blackrockgp_Button()); 
        $widgets_manager->register_widget_type(new \Blackrockgp_Elemntor_Addons\Widgets\Blackrockgp_Featured_Image()); 
/*         $widgets_manager->register_widget_type(new \My_Elemntor_Addons\Addons\Land_Wlc_Hero()); 
        $widgets_manager->register_widget_type(new \My_Elemntor_Addons\Addons\Land_Featured_Service()); 
        $widgets_manager->register_widget_type(new \My_Elemntor_Addons\Addons\Land_CTA()); 
        $widgets_manager->register_widget_type(new \My_Elemntor_Addons\Addons\Land_Testimonial_Slider()); 
        $widgets_manager->register_widget_type(new \My_Elemntor_Addons\Addons\Land_Section_Title());  */
    }
    add_action('elementor/widgets/widgets_registered', 'Blackrockgp_Elemntor_Addons\blackrockgp_addons_register_widget');
    

} else {
    // Elementor plugin is not active
    function blackrockgp_addons_admin_notice() {
        ?>
        <div class="notice notice-error">
            <p>Please activate the Elementor plugin to use this feature.</p>
        </div>
        <?php
    }
    add_action('admin_notices', 'Blackrockgp_Elemntor_Addons\blackrockgp_addons_admin_notice');
}
