<?php
/**
 * General page template
 */

get_header();
?>

	<div class="site-content error-404">
		
		<article <?php post_class(); ?>>
                
                <section class="section">
                    <div class="u-container">
                        <div class="flex has-sidebar">

                            <div class="sidebar sidebar-masthead">

                                <?php get_template_part( 'partials/sidebar', 'masthead' ); ?>
                            
                            </div>

                            <div class="content section-content">
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

			</article>

	</div><!-- .error-404 -->

<?php get_footer(); ?>
