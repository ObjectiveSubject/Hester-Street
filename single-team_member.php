<?php
/**
 * Single Team Member template
 */

if ( has_term( 'board', 'team_role' ) ) {
    wp_redirect( site_url('team/') );
}

global $post;
get_header();

$roles = get_the_terms( $post->ID, 'team_role' );
$member_role = ( $roles ) ? $roles[0]->name : 'Team';
$member_title = get_field( 'member_title' );
$member_scope_areas = get_the_terms( $post->ID, 'service' );
$member_issue_areas = get_the_terms( $post->ID, 'issue' );
$member_website = get_field( 'member_website' ); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrap'); ?>>                
                    
                <section class="section">
                    <div class="flex has-sidebar u-container">

                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">

                                <div id="masthead" class="masthead is-sticky">
                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                                </div>
                                
                            </div>

                            <div class="section__content flex__item">
                                <div class="page-header">
                                    <a href="<?php echo site_url( 'team/' ); ?>" class="member-heading h2 u-display-block u-mt-pull" data-title="<?php echo $member_role; ?>" data-title-hover="&larr; Team" role="presentation">&nbsp;</a>
                                </div>
                            </div>

                    </div><!-- .u-container -->
                </section>

                <section class="section">
                    <div class="flex u-container">

                            <div class="section__content flex__item u-pt-2">

                                <div class="flex">

                                    <div class="flex__item is-flush u-width-5">
                                        
                                        <?php if ( get_the_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'large', array( 'class' => 'u-mb-3' ) ); ?>
                                        <?php endif; ?>

                                        <?php if ( $member_scope_areas ) : ?>
                                            <div class="scope-areas member-meta u-mb-3">
                                                <h6 class="u-mt-0">Scope Focus Areas</h6>
                                                <div class="u-mt-nudge">
                                                    <?php foreach( $member_scope_areas as $scope ) : ?>
                                                        <p class="u-mt-0"><?php echo $scope->name; ?></p>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( $member_issue_areas ) : ?>
                                            <div class="issue-areas member-meta u-mb-3">
                                                <h6 class="u-mt-0">Issue Focus Areas</h6>
                                                <div class="u-mt-nudge">
                                                    <?php foreach( $member_issue_areas as $issue ) : ?>
                                                        <p class="u-mt-0"><?php echo $issue->name; ?></p>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( $member_website ) : ?>
                                            <div class="member-website member-meta">
                                                <a href="<?php echo esc_url( $member_website ); ?>" class="h6" target="_blank">View Website &nearr;</a>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                    <div class="flex__item u-width-7">
                                        <h1 class="post-title u-mt-pull">
                                            <?php the_title(); ?>
                                        </h1>
                                        <div class="h6"><?php echo $member_title; ?></div>
                                        <div class="h6"><?php echo get_the_excerpt(); ?></div>
                                        <div class="post-content">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>

                                </div>

                            </div>

                    </div><!-- .u-container -->
                </section>

                <!--Related Posts-->
                <?php 
                $args = array(
                    'post_type' => 'project',
                    'posts_per_page' => 10,
                    'meta_query' => array(
                        array(
                            'key' => 'project_team_members',
                            'value' => strval($post->ID),
                            'compare' => 'LIKE'
                        )
                    )
                );
                $projects = new WP_Query( $args ); ?>

                <?php if ( $projects->have_posts() ) : ?>
                
                    <section class="section">
                        <div class="flex u-container">
                            <div class="section__content flex__item u-width-12 u-pt-6">
                                
                                <div class="h6 u-mt-0"><?php echo explode( ' ', get_the_title() )[0] . '\'s Projects'?></div>

                                <ul class="u-clearfix u-mt-0">
                                    <?php while( $projects->have_posts() ) : $projects->the_post(); ?>
                                        <li class="u-span-6 u-mt-1">
                                            <a href="<?php the_permalink(); ?>" class="u-display-block">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <div class="post-image responsive-media-16x9" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>
                                                <?php endif; ?>
                                                <h3 class="h5"><?php the_title(); ?></h3>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>

                            </div>
                        </div><!-- .u-container -->
                    </section>

                <?php endif; ?>
                    
			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
