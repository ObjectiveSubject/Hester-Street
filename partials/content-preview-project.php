<?php

// Project Preview

$begin = get_field( 'project_begin_date' );
$begin_string = date( 'Y', $begin );
$end = get_field( 'project_end_date' );
if ( ! $end ) {
    $end_string = 'Present';
} else {
    $end_string = date( 'Y', $end );
}
$margin = '';
$title_size = ( is_single() ) ? 'h5' : 'h2'; ?>

<a href="<?php the_permalink(); ?>" title="Read more" class="u-display-block u-color-hover-green">
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-image responsive-media-16x9" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post, 'large' ); ?>);" role="presentation"></div>
        <?php $margin = 'u-mt-nudge';
    endif;?>

    <div class="h5 <?php echo $margin; ?>">
        <?php echo $begin_string . ' – ' . $end_string; ?>
    </div>

    <div class="hentry-title u-mt-nudge <?php echo $title_size; ?>">
        <?php the_title(); ?>
    </div>
</a>
