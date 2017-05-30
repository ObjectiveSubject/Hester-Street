<?php
namespace HSC\API\ProjectTimelines;

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
    add_rewrite_tag( "%project-id%", '([^&]+)' );

	add_rewrite_rule(
		'hsc-api/project-timeline/([^&]+)/?',
		'index.php?project-id=$matches[1]&api-call=project_timeline',
		'top' );
}


/**
 * Handle requested endpoint
 */
function handle_api_endpoints() {
	global $wp_query;

	$api_call = $wp_query->get( 'api-call' );

	// route api request
	if ( 'project_timeline' === $api_call ) {
        project_timeline_request();
	} else {
		return;
	}
}


/**
 * Handle project requests
 */
function project_timeline_request() {
	global $wp_query;
	$project_id = $wp_query->get( 'project-id' );
	$project_id = sanitize_text_field( $project_id );

	$data = array();

	if ( $project_id ) {

        $acf_timeline_items = (array) get_field( 'timeline_items', $project_id );
        $timeline_items = array();
        $date_format = get_option('date_format');

        foreach( $acf_timeline_items as $key => $item ) {

            $item_array = array(
                'id' => 'timeline-node-' . $key
            );

            switch ( $item['acf_fc_layout'] ) {
                case "project_stage":
                    $item_array['type'] = $item['stage_type'];
                    $item_array['layout'] = $item['acf_fc_layout'];
                    $item_array['label'] = ( $item['stage_label'] ) ? $item['stage_label'] : 'Project<br/>' . $item['stage_type']['label'];
                    $item_array['date_string'] = date( $date_format, $item['stage_date'] );
                    $item_array['date_unix'] = $item['stage_date'];
                    $item_array['content'] = $item['stage_content'];
                    break;
                case "publication":
                    $item_array['type'] = 'publication';
                    $item_array['label'] = 'Publication';
                    $item_array['date_string'] = date( $date_format, strtotime( $item['timeline_publication']->post_date ) );
                    $item_array['date_unix'] = strtotime( $item['timeline_publication']->post_date );
                    $item_array['title'] = $item['timeline_publication']->post_title;
                    $item_array['image'] = get_the_post_thumbnail( $item['timeline_publication']->ID, 'large' );
                    $item_array['links'] = array(
                        array('text' => 'Read More &rarr;', 'url' => '#'),
                        array('text' => 'Download &darr;', 'url' => '#')
                    );
                    break; 
                case "event":
                    $item_array['type'] = 'event';
                    $item_array['label'] = 'Event';
                    $item_array['date_string'] = date( $date_format, get_field( 'post_datetime', $item['timeline_event']->ID ) );
                    $item_array['date_unix'] = get_field( 'post_datetime', $item['timeline_event']->ID );
                    $item_array['image'] = get_the_post_thumbnail( $item['timeline_event']->ID, 'large' );
                    $item_array['permalink'] = get_permalink( $item['timeline_event']->ID );
                    $item_array['time_string'] = date( 'g:ia', get_field( 'post_datetime', $item['timeline_event']->ID ) );
                    $item_array['title'] = $item['timeline_event']->post_title;
                    $item_array['venue'] = get_post_meta( $item['timeline_event']->ID, 'event_venue', true);
                    break;
                case "events_recap":
                    $item_array['type'] = 'events_recap';
                    $item_array['label'] = 'Events Recap';
                    $item_array['date_string'] = date( $date_format, $item['recap_date'] );
                    $item_array['date_unix'] = $item['recap_date'];
                    $item_array['title'] = $item['recap_title'];
                    $item_array['desc'] = $item['recap_desc'];
                    $item_array['events'] = $item['recap_events'];
                    foreach( $item_array['events'] as $event ) {
                        $event->date_string = date( $date_format, get_field( 'post_datetime', $event->ID ) );
                        $event->image = get_the_post_thumbnail( $event->ID, 'thumbnail' );
                        $event->permalink = get_permalink( $event->ID );
                    }
                    break;
                default:
                    $item_array = $item;
            }

            if ( ! empty( $item_array ) ) {
                array_push( $timeline_items, $item_array ); 
            }
        }
        
        $data['timeline_items'] = $timeline_items;
        
		status_header( 200 );
		wp_send_json( $data );

	} else {
		status_header( 200 );
		wp_send_json( array('invalid project ID.') );
	}

	return;
}
