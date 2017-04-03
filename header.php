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
                            <a id="logo" class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <svg class="hsc-logo" viewBox="0 0 1140 400">
                                    <g fill-rule="evenodd">
                                        <polygon points="136.9 329.9 98.2 329.9 98.2 215.9 39.3 215.9 39.3 329.9 0.6 329.9 0.6 68.4 39.3 68.4 39.3 182.4 98.2 182.4 98.2 68.4 136.9 68.4 136.9 329.9"></polygon>
                                        <polygon points="279.4 296.3 279.4 329.9 167.8 329.9 167.8 68.4 276.8 68.4 276.8 102 206.4 102 206.4 182.4 270.9 182.4 270.9 216 206.4 216 206.4 296.4 279.4 296.4"></polygon>
                                        <path d="M299.1,266.5 L299.1,244.8 L338.1,244.8 L338.5,264 C338.5,290.9 347.3,304.9 365.8,304.9 C383.1,304.9 391.2,292.7 391.2,273.2 L391.2,263.6 C391.2,243 388.6,232.7 368.4,219.4 L337,199.5 C310.8,182.6 301.6,163 301.6,136.1 L301.6,122.8 C301.6,84.9 327,62 365.7,62 C407,62 430.5,80.1 430.5,126.1 L430.5,145.6 L391.8,144.8 L391.8,129.8 C391.8,105.5 383.7,93 365.6,93 C349.8,93 341.3,104.4 341.3,120.3 L341.3,132.8 C341.3,149.7 347.6,160.8 363,170.4 L395,191 C424.5,209.8 431.1,230 431.1,258.4 L431.1,272.4 C431.1,312.6 408.6,336.1 365.2,336.1 C322.6,336.2 299.1,311.5 299.1,266.5 Z"></path>
                                        <polygon points="588.7 102.2 537.9 102.2 537.9 329.9 500 329.9 500 102.2 448.8 102.2 448.8 68.3 588.8 68.3"></polygon>
                                        <polygon points="726.1 296.3 726.1 329.9 614.4 329.9 614.4 68.4 726 68.4 726 102 653.1 102 653.1 179.3 717.6 179.3 717.6 212.9 653.1 212.9 653.1 296.4 726.1 296.4"></polygon>
                                        <path d="M818.1,210.2 L795.6,210.2 L795.7,329.9 L757,329.9 L757,68.4 L818.5,68.4 C866.4,68.4 885.9,92.7 886.3,135.4 L886.3,150.1 C886.3,182.5 874,202.1 853.8,210.9 L893,329.9 L852.1,329.9 L818.1,210.2 Z M816.3,179.4 C838,179.4 846.5,176.6 846.5,146.7 L846.5,129.5 C846.5,99.7 838.1,96.6 815.9,96.6 L795.6,96.6 L795.6,179.3 L816.3,179.3 L816.3,179.4 L816.3,179.4 Z" id="Shape"></path>
                                        <path d="M996.9,234.3 C970.2,234.3 954.8,218.3 954.8,190.3 L954.8,174.2 L984.6,174.1 L984.6,188.8 C984.6,209.2 993.7,209.2 997.1,209.2 C999.9,209.2 1008.5,209.2 1008.5,194.1 L1008.5,188.5 C1008.5,177.5 1007.5,172.6 996.7,165.6 L978.5,154 C962.9,143.9 956.3,132 956.3,114.2 L956.3,106.5 C956.3,82.9 972.3,67.6 997.1,67.6 C1024.4,67.6 1038.3,81.3 1038.3,108.4 L1038.3,123.2 L1008.9,123.1 L1008.9,110.6 C1008.9,94.6 1002.6,92.5 997.1,92.5 C987.4,92.5 986.3,101.2 986.3,105 L986.3,112.3 C986.3,121 989.4,126.4 997.4,131.3 L1016.1,143.4 C1034.9,155.4 1038.7,168.9 1038.7,185.6 L1038.7,193.8 C1038.8,219.5 1023.5,234.3 996.9,234.3 Z"></path>
                                        <polygon points="1111.2 232.6 1082.2 232.6 1082.2 94.9 1052.3 94.9 1052.3 68.3 1140.7 68.3 1140.7 94.9 1111.1 94.9"></polygon>
                                        <rect x="0.6" y="0.6" width="1140.3" height="33.9"></rect>
                                        <rect x="0.6" y="363.8" width="1140.3" height="33.9"></rect>
                                    </g>
                                </svg>
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
