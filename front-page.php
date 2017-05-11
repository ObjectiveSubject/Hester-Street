<?php
/**
 * Front Page
 */

$featured_post = get_field( 'featured_post' );
$badge_text = get_field( 'badge_text' );
get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrap'); ?>>

                <h1 class="u-display-none" role="presentation"><? echo bloginfo( 'name' ); ?></h1> 
                               
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-sidebar">

                            <div class="sidebar-masthead section__sidebar flex__item">

                                <div id="masthead" class="masthead is-sticky">
                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                                </div>

                            </div>

                            <div class="section__content flex__item">

                                <nav id="site-navigation" class="main-navigation u-mt-pull" role="navigation">

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

                                <div class="h1 u-mt-3 u-width-8-10"><? echo bloginfo( 'description' ); ?></div> 

                                <div class="featured-post u-mt-2">
                                    <?php if ( $featured_post ) {
                                        $type = get_post_type( $featured_post );
                                        $post = $featured_post;
                                        setup_postdata( $post );
                                        get_template_part( 'partials/content-feature', $type );
                                        wp_reset_postdata();
                                    } ?>

                                    <br/>

                                    <?php if ( $badge_text ) :
                                        $badge_link = get_field( 'badge_link' ); ?>
                                        <a href="<?php echo esc_url( $badge_link ); ?>" class="badge">
                                            <span class="badge-text"><?php echo esc_html( $badge_text ); ?></span>
                                        </a>
                                    <?php endif; ?>

                                </div>

                            </div><!-- .section__content -->

                        </div>
                    </div>
                </section>

                <?php get_template_part( 'partials/sections' ); ?>
                
			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
