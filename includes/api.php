<?php
namespace HSC\API;

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
            'value' => $start_date,
            'compare' => '>='
		) );
	}
	// Check if there are any areas_of_study terms
	// if ( $has_roles ) {
	// 	array_push( $tax_query, array(
	// 		'taxonomy'  => 'role',
	// 		'field'     => 'slug',
	// 		'terms'     => $roles,
	// 	) );
	// }

	// Check for degree_type terms
	// if ( $has_expertise ) {
	// 	array_push( $tax_query, array(
	// 		'taxonomy'  => 'expertise',
	// 		'field'     => 'slug',
	// 		'terms'     => $expertise,
	// 	) );
	// }

	$args = array(
		'post_type'  => 'project',
		'tax_query'  => $tax_query,
        'meta_query' => $meta_query,
		'order'      => 'ASC',
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

			$begin = get_post_meta( $post->ID, 'project_begin_date', true );
			$end = get_post_meta( $post->ID, 'project_end_date', true );
			if ( ! $end ) {
				$begin_string = date( 'M. Y', $begin );
				$end_string = 'Present';
			} else {
				if ( date( 'Y', $begin ) == date( 'Y', $end ) ) {
					$begin_string = date( 'M', $begin );
				} else {
					$begin_string = date( 'M. Y', $begin );
				}
				$end_string = date( 'M. Y', $end );
			}

			array_push( $data, array(
				'title' 	=> $post->post_title,
                'title_alt' => get_post_meta( $post->ID, 'project_alt_title', true ),
				'slug' => $post->post_name,
				'url'	=> get_the_permalink( $post->ID ),
				'attachment' => $attachment,
				'begin_date' => get_post_meta( $post->ID, 'project_begin_date', true ),
                'end_date' => get_post_meta( $post->ID, 'project_end_date', true ),
				'date_string' => $begin_string . ' – ' . $end_string, 
                'geojson' => get_post_meta( $post->ID, 'project_geojson', true ),
				'post_class' => implode( ' ', get_post_class() )
			) );
		}
		wp_reset_query();
		status_header( 200 );
		wp_send_json( $data );
	}

	return;
}


/**
 * Handle program requests
 */
// function programs_request() {
//     global $wp_query;

// 	// Separate queries into arrays
// 	$query_schools = explode( ',', $wp_query->get( 'schools' ) );
// 	$query_areas_of_study = explode( ',', $wp_query->get( 'areas-of-study' ) );
// 	$query_degree_types 	= explode( ',', $wp_query->get( 'degree-types' ) );

// 	// Sanitize
// 	foreach ( $query_schools as $key => $value ) {
// 	    $query_schools[$key] = sanitize_text_field( $value );
//     }
// 	foreach ( $query_areas_of_study as $key => $value ) {
// 	    $query_areas_of_study[$key] = sanitize_text_field( $value );
//     }
// 	foreach ( $query_degree_types as $key => $value ) {
// 	    $query_degree_types[$key] = sanitize_text_field( $value );
//     }

// 	// Default to FALSE to get all programs.
// 	$tax_query = array(
// 		'relation' => 'AND'
// 	);

// 	// Check if there are any schools terms
// 	$query_has_schools = ( ! in_array( 'all_schools', $query_schools ) ) ? true : false;
// 	if ( $query_has_schools ) {
// 		array_push( $tax_query, array(
// 			'taxonomy'  => '_school',
// 			'field'     => 'slug',
// 			'terms'     => $query_schools,
// 		) );
// 	}

// 	// Check if there are any areas_of_study terms
// 	$query_has_areas_of_study = ( ! in_array( 'all_areas_of_study', $query_areas_of_study ) ) ? true : false;
// 	if ( $query_has_areas_of_study ) {
// 		array_push( $tax_query, array(
// 			'taxonomy'  => '_area_of_study',
// 			'field'     => 'slug',
// 			'terms'     => $query_areas_of_study,
// 		) );
// 	}

// 	// Check for degree_type terms
// 	$query_has_degree_types = ( ! in_array( 'all_degree_types', $query_degree_types ) ) ? true : false;
// 	if ( $query_has_degree_types ) {
// 		array_push( $tax_query, array(
// 			'taxonomy'  => 'degree_type',
// 			'field'     => 'slug',
// 			'terms'     => $query_degree_types,
// 		) );
// 	}

// 	// Perform query
// 	$args = array(
//         'post_type' => 'program',
//         'tax_query' => $tax_query,
//         'order'     => 'ASC',
//         'orderby'   => 'title',
//         'posts_per_page' => 500,
// 		'post_parent' => 0,
//         'ignore_sticky_posts' => true,
//         'no_found_rows' => true
//     );
//     $query = new \WP_Query( $args );
//     $data = array();

// 	// Loop through query results
//     if ( $query->have_posts() ) {
//         while ( $query->have_posts() ) {
//             $query->the_post();
//             global $post;

// 			// Get program concentration, if any.
// 	        $post_concentration = '';
// 			$term_id = (int) get_post_meta( $post->ID, 'program_concentration', true );

// 			if ( $term_id ) {
// 				$term = get_term_by( 'id', $term_id, '_area_of_study' );
// 				if ( $term ) {
// 					$post_concentration = $term->name;
// 				}
// 			}

// 			// Get area of study terms
// 			$post_areas_of_study = false;
// 			$post_area_of_study_terms = get_the_terms( $post->ID, '_area_of_study' );
// 			if ( $post_area_of_study_terms ) {
// 				$post_areas_of_study = array();
// 				foreach ( $post_area_of_study_terms as $term ) {
// 					if ( !$term->parent ) { array_push( $post_areas_of_study, $term->slug ); }
// 				}
// 			}

// 			// Get degree type terms
// 			$post_degree_type_terms = get_the_terms( $post->ID, 'degree_type' );
// 			if ( $post_degree_type_terms ) {
// 				foreach ( $post_degree_type_terms as $term ) {
// 					$term->degree_order = get_term_meta( $term->term_id, 'degree_type_term_order', true );
// 				}
// 			}

// 			// Loop through degree types and place a program object for each term.
// 			// Because of the way we're sorting programs by degree type in the JavaScript,
// 			// this is the easiest way to show programs in multiple degree type groups.
// 			if ( $post_degree_type_terms ) {
// 				foreach ( $post_degree_type_terms as $term ) {

// 					$program_data = array(
// 						'program_title' => $post->post_title,
// 						'program_id'	=> $post->ID,
// 						'url'           => get_permalink( $post->ID ),
// 						'concentration' => $post_concentration,
// 						'degree_type'	=> $term->name,
// 						'degree_order'	=> ( $term->degree_order ) ? $term->degree_order : 0,
// 						'degree_slug'	=> $term->slug,
// 						'areas_of_study'=> $post_areas_of_study,
// 						'degree_awarded'=> get_post_meta( $post->ID, 'program_degree_awarded', true )
// 					);

// 					// if certain degree types are specifically queried and this
// 					// term's slug is NOT one of them, don't return it.
// 					if ( $query_has_degree_types && ! in_array( $term->slug, $query_degree_types ) ) {
// 						continue;
// 					} else {
// 						array_push( $data, $program_data );
// 					}

// 				}
// 			}

//         }

// 	}

// 	wp_reset_query();
// 	wp_send_json( $data );

//     return;
// }
