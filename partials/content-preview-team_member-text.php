<?php

// Team Member Preview - text version

$website = get_post_meta( $post->ID, 'member_website', true );
$link_action = get_post_meta( $post->ID, 'member_link_action', true );
$link = ( $link_action && $website ) ? $website : get_permalink();
?>

<h3 class="hentry-title p u-mt-nudge">
    <a href="<?php echo esc_url( $link ); ?>">
        <?php the_title(); ?>
        <?php echo ( $link_action ) ? '&nearr;' : '' ; ?>
    </a>
</h3>
