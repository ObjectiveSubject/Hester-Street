<?php
/**
 * Archive: Projects
 */
get_header();
$queried_object = get_queried_object();
?>

	<div class="site-content">
        
        <div id="project-archive-app" class="wrap">
            
            <section class="section" data-test-attr="blank">
                <div class="flex has-sidebar u-container">
                    
                    <?php get_template_part( 'partials/menu-ui' ); ?>

                    <div class="sidebar-masthead section__sidebar flex__item">

                        <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                    </div>

                    <div class="section__content flex__item">
                        
                        <h1 class="page-title h2 u-mt-pull">
                            <? post_type_archive_title(); ?>
                        </h1>

                        <div id="project-filters">

                            <ul class="filter-toggle-list list">
                                <!-- VueJS node -->
                                <li class="filter-toggle-list__item list__item" v-for="toggle in projectFilterData.filterToggles">
                                    <a href="#" class="filter-group-toggle" v-bind:class="[ currentFilterGroup == toggle.slug ? 'is-active' : '' ]" v-on:click="toggleFilterGroup(toggle)">{{toggle.name}}</a>
                                </li>
                            </ul>

                            <div class="filter-groups">

                                <!-- VueJS node -->
                                <ul id="filter-group-services" class="filter-group list u-mt-2" v-if="currentFilterGroup == 'services'">
                                    <li class="list__item u-mt-1" v-for="service in projectFilterData.services" :key="service.slug"> 
                                        <span class="u-caps">{{ service.name }}</span>
                                        <ul v-if="service.children.length">
                                            <li class="list__item" v-for="child in service.children" :key="child.slug">
                                                <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.prevent="addFilter(child)">{{ child.name }}</a>
                                            </li>
                                        </ul>
                                        
                                    </li>
                                </ul>

                                <!-- VueJS node -->
                                <ul id="filter-group-issues" class="filter-group list u-mt-2" v-if="currentFilterGroup == 'issues'">
                                    <li class="list__item" v-for="issue in projectFilterData.issues" :key="issue.slug"> 
                                        <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.prevent="addFilter(issue)">{{ issue.name }}</a>
                                    </li>
                                </ul>

                                <!-- VueJS node -->
                                <ul id="filter-group-date" class="filter-group list u-mt-2" v-if="currentFilterGroup == 'date'">
                                    <li class="list__item"> 
                                        <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.stop="addFilter(30*24*60*60)">Last Month</a>
                                    </li>
                                    <li class="list__item"> 
                                        <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.prevent="addFilter((30*24*60*60)*3)">Last 3 Months</a>
                                    </li>
                                    <li class="list__item"> 
                                        <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.stop="addFilter((30*24*60*60)*6)">Last 6 Months</a>
                                    </li>
                                    <li class="list__item"> 
                                        <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.stop="addFilter(365*24*60*60)">Last Year</a>
                                    </li>
                                    <li class="list__item"> 
                                        <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.stop="addFilter((365*24*60*60)*3)">Last 3 Years</a>
                                    </li>
                                </ul>

                                <!-- VueJS node -->
                                <ul id="filter-group-status" class="filter-group list u-mt-2" v-if="currentFilterGroup == 'status'">
                                    <li class="list__item" v-for="stati in projectFilterData.status" :key="stati.slug"> 
                                        <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.stop="addFilter(stati)">{{ stati.name }}</a>
                                    </li>
                                </ul>

                                <!-- VueJS node -->
                                <ul id="filter-group-locations" class="filter-group list u-mt-2" v-if="currentFilterGroup == 'locations'">
                                    <li class="list__item u-mt-1" v-for="location in projectFilterData.locations" :key="location.slug"> 
                                        <span class="u-caps" v-if="location.children.length">{{ location.name }}</span>
                                        <a href="#" class="filter-group__item u-color-hover-orange" v-if="location.children.length === 0"v-on:click.prevent="addFilter(location)">{{ location.name }}</a>
                                        <ul v-if="location.children.length">
                                            <li class="list__item" v-for="child in location.children" :key="child.slug">
                                                <a href="#" class="filter-group__item u-color-hover-orange" v-on:click.prevent="addFilter(child)">{{ child.name }}</a>
                                            </li>
                                        </ul>
                                        
                                    </li>
                                </ul>
                                
                            </div>

                        </div>

                    </div> <!-- .section__content -->

                </div><!-- .u-container -->
            </section>

            <section class="section">
                <div class="project-results flex has-sidebar has-fat-sidebar u-container">

                    <div class="section__sidebar flex__item is-borderless is-flush">
                        <!-- VueJS node -->
                        <archive-map :projects="projects"></archive-map>
                    </div>

                    <div class="section__content u-width-12 flex__item">

                        <div class="u-clearfix">

                            <!-- VueJS node -->
                            <article :id="project.slug" class="u-mb-4" v-for="project in projects" :key="project.title" :class="project.post_class" :data-geojson='project.geojson'>
                                <div class="hentry-thumbnail" v-if="project.attachment.src">
                                    <img :src="project.attachment.src" :width="project.attachment.width" :height="project.attachment.height" alt="project image"/>
                                </div>
                                <div class="h6 u-mt-nudge">
                                    {{ project.date_string }}
                                </div>
                                <h2 class="hentry-title u-mt-nudge">
                                    <a :href="project.url" title="Read more">{{ project.title }}</a>
                                </h2>
                            </article>

                        </div>

                    </div> <!-- .section__content -->

                </div><!-- .u-container -->
            </section>
            
        </div>

	</div>



<?php get_footer();