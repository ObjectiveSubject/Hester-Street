<?php
/**
 * General page template
 */

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?>>
                
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-sidebar">
                            
                            <div class="sidebar sidebar-masthead">

                                <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                            
                            </div>

                            <div class="content section-content">
                                   
                                <div class="post-image">
                                    <!-- Temporarily output as <img> -->
                                    <?php echo get_the_post_thumbnail( $post_id ); ?> 
                                </div>

                                <div class="post-title">
                                    <h1><?php the_title(); ?></h1>
                                    <div class="u-mt-1">
                                        <div class="h6 u-display-inline-block">Paths to Pier 42</div>
                                        <div class="h6 u-display-inline-block u-ml-2">2007-2016</div>
                                    </div>
                                </div>

                                <div class="flex u-pt-6">

                                    <aside class="sidebar sidebar--expanded sidebar-post-meta">
                                        <div class="post-meta">
                                            <div class="list-title">Scope</div>
                                            <ul class="list">
                                                <li class="list-item"><a href="#">Item</a></li>
                                            </ul>
                                        </div>
                                        <div class="post-meta">
                                            <div class="list-title">Issues</div>
                                            <ul class="list">
                                                <li class="list-item"><a href="#">Issue</a></li>
                                            </ul>
                                        </div>
                                        <div class="post-meta">
                                            <div class="list-title">Team Members</div>
                                            <ul class="list">
                                                <li class="list-item"><a href="#">Team Member</a></li>
                                            </ul>
                                        </div>
                                        <div class="post-meta">
                                            <div class="list-title">Partners</div>
                                            <ul class="list">
                                                <li class="list-item"><a href="#">Partner</a></li>
                                            </ul>
                                        </div>
                                    </aside>

                                    <div class="post-content">

                                        <div class="h6">Location</div>
                                        <!-- Google Maps embed -->
                                        <div style="width: 100%; height: 0; padding-bottom: 75%; background: lightgray;" class="u-mt-1 u-mb-6">
                                            Old map layout, now full-width
                                        </div>
                                        
                                        <div class="post-entry">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>

                                </div>
                                    
                            </div> <!-- .content -->

                        </div>
                    </div><!-- .u-container -->
                </section>
                
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-module has-sidebar">
                            <div class="content section-content module">
                                <div class="module-content">
                                    <div class="h6 u-display-inline-block">Project sign off</div>
                                    <div class="h6 u-display-inline-block u-ml-2">Mar. 12, 2017</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius dolor unde excepturi ullam itaque saepe eligendi fugiat neque accusantium sunt! Harum dolorem voluptate doloribus tempore. Adipisci velit itaque iste delectus vero officiis qui quod ea inventore similique impedit repudiandae minima doloremque, aspernatur, ratione, beatae quae facere? Est placeat temporibus a ratione tempora iusto earum et magni autem reprehenderit quidem velit at in fugit eligendi voluptas possimus facere nam sint vero nemo, nihil praesentium amet quisquam sapiente. Quas sit incidunt impedit itaque, quod officia? Minus iusto, quas possimus sapiente maxime, sunt voluptate accusantium, voluptatum ratione doloremque expedita excepturi itaque reiciendis dolor?</p>
                                </div>
                                <div class="module-content module-content--expanded">
                                    <div class="h6 u-display-inline-block">Report</div>
                                    <div class="h6 u-display-inline-block u-ml-2">Feb. 23, 2017</div>
                                    <div class="h4">A Peoples Plan for the East River Waterfront</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius dolor unde excepturi ullam itaque saepe eligendi fugiat neque accusantium sunt! Harum dolorem voluptate doloribus tempore. Adipisci velit itaque iste delectus vero officiis qui quod ea inventore similique impedit repudiandae minima doloremque, aspernatur, ratione, beatae quae facere? Est placeat temporibus a ratione tempora iusto earum et magni autem reprehenderit quidem velit at in fugit eligendi voluptas possimus facere nam sint vero nemo, nihil praesentium amet quisquam sapiente. Quas sit incidunt impedit itaque, quod officia? Minus iusto, quas possimus sapiente maxime, sunt voluptate accusantium, voluptatum ratione doloremque expedita excepturi itaque reiciendis dolor?</p>
                                </div>
                            </div>
                            <aside class="sidebar sidebar-module">
                                <div class="timeline js-sticky">
                                    <div class="list-title">Timeline</div>
                                    <ul class="list">
                                        <li class="list-item"><a href="#">Sign off</a></li>
                                        <li class="list-item"><a href="#">Mar. 2017</a></li>
                                        <li class="list-item"><a href="#">2016</a></li>
                                        <li class="list-item"><a href="#">2015</a></li>
                                        <li class="list-item"><a href="#">2014</a></li>
                                        <li class="list-item"><a href="#">2013</a></li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
