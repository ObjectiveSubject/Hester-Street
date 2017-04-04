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

                                <div class="sidebar sidebar-masthead section__sidebar flex__item">

                                    <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>

                                </div>

                                <div class="content section__content flex__item">
                                    <div class="page-title">
                                        <h1 class="h2"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'os-wp-starter' ); ?></h1>
                                    </div>
                                    <div class="page-content">
                                        <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'hsc' ); ?>
                                    </div>

                                    <?php get_search_form(); ?>

                                </div>

                            </div>
                        </div>
                    </section>
                
                </div>

			</article>

	</div><!-- .error-404 -->

<?php get_footer(); ?>
