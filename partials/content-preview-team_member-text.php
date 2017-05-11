<?php

// Team Member Preview - text version

$website = get_field( 'member_website' );
$link_action = get_field( 'member_link_action' );
$link = ( $link_action && $website ) ? $website : get_permalink();
?>

<h3 class="hentry-title p u-mt-nudge">
    <a href="<?php echo esc_url( $link ); ?>" class="u-color-hover-purple">
        <?php the_title(); ?>
        <?php echo ( $link_action ) ? '&nearr;' : '' ; ?>
    </a>
</h3>
