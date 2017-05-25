<?php

// Team Member Preview

$margin = '';
$is_board = has_term( 'board', 'team_role' );

ob_start(); ?>

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
        <?php the_field( 'member_title' ); ?>
    </div>

<?php $content = ob_get_contents(); ob_get_clean();

if ( $is_board ) : ?>

    <?php echo $content; ?>

<?php else : ?>

    <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-purple" title="Read more">
        <?php echo $content; ?>
    </a>

<?php endif; ?>
