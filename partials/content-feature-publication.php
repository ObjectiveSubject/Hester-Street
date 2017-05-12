<?php
/*
 * Featured Publication
 *
 */

$secondary_images = get_field('publication_sec_featured_images'); ?>

<div <?php post_class("featured u-clearfix"); ?> >
    <div class="content-left u-span-3">
        <?php if ( $secondary_images ) {
            foreach ( $secondary_images as $img ) {
                echo wp_get_attachment_image( $img['ID'], 'large', false, array('u-display-block') );
            }
        } ?>
    </div>
    <div class="content-right u-span-9">
        <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-orange">
            <?php the_post_thumbnail( 'large', array( 'class' => 'u-display-block u-mb-2' ) ); ?>
            <p class="h1 u-mt-pull"><?php the_title(); ?></p>
            <p class="h6 u-color-black"><?php _e( 'Publications' ); ?> &nbsp;&nbsp;&nbsp; <?php the_date(); ?></p>
            <p class="u-color-black"><?php echo get_the_excerpt(); ?></p>
            <p><?php _e( 'Continue Reading', 'hsc' ); ?> &nbsp;&nbsp;&nbsp; <?php _e( 'Download &darr;', 'hsc' ); ?></p>
        </a>
        <p class="u-mt-2 align-flex-end"><a href="<?php echo site_url('publications/'); ?>" class="u-font-gta-extended u-color-orange u-color-hover-black">View all publications</a></p>
    </div>
</div>
