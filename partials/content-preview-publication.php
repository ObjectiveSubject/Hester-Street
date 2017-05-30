<?php

// Publication Preview

$pdf_url = get_field( 'publication_pdf' );
$image_size = ( is_front_page() ) ? 'large' : 'medium';
$title_class = ( is_front_page() ) ? 'h1 u-mt-pull' : 'h5 u-mt-0';
$image_class = ( is_front_page() ) ? 'u-display-block u-mb-2' : 'u-display-block u-mb-nudge';
$excerpt = get_the_excerpt(); ?>

<a href="<?php the_permalink(); ?>" target="_blank" class="u-display-block u-color-hover-orange">
    <?php the_post_thumbnail( $image_size, array( 'class' => $image_class ) ); ?>
    <p class="<?php echo $title_class; ?>"><?php the_title(); ?></p>
</a>
<p class="h6 u-mt-nudge u-color-black"><?php _e( 'Publications' ); ?> &nbsp;&nbsp;&nbsp; <?php the_date(); ?></p>
<?php if ( $excerpt ) : ?><p class="u-color-black"><?php echo get_the_excerpt(); ?></p><?php endif; ?>
<p> 
    <a href="<?php the_permalink(); ?>" target="_blank" class="u-color-hover-orange">
        <?php _e( 'Read more', 'hsc' ); echo ' &rarr;' ?>
    </a>
    <?php if ( $pdf_url ) : ?>
        &nbsp;&nbsp;&nbsp;
        <a href="<?php echo esc_url( $pdf_url ); ?>" target="_blank" class="u-color-hover-orange">
            <?php _e( 'Download', 'hsc' ); echo ' &darr;' ?>
        </a>
    <?php endif; ?>
</p>