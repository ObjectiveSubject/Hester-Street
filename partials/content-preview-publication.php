<?php

// Publication Preview

$margin = ''; ?>

<?php if ( has_post_thumbnail() ) : ?>
    <div class="hentry-thumbnail">
        <?php the_post_thumbnail( 'large' ); ?>
    </div>
<?php $margin = 'u-mt-nudge';
endif;?>

<div class="h6 <?php echo $margin; ?>">
    <?php echo get_the_date(); ?>
</div>

<h3 class="hentry-title h5 u-mt-nudge">
    <?php the_title(); ?>
</h3>

<div class="hentry-excerpt u-mt-nudge">
    <a href="<?php the_permalink(); ?>" title="Read <?php the_title(); ?>">Read</a>
    &nbsp;&nbsp;&nbsp;
    <a href="#download-link" title="Download <?php the_title(); ?>">Download &darr;</a>
</div>
