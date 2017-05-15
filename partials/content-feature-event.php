<?php
/*
 * Featured Event
 *
 */

$post_datetime = get_field('post_datetime');
$date_format = get_option('date_format');
$video_url = get_field('featured_video_url');
?>
<article <?php post_class(); ?>>

    <?php if ( $video_url ) : ?>

        <div class="hsc-video video--preload js-hsc-video" data-url="<?php echo $video_url; ?>" data-callback="removeBadge">
            <?php the_post_thumbnail( 'large', array( 'class' => 'u-display-block' ) ); ?>
            <div class="hsc-video__play"><?php get_template_part( 'partials/play-icon' ); ?></div>
        </div>
        <p class="h1 u-width-8-10">
            <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-teal"><?php the_title(); ?></a>
        </p>
    
    <?php else : ?>
    
        <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-teal">
            <div class="post-thumbnail">
                <?php the_post_thumbnail( 'large', array( 'class' => 'u-display-block' ) ); ?>
            </div>
            <p class="h1 u-width-8-10"><?php the_title(); ?></p>
        </a>
    
    <?php endif; ?>
    

    <div class="u-width-6-10">
        <p class="h6">Featured Event &nbsp;&nbsp;&nbsp; <?php echo date( $date_format, $post_datetime); ?></p>
        <p><?php the_excerpt(); ?></p>
        <p><a href="<?php the_permalink(); ?>" class="u-color-hover-teal">Continue Reading</a></p>
    </div>

</article>