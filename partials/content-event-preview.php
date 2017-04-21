<?php

// Event Preview

$now = time();
$event_datetime = get_post_meta( $post->ID, 'event_datetime', true );
$is_upcoming = $now < $event_datetime; 
$is_past = $now >= $event_datetime;
?>

<a href="<?php the_permalink(); ?>" class="u-display-block u-px-1 u-pb-1" title="Read more">
    <div class="h6">
        <?php echo ( $is_upcoming ) ? 'Upcoming Event' : 'Past Event'; ?>
    </div>
    <h3 class="hentry-title h5 u-mt-nudge">
        <?php the_title(); ?>
    </h3>
    <div class="h3 u-mt-nudge">
        <?php echo date( 'M. j', $event_datetime ); ?>
    </div>
    <div class="hentry-excerpt">
        <?php the_excerpt(); ?>
    </div>
</a>