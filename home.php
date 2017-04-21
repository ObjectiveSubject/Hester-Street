<?php
/**
 * The posts page template
 */
get_header();
$page_for_posts = get_option( 'page_for_posts' )
?>

	<div class="site-content">

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

                                    <h1 class="page-title h2 u-mt-pull"><span class="u-color-dark-gray"><? echo get_the_title( $page_for_posts ); ?></span></h1> 
                                    
                                </div> <!-- .section__content -->

                            </div>
                        </div><!-- .u-container -->
                    </section>

                    <!--Posts-->

                    <section class="section">
                        <div class="flex u-container">

                            <div class="section__content flex__item">
                                
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
                                            $post_class = array( 'u-span-4 u-mt-4 preview' );
                                            if ( 'event' == $post_type ) {
                                                $now = time();
                                                $event_datetime = get_post_meta( $post->ID, 'post_datetime', true );
                                                $is_upcoming = $now < $event_datetime; 
                                                $is_past = $now >= $event_datetime;
                                                $post_class[] = ( $is_upcoming ) ? 'event-upcoming' : 'event-past';
                                            } ?>
                                            <article <?php post_class( implode( ' ', $post_class ) ); ?>>
                                                <?php get_template_part( 'partials/content', $post_type . '-preview' ); ?>
                                            </article>
                                            
                                        <?php endwhile; ?>

                                    </div>

                                    <div class="posts-pagination">
                                        <hr/>
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