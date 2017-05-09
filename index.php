<?php
/**
 * General page template
 */

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?>>
               
                <div class="wrap">
                
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
                                        <h1 class="h2 u-mt-pull">Base Content</h1>
                                        <ul class="list page-anchors">
                                            <li class="list__item">
                                                <a href="#">Anchor</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="page-content">
                                        
                                        <?php the_content(); ?>

                                        <?php get_template_part( 'content', 'base' ); ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
