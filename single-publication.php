<?php
/**
 * Single Publication
 */

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrap'); ?>>
               
                <section class="section">
                    <div class="flex has-sidebar u-container">

                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">

                                <div id="masthead" class="masthead is-sticky">
                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                                </div>

                            </div>

                            <div class="section__content flex__item">

                                <div class="page-header">
                                
                                    <div class="h2 u-mt-pull"><?php _e( 'Publications', 'hsc' ); ?></div>

                                    <h1 class="post-title u-mt-3">
                                        <?php the_title(); ?>
                                    </h1>

                                    <h2 class="h3 u-mt-nudge"><?php the_date(); ?></h2>

                                        <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="post-image u-mt-3">
                                            <?php the_post_thumbnail(); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <div class="post-content u-mt-2">
                                    <?php the_content(); ?>
                                </div>

                            </div>

                    </div><!-- .u-container -->
                </section>
                    
			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
