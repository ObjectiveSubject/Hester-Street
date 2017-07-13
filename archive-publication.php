<?php
/**
 * Archive: Publications
 */
get_header();
$queried_object = get_queried_object();
?>

	<div class="site-content">
        
        <div id="publication-archive-app">

            <div class="wrap">
        
                <section class="section">
                    <div class="flex has-sidebar u-container">
                        
                        <?php get_template_part( 'partials/menu-ui' ); ?>

                        <div class="sidebar-masthead section__sidebar flex__item">
                            <?php get_template_part( 'partials/masthead' ); ?>
                        </div>

                        <div class="section__content flex__item">
                            
                            <div class="page-header u-clearfix">
                                <h1 class="page-title h2 u-mt-pull">
                                    <?php post_type_archive_title(); ?>
                                </h1>
                            </div>

                            <div class="h6 u-animate-pulse"><?php _e( 'Loading...', 'hsc' ); ?></div>

                        </div> <!-- .section__content -->

                    </div><!-- .u-container -->
                </section>

            </div>
        
        </div>

        <script id="publication-archive-template" type="text/html">

            <div class="wrap" :class="[[ loading ? 'is-loading' : 'loaded' ], { 'has-filters' : hasFilters } ]">
                
                <section class="section">
                    <div class="flex has-sidebar u-container">
                        
                        <?php get_template_part( 'partials/menu-ui' ); ?>

                        <div class="sidebar-masthead section__sidebar flex__item">
                            <?php get_template_part( 'partials/masthead' ); ?>
                        </div>

                        <div class="section__content flex__item">
                            
                            <div class="page-header u-clearfix">
                                <h1 class="page-title h2 u-mt-pull">
                                    <?php post_type_archive_title(); ?>
                                </h1>


                                <!-- ////
                                <div class="page-header__right">
                                    <a href="#" v-on:click.prevent="resetFilters()" class="reset-filters-btn u-font-gta-extended">Clear All</a>
                                </div>
                                //// -->


                            </div>


                            <!-- //// 
                            CURRENTLY HIDING FILTERS. MAY REACTIVATE LATER 
                            //// -->

                            <div id="publication-filters" style="display:none">

                                <ul class="filter-toggle-list list">
                                    <!-- VueJS node -->
                                    <li class="filter-toggle-list__item list__item" v-for="toggle in publicationFilterData.filterToggles">
                                        <a href="#" class="filter-group-toggle" v-bind:class="[ currentFilterGroup == toggle.slug ? 'is-active' : '' ]" v-on:click="toggleFilterGroup(toggle)">
                                            {{toggle.name}}<br/>
                                            <span v-if="toggle.slug != 'date' && currentFilters[toggle.slug].length" class="u-color-orange u-font-gta-extended">{{ currentFilters[toggle.slug].length }} selected</span>
                                            <span v-if="toggle.slug == 'date'" class="u-color-orange u-font-gta-extended">{{ currentFilters.date.shortName || currentFilters.date.name }}</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="filter-groups">

                                    <!-- VueJS node -->
                                    <ul id="filter-group-services" class="filter-group list u-mt-2" :class="{ 'has-selection' : currentFilters.service.length }" v-if="currentFilterGroup == 'service'">
                                        <li class="list__item u-mb-1" v-for="service in publicationFilterData.services" :key="service.slug"> 
                                            <span v-if="service.children.length" class="u-caps">{{ service.name }}</span>
                                            <span is="filter-term" 
                                                v-if="service.children.length === 0" 
                                                :filter-obj="service" 
                                                :is-active="currentFilters[service.taxonomy].indexOf(service.slug) > -1" 
                                                v-on:select="toggleFilter(service)"></span>
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
                                            v-for="issue in publicationFilterData.issues" :key="issue.slug"
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
                                                                    
                                </div>

                            </div>

                            <!-- //// -->


                        </div> <!-- .section__content -->

                    </div><!-- .u-container -->
                </section>

                <section class="section">
                    <div class="publication-results flex u-container">

                        <div class="section__content flex__item u-width-12 u-pt-2">

                            <div class="u-clearfix">

                                <div v-if="loading" class="h6 u-animate-pulse">Loading...</div>
                                
                                <!-- ////
                                <div v-if=" ! publications.length && ! loading" class="error">
                                    <h3 class="u-mt-0">Hmm... no publications match your criteria :(</h3>
                                    <p class="h6">Try removing some of your filters above &uarr;</p>                                
                                </div>
                                //// -->


                                <!-- VueJS node -->
                                <article :id="publication.slug" class="u-mb-4 u-span-4" v-for="publication in publications" :key="publication.title" :class="publication.post_class" >
                                    <a :href="publication.url" title="Read more" class="u-display-block u-color-hover-orange">
                                        <div class="hentry-thumbnail" v-if="publication.attachment.src">
                                            <img :src="publication.attachment.src" :width="publication.attachment.width" :height="publication.attachment.height" alt="publication image"/>
                                        </div>
                                        <div class="h6 u-mt-nudge">
                                            {{ publication.date_string }}
                                        </div>
                                        <h2 class="hentry-title h5 u-mt-nudge">
                                            {{ publication.title }}
                                        </h2>
                                        <p>Download &darr;</p>
                                    </a>
                                </article>

                            </div>

                        </div> <!-- .section__content -->

                    </div><!-- .u-container -->
                </section>
                
            </div>

        </script>

	</div>

<?php get_footer();