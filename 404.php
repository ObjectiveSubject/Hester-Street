<?php
/**
 * General page template
 */

get_header();
?>

	<div class="site-content error-404">
		
		<article <?php post_class(); ?>>
               
                <div class="wrap">
                                    
                    <section class="section">
                        <div class="u-container">
                            <div class="flex has-sidebar">

                                <?php get_template_part( 'partials/menu-ui' ); ?>

                                <div class="sidebar sidebar-masthead section__sidebar flex__item">

                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                                </div>

                                <div class="content section__content flex__item">
                                    <div class="page-title">
                                        <h1 class="h2 u-mt-pull"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hsc' ); ?></h1>
                                    </div>
                                    <div class="page-content h3">
                                        <?php esc_html_e( 'It looks like nothing was found at this location.', 'hsc' ); ?>
                                    </div>

                                    <form role="search" method="get" class="search-form u-mt-6" action="<?php echo site_url(); ?>">
                                        <label for="page-404-s" class="h6"><?php _e( 'Maybe try a search?', 'hsc' ); ?></label>
                                        <input id="page-404-s" type="search" class="search-field form-field h3 u-mt-1" placeholder="<?php _e( 'Search', 'hsc' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
                                    </form>

                                </div>

                            </div>
                        </div>
                    </section>
                
                </div>

			</article>

	</div><!-- .error-404 -->

<?php get_footer(); ?>
