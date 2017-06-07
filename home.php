<?php
/**
 * The posts page template
 */
get_header();
$page_for_posts = get_option( 'page_for_posts' )
?>

	<div class="site-content">
     
        <div class="wrap">
            
            <section class="section">
                <div class="u-container">
                    <div class="flex has-sidebar">

                        <?php get_template_part( 'partials/menu-ui' ); ?>

                        <div class="sidebar-masthead section__sidebar flex__item">
                            <?php get_template_part( 'partials/masthead' ); ?>
                        </div>

                        <div class="section__content flex__item">

                            <div class="page-header">
                                <h1 class="page-title h2 u-mt-pull"><? echo get_the_title( $page_for_posts ); ?></h1> 
                            </div>
                            
                        </div> <!-- .section__content -->

                    </div>
                </div><!-- .u-container -->
            </section>

            <!--Posts-->

            <section class="section">
                <div class="flex u-container">

                    <div class="section__content flex__item u-width-12">

                        <div id="news-feed">
                            <div class="h6 u-animate-pulse"><?php _e( 'Loading...', 'hsc' ); ?></div>
                        </div>

                        <!-- Vue JS App -->
                        <script id="news-feed-template" type="text/html">

                            <div class="vue-js-app u-clearfix" :class="{ 'is-loading' : loading }">

                                <ul class="filter-toggle-list list">

                                    <li class="filter-toggle-list__item list__item" v-for="toggle in filterToggles">
                                        <a href="#" class="filter-group-toggle" 
                                            v-bind:class="[ currentFilterGroup == toggle.slug ? 'is-active' : '' ]" 
                                            v-on:click.prevent="toggleFilterGroup(toggle)">
                                            {{toggle.name}}<br/>
                                            <span class="u-color-teal u-font-gta-extended" v-if="toggle.slug == 'post-type' && currentFilters.postType !== 'all'">{{ currentFilters.postType.name }}</span>
                                            <span class="u-color-teal u-font-gta-extended" v-if="toggle.slug == 'date' && currentFilters.date !== 'all'">{{ currentFilters.date.name }}</span>
                                        </a>
                                    </li>

                                </ul><!-- filter-toggle-list -->

                                <div class="news-feed__filters">

                                    <ul id="filter-group-post-type" class="filter-group list" :class="{ 'has-selection' : currentFilters.postType !== 'all' }" v-if="currentFilterGroup == 'post-type'">
                                        <li v-for="type in postTypes" :key="type.slug"
                                            class="filter-group__item"
                                            :class="{ 'is-active' : currentFilters.postType.slug == type.slug }"
                                            v-on:click="toggleFilter(type)">{{ type.name }}</li>
                                    </ul>
                                    
                                    <ul id="filter-group-date" class="filter-group shift-1 u-pl-1 list" :class="{ 'has-selection' : currentFilters.date !== 'all' }" v-if="currentFilterGroup == 'date'">
                                        <li v-for="date in dates" :key="date.seconds"
                                            class="filter-group__item"
                                            :class="{ 'is-active' : currentFilters.date.seconds == date.seconds }"
                                            v-on:click="toggleFilter(date)">{{ date.name }}</li>
                                    </ul>

                                </div><!-- news-feed__filters -->

                                <div class="news-feed__nodes u-clearfix">

                                    <div v-if=" ! newsPosts.length && ! loading" class="error u-mt-4">
                                        <h3 class="u-mt-0">Hmm... no posts found :(</h3>
                                        <p class="h6">Try removing some of your filters above &uarr;</p>                                
                                    </div>

                                    <article v-for="post in newsPosts" :key="post.slug" class="u-span-4 u-mt-4 preview" :class="post.post_class">

                                        <a v-if="post.post_type == 'event'" :href="post.url" class="u-display-block u-px-1 u-pb-1" title="Read more">
                                            <div class="h6">{{ post.label }}</div>
                                            <h3 class="hentry-title h5 u-mt-nudge">{{ post.title }}</h3>
                                            <div class="h3 u-mt-nudge">{{ post.date_string }}</div>
                                            <div class="hentry-excerpt u-mt-nudge" v-html="post.excerpt"></div>
                                        </a>

                                        <a v-if="post.post_type == 'post'" :href="post.url" class="u-display-block" :class="{ 'u-px-1 u-pb-1' : post.fake_type == 'newsletter' }" title="Read more">
                                            <img v-if="post.attachment" :src="post.attachment.src" :width="post.attachment.width" :height="post.attachment.height" class="u-display-block" />
                                            <div class="h6">{{ post.label }}&nbsp;&nbsp;&nbsp;{{ post.date_string }}</div>
                                            <h3 class="hentry-title h4 u-mt-nudge">{{ post.title }}</h3>
                                            <div class="hentry-excerpt u-mt-nudge" v-html="post.excerpt"></div>
                                        </a>

                                    </article>
                                    
                                </div><!-- .news-feed__nodes -->

                            
                                <hr v-if="queryData.current_page < queryData.total_pages"/>
                                <p class="u-mt-2" v-if="loading || queryData.current_page < queryData.total_pages">
                                    <a href="#" class="u-font-gta-extended u-caps u-color-hover-teal" v-on:click.prevent="getMorePosts()">
                                        <span v-if="loading" class="u-animate-pulse">Loading ...</span>
                                        <span v-else>Load More &plus;</span>
                                    </a>
                                </p>
                            

                            </div>

                        </script>
                        <!-- // Vue JS App -->
                        

                    </div> <!-- .section__content -->

                </div><!-- .u-container -->
            </section>
            
        </div>

	</div>



<?php get_footer();