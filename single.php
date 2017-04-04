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

                                <div class="sidebar-masthead section__sidebar flex__item">

                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                                </div>

                                <div class="section__content flex__item">

                                    <?php if ( get_the_post_thumbnail( $post_id ) ) : ?>

                                    <div class="post-image" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post_id ); ?>);"></div>

                                    <?php endif; ?>
                                    
                                    <h1 class="post-title">
                                        <?php the_title(); ?>
                                    </h1>

                                    <div class="post-content">
                                        <?php the_content(); ?>
                                    </div>

                                </div>

                            </div><!-- .flex -->
                        </div><!-- .u-container -->
                    </section>
                    
                </div>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
