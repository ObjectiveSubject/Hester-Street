<?php
/**
 * The template for displaying the header.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    
    <header class="site-menu u-bg-black u-display-none">
        <div class="site-menu-content">
            <div class="flex u-container">
                <div class="flex has-sidebar">

                    <div class="sidebar">
                        <div class="masthead">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hsc-logo">
                                <span class="u-display-none"><?php bloginfo( 'name' ); ?></span>
                            </a>
                        </div>
                    </div>

                    <div class="menu">
                        <nav id="site-navigation" class="main-navigation" role="navigation">

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
                            
                        </nav>

                        <div class="tagline">
                            <?php bloginfo( 'description' ); ?>
                        </div>
                        
                    </div><!-- .menu -->
                </div>
            </div>
        </div>
	</header>
	
	<div id="page">
