<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'isbs' ); ?></a>
    <header id="masthead" class="header-area">
        <nav class="navbar navbar-expand-lg px-md-4">
            <div class="container-fluid">
                <?php 
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    if ( has_custom_logo() ) {
                            echo '
                                <a class="navbar-brand" rel="home" href="'.esc_url( home_url( '/' ) ).'">
                                    <img src="' . esc_url( $logo[0] ) . '" class="img-fluid" alt="' . get_bloginfo( 'name' ) . '">
                                </a>
                            ';
                    } else {
                            echo '<h1><a rel="home" href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'">'. get_bloginfo( 'name' ) .'</a></h1>';
                    }

                ?>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown"
                    aria-expanded="false"
                    aria-label="<?php esc_attr_e( 'Toggle navigation', 'hello-elementor-child' ); ?>"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'menu-1',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id'    => 'navbarNavDropdown',
                            'menu_class'      => 'navbar-nav ms-auto mb-2 mb-lg-0',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-menu',
                            'depth'           => 2,
                            'walker'          => new Blackrockgp_WP_Bootstrap_Navwalker(),
                        )
                    );
                ?>
            </div>
        </nav>
    </header><!-- #masthead -->    