<?php
namespace HSC\MetaBoxes\Events;

/**
 * Metaboxes that appear on more than one post type around the site
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// NOTE: Uncomment to activate metabox
	add_action( 'cmb2_init',  $n( 'event_options' ) );
}

function event_options() {

	$prefix = 'event_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Event Options', 'cmb2' ),
		'priority'     => 'high',
		'object_types' => array( 'event' )
	) );

	$cmb->add_field( array(
		'name'	=> __( 'Date & Time', 'cmb2' ),
		'id'  	=> 'post_datetime', // need to use 'post_' prefix here because we group posts and events together with meta query on front end.
		'type'	=> 'text_datetime_timestamp',
		'default' => time()
	) );

	$cmb->add_field( array(
		'name'	=> __( 'Venue', 'cmb2' ),
		'id'  	=> $prefix . 'venue',
		'type'	=> 'text'
	) );

}
