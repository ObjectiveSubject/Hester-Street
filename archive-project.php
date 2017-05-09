<?php
/**
 * Archive: Projects
 */
get_header();
$queried_object = get_queried_object();
?>

	<div class="site-content">
        
        <div id="project-archive-app" class="wrap" :class="[[ loading ? 'is-loading' : 'loaded' ], { 'has-filters' : hasFilters } ]">
            
            <section class="section">
                <div class="flex has-sidebar u-container">
                    
                    <?php get_template_part( 'partials/menu-ui' ); ?>

                    <div class="sidebar-masthead section__sidebar flex__item">

                        <div id="masthead" class="masthead is-sticky">
                            <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                        </div>

                    </div>

                    <div class="section__content flex__item">
                        
                        <div class="page-header u-clearfix">
                            <h1 class="page-title h2 u-mt-pull">
                                <? post_type_archive_title(); ?>
                            </h1>
                            <div class="page-header__right">
                                <a href="#" v-on:click.prevent="resetFilters()" class="reset-filters-btn u-font-gta-extended">Clear All</a>
                            </div>
                        </div>

                        <div id="project-filters">

                            <ul class="filter-toggle-list list">
                                <!-- VueJS node -->
                                <li class="filter-toggle-list__item list__item" v-for="toggle in projectFilterData.filterToggles">
                                    <a href="#" class="filter-group-toggle" v-bind:class="[ currentFilterGroup == toggle.slug ? 'is-active' : '' ]" v-on:click="toggleFilterGroup(toggle)">
                                        {{toggle.name}}<br/>
                                        <span v-if="toggle.slug != 'date' && toggle.slug != 'status' && currentFilters[toggle.slug].length" class="u-color-green u-font-gta-extended">{{ currentFilters[toggle.slug].length }} selected</span>
                                        <span v-if="toggle.slug == 'date'" class="u-color-green u-font-gta-extended">{{ currentFilters.date.shortName || currentFilters.date.name }}</span>
                                        <span v-if="toggle.slug == 'status'" class="u-color-green u-font-gta-extended">{{ currentFilters.status.name }}</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="filter-groups">

                                <!-- VueJS node -->
                                <ul id="filter-group-services" class="filter-group list u-mt-2" :class="{ 'has-selection' : currentFilters.service.length }" v-if="currentFilterGroup == 'service'">
                                    <li class="list__item u-mb-1" v-for="service in projectFilterData.services" :key="service.slug"> 
                                        <span class="u-caps">{{ service.name }}</span>
                                        <ul v-if="service.children.length" class="u-columns-2">
                                            <li is="filter-term"
                                                v-for="child in service.children" :key="child.slug"
                                                :is-active="currentFilters[child.taxonomy].indexOf(child.slug) > -1" 
                                                :filter-obj="child" v-on:select="toggleFilter(child)"></li>
                                        </ul>
                                        
                                    </li>
                                </ul>
                                
                                <!-- VueJS node -->
                                <ul id="filter-group-issues" class="filter-group list u-mt-2 u-columns-2" :class="{ 'has-selection' : currentFilters.issue.length }" v-if="currentFilterGroup == 'issue'">
                                    <li is="filter-term"
                                        v-for="issue in projectFilterData.issues" :key="issue.slug"
                                        :filter-obj="issue" 
                                        :is-active="currentFilters[issue.taxonomy].indexOf(issue.slug) > -1" 
                                        v-on:select="toggleFilter(issue)"></li>
                                </ul>
                                
                                <!-- VueJS node -->
                                <ul id="filter-group-date" class="filter-group list u-mt-2 " :class="{ 'has-selection' : currentFilters.date }" v-if="currentFilterGroup == 'date'">
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
                                <ul id="filter-group-status" class="filter-group list u-mt-2" :class="{ 'has-selection' : currentFilters.status }" v-if="currentFilterGroup == 'status'">
                                    <li is="filter-term"
                                        v-for="stati in projectFilterData.status" :key="stati.slug"
                                        :filter-obj="stati" 
                                        :is-active="currentFilters.status.slug == stati.slug" 
                                        v-on:select="toggleStatus(stati)"></li>
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
                                            
                                        <ul v-if="location.children.length" class="u-columns-2">
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

            <section class="section flex u-container" v-if="projects.length">
                <div class="flex__item">
                    <sort-select :active-choice="currentSort" v-on:selectsortchoice="toggleSort"></sort-select>
                </div>
            </section>

            <section class="section">
                <div class="project-results flex has-sidebar has-fat-sidebar u-container">

                    <div class="section__sidebar flex__item is-borderless is-flush u-pt-2">
                        <!-- VueJS node -->
                        <archive-map :projects="projects"></archive-map>
                    </div>

                    <div class="section__content flex__item u-width-12 u-pt-2">

                        <div class="u-clearfix">

                            <div v-if=" ! projects.length && ! loading" class="error">
                                <h3 class="u-mt-0">Hmm... no projects match your criteria :(</h3>
                                <p class="h6">Try removing some of your filters above &uarr;</p>                                
                            </div>

                            <!-- VueJS node -->
                            <article :id="project.slug" class="u-mb-4" v-for="project in projects" :key="project.title" :class="project.post_class" >
                                <a :href="project.url" title="Read more" class="u-display-block">
                                    <div class="hentry-thumbnail" v-if="project.attachment.src">
                                        <img :src="project.attachment.src" :width="project.attachment.width" :height="project.attachment.height" alt="project image"/>
                                    </div>
                                    <div class="h6 u-mt-nudge">
                                        {{ project.date_string }}
                                    </div>
                                    <h2 class="hentry-title u-mt-nudge">
                                        {{ project.title }}
                                    </h2>
                                </a>
                            </article>

                        </div>

                    </div> <!-- .section__content -->

                </div><!-- .u-container -->
            </section>
            
        </div>

	</div>

    <script id="sort-select" type="vue-template">
        <div class="sort-select" v-on:click="toggleSelect" >
            <p class="u-caps">Sort By</p>
            <ul class="u-mt-0">
                <sort-choice v-on:selectchoice="selectSortChoice('alpha_desc')" v-if=" selectIsOpen || choice == 'alpha_desc' " value="alpha_desc" name="Alphabetical ⬇︎" ></sort-choice>
                <sort-choice v-on:selectchoice="selectSortChoice('alpha_asc')" v-if=" selectIsOpen || choice == 'alpha_asc' " value="alpha_asc" name="Alphabetical ⬆︎" ></sort-choice>
                <sort-choice v-on:selectchoice="selectSortChoice('date_start_desc')" v-if=" selectIsOpen || choice == 'date_start_desc' " value="date_start_desc" name="Date Started ⬇︎" ></sort-choice>
                <sort-choice v-on:selectchoice="selectSortChoice('date_start_asc')" v-if=" selectIsOpen || choice == 'date_start_asc' " value="date_start_asc" name="Date Started ⬆︎" ></sort-choice>
                <sort-choice v-on:selectchoice="selectSortChoice('date_end_desc')" v-if=" selectIsOpen || choice == 'date_end_desc' " value="date_end_desc" name="Date Completed ⬇︎" ></sort-choice>
                <sort-choice v-on:selectchoice="selectSortChoice('date_end_asc')" v-if=" selectIsOpen || choice == 'date_end_asc' " value="date_end_asc" name="Date Completed ⬆︎" ></sort-choice>
            </ul>
        </div>
    </script>

<?php get_footer();