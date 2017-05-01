<?php

// Project Preview

$begin = get_post_meta( $post->ID, 'project_begin_date', true );
$end = get_post_meta( $post->ID, 'project_end_date', true );
if ( ! $end ) {
    $begin_string = date( 'M. Y', $begin );
    $end_string = 'Present';
} else {
    if ( date( 'Y', $begin ) == date( 'Y', $end ) ) {
        $begin_string = date( 'M', $begin );
    } else {
        $begin_string = date( 'M. Y', $begin );
    }
    $end_string = date( 'M. Y', $end );
}
$margin = ''; ?>

<?php if ( has_post_thumbnail() ) : ?>
    <div class="hentry-thumbnail">
        <?php the_post_thumbnail( 'large' ); ?>
    </div>
<?php $margin = 'u-mt-nudge';
endif;?>

<div class="h6 <?php echo $margin; ?>">
    <?php echo $begin_string . ' – ' . $end_string; ?>
</div>

<h2 class="hentry-title u-mt-nudge">
    <a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a>
</h2>
