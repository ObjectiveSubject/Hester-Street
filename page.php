<?php
/**
 * General page template
 */

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class(); ?>>
               
                <div class="wrap">
                
                    <section class="section">
                        <div class="u-container">
                            <div class="flex has-sidebar">

                                <?php get_template_part( 'partials/menu-ui' ); ?>

                                <div class="sidebar-masthead section__sidebar flex__item">

                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                                </div>

                                <div class="section__content flex__item">
                                    <div class="page-title">
                                        <h1 class="h2 u-mt-pull"><?php the_title(); ?></h1>
                                        <ul class="list page-anchors">
                                            <li class="list__item">
                                                <a href="#">Anchor</a>
                                            </li>
                                        </ul>
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
                            <div class="flex">
                                <div class="section__content flex__item">
                                    <div class="module module--quote">

                                        <blockquote>Hester Street is an urban planning, design and community development nonprofit working so that neighborhoods are shaped by their people.</blockquote>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="u-container">
                            <div class="flex">
                                <div class="section__content flex__item">
                                    <div class="module module--basic">

                                        <div class="module__title">
                                            <h4>Basic module</h4>
                                        </div>

                                        <div class="module__content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi possimus at libero esse earum velit cumque facere in pariatur! Vel commodi ducimus culpa laboriosam maxime fuga at nisi architecto labore, voluptate recusandae minus accusantium quo eos, aliquam iste ipsam amet quas numquam quos. Maxime blanditiis ducimus voluptatibus id perspiciatis quae, corporis ipsum. Dolores minus impedit earum esse deserunt. Eaque saepe aliquam, ullam enim, voluptas at excepturi, totam sunt architecto temporibus, nam quis. Commodi nisi, molestiae, ad illum earum deserunt reiciendis!</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="u-container">
                            <div class="flex">
                                <div class="section__content flex__item">
                                    <div class="module module--basic">

                                        <div class="module__title">
                                            <h4>Basic module (full-width)</h4>
                                        </div>

                                        <div class="module__content module__content--full">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi possimus at libero esse earum velit cumque facere in pariatur! Vel commodi ducimus culpa laboriosam maxime fuga at nisi architecto labore, voluptate recusandae minus accusantium quo eos, aliquam iste ipsam amet quas numquam quos. Maxime blanditiis ducimus voluptatibus id perspiciatis quae, corporis ipsum. Dolores minus impedit earum esse deserunt. Eaque saepe aliquam, ullam enim, voluptas at excepturi, totam sunt architecto temporibus, nam quis. Commodi nisi, molestiae, ad illum earum deserunt reiciendis!</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="u-container">
                            <div class="flex">
                                <div class="section__content flex__item">
                                    <div class="module module--basic">

                                        <div class="module__title">
                                            <h4>Basic module (w/ aside)</h4>
                                        </div>

                                        <div class="module__content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi possimus at libero esse earum velit cumque facere in pariatur! Vel commodi ducimus culpa laboriosam maxime fuga at nisi architecto labore, voluptate recusandae minus accusantium quo eos, aliquam iste ipsam amet quas numquam quos. Maxime blanditiis ducimus voluptatibus id perspiciatis quae, corporis ipsum. Dolores minus impedit earum esse deserunt. Eaque saepe aliquam, ullam enim, voluptas at excepturi, totam sunt architecto temporibus, nam quis. Commodi nisi, molestiae, ad illum earum deserunt reiciendis!</p>
                                        </div>

                                        <div class="module__aside">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi possimus at libero esse earum velit cumque facere in pariatur! Vel commodi ducimus culpa laboriosam maxime fuga at nisi architecto labore.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="u-container">
                            <div class="flex">
                                <div class="section__content flex__item">
                                    <div class="module module--basic">

                                        <div class="module__title">
                                            <h4>Basic module (hybrid)</h4>
                                        </div>

                                        <div class="module__content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi possimus at libero esse earum velit cumque facere in pariatur! Vel commodi ducimus culpa laboriosam maxime fuga at nisi architecto labore, voluptate recusandae minus accusantium quo eos, aliquam iste ipsam amet quas numquam quos. Maxime blanditiis ducimus voluptatibus id perspiciatis quae, corporis ipsum. Dolores minus impedit earum esse deserunt. Eaque saepe aliquam, ullam enim, voluptas at excepturi, totam sunt architecto temporibus, nam quis. Commodi nisi, molestiae, ad illum earum deserunt reiciendis!</p>
                                        </div>

                                        <div class="module__aside">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi possimus at libero esse earum velit cumque facere in pariatur! Vel commodi ducimus culpa laboriosam maxime fuga at nisi architecto labore.</p>
                                        </div>

                                        <div class="module__content module__content--full">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi possimus at libero esse earum velit cumque facere in pariatur! Vel commodi ducimus culpa laboriosam maxime fuga at nisi architecto labore, voluptate recusandae minus accusantium quo eos, aliquam iste ipsam amet quas numquam quos. Maxime blanditiis ducimus voluptatibus id perspiciatis quae, corporis ipsum. Dolores minus impedit earum esse deserunt. Eaque saepe aliquam, ullam enim, voluptas at excepturi, totam sunt architecto temporibus, nam quis. Commodi nisi, molestiae, ad illum earum deserunt reiciendis!</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                
                </div>

			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
