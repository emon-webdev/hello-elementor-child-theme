
    <footer id="colophon" class="footer-area">
        <?php if( is_active_sidebar( 'sidebar-1' )  ) : ?>
            <div class="footer-top-area px-md-5">
                <div class="container-fluid">
                    <div class="row">
                        <?php dynamic_sidebar( 'sidebar-1' ); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>    

        <div class="footer-middle-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="emergency-number text-center">
                            <h4>
                                <?php
                                    if( is_active_sidebar( 'sidebar-2' ) ){
                                        dynamic_sidebar( 'sidebar-2' );
                                    }else{
                                        printf( esc_html__( 'For Life Threatening Emergencies - Call 999', 'hello-elementor-child' ) );
                                    }
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p class="text-center">
                            <?php
                                if( is_active_sidebar( 'sidebar-3' ) ){
                                    dynamic_sidebar( 'sidebar-3' );
                                }else{
                                    printf( esc_html__( '© 2024 Black Rock GP Practice', 'hello-elementor-child' ) );
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
