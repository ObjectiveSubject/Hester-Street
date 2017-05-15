<?php
/*
 * Section Anchors
 *
 */
?>

<?php if ( have_rows( 'sections' ) ) : ?>

<ul class="list page-anchors">

    <?php while ( the_flexible_field( 'sections' ) ) :
    
        $id = sanitize_key( get_sub_field( 'section_title' ) ); ?>
        
        <li class="list__item"><a href="#<?php echo $id; ?>"><?php the_sub_field( 'section_title' ); ?></a></li>    

    <?php endwhile; ?>

</ul>

<?php endif; ?>