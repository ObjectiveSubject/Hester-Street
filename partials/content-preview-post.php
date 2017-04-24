<?php

// Post Preview

$cats = (array) get_the_terms( $post, 'category' );
$cat = $cats[0];
$is_newsletter = has_category( 'newsletter');
$post_class = ( $is_newsletter ) ? 'u-px-1 u-pb-1' : '';
?>

<div class="<?php echo $post_class; ?>">
    <a href="<?php the_permalink(); ?>" class="u-display-block" title="Read more">
        <div class="h6">
            <?php
            if ( $is_newsletter ) {
                echo ($cat) ? $cat->name.'<br>'.get_the_date('M. Y') : get_the_date('M. Y');
            } else {
                echo ($cat) ? $cat->name.' &nbsp;&nbsp;&nbsp; '.get_the_date() : get_the_date();
            } ?>
        </div>
        <h3 class="hentry-title u-mt-nudge">
            <?php the_title(); ?>
        </h3>
        <div class="hentry-excerpt">
            <?php the_excerpt(); ?>
        </div>
    </a>
</div>