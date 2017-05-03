<?php
namespace HSC\Taxonomies;

/**
 * Set up taxonomies.
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// NOTE: Uncomment to activate taxonomy
	add_action( 'init', $n( 'register_taxonomies' ) );

}

/**
 * Register the my_taxo taxonomy and assign it to posts.
 *
 * See https://github.com/johnbillion/extended-taxos for more info on using the extended-taxos library
 */
function register_taxonomies() {

	register_extended_taxonomy( 'service', array('project', 'publication') );
	register_extended_taxonomy( 'issue', array('project', 'publication') );
	register_extended_taxonomy( 'location', array('project') );
	register_extended_taxonomy( 'status', array('project'), array( 'meta_box' => 'radio' ), array(
		# Override the base names used for labels:
		'singular' => 'Status',
		'plural'   => 'Status',
		'slug'     => 'status',
	) );
	register_extended_taxonomy( 'team_role', array('team_member'), array(), array(
		# Override the base names used for labels:
		'singular' => 'Role',
		'plural'   => 'Roles',
		'slug'     => 'roles'
	) );

}
