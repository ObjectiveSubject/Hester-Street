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
    <?php hsc_open_graph_tags(); ?>
</head>

<?php
$body_class = array(); 
if ( is_single() || is_page() ) {
    array_push( $body_class, get_post_type() . '-' . $post->post_name );
} 
if ( is_tax() ) {
    array_push( $body_class, 'tax-archive' );
} ?>

<body <?php body_class( implode( ' ', $body_class ) ); ?>>
    


    <header class="site-menu" data-background="">
        <div class="site-menu-content">
            <div class="flex has-sidebar u-container">

                <?php get_template_part( 'partials/menu-ui' ); ?>

                <div class="section__sidebar flex__item">
                    <div class="masthead">
                        <a id="logo" class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/logo-hsc-white.svg'; ?>" alt="hsc logo"/>
                            <span class="u-display-none"><?php bloginfo( 'name' ); ?></span>
                        </a>
                    </div>
                </div>

                <div class="menu section__content flex__item">
                    <nav id="site-navigation" class="main-navigation" role="navigation">

                        <?php
                        $menu_primary   = false;
                        $menu_secondary = false;
                        if ( has_nav_menu( 'primary' ) ) {
                            $menu_primary = wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container'		 => false,
                                'menu_class'	 => 'primary-menu header-primary-menu',
                                'menu_id'		 => 'header-primary-menu',
                                'echo'			 => false
                            ));
                            echo $menu_primary;
                        }
                        if ( has_nav_menu( 'secondary' ) ) {
                            $menu_secondary = wp_nav_menu(array(
                                'theme_location' => 'secondary',
                                'container'		 => false,
                                'menu_class'	 => 'secondary-menu header-secondary-menu',
                                'menu_id'		 => 'header-secondary-menu',
                                'echo'			 => false
                            ));
                            echo $menu_secondary;
                        }
                        ?>
                        
                    </nav>

                    <!--<div class="h1 u-my-3 u-width-8-10">
                        <?php bloginfo( 'description' ); ?>
                    </div>-->
                    
                </div><!-- .menu -->
            
            </div>
        </div>
	</header>
	
	<div id="page">
