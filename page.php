<?php
/**
 * General page template
 */

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrap'); ?>>
                               
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-sidebar">

                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">

                                <div id="masthead" class="masthead is-sticky">
                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                                </div>

                            </div>

                            <div class="section__content flex__item">
                                <div class="page-title">
                                    <h1 class="h2 u-mt-pull"><?php the_title(); ?></h1>
                                    <?php get_template_part( 'partials/section-anchors' ); ?>
                                </div>
                                <div class="page-content u-mt-6 u-width-8-10">
                                    <?php the_content(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <?php get_template_part( 'partials/sections' ); ?>
                
			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
