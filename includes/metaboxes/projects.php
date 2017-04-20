<?php
namespace HSC\MetaBoxes\Projects;

/**
 * Metaboxes that appear on more than one post type around the site
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'cmb2_init',  $n( 'project_options' ) );
}

function project_options() {

	$prefix = 'project_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Project Options', 'cmb2' ),
		'priority'     => 'high',
		'object_types' => array( 'project' )
	) );

    $cmb->add_field( array(
        'name'	=> __( 'Associated Events', 'cmb2' ),
        'id'  	=> $prefix . 'events',
        'type'    => 'custom_attached_posts',
        'options' => array(
            // 'show_thumbnails' => true, // Show thumbnails on the left
            'filter_boxes'    => true, // Show a text box for filtering the results
            'query_args'      => array( 'post_type' => 'event', 'posts_per_page' => 500 ), // override the get_posts args
        )
    ) );

}
