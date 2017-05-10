<?php
namespace HSC\API\PostsEvents;

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
	add_rewrite_tag( "%post-types%", '([^&]+)' );
	add_rewrite_tag( "%categories%", '([^&]+)' );
    add_rewrite_tag( "%page%", '([^&]+)' );
    add_rewrite_tag( "%api-call%", '([^&]+)' );

	add_rewrite_rule(
		'hsc-api/posts-events/([^&]+)/([^&]+)/([^&]+)/([^&]+)/?',
		'index.php?date=$matches[1]&post-types=$matches[2]&categories=$matches[3]&page=$matches[4]&api-call=posts-events',
		'top' );
}


/**
 * Handle requested endpoint
 */
function handle_api_endpoints() {
	global $wp_query;

	$api_call = $wp_query->get( 'api-call' );

	// route api request
	if ( 'posts-events' === $api_call ) {
        posts_events_request();
	} else {
		return;
	}
}


/**
 * Handle project requests
 */
function posts_events_request() {
	global $wp_query;
	$date 		= $wp_query->get( 'date' );
	$page 		= $wp_query->get( 'page' );
	$post_types = explode( '+', $wp_query->get( 'post-types' ) );
	$categories = explode( '+', $wp_query->get( 'categories' ) );

	$date = sanitize_text_field( $date );
	$page = sanitize_text_field( $page );

	foreach ( $post_types as $key => $value ) {
		$post_types[$key] = sanitize_text_field( $value );
	}
	foreach ( $categories as $key => $value ) {
		$categories[$key] = sanitize_text_field( $value );
	}

	$has_date 		= ( 'all_dates' == $date ) ? false : true;
	$has_post_types = ( in_array( 'all_post_types', $post_types ) ) ? false : true;
	$has_categories 	= ( in_array( 'all_categories', $categories ) ) ? false : true;

	// Default to FALSE to get all programs.
	$tax_query = array(
		'relation' => 'AND'
	);
    $meta_query = array();
	$args = array(
		'post_type'  => array('post', 'event'),
		'order'      => 'DESC',
		'orderby'    => 'meta_value',
        'meta_key'   => 'post_datetime',
		'paged'		 => $page,
		'posts_per_page' => 5,
		'ignore_sticky_posts' => true,
	);

	// Check if there are any schools terms
	if ( $has_date ) {
		array_push( $meta_query, array(
			'key' => 'post_datetime',
            'value' => $date,
            'compare' => '>='
		) );
	}

	if ( $has_post_types ) {
		$args['post_type'] = $post_types;
	}

	if ( $has_categories ) {
		array_push( $tax_query, array(
			'taxonomy'  => 'category',
			'field'     => 'slug',
			'terms'     => $categories,
		) );
	}

	$args['tax_query']  = $tax_query;
	$args['meta_query'] = $meta_query;
	
	$query = new \WP_Query( $args );
	$queryData = array( 'total_pages' => $query->max_num_pages, 'found_posts' => intval($query->found_posts), 'current_page' => intval($page) );
	$posts = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			global $post;

			$date_format = get_option('date_format');

            $attachment_id = get_post_thumbnail_id( $post->ID );
			$attachment = array();
			if ( $attachment_id ) {
				$attachment_src = wp_get_attachment_image_src( $attachment_id, 'large' );
				if ( $attachment_src ) {
					$attachment = array(
						'src' => $attachment_src[0],
						'width' => $attachment_src[1],
						'height' => $attachment_src[2],
					);
				}
			}

			$date = get_post_meta( $post->ID, 'post_datetime', true );
			$date_unix = 0;
			$date_string = '';
			if ( $date ) {
				$date_unix = intval($date);
				$date_string = date( $date_format, $date );
			}

			$cats = (array) get_the_terms( $post, 'category' );
			$cat = ( ! empty( $cats ) ) ? $cats[0] : false;
			$label = ( $cat ) ? $cat->name : 'News';
			$event_class = '';
			if ( 'event' == $post->post_type ) {
				$now = time();
				if ( $now < $date ) {
					$label = 'Upcoming Event';
					$event_class = 'event-upcoming';
				} else {
					$label = 'Past Event';
					$event_class = 'event-past';
				}	
			}

			$fake_type = 'news';
			if ( 'event' == $post->post_type ) {
				$fake_type = 'event';
			} elseif ( $cat ) {
				$fake_type = $cat->slug;
			}

			array_push( $posts, array(
				'title' 	=> $post->post_title,
				'excerpt'	=> get_the_excerpt( $post ),
				'slug' => $post->post_name,
				'url'	=> get_the_permalink( $post->ID ),
				'attachment' => $attachment,
				'date_unix' => $date_unix,
				'date_string' => $date_string, 
				'post_class' => implode( ' ', get_post_class($event_class) ),
				'post_type' => $post->post_type,
				'fake_type' => $fake_type,
				'label' => $label,
			) );
		}
		
	} 
	
	wp_reset_query();
	status_header( 200 );
	wp_send_json( array( 'query' => $queryData, 'posts' => $posts ) );

	return;
}
