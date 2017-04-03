<?php
/**
 * General page template
 */

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?>>
                
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-sidebar">
                            
                            <div class="sidebar sidebar-masthead">

                                <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                            
                            </div>
                            
                            <div class="content">
                                   
                                <?php if ( get_the_post_thumbnail( $post_id ) ) : ?>
                                   
                                <div class="post-image" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post_id ); ?>);"></div>
                                
                                <?php endif; ?>

                                <div class="section-content">

                                    <div class="post-title u-mb-4">
                                        <h1><?php the_title(); ?></h1>
                                    </div>

                                    <div class="post-content">

                                        <div class="post-entry">
                                            <?php the_content(); ?>
                                        </div>

                                    </div>

                                </div> <!-- .section-content -->

                            </div><!-- .content -->

                        </div>
                    </div><!-- .u-container -->
                </section>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
