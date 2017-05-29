<?php
/**
 * Template Name: Team
 */
get_header();
$roles = get_terms( array( 'taxonomy' => 'team_role', 'hide_empty' => true ) );
function compare_team_members($a, $b) {
    $a_name = explode( ' ', $a->post_title );
    $b_name = explode( ' ', $b->post_title );
    $a_last_name = $a_name[ (count($a_name) - 1) ];
    $b_last_name = $b_name[ (count($b_name) - 1) ];
    if ( $a_last_name == $b_last_name ) {
        return 0;
    }
    return ( $a_last_name < $b_last_name ) ? -1 : 1;
}
?>

	<div class="site-content">

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
                                <h1 class="page-title h2 u-mt-pull">
                                    <span class="u-color-dark-gray">
                                        <?php the_title(); ?>
                                    </span>
                                </h1>
                            </div>

                            <ul class="list page-anchors">
                                <?php foreach ( $roles as $role ) :
                                // hide alumni and collaborators from this list
                                if ( 'alumni' == $role->slug || 'collaborators' == $role->slug ) { continue; } ?>
                                <li class="list__item">
                                    <a href="#<?php echo $role->slug; ?>" class="u-color-hover-purple"><?php echo $role->name; ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                        </div> <!-- .section__content -->

                    </div><!-- .u-container -->
                </section>

                <section class="section">
                    <div class="flex u-container">

                        <div class="section__content u-width-12 flex__item">

                            <?php foreach ( $roles as $role ) :

                                // hide alumni and collaborators from this list
                                if ( 'alumni' == $role->slug || 'collaborators' == $role->slug )
                                    continue;

                                $team_members = new WP_Query(array(
                                    'post_type' => 'team_member',
                                    'posts_per_page' => 100,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'team_role',
                                            'field' => 'slug',
                                            'terms' => $role->slug
                                        )
                                    )
                                )); 
                                
                                if ( $team_members->have_posts() ) :
                                
                                    $team_member_posts = $team_members->posts;
                                    usort( $team_member_posts, 'compare_team_members' ); ?>

                                    <div id="<?php echo $role->slug; ?>">

                                        <h2 class="h4 u-pt-4"><?php echo $role->name; ?></h2>

                                        <div class="u-clearfix">

                                            <?php foreach ( $team_member_posts as $post ) : setup_postdata( $post ); ?>

                                                <?php if ( has_term( 'supporters', 'team_role' ) || has_term( 'partners', 'team_role' ) ) : ?>
                                                
                                                    <article <?php post_class( 'u-span-4 u-mt-1 preview' ); ?> >
                                                        <?php get_template_part( 'partials/content-preview', 'team_member-text' ); ?>
                                                    </article>

                                                <?php else : ?>

                                                    <article <?php post_class( 'u-span-3 u-mt-2 preview' ); ?> >
                                                        <?php get_template_part( 'partials/content-preview', 'team_member' ); ?>
                                                    </article>

                                                <?php endif; ?>
                                                
                                            <?php endforeach; wp_reset_postdata(); ?>

                                        </div>

                                    </div>

                                <?php endif; ?>
                            
                            <?php endforeach; ?>

                        </div> <!-- .section__content -->

                    </div><!-- .u-container -->
                </section>
                    
			</article>

	</div>



<?php get_footer();