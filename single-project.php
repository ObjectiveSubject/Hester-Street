<?php
/**
 * Single Post template
 */

global $post;
get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?>>
               
                <div class="wrap">
                    
                    <section class="section">
                        <div class="flex has-sidebar u-container">

                                <?php get_template_part( 'partials/menu-ui' ); ?>

                                <div class="sidebar-masthead section__sidebar flex__item">

                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                                </div>

                                <div class="section__content flex__item">
                                    
                                    <div class="h2 u-mt-pull"><?php _e( 'News', 'hsc' ); ?></div>

                                    <h1 class="post-title u-mt-3">
                                        <?php the_title(); ?>
                                    </h1>

                                    <h2 class="h3 u-mt-0"><?php the_date(); ?></h2>

                                     <?php if ( get_the_post_thumbnail() ) : ?>
                                        <div class="post-image u-mt-3" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
                                    <?php endif; ?>

                                    <div class="post-content u-mt-2">
                                        <?php the_content(); ?>
                                    </div>

                                </div>

                        </div><!-- .u-container -->
                    </section>

                    <!--Related Posts-->
                    <section class="section">
                        <div class="flex u-container">

                            <div class="section__content flex__item u-width-12">
                                
                                <pre><?php var_dump( get_post_meta( $post->ID, 'project_events', true ) ); ?></pre>

                            </div>

                        </div><!-- .u-container -->
                    </section>
                    
                </div>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
