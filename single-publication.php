<?php
/**
 * Single Publication
 */

get_header();
$pdf_url = get_field( 'publication_pdf' );
$related_projects = get_field( 'publication_related_projects' );
$secondary_images = get_field('publication_sec_featured_images'); ?>

	<div class="site-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class('wrap'); ?>>
               
                <section class="section">
                    <div class="flex has-sidebar u-container">

                            <?php get_template_part( 'partials/menu-ui' ); ?>

                            <div class="sidebar-masthead section__sidebar flex__item">
                                <?php get_template_part( 'partials/masthead' ); ?>
                            </div>

                            <div class="section__content flex__item">

                                <div class="page-header">
                                
                                    <div class="h2 u-mt-pull"><?php _e( 'Publications', 'hsc' ); ?></div>

                                    <h1 class="post-title u-mt-3">
                                        <?php the_title(); ?>
                                    </h1>

                                    <h2 class="h3 u-mt-nudge"><?php the_date(); ?></h2>

                                    <?php if ( $pdf_url ) : ?>
                                        <p class="h6"><a href="<?php echo esc_url( $pdf_url ); ?>" class="u-color-orange u-color-hover-black"><? _e( 'Download (PDF)', 'hsc' ); echo ' &darr;' ?></a></p>
                                    <?php endif; ?> 

                                    <div class="u-mt-3">
                                        <div class="publication-images">
                                            <?php if ( $secondary_images ) : ?>
                                            <div class="content-left">
                                                <?php foreach ( $secondary_images as $img ) {
                                                    echo wp_get_attachment_image( $img['ID'], 'large', false, array('u-display-block') );
                                                } ?>
                                            </div>
                                            <?php endif; ?>
                                            <div class="content-right">
                                                <div>
                                                    <?php the_post_thumbnail( 'large', array( 'class' => 'u-display-block' ) ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="post-content u-mt-2">
                                    <?php the_content(); ?>

                                    <?php if ( $pdf_url ) : ?>
                                        <p class="h6 u-mt-4">
                                            <a href="<?php echo esc_url( $pdf_url ); ?>" class="u-color-orange u-color-hover-black"><? _e( 'Download (PDF)', 'hsc' ); echo ' &darr;' ?></a>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <?php 
                                
                                // Related Projects

                                if ( $related_projects ) : ?>
                                
                                    <div class="h6 u-mt-4"><?php _e( 'Related Projects', 'hsc' ); ?></div>

                                    <ul class="u-clearfix u-mt-0">
                                        <?php foreach( $related_projects as $project_id ) :
                                            $post = get_post( $project_id );
                                            setup_postdata( $post ); ?>
                                            <li class="u-span-6 u-mt-1">
                                                <?php get_template_part( 'partials/content-preview', 'project' ); ?>
                                            </li>
                                        <?php endforeach; wp_reset_postdata(); ?>
                                    </ul>

                                <?php endif; ?>

                            </div>

                    </div><!-- .u-container -->
                </section>
                    
			</article>

		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>
