<?php
/**
 * General page template
 */

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?>>
                
                <section class="page-section">
                   
                    <div class="section-row u-container">
                       
                        <div id="masthead" class="masthead section-column">
                            <a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hsc-logo">
                                <span class="u-display-none"><?php bloginfo( 'name' ); ?></span>
                            </a>
                        </div>
                      
                        <div class="section-content">
                            <div class="section-column">
                                <h1 class="page-title h2"><?php the_title(); ?></h1>
                                <div class="page-content u-max-width-9">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
               
                </section>
                
                <!-- Module -->
                <section class="page-section u-bg-red">
                    <div class="section-row u-container">
                        <div class="section-column">
                            <div class="module">
                                <div class="module__content">
                                    <div class="h2">Hester Street is an urban planning, design and community development nonprofit working so that neighborhoods are shaped by their people.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End of module -->

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
