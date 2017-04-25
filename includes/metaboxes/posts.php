<?php
namespace HSC\MetaBoxes\Posts;

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
	add_action( 'cmb2_init',  $n( 'post_options' ) );
}

function post_options() {

	$prefix = 'post_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Post Options', 'cmb2' ),
		'priority'     => 'high',
		'object_types' => array( 'post' )
	) );

	$cmb->add_field( array(
		'name'	=> __( 'Custom Date & Time', 'cmb2' ),
        'description' => __( 'Used for proper ordering on the front-end', 'cmb2' ),
		'id'  	=> $prefix . 'datetime',
		'type'	=> 'text_datetime_timestamp',
		'default' => time()
	) );

}
