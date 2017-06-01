<?php
/**
 * General single template
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

			<article <?php post_class('wrap'); ?>>
                    
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-sidebar">

                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">
                                <?php get_template_part( 'partials/masthead' ); ?>
                            </div>

                            <div class="section__content flex__item">

                                <div class="page-header">
                                
                                    <div class="h6 u-mt-pull"><?php _e( 'You searched for:', 'hsc' ); ?></div>
                                    <h1 class="page-title h2"><span class="u-color-dark-gray"><? _e( 'Search:', 'hsc' ); ?></span> <?php echo get_search_query(); ?></h1>
                                    <h2 class="page-subtitle h4"><? _e( 'Found:', 'hsc' ); ?> <?php echo $result_count; ?></h2>

                                </div>

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
                                                    <?php switch ( $post_type ) {
                                                        case 'post':
                                                            echo 'Post - ' . get_the_date();
                                                            break;
                                                        case 'page':
                                                            $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                                                            $page_path = array();
                                                            foreach ( $ancestors as $ancestor ) {
                                                                array_push( $page_path, '<a href="' .  get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a>' );
                                                            }
                                                            echo implode( ' &rsaquo; ', $page_path );
                                                            break;
                                                        default:
                                                            echo str_replace( '_', ' ', $post_type );
                                                            break;
                                                    }
                                                    ?>
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

                                <?php else : ?>

                                    <article>
                                        <h3 class="u-mt-4"><?php _e( 'Sorry, we couldn\'t find anything that matched your request.', 'hsc' ); ?></h3>
                                    </article>

                                <?php endif; ?>

                                <form role="search" method="get" class="search-form u-mt-6" action="<?php echo site_url(); ?>">
                                    <label for="search-page-s" class="h6"><?php _e( 'Try a new search:', 'hsc' ); ?></label>
                                    <input id="search-page-s" type="search" class="search-field form-field h3 u-mt-1" placeholder="<?php _e( 'Search', 'hsc' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
                                </form>

                            </div> <!-- .section__content -->

                        </div>
                    </div><!-- .u-container -->
                </section>

			</article>

	</div>



<?php get_footer();