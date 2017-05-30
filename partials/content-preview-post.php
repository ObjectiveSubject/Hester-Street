<?php

// Post Preview

$cats = (array) get_the_terms( $post, 'category' );
$cat = $cats[0];
$is_newsletter = has_category( 'newsletter');
$post_class = ( $is_newsletter ) ? 'u-px-1 u-pb-1' : '';
$title_size = ( is_front_page() ) ? 'h3' : 'h5';
?>

<div class="<?php echo $post_class; ?>">
    <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-teal" title="Read more">
        <?php the_post_thumbnail( 'lareg', array( 'class' => 'u-display-block' ) ); ?>
        <div class="h6">
            <?php
            if ( $is_newsletter ) {
                echo ($cat) ? $cat->name.'<br>'.get_the_date('M. Y') : get_the_date('M. Y');
            } else {
                echo ($cat) ? $cat->name.' &nbsp;&nbsp;&nbsp; '.get_the_date() : get_the_date();
            } ?>
        </div>
        <div class="hentry-title u-mt-nudge <?php echo $title_size; ?>">
            <?php the_title(); ?>
        </div>
        <?php if ( is_front_page() ) : ?>
            <div class="hentry-excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php endif; ?>
    </a>
</div>