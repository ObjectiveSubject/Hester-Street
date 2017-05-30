<?php
/**
 * Single Event template
 */

global $post;

$begin_datetime = get_field( 'post_datetime' );
$begin_string = date( get_option('date_format') . ', g:ia', $begin_datetime );
$end_datetime = get_field( 'post_datetime_end' );
if ( $end_datetime ) {
    if ( date('M j, Y', $begin_datetime) == date('M j, Y', $end_datetime) ) {
        $end_string = date('g:ia', $end_datetime);
    } else {
        $end_string = date( get_option('date_format') . ', g:ia', $end_datetime );
    }
    $date_string = $begin_string . ' - ' . $end_string;
} else {
    $date_string = $begin_string;
}


get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrap'); ?>>            
                
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-sidebar">

                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">

                                <div id="masthead" class="masthead">
                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                                </div>

                            </div>

                            <div class="section__content flex__item">
                                <div class="page-header">
                                    <div class="h2 u-mt-pull"><?php _e( 'Event', 'hsc' ); ?></div>
                                </div>
                            </div>

                        </div><!-- .flex -->
                    </div><!-- .u-container -->
                </section>

                <section class="section">
                    <div class="u-container">
                        <div class="flex">

                            <div class="section__content flex__item u-max-width-8">
                                
                                <h1 class="post-title">
                                    <?php the_title(); ?>
                                </h1>

                                <h2 class="h5 u-mt-nudge">
                                    <?php echo $date_string; ?><br/>
                                    <?php the_field('event_venue'); ?>
                                </h2>

                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-image u-mt-3">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
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
                            <div class="section__content flex__item u-width-12 u-pt-6">
                                
                                <div class="h6 u-mt-0"><?php _e( 'Related Projects', 'hsc' ); ?></div>

                                <ul class="u-clearfix">
                                    <?php while( $projects->have_posts() ) : $projects->the_post(); ?>
                                        <li class="u-span-6">
                                            <?php get_template_part( 'partials/content-preview', 'project' ); ?>
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
