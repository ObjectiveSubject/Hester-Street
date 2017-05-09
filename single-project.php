<?php
/**
 * Single Post template
 */

global $post;
$alt_title = get_post_meta($post->ID, 'project_alt_title', true);
$subtitle = get_post_meta($post->ID, 'project_subtitle', true);
$begin_date = get_post_meta($post->ID, 'project_begin_date', true);
$end_date = get_post_meta($post->ID, 'project_end_date', true);
$date_string = array();
if ( $begin_date ) $date_string[] = date( 'Y', $begin_date );
$date_string[] = ( $end_date ) ? date( 'Y', $end_date ) : 'Present';
$services = get_the_terms( $post->ID, 'service' );
$issues = get_the_terms( $post->ID, 'issue' );
$team_members = get_post_meta( $post->ID, 'project_team_members', true );
$collaborators = get_post_meta( $post->ID, 'project_collaborators', true );
$partners = get_post_meta( $post->ID, 'project_partners', true );
$site = get_post_meta( $post->ID, 'project_site', true );
$site_url = get_post_meta( $post->ID, 'project_site_url', true );

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?>>
               
                <div class="wrap">
                    
                    <section class="section">
                        <div class="flex has-sidebar u-container">

                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">

                                <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                            </div>

                            <div class="section__content flex__item">
                                
                                <?php if ( get_the_post_thumbnail() ) : ?>
                                    <div class="post-image" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
                                <?php endif; ?>

                                <h1 class="post-title u-mt-3">
                                    <?php 
                                    if ( $alt_title ) {
                                        echo apply_filters( 'the_title', $alt_title );
                                    } else {
                                        the_title();
                                    } ?>
                                </h1>
                                <?php if ( $subtitle || $begin_date || $end_date ) : ?>
                                    <p class="h6">
                                        <?php echo $subtitle; ?>
                                        <span class="u-pl-1"><?php echo implode( '–', $date_string ); ?></span>
                                    </p>
                                <?php endif; ?>

                            </div>
                            
                        </div>
                    </section>

                    <section class="section">
                        <div id="map" style="height:350px;" data-geojson='<?php echo get_field('project_geojson') ?>'></div>
                    </section>

                    <section class="section">
                        <div class="flex has-sidebar u-container">

                                <div class="sidebar-masthead section__sidebar flex__item u-pt-6">
                                    &nbsp;
                                </div>

                                <div class="section__content flex__item u-pt-6">                                    

                                    <div class="clearfix">
                                        <div class="project-content">
                                            <div class="h6 u-mt-0">Description</div>
                                            <?php the_content(); ?>
                                        </div>
                                        <ul class="project-sidebar">
                                            
                                            <?php if ( $services ) : ?>
                                            <li class="project-sidebar__group u-mb-3 u-mt-0">
                                                <div class="h6 u-mt-0">Scope</div>
                                                <ul class="u-mt-1">
                                                    <?php foreach( $services as $service ) : ?>
                                                        <li><?php echo $service->name; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php if ( $issues ) : ?>
                                            <li class="project-sidebar__group u-mb-3 u-mt-0">
                                                <div class="h6 u-mt-0">Issues</div>
                                                <ul class="u-mt-1">
                                                    <?php foreach( $issues as $issue ) : ?>
                                                        <li><?php echo $issue->name; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php if ( $team_members ) : ?>
                                            <li class="project-sidebar__group u-mb-3 u-mt-0">
                                                <div class="h6 u-mt-0">Team Members</div>
                                                <ul class="u-mt-1">
                                                    <?php foreach ( $team_members as $member ) : ?>
                                                        <li><a href="<?php echo get_permalink($member); ?>" class="u-color-hover-green"><?php echo get_the_title( $member ); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php if ( $collaborators ) : ?>
                                            <li class="project-sidebar__group u-mb-3 u-mt-0">
                                                <div class="h6 u-mt-0">Collaborators</div>
                                                <ul class="u-mt-1">
                                                    <?php foreach ( $collaborators as $collaborator ) : ?>
                                                        <li><a href="<?php echo get_permalink($collaborator); ?>" class="u-color-hover-green"><?php echo get_the_title( $collaborator ); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php if ( $partners ) : ?>
                                            <li class="project-sidebar__group u-mb-3 u-mt-0">
                                                <div class="h6 u-mt-0">Partners</div>
                                                <ul class="u-mt-1">
                                                    <?php foreach ( $partners as $partner ) : 
                                                        $link_action = get_post_meta( $partner, 'member_link_action', true );
                                                        $website = get_post_meta( $partner, 'member_website', true );
                                                        $target = ( $link_action ) ? '_blank' : '_self';
                                                        $url = ( $link_action ) ? esc_url( $website ) : get_permalink($partner); ?>
                                                        <li>
                                                            <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="u-color-hover-green">
                                                                <?php echo get_the_title( $partner ); ?>
                                                                <?php echo ( $link_action ) ? '&nearr;' : ''; ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php if ( $site && $site_url ) : ?>
                                            <li class="project-sidebar__group u-mb-3 u-mt-0">
                                                <div class="h6">Project Site</div>
                                                <ul class="u-mt-1">
                                                    <li><a href="<?php echo esc_url($site_url); ?>" target="_blank" class="u-color-hover-green"><?php echo $site . ' &nearr;'; ?></a></li>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>

                                </div>

                        </div><!-- .u-container -->
                    </section>

                    <!--Related Events-->
                    <section class="section">
                        <div class="flex u-container">

                            <div class="section__content flex__item u-width-12">
                                
                                <!--Vue JS App-->
                                <div id="project-timeline" class="vue-js-app u-clearfix u-mt-6">

                                    <ul class="filter-toggle-list list">

                                        <li class="filter-toggle-list__item list__item" v-for="toggle in filterToggles">
                                            <a href="#" class="filter-group-toggle" 
                                               v-bind:class="[ currentFilterGroup == toggle.slug ? 'is-active' : '' ]" 
                                               v-on:click.prevent="toggleFilterGroup(toggle)">
                                                {{toggle.name}}
                                            </a>
                                        </li>

                                    </ul>

                                    <div class="project-timeline__filters">

                                        <ul id="filter-group-post-type" class="filter-group list" :class="{ 'has-selection' : currentPostType !== 'all' }" v-if="currentFilterGroup == 'post-type'">
                                            <li v-for="type in postTypes" :key="type.slug"
                                                class="filter-group__item"
                                                :class="{ 'is-active' : currentPostType == type.slug }"
                                                v-on:click="toggleFilter(type)">{{ type.name }}</li>
                                        </ul>
                                        
                                        <ul id="filter-group-date" class="filter-group list" :class="{ 'has-selection' : currentDate !== 'all' }" v-if="currentFilterGroup == 'date'">
                                            <li v-for="date in dates" :key="date.seconds"
                                                class="filter-group__item"
                                                :class="{ 'is-active' : currentDate == date.seconds }"
                                                v-on:click="toggleFilter(date)">{{ date.name }}</li>
                                        </ul>

                                    </div>

                                    <div class="project-timeline__contents u-mt-6">

                                        <div class="project-timeline__sidebar-wrap">
                                            <ul class="project-timeline__sidebar">
                                                <li v-for="item in timelineItems" class="project-timeline__sidebar-item">
                                                    <a href="#" class="u-display-block h6 u-mt-0 u-mb-1">
                                                        {{ item.label }}<br/>
                                                        {{ item.date_string }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                        <div v-if="timelineItems.length" class="project-timeline__items">

                                            <article v-if="(currentPostType == item.type || currentPostType == 'all') && (currentDate <= item.date_unix || currentDate == 'all')"
                                                    v-for="item in timelineItems" class="project-timeline__item u-mb-6">

                                                <div v-if="item.layout == 'project_stage'" class="layout-project-stage u-clearfix" v-html="item.content"></div>

                                                <div v-if="item.type == 'publication'" class="layout-publication u-clearfix">
                                                    <h3 class="h4">{{ item.title }}</h3>
                                                    <p v-html="item.image"></p>
                                                    <p><a :href="link.url" class="u-mr-1 u-color-black u-color-hover-green" v-for="link in item.links" v-html="link.text"></a></p>
                                                </div>

                                                <div v-if="item.type == 'event'" class="layout-event u-clearfix">
                                                    <a :href="item.permalink" class="u-display-block u-color-hover-green">
                                                        <div class="image" v-html="item.image"></div>
                                                        <div class="content">
                                                            <h3 class="h1 u-mt-0">{{ item.title }}</h3>
                                                            <p class="h6 u-mt-nudge">
                                                                {{ item.date_string }}, {{ item.time_string }}<br/>
                                                                {{ item.venue }}
                                                            </p>
                                                            <p>Read more</p>
                                                        </div>
                                                    </a>
                                                </div>

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
                                            
                                        </div>
                                        
                                    </div>

                                </div>

                            </div>

                        </div><!-- .u-container -->
                    </section>
                    
                </div>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
