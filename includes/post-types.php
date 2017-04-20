<?php
namespace HSC\PostTypes;

/**
 * Set up post types
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// NOTE: Uncomment to activate post type
	add_action( 'init', $n( 'register_my_post_types' ) );

}

/**
 * Register the 'my_post_type' post type
 *
 * See https://github.com/johnbillion/extended-cpts for more information
 * on registering post types with the extended-cpts library.
 */
function register_my_post_types() {
	
	register_extended_post_type( 'project', array(
		'menu_icon' 		=> 'dashicons-media-spreadsheet',
		'supports' 			=> array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'has_archive'		=> true
	) );

	register_extended_post_type( 'team_member', array(
		'menu_icon' 		=> 'dashicons-businessman',
		'supports' 			=> array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'has_archive'		=> true
	) );

	register_extended_post_type( 'event', array(
		'menu_icon' 		=> 'dashicons-calendar-alt',
		'supports' 			=> array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		// 'has_archive'		=> true,
		'admin_cols' => array(
			// 'featured_image' => array(
			// 	'title'          => 'Illustration',
			// 	'featured_image' => 'thumbnail'
			// ),
			'datetime' => array(
				'title'       => 'Date & Time',
				'meta_key'    => 'event_datetime',
				'date_format' => get_option( 'date_format' ) . ', g:ia'
			),
			// 'genre' => array(
			// 	'taxonomy' => 'genre'
			// )
		),
	) );

	register_extended_post_type( 'publication', array(
		'menu_icon' 		=> 'dashicons-book-alt',
		'supports' 			=> array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'has_archive'		=> true
	) );

}
