<?php
/**
 * Single Event template
 */

global $post;
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

                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                                </div>

                                <div class="section__content flex__item">
                                    
                                    <div class="h2 u-mt-pull"><?php _e( 'Event', 'hsc' ); ?></div>

                                    <h1 class="post-title u-mt-3">
                                        <?php the_title(); ?>
                                    </h1>

                                    <h2 class="h3 u-mt-0">
                                        <?php the_date(); ?>, 7:00pm<br/>
                                        PS. 101 Auditorium
                                    </h2>

                                     <?php if ( get_the_post_thumbnail() ) : ?>
                                        <div class="post-image u-mt-3" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
                                    <?php endif; ?>

                                    <div class="post-content u-mt-2">
                                        <?php the_content(); ?>
                                    </div>

                                </div>

                            </div><!-- .flex -->
                        </div><!-- .u-container -->
                    </section>

                    <!--Related Posts-->

                    <?php 
                    $args = array(
                        'post_type' => 'project',
                        'posts_per_page' => 2,
                        'meta_query' => array(
                            array(
                                'key' => 'project_events',
                                'value' => strval($post->ID),
                                'compare' => 'LIKE'
                            )
                        )
                    );
                    $projects = new WP_Query( $args ); ?>

                    <?php if ( $projects->have_posts() ) : ?>
                        
                        <section class="section">
                            <div class="flex u-container">
                                <div class="section__content flex__item u-width-12">
                                    
                                    <div class="h6 u-mt-0"><?php _e( 'Related Projects', 'hsc' ); ?></div>

                                    <ul class="u-clearfix">
                                        <?php while( $projects->have_posts() ) : $projects->the_post(); ?>
                                            <li class="u-span-6">
                                                <a href="<?php the_permalink(); ?>" class="u-display-block">
                                                    <?php if ( get_the_post_thumbnail() ) : ?>
                                                        <div class="post-image" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
                                                    <?php endif; ?>
                                                    <h3 class="h5 u-max-width-6"><?php the_title(); ?></h3>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                        </ul>                                

                                </div>
                            </div><!-- .u-container -->
                        </section>

                    <?php endif; ?>
                    
                </div>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
