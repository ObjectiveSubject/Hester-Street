<?php
/**
 * Archive template
 */
get_header();
$queried_object = get_queried_object();
?>

	<div class="site-content">

			<article <?php post_class(); ?>>
               
                <div class="wrap">
                    
                    <section class="section">
                        <div class="flex has-sidebar u-container">
                            
                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">

                                <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                            </div>

                            <div class="section__content flex__item">
                                
                                <h1 class="page-title h2 u-mt-pull">
                                    <span class="u-color-dark-gray">
                                        <? if ( is_post_type_archive() ) {
                                            post_type_archive_title(); 
                                        } else {
                                            the_archive_title();
                                        } ?>
                                    </span>
                                </h1>

                                <?php get_template_part( 'partials/filters', $queried_object->name ); ?>

                            </div> <!-- .section__content -->

                        </div><!-- .u-container -->
                    </section>

                    <section class="section">
                        <div class="flex u-container">

                            <div class="section__content u-width-12 flex__item">
                                
                                <?php if ( have_posts() ) : ?>

                                    <?php if ( 1 < get_query_var('paged') ) : ?>
                                    <div class="posts-pagination">
                                        <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
                                        <hr>
                                    </div>
                                <?php endif; ?>

                                <div class="u-clearfix">

                                    <?php while ( have_posts() ) : the_post();
                                        $post_type = get_post_type();
                                        $post_class = array( 'u-span-4 u-mt-4 preview' ); ?>
                                        
                                        <article <?php post_class( implode( ' ', $post_class ) ); ?>>
                                            <?php get_template_part( 'partials/content-preview', $post_type ); ?>
                                        </article>
                                        
                                    <?php endwhile; ?>

                                </div>

                                <hr class="u-mt-4"/>

                                <div class="posts-pagination u-pt-1">
                                    <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
                                </div>

                                <?php endif; ?>

                            </div> <!-- .section__content -->

                        </div><!-- .u-container -->
                    </section>
                    
                </div>

			</article>

	</div>



<?php get_footer();