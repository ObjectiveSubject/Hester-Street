<?php
namespace HSC\MetaBoxes\TeamMembers;

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
	add_action( 'cmb2_init',  $n( 'member_options' ) );
}

function member_options() {

	$prefix = 'member_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Team Member Options', 'cmb2' ),
		'priority'     => 'high',
		'object_types' => array( 'team_member' )
	) );

    $cmb->add_field( array(
		'name'	=> __( 'Title', 'cmb2' ),
		'id'  	=> $prefix . 'title',
		'type'	=> 'textarea_small'
	) );

	$cmb->add_field( array(
		'name'	=> __( 'Scope Focus Areas', 'cmb2' ),
		'id'  	=> $prefix . 'scope_areas',
		'type'	=> 'textarea_small'
	) );

    $cmb->add_field( array(
		'name'	=> __( 'Issue Focus Areas', 'cmb2' ),
		'id'  	=> $prefix . 'issue_areas',
		'type'	=> 'textarea_small'
	) );

    $cmb->add_field( array(
		'name'	=> __( 'Website', 'cmb2' ),
		'id'  	=> $prefix . 'website',
		'type'	=> 'text'
	) );

    $cmb->add_field( array(
		'name'	=> __( 'Link Action', 'cmb2' ),
        'desc'	=> __( 'Link directly to website &uarr; (this member\'s page will be ignored)', 'cmb2' ),
		'id'  	=> $prefix . 'link_action',
		'type'	=> 'checkbox'
	) );

}
