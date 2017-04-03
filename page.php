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
                                <div class="page-title">
                                    <h1 class="h2"><?php the_title(); ?></h1>
                                </div>
                                <div class="page-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                
                <section class="section u-bg-red">
                    <div class="u-container">
                        <div class="flex has-module">
                            <div class="section-content module module--quote">
                                <!--<div class="h6">About</div>-->
                                <blockquote>Hester Street is an urban planning, design and community development nonprofit working so that neighborhoods are shaped by their people.</blockquote>
                                <!--<a href="#">Read More</a>-->
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-module">
                            <div class="content section-content module module--basic">
                                <div class="module-content">
                                    <h4>Approach</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi possimus at libero esse earum velit cumque facere in pariatur! Vel commodi ducimus culpa laboriosam maxime fuga at nisi architecto labore, voluptate recusandae minus accusantium quo eos, aliquam iste ipsam amet quas numquam quos. Maxime blanditiis ducimus voluptatibus id perspiciatis quae, corporis ipsum. Dolores minus impedit earum esse deserunt. Eaque saepe aliquam, ullam enim, voluptas at excepturi, totam sunt architecto temporibus, nam quis. Commodi nisi, molestiae, ad illum earum deserunt reiciendis!</p>
                                </div>
                                <aside class="aside module-aside u-span-4">
                                    Here is some random text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam recusandae iure facere debitis distinctio quasi cumque.
                                </aside>
                            </div>
                        </div>
                    </div>
                </section>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>