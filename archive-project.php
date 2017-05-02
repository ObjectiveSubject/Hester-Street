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
                                    <a href="#" class="filter-group-toggle" v-bind:class="[ currentFilterGroup == toggle.slug ? 'is-active' : '' ]" v-on:click="toggleFilterGroup(toggle)">
                                        {{toggle.name}}<br/>
                                        <span v-if="toggle.slug != 'date' && currentFilters[toggle.slug].length" class="u-color-green u-font-gta-extended">{{ currentFilters[toggle.slug].length }} selected</span>
                                        <span v-if="toggle.slug == 'date'" class="u-color-green u-font-gta-extended">{{ currentFilters.date.shortName || currentFilters.date.name }}</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="filter-groups">

                                <!-- VueJS node -->
                                <ul id="filter-group-services" class="filter-group list u-mt-2" :class="{ 'has-selection' : currentFilters.service.length }" v-if="currentFilterGroup == 'service'">
                                    <li class="list__item u-mt-1" v-for="service in projectFilterData.services" :key="service.slug"> 
                                        <span class="u-caps">{{ service.name }}</span>
                                        <ul v-if="service.children.length">
                                            <li is="filter-term"
                                                v-for="child in service.children" :key="child.slug"
                                                :is-active="currentFilters[child.taxonomy].indexOf(child.slug) > -1" 
                                                :filter-obj="child" v-on:select="toggleFilter(child)"></li>
                                        </ul>
                                        
                                    </li>
                                </ul>

                                <!-- VueJS node -->
                                <ul id="filter-group-issues" class="filter-group list u-mt-2" :class="{ 'has-selection' : currentFilters.issue.length }" v-if="currentFilterGroup == 'issue'">
                                    <li is="filter-term"
                                        v-for="issue in projectFilterData.issues" :key="issue.slug"
                                        :filter-obj="issue" 
                                        :is-active="currentFilters[issue.taxonomy].indexOf(issue.slug) > -1" 
                                        v-on:select="toggleFilter(issue)"></li>
                                </ul>

                                <!-- VueJS node -->
                                <ul id="filter-group-date" class="filter-group list u-mt-2" :class="{ 'has-selection' : currentFilters.date }" v-if="currentFilterGroup == 'date'">
                                    <li is="filter-term"
                                        :filter-obj="{ name: 'Last Month', seconds: (30*24*60*60) }" 
                                        :is-active="currentFilters.date.name == 'Last Month'"
                                        v-on:select="toggleDate({ name: 'Last Month', seconds: (30*24*60*60) })"></li>
                                    <li is="filter-term"
                                        :filter-obj="{ name: 'Last 3 Months', shortName: 'Last 3 Mos.', seconds: ((30*24*60*60)*3) }" 
                                        :is-active="currentFilters.date.name == 'Last 3 Months'"
                                        v-on:select="toggleDate({ name: 'Last 3 Months', shortName: 'Last 3 Mos.', seconds: ((30*24*60*60)*3) })"></li>
                                    <li is="filter-term"
                                        :filter-obj="{ name: 'Last 6 Months', shortName: 'Last 6 Mos.', seconds: ((30*24*60*60)*6) }" 
                                        :is-active="currentFilters.date.name == 'Last 6 Months'"
                                        v-on:select="toggleDate({ name: 'Last 6 Months', shortName: 'Last 6 Mos.', seconds: ((30*24*60*60)*6) })"></li>
                                    <li is="filter-term"
                                        :filter-obj="{ name: 'Last Year', seconds: (365*24*60*60) }" 
                                        :is-active="currentFilters.date.name == 'Last Year'"
                                        v-on:select="toggleDate({ name: 'Last Year', seconds: (365*24*60*60) })"></li>
                                    <li is="filter-term"
                                        :filter-obj="{ name: 'Last 3 Years', shortName: 'Last 3 Yrs.', seconds: ((365*24*60*60)*3) }" 
                                        :is-active="currentFilters.date.name == 'Last 3 Years'"
                                        v-on:select="toggleDate({ name: 'Last 3 Years', shortName: 'Last 3 Yrs.', seconds: ((365*24*60*60)*3) })"></li>
                                </ul>

                                <!-- VueJS node -->
                                <ul id="filter-group-status" class="filter-group list u-mt-2" :class="{ 'has-selection' : currentFilters.status.length }" v-if="currentFilterGroup == 'status'">
                                    <li is="filter-term"
                                        v-for="stati in projectFilterData.status" :key="stati.slug"
                                        :filter-obj="stati" 
                                        :is-active="currentFilters[stati.taxonomy].indexOf(stati.slug) > -1" 
                                        v-on:select="toggleFilter(stati)"></li>
                                </ul>

                                <!-- VueJS node -->
                                <ul id="filter-group-locations" class="filter-group list u-mt-2" :class="{ 'has-selection' : currentFilters.location.length }" v-if="currentFilterGroup == 'location'">
                                    <li class="list__item u-mt-1" v-for="location in projectFilterData.locations" :key="location.slug"> 
                                        
                                        <span class="u-caps" v-if="location.children.length">{{ location.name }}</span>
                                        <span is="filter-term" 
                                              v-if="location.children.length === 0" 
                                              :filter-obj="location" 
                                              :is-active="currentFilters[location.taxonomy].indexOf(location.slug) > -1" 
                                              v-on:select="toggleFilter(location)"></span>
                                            
                                        <ul v-if="location.children.length">
                                            <li is="filter-term"
                                                v-for="child in location.children" :key="child.slug"
                                                :filter-obj="child" 
                                                :is-active="currentFilters[child.taxonomy].indexOf(child.slug) > -1" 
                                                v-on:select="toggleFilter(child)"></li>
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