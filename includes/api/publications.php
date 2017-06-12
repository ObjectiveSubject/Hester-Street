<?php
namespace HSC\API\Publications;

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
    add_rewrite_tag( "%date%", '([^&]+)' );
	add_rewrite_tag( "%services%", '([^&]+)' );
    add_rewrite_tag( "%issues%", '([^&]+)' );
    add_rewrite_tag( "%page%", '([^&]+)' );
    add_rewrite_tag( "%api-call%", '([^&]+)' );

	add_rewrite_rule(
		'hsc-api/hsc-publications/([^&]+)/([^&]+)/([^&]+)/([^&]+)/?',
		'index.php?date=$matches[1]&services=$matches[2]&issues=$matches[3]&page=$matches[4]&api-call=publications',
		'top' );
}


/**
 * Handle requested endpoint
 */
function handle_api_endpoints() {
	global $wp_query;

	$api_call = $wp_query->get( 'api-call' );

	// route api request
	if ( 'publications' === $api_call ) {
        publications_request();
	} else {
		return;
	}
}


/**
 * Handle project requests
 */
function publications_request() {
	global $wp_query;
	$date       = $wp_query->get( 'date' );
    $page 		= $wp_query->get( 'page' );
	$services 	= explode( '+', $wp_query->get( 'services' ) );
	$issues 	= explode( '+', $wp_query->get( 'issues' ) );

	$date = sanitize_text_field( $date );
    $page = sanitize_text_field( $page );

	foreach ( $services as $key => $value ) {
		$services[$key] = sanitize_text_field( $value );
	}
	foreach ( $issues as $key => $value ) {
		$issues[$key] = sanitize_text_field( $value );
	}

	// Default to FALSE to get all programs.
	$tax_query = array(
		'relation' => 'AND'
	);
    $date_query = array();

    $has_start_date = ( 'all_dates' == $date ) ? false : true;
	$has_services 	= ( in_array( 'all_services', $services ) ) ? false : true;
	$has_issues 	= ( in_array( 'all_issues', $issues ) ) ? false : true;

	// Check if there are any schools terms
	if ( $has_start_date ) {
		array_push( $date_query, array(
            'after' => date( 'F j, Y g:ia', $date ),
            'inclusive' => true
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

	$args = array(
		'post_type'  => 'publication',
		'tax_query'  => $tax_query,
        'date_query' => $date_query,
		'order'      => 'DESC',
		'orderby'    => 'date',
        'paged'		 => $page,
		'posts_per_page' => 9,
		'ignore_sticky_posts' => true,
		'no_found_rows' => true
	);
	$query = new \WP_Query( $args );
    $queryData = array( 'args' => $args, 'total_pages' => $query->max_num_pages, 'found_posts' => intval($query->found_posts), 'current_page' => intval($page) );
	$posts = array();

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

			array_push( $posts, array(
				'title' 	=> $post->post_title,
				'slug' => $post->post_name,
				'url'	=> get_permalink( $post ),
				'attachment' => $attachment,
				'date_unix' => strtotime( $post->post_date ),
				'date_string' => date( get_option('date_format'), strtotime( $post->post_date ) ), 
				'post_class' => implode( ' ', get_post_class() )
			) );
		}
		
	}
    
    wp_reset_query();
    status_header( 200 );
    wp_send_json( array( 'query' => $queryData, 'posts' => $posts ) );

	return;
}
