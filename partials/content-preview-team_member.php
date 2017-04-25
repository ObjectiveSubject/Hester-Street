<?php

// Team Member Preview

$margin = ''; ?>

<a href="<?php the_permalink(); ?>" class="u-display-block" title="Read more">

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="hentry-thumbnail">
            <?php the_post_thumbnail( 'large' ); ?>
        </div>
    <?php $margin = 'u-mt-nudge';
    endif;?>

    <h3 class="hentry-title h6 u-mt-nudge">
        <?php the_title(); ?>
    </h3>

    <div class="hentry-excerpt u-mt-nudge">
        <?php echo nl2br( get_post_meta( $post->ID, 'member_title', true ) ); ?>
    </div>

</a>