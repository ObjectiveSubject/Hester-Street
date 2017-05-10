<?php
/*
 * Sections
 *
 */
?>

<?php while ( the_flexible_field( 'sections' ) ) {
    
    get_template_part( 'partials/section',  get_row_layout() );

} ?>
