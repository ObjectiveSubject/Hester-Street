<?php
/*
 * Featured Project
 *
 */

$alt_title = get_field( 'project_alt_title' );
$title = ($alt_title) ? $alt_title : get_the_title();
if ( have_rows( 'timeline_items' ) ) {
    $latest_update_unix = 0;
    while( the_flexible_field( 'timeline_items' ) ) {
        switch( get_row_layout() ) {
            case 'event':
                $event = get_sub_field('timeline_event');
                $item_unix = intval( get_field('post_datetime', $event->ID ) );
                break;
            case 'events_recap':
                $item_unix = intval( get_sub_field('recap_date') );
                break;
            case 'project_stage':
                $item_unix = intval( get_sub_field('stage_date') );
                break;
            case 'publication':
                $publication = get_sub_field( 'timeline_publication' );
                $item_unix = strtotime( $publication->post_date ); 
                break;
            default:
                $item_unix = time();
        }
        if ( $item_unix > $latest_update_unix ) {
            $latest_update_unix = $item_unix;
        }
    }
} else {
    $end_date = get_field( 'project_end_date' );
    $begin_date = get_field( 'project_begin_date' );
    $latest_update_unix = (empty( $end_date )) ? $begin_date : $end_date;
}
$latest_update_date = date( 'M Y', $latest_update_unix );
?>
<article <?php post_class(); ?>>

    <a href="<?php the_permalink(); ?>" class="u-display-block u-color-hover-green">
        <?php the_post_thumbnail( 'large', array( 'class' => 'u-display-block' ) ); ?>
        <p class="h1 u-width-8-10"><?php echo $title; ?></p>
    </a>

    <div class="u-width-6-10">
        <p class="h6">Featured Project &nbsp;&nbsp;&nbsp; Last Update <?php echo $latest_update_date; ?></p>
        <p><?php the_excerpt(); ?></p>
        <p><a href="<?php the_permalink(); ?>" class="u-color-hover-green">Continue Reading</a></p>
    </div>

</article>