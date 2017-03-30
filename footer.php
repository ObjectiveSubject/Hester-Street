<?php
/**
 * The template for displaying the footer.
 */
?>

	<footer class="site-footer footer" role="contentinfo">
        <div class="u-container">
            <div class="footer-row has-sidebar">

                <div class="sidebar column footer-column">

                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                </div>

                <div class="footer-content">
                   
                    <nav class="footer-nav footer-column">

                        <?php
                        $menu_primary   = false;
                        $menu_secondary = false;
                        if ( has_nav_menu( 'footer-primary' ) ) {
                            $menu_primary = wp_nav_menu(array(
                                'theme_location' => 'footer-primary',
                                'container'		 => false,
                                'menu_class'	 => 'primary-menu footer-primary-menu',
                                'menu_id'		 => 'footer-primary-menu',
                                'echo'			 => false
                            ));
                            echo $menu_primary;
                        }
                        if ( has_nav_menu( 'footer-secondary' ) ) {
                            $menu_secondary = wp_nav_menu(array(
                                'theme_location' => 'footer-secondary',
                                'container'		 => false,
                                'menu_class'	 => 'secondary-menu footer-secondary-menu',
                                'menu_id'		 => 'footer-secondary-menu',
                                'echo'			 => false
                            ));
                            echo $menu_secondary;
                        }
                        ?>

                        <!-- social media -->

                    </nav>

                    <div id="colophon" class="footer-colophon footer-column">
                        Hester Street is an urban planning, design and community development nonprofit working so that neighborhoods are shaped by their people.
                        <address class="u-mt-6">
                            <span class="h6 u-display-block">113 Hester Street</span>
                            <span class="h6 u-display-block">New York, NY 10002</span>
                        </address>
                    </div>

                </div><!-- .footer-content -->

            </div><!-- .footer-row -->
        </div>
	</footer>

</div><!-- #page -->

<span class="media-size"></span>

<?php wp_footer(); ?>

</body>
</html>
