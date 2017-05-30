<?php
/*
 * Secondary Project
 *
 */

$begin_date = get_field( 'project_begin_date' );
$end_date = get_field( 'project_end_date' );
$date_string = array();
if ( $begin_date ) $date_string[] = date( 'M. Y', $begin_date );
$date_string[] = ( $end_date ) ? date( 'M. Y', $end_date ) : 'Present';
?>
<article <?php post_class(); ?>>

    <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-green">
        <?php the_post_thumbnail( 'large', array( 'class' => 'u-display-block' ) ); ?>
        <p class="h4"><?php the_title(); ?></p>
    </a>

    <p class="h6">Project &nbsp;&nbsp;&nbsp; <?php echo implode( '–', $date_string ); ?></p>
    <p><?php the_excerpt(); ?></p>
    <p><a href="<?php the_permalink(); ?>" class="u-color-hover-green"><?php _e( 'Continue Reading', 'hsc' ); echo ' &rarr;' ?></a></p>

</article>