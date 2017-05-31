<?php
/*
 * Featured Publication
 *
 */

$pdf_url = get_field( 'publication_pdf', $id );
$secondary_images = get_field('publication_sec_featured_images'); ?>

<div <?php post_class("featured u-clearfix"); ?> >
    <div class="content-left">
        <?php if ( $secondary_images ) {
            foreach ( $secondary_images as $img ) {
                echo wp_get_attachment_image( $img['ID'], 'large', false, array('u-display-block') );
            }
        } ?>
    </div>
    <div class="content-right">
        <div>
            <?php get_template_part( 'partials/content-preview', 'publication' ) ?>
        </div>
        <p class="u-mt-2 align-flex-end"><a href="<?php echo site_url('publications/'); ?>" class="u-font-gta-extended u-color-orange u-color-hover-black">View all publications</a></p>
    </div>
</div>
