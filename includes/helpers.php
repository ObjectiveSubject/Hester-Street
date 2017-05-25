<?php
namespace HSC\Helpers;

/**
 * Get Project Archive localized data.
 *
 * @return array
 */
function get_lcl_data_archive_project() {
	
    $services = get_terms( array( 'taxonomy' => 'service', 'hide_empty' => false, 'parent' => 0 ) );
    foreach ( $services as $service ) {
        $service->children = get_terms( array( 'taxonomy' => 'service', 'hide_empty' => false, 'parent' => $service->term_id ) );
    }
    $issues = get_terms( array( 'taxonomy' => 'issue', 'hide_empty' => false ) );
    $status = get_terms( array( 'taxonomy' => 'status', 'hide_empty' => false ) );
    $locations = get_terms( array( 'taxonomy' => 'location', 'hide_empty' => false, 'parent' => 0 ) );
    foreach ( $locations as $location ) {
        $location->children = get_terms( array( 'taxonomy' => 'location', 'hide_empty' => false, 'parent' => $location->term_id ) );
    }
    
    return array(
        'filterToggles' => array(
            array( 'slug' => 'service', 'name' => 'Services' ),
            array( 'slug' => 'issue', 'name' => 'Issues' ),
            array( 'slug' => 'date', 'name' => 'Date' ),
            array( 'slug' => 'status', 'name' => 'Status' ),
            array( 'slug' => 'location', 'name' => 'Locations')
        ),
        'services' => $services,
        'issues' => $issues,
        'status' => $status,
        'locations' => $locations
    );

}


/**
 * Get Publication Archive localized data.
 *
 * @return array
 */
function get_lcl_data_archive_publication() {
	
    $services = get_terms( array( 'taxonomy' => 'service', 'hide_empty' => false, 'parent' => 0 ) );
    foreach ( $services as $service ) {
        $service->children = get_terms( array( 'taxonomy' => 'service', 'hide_empty' => false, 'parent' => $service->term_id ) );
    }
    $issues = get_terms( array( 'taxonomy' => 'issue', 'hide_empty' => false ) );
    
    return array(
        'filterToggles' => array(
            array( 'slug' => 'service', 'name' => 'Services' ),
            array( 'slug' => 'issue', 'name' => 'Issues' ),
            array( 'slug' => 'date', 'name' => 'Date' )
        ),
        'services' => $services,
        'issues' => $issues,
    );

}


/**
 * Get Publication PDF URL or the post permalink.
 *
 * @return array
 */
function get_publication_url($id = 0) {
    if ( ! $id )
        return;

    $pdf_url = get_field( 'publication_pdf', $id );
    if ( $pdf_url ) {
        return $pdf_url;
    } else {
        return get_permalink( $id );
    }
}