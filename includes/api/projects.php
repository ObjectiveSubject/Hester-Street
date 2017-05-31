<?php
namespace HSC\API\Projects;

/**
 * Set up the programs endpoint of the CGU API
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n( 'add_endpoint' ) );
	add_action( 'template_redirect', $n( 'handle_api_endpoints' ) );
}

/**
 * Create our json endpoint by adding new rewrite rules to WordPress
 */
function add_endpoint(){
    add_rewrite_tag( "%start-date%", '([^&]+)' );
	add_rewrite_tag( "%services%", '([^&]+)' );
    add_rewrite_tag( "%issues%", '([^&]+)' );
	add_rewrite_tag( "%status%", '([^&]+)' );
	add_rewrite_tag( "%locations%", '([^&]+)' );
    add_rewrite_tag( "%api-call%", '([^&]+)' );

	add_rewrite_rule(
		'hsc-api/projects/([^&]+)/([^&]+)/([^&]+)/([^&]+)/([^&]+)/?',
		'index.php?start-date=$matches[1]&services=$matches[2]&issues=$matches[3]&status=$matches[4]&locations=$matches[5]&api-call=projects',
		'top' );
}


/**
 * Handle requested endpoint
 */
function handle_api_endpoints() {
	global $wp_query;

	$api_call = $wp_query->get( 'api-call' );

	// route api request
	if ( 'projects' === $api_call ) {
        projects_request();
	} else {
		return;
	}
}


/**
 * Handle project requests
 */
function projects_request() {
	global $wp_query;
	$start_date = $wp_query->get( 'start-date' );
	$services 	= explode( '+', $wp_query->get( 'services' ) );
	$issues 	= explode( '+', $wp_query->get( 'issues' ) );
    $status 	= explode( '+', $wp_query->get( 'status' ) );
    $locations 	= explode( '+', $wp_query->get( 'locations' ) );

	$start_date = sanitize_text_field( $start_date );

	foreach ( $services as $key => $value ) {
		$services[$key] = sanitize_text_field( $value );
	}
	foreach ( $issues as $key => $value ) {
		$issues[$key] = sanitize_text_field( $value );
	}
    foreach ( $status as $key => $value ) {
		$status[$key] = sanitize_text_field( $value );
	}
    foreach ( $locations as $key => $value ) {
		$locations[$key] = sanitize_text_field( $value );
	}

	// Default to FALSE to get all programs.
	$tax_query = array(
		'relation' => 'AND'
	);
    $meta_query = array();

    $has_start_date = ( 'all_dates' == $start_date ) ? false : true;
	$has_services 	= ( in_array( 'all_services', $services ) ) ? false : true;
	$has_issues 	= ( in_array( 'all_issues', $issues ) ) ? false : true;
	$has_status 	= ( in_array( 'all_status', $status ) ) ? false : true;
    $has_locations 	= ( in_array( 'all_locations', $locations ) ) ? false : true;

	// Check if there are any schools terms
	if ( $has_start_date ) {
		array_push( $meta_query, array(
			'key' => 'project_begin_date',
            'value' => date( 'Ymd', $start_date),
            'compare' => '>=',
			'type' => 'DATE'
		) );
	}

	if ( $has_services ) {
		array_push( $tax_query, array(
			'taxonomy'  => 'service',
			'field'     => 'slug',
			'terms'     => $services,
		) );
	}

	if ( $has_issues ) {
		array_push( $tax_query, array(
			'taxonomy'  => 'issue',
			'field'     => 'slug',
			'terms'     => $issues,
		) );
	}

	if ( $has_status ) {
		array_push( $tax_query, array(
			'taxonomy'  => 'status',
			'field'     => 'slug',
			'terms'     => $status,
		) );
	}

	if ( $has_locations ) {
		array_push( $tax_query, array(
			'taxonomy'  => 'location',
			'field'     => 'slug',
			'terms'     => $locations,
		) );
	}

	$args = array(
		'post_type'  => 'project',
		'tax_query'  => $tax_query,
        'meta_query' => $meta_query,
		'order'      => 'DESC',
		'orderby'    => 'meta_value',
        'meta_key'   => 'project_begin_date',
		'posts_per_page' => 500,
		'post_parent' => 0,
		'ignore_sticky_posts' => true,
		'no_found_rows' => true
	);
	$query = new \WP_Query( $args );
	$data = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			global $post;

            $attachment_id = get_post_thumbnail_id( $post->ID );
			$attachment_src = wp_get_attachment_image_src( $attachment_id, 'large' );
            $attachment = array();
			if ( $attachment_src ) {
				$attachment = array(
					'src' => $attachment_src[0],
					'width' => $attachment_src[1],
					'height' => $attachment_src[2],
				);
			}

			$begin = get_field( 'project_begin_date', $post->ID );
			$begin_string = date( 'Y', intval($begin) );
			$end = get_field( 'project_end_date', $post->ID );
			if ( ! $end ) {
				$end_string = 'Present';
			} else {
				$end_string = date( 'Y', intval($end) );
			}

			array_push( $data, array(
				'title' 	=> $post->post_title,
                'title_alt' => get_field( 'project_alt_title', $post->ID ),
				'slug' => $post->post_name,
				'url'	=> get_the_permalink( $post->ID ),
				'attachment' => $attachment,
				'begin_date' => get_field( 'project_begin_date', $post->ID ),
                'end_date' => get_field( 'project_end_date', $post->ID ),
				'date_string' => $begin_string . ' – ' . $end_string, 
                'geojson' => get_field( 'project_geojson', $post->ID ),
				'post_class' => implode( ' ', get_post_class() )
			) );
		}
		wp_reset_query();
		status_header( 200 );
		wp_send_json( $data );
	} else {
		wp_reset_query();
		status_header( 200 );
		wp_send_json( array() );
	}

	return;
}
