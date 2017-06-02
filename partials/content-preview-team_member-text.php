<?php

// Team Member Preview - text version

$website = get_field( 'member_website' );
$link_action = get_field( 'member_link_action' );
$link = ( $link_action && $website ) ? $website : get_permalink();
$target = ( $link_action ) ? '_blank' : '_self';
$rel = ('_blank' == $target) ? 'nofollow' : '';
?>

<h3 class="hentry-title p u-mt-nudge">
    <?php if ( $website ) : ?>
    
        <a href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>" class="u-color-hover-purple">
            <?php the_title(); ?>
            <?php echo ( $link_action ) ? '&nearr;' : '' ; ?>
        </a>
    
    <?php else : ?>

        <?php the_title(); ?>
        <?php echo ( $link_action ) ? '&nearr;' : '' ; ?>

    <? endif; ?>
</h3>
