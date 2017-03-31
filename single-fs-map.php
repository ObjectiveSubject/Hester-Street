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
                        <div class="row has-sidebar">
                            
                            <div class="sidebar sidebar-masthead column">

                                <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                            
                            </div>

                            <div class="section-content">
                                <div class="column">
                                   
                                    <div class="post-image u-mb-4">
                                        <!-- Temporarily output as <img> -->
                                        <?php echo get_the_post_thumbnail( $post_id ); ?> 
                                    </div>
                                    
                                    <div class="post-title u-mb-6">
                                        <h1 class="u-pr-6"><?php the_title(); ?></h1>
                                        <div class="u-mt-1">
                                            <div class="h6 u-display-inline-block">Paths to Pier 42</div>
                                            <div class="h6 u-display-inline-block u-ml-2">2007-2016</div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                       
                <section class="u-bg-red">
                    <div class="u-container">
                        <div class="row">
                            <div class="column">
                                Content here
                            </div>
                        </div>
                    </div>
                </section>
                        
                <section class="section">
                    <div class="u-container">
                        <div class="row has-sidebar">
                            <div class="section-content">
                                <div class="column">
                                    <div class="row">
                                       
                                        <aside class="post-meta sidebar sidebar--expanded">
                                            <div class="row">
                                                <div class="post-meta__scope column">
                                                    <div class="list-title">Scope</div>
                                                    <ul class="list">
                                                        <li class="list-item"><a href="#">Item</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="post-meta__issues column">
                                                    <div class="list-title">Issues</div>
                                                    <ul class="list">
                                                        <li class="list-item"><a href="#">Issue</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="post-meta__team column">
                                                    <div class="list-title">Team Members</div>
                                                    <ul class="list">
                                                        <li class="list-item"><a href="#">Team Member</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="post-meta__partners column">
                                                    <div class="list-title">Partners</div>
                                                    <ul class="list">
                                                        <li class="list-item"><a href="#">Partner</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </aside>
                                        
                                        <div class="post-content">
                                            
                                            <?php the_content(); ?>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div> <!-- .section-content -->

                        </div>
                    </div>
                </section>
                
                <section class="section">
                    <div class="u-container">
                        <div class="row has-module has-sidebar">
                            <div class="section-content">
                                <div class="column">
                                    <div class="row">
                                        <div class="post-content">
                                            <div class="h6 u-display-inline-block">Project sign off</div>
                                            <div class="h6 u-display-inline-block u-ml-2">Mar. 12, 2017</div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius dolor unde excepturi ullam itaque saepe eligendi fugiat neque accusantium sunt! Harum dolorem voluptate doloribus tempore. Adipisci velit itaque iste delectus vero officiis qui quod ea inventore similique impedit repudiandae minima doloremque, aspernatur, ratione, beatae quae facere? Est placeat temporibus a ratione tempora iusto earum et magni autem reprehenderit quidem velit at in fugit eligendi voluptas possimus facere nam sint vero nemo, nihil praesentium amet quisquam sapiente. Quas sit incidunt impedit itaque, quod officia? Minus iusto, quas possimus sapiente maxime, sunt voluptate accusantium, voluptatum ratione doloremque expedita excepturi itaque reiciendis dolor?</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="post-content post-content--expanded">
                                            <div class="h6 u-display-inline-block">Report</div>
                                            <div class="h6 u-display-inline-block u-ml-2">Feb. 23, 2017</div>
                                            <div class="h4">A Peoples Plan for the East River Waterfront</div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius dolor unde excepturi ullam itaque saepe eligendi fugiat neque accusantium sunt! Harum dolorem voluptate doloribus tempore. Adipisci velit itaque iste delectus vero officiis qui quod ea inventore similique impedit repudiandae minima doloremque, aspernatur, ratione, beatae quae facere? Est placeat temporibus a ratione tempora iusto earum et magni autem reprehenderit quidem velit at in fugit eligendi voluptas possimus facere nam sint vero nemo, nihil praesentium amet quisquam sapiente. Quas sit incidunt impedit itaque, quod officia? Minus iusto, quas possimus sapiente maxime, sunt voluptate accusantium, voluptatum ratione doloremque expedita excepturi itaque reiciendis dolor?</p>
                                        </div>
                                    </div>
                                    <div class="row has-module">
                                        <div class="section-content">
                                            <div class="module module--quote">
                                                <!--<div class="h6">About</div>-->
                                                <blockquote>Hester Street is an urban planning, design and community development nonprofit working so that neighborhoods are shaped by their people.</blockquote>
                                                <!--<a href="#">Read More</a>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <aside class="sidebar">
                                <div class="timeline column js-sticky">
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
