<?php
/**
 * Single Post template
 */

global $post;
$alt_title = get_field( 'project_alt_title' );
$subtitle = get_field( 'project_subtitle' );
$begin_date = get_field( 'project_begin_date' );
$end_date = get_field( 'project_end_date' );
$date_string = array();
if ( $begin_date ) $date_string[] = date( 'Y', $begin_date );
$date_string[] = ( $end_date ) ? date( 'Y', $end_date ) : 'Present';

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrap'); ?>>               
                
                <section class="section">
                    <div class="flex has-sidebar u-container">

                        <?php get_template_part( 'partials/menu-ui' ); ?>

                        <div class="sidebar-masthead section__sidebar flex__item">
                            <?php get_template_part( 'partials/masthead' ); ?>
                        </div>

                        <div class="section__content flex__item">

                            <div class="page-header">
                            
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-image">
                                        <?php the_post_thumbnail('large'); ?>
                                    </div>
                                <?php endif; ?>

                                <h1 class="post-title <?php echo ( has_post_thumbnail() ) ? 'u-mt-3' : 'u-mt-pull'; ?>">
                                    <?php 
                                    if ( $alt_title ) {
                                        echo apply_filters( 'the_title', $alt_title );
                                    } else {
                                        the_title();
                                    } ?>
                                </h1>

                                <?php if ( $subtitle || $begin_date || $end_date ) : ?>
                                    <p class="h6">
                                        <?php echo $subtitle ? '<span class="u-pr-1">'.$subtitle.'</span>' : ''; ?>
                                        <span><?php echo implode( '–', $date_string ); ?></span>
                                    </p>
                                <?php endif; ?>

                            </div>

                        </div>
                        
                    </div>
                </section>

                <section class="section">
                    <div id="page-map"></div>
                    <script type="text/json" id="map-geojson">
                    
                        <?php 
                        $project_geojson_file = get_field('project_geojson_file');
                        if ( $project_geojson_file ) {
                            echo file_get_contents( $project_geojson_file['url'] );
                        } else {
                            echo get_field('project_geojson');
                        }
                        ?>
                        
                    </script>

                </section>
                
                <section class="section">
                    <div class="flex has-sidebar u-container">

                            <div class="sidebar-masthead section__sidebar flex__item u-pt-6">
                                &nbsp;
                            </div>

                            <div class="section__content flex__item u-pt-6">                                    

                                <div class="clearfix">
                                    <div class="project-content post-content">
                                        <div class="h6 u-mt-0">Description</div>
                                        <?php the_content(); ?>
                                    </div>
                                    <div class="project-sidebar">
                                        <?php get_sidebar( 'project' ); ?>
                                    </div>
                                </div>

                            </div>

                    </div><!-- .u-container -->
                </section>

                <?php if ( have_rows('timeline_items') ) : ?>

                <!--Related Events-->
                <section class="section">
                    <div class="flex u-container">

                        <div class="section__content flex__item u-width-12">
                            
                            <!--Vue JS App-->
                            <div id="project-timeline" class="vue-js-app u-clearfix u-mt-6" :class="appClass">

                                <div class="h5"><?php _e( 'Project Timeline', 'hsc' ); ?></div>

                                <div v-if="loading" class="h6 u-mt-3 u-animate-pulse">Loading...</div>

                                <div v-if=" ! visibleTimelineItems.length && ! loading" class="error u-mt-3">
                                    <h3 class="u-mt-0">Sorry, no projects were found.</h3>
                                </div>

                                <div class="project-timeline__contents u-mt-6">

                                    <!-- project-timeline__sidebar-wrap -->
                                    <div class="project-timeline__sidebar-wrap">
                                        <ul class="project-timeline__sidebar u-mt-0">
                                            <li v-for="item in visibleTimelineItems" class="project-timeline__sidebar-item">
                                                <a :href="'#' + item.id" class="u-display-block h6 u-mt-0 u-mb-1">
                                                    <span v-html="item.label"></span><br/>
                                                    <span style="opacity:0.5">
                                                        {{ item.date_string }}
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="project-timeline__nodes">

                                        <article :id="item.id" v-for="item in visibleTimelineItems" :key="item.id" class="timeline-node">

                                            <!-- LAYOUT: Project Stage -->
                                            <div v-if="item.layout == 'project_stage'" class="layout-project-stage u-clearfix" v-html="item.content"></div>

                                            <!-- LAYOUT: Publication -->
                                            <div v-if="item.type == 'publication'" class="layout-publication u-clearfix">
                                                <h3 class="h4 u-mt-0">{{ item.title }}</h3>
                                                <p v-html="item.image"></p>
                                                <p><a :href="link.url" class="u-mr-1 u-color-black u-color-hover-green" v-for="link in item.links" v-html="link.text"></a></p>
                                            </div>

                                            <!-- LAYOUT: Event -->
                                            <div v-if="item.type == 'event'" class="layout-event u-clearfix">
                                                <a :href="item.permalink" class="u-display-block u-color-hover-green">
                                                    <div class="image" v-html="item.image"></div>
                                                    <div class="content">
                                                        <h3 class="title h1">{{ item.title }}</h3>
                                                        <p class="h6 u-mt-nudge">
                                                            {{ item.date_string }}, {{ item.time_string }}<br/>
                                                            {{ item.venue }}
                                                        </p>
                                                        <p><?php _e( 'Read more', 'hsc' ); echo ' &rarr;' ?></p>
                                                    </div>
                                                </a>
                                            </div>

                                            <!-- LAYOUT: Events Recap -->
                                            <div v-if="item.type == 'events_recap'" class="layout-events-recap">
                                                <ul class="u-mt-0" v-if="item.events.length">
                                                    <li v-for="event in item.events" class="u-mb-1">
                                                        <a :href="event.permalink" class="u-display-block u-clearfix u-color-hover-green ">
                                                            <div class="image" v-html="event.image"></div>
                                                            <div class="content">
                                                                <p class="h5 u-mt-0">
                                                                    {{event.post_title}}<br/>
                                                                    {{event.date_string}}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <h3 class="h1 u-mt-0">{{ item.title }}</h3>
                                                <div v-html="item.desc"></div>
                                            </div>

                                        </article>
                                        
                                    </div><!-- .project-timeline__nodes -->
                                    
                                </div><!-- project-timeline__contents -->

                            </div><!-- #project-timeline -->

                        </div>

                    </div><!-- .u-container -->
                </section>

                <?php endif; ?>


                <?php 

                // Related Publications

                $args = array(
                    'post_type' => 'publication',
                    'posts_per_page' => 10,
                    'meta_query' => array(
                        array(
                            'key' => 'publication_related_projects',
                            'value' => strval($post->ID),
                            'compare' => 'LIKE'
                        )
                    )
                );
                $publications = new WP_Query( $args ); ?>

                <?php if ( $publications->have_posts() ) : ?>
                
                    <section class="section">
                        <div class="flex u-container">
                            <div class="section__content flex__item u-width-12 u-pt-6">
                                
                                <div class="h6 u-mt-0"><?php _e( 'Related Publications', 'hsc' ); ?></div>

                                <ul class="u-clearfix u-mt-0">
                                    <?php while( $publications->have_posts() ) : $publications->the_post(); ?>
                                        <li class="u-span-6 u-mt-1">
                                            <?php get_template_part( 'partials/content-preview', 'publication' ); ?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>

                            </div>
                        </div><!-- .u-container -->
                    </section>

                <?php endif; ?>
                

                <?php 

                // Related Projects

                $args = array(
                    'post_type' => 'project',
                    'posts_per_page' => 2,
                    'post__not_in' => array( $post->ID )
                );
                $related_project_ids = get_field('project_related_projects');
                $projects_title = __( 'Recent Projects', 'hsc');
                if ( ! empty( $related_project_ids ) ) {
                    $args['post__in'] = $related_project_ids;   
                    $projects_title = __( 'Related Projects', 'hsc');
                } 
                $projects = new WP_Query( $args ); ?>

                <?php if ( $projects->have_posts() ) : ?>
                    
                    <section class="section">
                        <div class="flex u-container">
                            <div class="section__content flex__item u-width-12 u-pt-6">
                                
                                <div class="h6 u-mt-0"><?php echo $projects_title; ?></div>

                                <ul class="u-clearfix">
                                    <?php while( $projects->have_posts() ) : $projects->the_post(); ?>
                                        <li class="u-span-6">
                                            <?php get_template_part( 'partials/content-preview', 'project' ); ?>
                                        </li>
                                    <?php endwhile; wp_reset_query(); ?>
                                    </ul>                                

                            </div>
                        </div><!-- .u-container -->
                    </section>

                <?php endif; ?>
                
			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
