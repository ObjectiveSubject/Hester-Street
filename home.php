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

                                    <h1 class="page-title h2 u-mt-pull"><? echo get_the_title( $page_for_posts ); ?></h1> 
                                    
                                    <ul class="filter-toggle-list list">
                                        <li class="filter-toggle-list__item list__item">
                                            <a href="#filter-group-post-type" data-target="#filter-group-post-type" class="filter-group-toggle is-active js-fade-toggle">Post Type</a>
                                        </li>
                                        <li class="filter-toggle-list__item list__item">
                                            <a href="#filter-group-date" data-target="#filter-group-date" class="filter-group-toggle js-fade-toggle">Date</a>
                                        </li>
                                    </ul>

                                    <div class="filter-groups u-mt-4">

                                        <ul id="filter-group-post-type" class="filter-group is-active list">
                                            <li class="list__item">
                                                <a href="#" class="filter-group__item">Event</a>
                                            </li>
                                            <li class="list__item">
                                                <a href="#" class="filter-group__item">Newsletter</a>
                                            </li>
                                            <li class="list__item">
                                                <a href="#" class="filter-group__item">Press</a>
                                            </li>
                                            <li class="list__item">
                                                <a href="#" class="filter-group__item">News</a>
                                            </li>
                                        </ul>

                                        <ul id="filter-group-date" class="filter-group list">
                                            <li class="filter-group__item list__item">
                                                <a href="#">Upcoming</a>
                                            </li>
                                            <li class="filter-group__item list__item">
                                                <a href="#">Last Month</a>
                                            </li>
                                            <li class="filter-group__item list__item">
                                                <a href="#">Last 3 Months</a>
                                            </li>
                                            <li class="filter-group__item list__item">
                                                <a href="#">Last 6 Months</a>
                                            </li>
                                            <li class="filter-group__item list__item">
                                                <a href="#">Last Year</a>
                                            </li>
                                            <li class="filter-group__item list__item">
                                                <a href="#">Last 3 Years</a>
                                            </li>
                                        </ul>

                                    </div>
                                    
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