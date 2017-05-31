<?php
/**
 * Single Post template
 */

get_header();

global $post;
$cats = get_the_terms( $post, 'category' );
$cat = ( ! empty( $cats ) ) ? $cats[0]->name : 'News';
$post_datetime = get_field( 'post_datetime' );
$post_datetime = ( $post_datetime ) ? $post_datetime : strtotime( $post->post_date ); ?>

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
                                    <div class="h2 u-mt-pull"><?php echo $cat; ?></div>
                                </div>
                                
                                <h1 class="post-title u-mt-3">
                                    <?php the_title(); ?>
                                </h1>

                                <h2 class="h3 u-mt-nudge"><?php echo date( get_option( 'date_format' ), $post_datetime ); ?></h2>

                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-image u-mt-3">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="post-content u-mt-2">
                                    <?php the_content(); ?>
                                </div>

                            </div>

                    </div><!-- .u-container -->
                </section>

                <!--Related Posts-->
                <?php 
                $args = array(
                    'posts_per_page' => 2,
                    'post__not_in' => array( $post->ID ),
                );
                $recent = new WP_Query( $args ); ?>

                <?php if ( $recent->have_posts() ) : ?>
                
                    <section class="section">
                        <div class="flex u-container">
                            <div class="section__content flex__item u-width-12">
                                
                                <div class="h6 u-mt-0"><?php _e( 'Recent News', 'hsc' ); ?></div>

                                <ul class="u-clearfix">
                                    <?php while( $recent->have_posts() ) : $recent->the_post(); ?>
                                        <li class="u-span-6">
                                            <?php get_template_part( 'partials/content-preview', 'post' ) ?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>

                            </div>
                        </div><!-- .u-container -->
                    </section>

                <?php endif; ?>                

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
