<?php
/**
 * Template Name: News Page
 */
get_header();
global $wp_query;
$pagination = '';
if ( $wp_query->max_num_pages > 1 ) {
	$paginate_links = paginate_links( array(
		'mid_size' => 2
	) );
	$pagination = '<nav class="pagination">' . $paginate_links . '</nav>';
}
$result_count = $wp_query->found_posts;
$result_count = ( 1 === $result_count ) ? $result_count . ' result' : $result_count . ' results';
?>

	<div class="site-content">

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
                                    
                                    <h1 class="page-title h2 u-mt-pull"><span class="u-color-dark-gray"><? _e( 'News', 'hsc' ); ?></span></h1>

                                    <?php if ( have_posts() ) : ?>

                                        <?php if ( 1 < get_query_var('paged') ) : ?>
                                            <div class="posts-pagination">
                                                <?php echo $pagination; ?>
                                                <hr>
                                            </div>
                                        <?php endif; ?>

                                        <div>

                                            <?php while ( have_posts() ) : the_post(); ?>
                                                
                                                <article <?php post_class( 'u-mt-4' ); ?>>
                                                    <div class="h6">
                                                        <?php echo 'Post - ' . get_the_date(); ?>
                                                    </div>
                                                    <h3 class="hentry-title">
                                                        <a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="hentry-excerpt">
                                                        <?php the_excerpt(); ?>
                                                    </div>
                                                    <hr class="u-mt-4">
                                                </article>
                                                
                                            <?php endwhile; ?>

                                        </div>

                                        <div class="posts-pagination">
                                            <?php echo $pagination; ?>
                                        </div>

                                    <?php endif; ?>

                                </div> <!-- .section__content -->

                            </div>
                        </div><!-- .u-container -->
                    </section>
                    
                </div>

			</article>

	</div>



<?php get_footer();