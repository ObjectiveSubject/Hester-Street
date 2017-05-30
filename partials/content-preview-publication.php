<?php

// Publication Preview

$pdf_url = get_field( 'publication_pdf' ); ?>

<a href="<?php the_permalink(); ?>" target="_blank" class="u-display-block u-color-hover-orange">
    <?php the_post_thumbnail( 'large', array( 'class' => 'u-display-block u-mb-2' ) ); ?>
    <p class="h1 u-mt-pull"><?php the_title(); ?></p>
</a>
<p class="h6 u-color-black"><?php _e( 'Publications' ); ?> &nbsp;&nbsp;&nbsp; <?php the_date(); ?></p>
<p class="u-color-black"><?php echo get_the_excerpt(); ?></p>
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