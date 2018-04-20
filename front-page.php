<?php
/**
 * Front Page
 */

get_header(); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrap'); ?>>

                <h1 class="u-display-none" role="presentation"><? echo bloginfo( 'name' ); ?></h1> 
                               
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-sidebar">

                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">
                                <?php get_template_part( 'partials/masthead' ); ?>
                            </div>

                            <div class="section__content flex__item">

                                <div class="h1 u-mt-pull u-width-8-10"><? echo bloginfo( 'description' ); ?></div> 

                                <?php 
                                $featured_post = get_field( 'featured_post' );
                                    
                                if ( $featured_post ) : ?>
                                <div class="featured-post u-mt-2">

                                    <?php 
                                    $type = get_post_type( $featured_post );
                                    $post = $featured_post;
                                    setup_postdata( $post );
                                    get_template_part( 'partials/content-feature', $type );
                                    wp_reset_postdata();
                                    ?>

                                    <br/>

                                    <?php 
                                    $badge_text = get_field( 'badge_text' );
                                    if ( $badge_text ) :
                                        $badge_link = get_field( 'badge_link' ); ?>
                                        <a href="<?php echo esc_url( $badge_link ); ?>" class="badge">
                                            <span class="badge-text"><?php echo esc_html( $badge_text ); ?></span>
                                        </a>
                                    <?php endif; ?>

                                </div>
                                <?php endif; ?>

                            </div><!-- .section__content -->

                        </div>
                    </div>
                </section>

                <?php $recent_projects = new WP_Query(array(
                    'post_type' => 'project',
                    'posts_per_page' => 3,
                    'orderby' => 'meta_value',
                    'meta_key' => 'project_begin_date'
                )); 
                
                if ( $recent_projects->have_posts() ) : ?>

                    <section class="section">
                        <div class="u-container">
                            <div class="flex">

                                <div class="section__content flex__item">

                                    <div class="u-width-12 u-mt-1 u-clearfix">
                                        <?php while ( $recent_projects->have_posts() ) : $recent_projects->the_post(); ?>
                                            <article class="u-span-4 u-mt-2">
                                                <?php get_template_part( 'partials/content-feature', 'secondary-project' ) ?>
                                            </article>
                                        <?php endwhile; wp_reset_query(); ?>
                                    </div>

                                    <p class="u-mt-3"><a href="<?php echo site_url('projects/'); ?>" class="u-font-gta-extended u-color-green u-color-hover-black">View all Projects</a></p>

                                </div><!-- .section__content -->

                            </div>
                        </div>
                    </section>

                <?php endif; ?>


                <?php $featured_team_member = get_field('featured_team_member'); 
                if ( $featured_team_member ) : ?>

                    <section class="section u-mt-12">
                        <div class="u-container">

                            <div class="section__content">

                                <div class="u-width-10 u-shift-1">
                                    <?php 
                                    $post = $featured_team_member; 
                                    setup_postdata( $post );
                                    get_template_part( 'partials/content-feature', 'team_member' );
                                    wp_reset_postdata(); ?>
                                </div>

                                <p class="u-display-none-md"><a href="<?php echo site_url('team/'); ?>" class="u-font-gta-extended u-color-purple u-color-hover-black">View all team members</a></p>

                            </div><!-- .section__content -->

                        </div>
                    </section>

                <?php endif; ?>


                <?php $featured_page = get_field('featured_page'); 
                if ( $featured_page ) : ?>

                    <?php 
                    $featured_page_text = get_field('featured_page_text');
                    $post = $featured_page; 
                    setup_postdata( $post ); ?>

                    <section class="section u-bg-red u-mt-12">
                        <div class="u-container">
                            <div class="section__content">
                                <div class="module module--quote u-py-6">

                                    <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-black">
                                        <p class="u-font-gta-extended"><?php the_title(); ?></p>
                                        <blockquote class="u-color-white"><?php echo esc_html( $featured_page_text ); ?></blockquote>
                                        <p class="u-mt-2"><?php _e( 'Read more', 'hsc' ); echo ' &rarr;' ?></p>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <?php wp_reset_postdata(); ?>

                <?php endif; ?>


                <?php $featured_publication = get_field('featured_publication'); 
                if ( $featured_publication ) : ?>

                    <section class="section u-mt-12">
                        <div class="u-container">

                            <div class="section__content">

                                <!--<div class="u-width-10">-->
                                    <?php 
                                    $post = $featured_publication; 
                                    setup_postdata( $post );
                                    get_template_part( 'partials/content-feature', 'publication' );
                                    wp_reset_postdata(); ?>
                                <!--</div>-->

                            </div><!-- .section__content -->

                        </div>
                    </section>

                <?php endif; ?>


                <?php $recent_news = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => array('news-category')
                        )
                    ),
                    // 'orderby' => 'meta_value',
                    // 'order' => 'ASC',
                    // 'meta_key' => 'post_datetime'
                )); 
                
                if ( $recent_news->have_posts() ) : ?>

                    <section class="section u-mt-12">
                        <div class="u-container">
                            <div class="flex">

                                <div class="section__content flex__item">

                                    <div class="u-width-12 u-clearfix">
                                        <?php while ( $recent_news->have_posts() ) : $recent_news->the_post(); ?>
                                            <article class="u-span-4 u-mb-2">
                                                <?php get_template_part( 'partials/content-preview', 'post' ) ?>
                                            </article>
                                        <?php endwhile; wp_reset_query(); ?>
                                    </div>

                                    <p class="u-mt-6"><a href="<?php echo site_url('news/'); ?>" class="u-font-gta-extended u-color-teal u-color-hover-black">View all News</a></p>

                                </div><!-- .section__content -->

                            </div>
                        </div>
                    </section>

                <?php endif; ?>


			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
