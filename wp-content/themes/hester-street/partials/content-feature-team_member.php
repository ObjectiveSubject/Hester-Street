<?php
/*
 * Featured Team Member
 *
 */
?>

<div <?php post_class("featured u-clearfix"); ?> >
    <div class="content-left u-span-4-10">
        <?php the_post_thumbnail( 'large', array( 'class' => 'u-display-block u-mb-1' ) ); ?>
        <p class="u-display-block-md u-mt-0"><a href="<?php echo site_url('team/'); ?>" class="u-font-gta-extended u-color-purple u-color-hover-black">View all team members</a></p>
    </div>
    <div class="content-right u-span-6-10">
        <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-purple">
            <p class="h1 u-mt-pull"><?php the_title(); ?></p>
            <p class="h6 u-color-black">Team</p>
            <p class="u-color-black"><?php echo get_the_excerpt(); ?></p>
            <p><?php _e( 'Continue Reading', 'hsc' ); ?></p>
        </a>
    </div>
</div>
