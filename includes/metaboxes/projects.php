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
        'name'	=> __( 'Alternate Title', 'cmb2' ),
        'id'  	=> $prefix . 'alt_title',
        'type'    => 'text'
    ) );

    $cmb->add_field( array(
        'name'	=> __( 'Subtitle', 'cmb2' ),
        'id'  	=> $prefix . 'subtitle',
        'type'    => 'text'
    ) );

    $cmb->add_field( array(
		'name'	=> __( 'Begin Date', 'cmb2' ),
		'id'  	=> $prefix . 'begin_date', // need to use 'post_' prefix here because we group posts and events together with meta query on front end.
		'type'	=> 'text_date_timestamp',
		'default' => time()
	) );

    $cmb->add_field( array(
		'name'	=> __( 'End Date', 'cmb2' ),
        'desc'	=> __( 'Leave blank for ongoing projects', 'cmb2' ),
		'id'  	=> $prefix . 'end_date', // need to use 'post_' prefix here because we group posts and events together with meta query on front end.
		'type'	=> 'text_date_timestamp',
	) );
    
    $cmb->add_field( array(
		'name'	=> __( 'Project Site', 'cmb2' ),
		'id'  	=> $prefix . 'site', // need to use 'post_' prefix here because we group posts and events together with meta query on front end.
		'type'	=> 'text',
	) );

    $cmb->add_field( array(
		'name'	=> __( 'Project Site URL', 'cmb2' ),
		'id'  	=> $prefix . 'site_url', // need to use 'post_' prefix here because we group posts and events together with meta query on front end.
		'type'	=> 'text',
	) );

    $cmb->add_field( array(
        'name'	=> __( 'Project Team Members', 'cmb2' ),
        'id'  	=> $prefix . 'team_members',
        'type'    => 'custom_attached_posts',
        'options' => array(
            'filter_boxes'    => true, // Show a text box for filtering the results
            'query_args'      => array( 
                'post_type' => 'team_member', 
                'posts_per_page' => 500, 
                'tax_query' => array( 
                    array( 
                        'taxonomy' => 'team_role', 
                        'field' => 'slug', 
                        'terms' => array('staff'),
                    ) 
                ) 
            ),
        )
    ) );

    $cmb->add_field( array(
        'name'	=> __( 'Project Collaborators', 'cmb2' ),
        'id'  	=> $prefix . 'collaborators',
        'type'    => 'custom_attached_posts',
        'options' => array(
            'filter_boxes'    => true, // Show a text box for filtering the results
            'query_args'      => array( 
                'post_type' => 'team_member', 
                'posts_per_page' => 500, 
                'tax_query' => array( 
                    array( 
                        'taxonomy' => 'team_role', 
                        'field' => 'slug', 
                        'terms' => array('collaborators'),
                    ) 
                ) 
            ),
        )
    ) );

    $cmb->add_field( array(
        'name'	=> __( 'Project Partners', 'cmb2' ),
        'id'  	=> $prefix . 'partners',
        'type'    => 'custom_attached_posts',
        'options' => array(
            'filter_boxes'    => true, // Show a text box for filtering the results
            'query_args'      => array( 
                'post_type' => 'team_member', 
                'posts_per_page' => 500, 
                'tax_query' => array( 
                    array( 
                        'taxonomy' => 'team_role', 
                        'field' => 'slug', 
                        'terms' => array('partners', 'supporters') 
                    ) 
                ) 
            ),
        )
    ) );
	
	$cmb->add_field( array(
        'name'	=> __( 'Project Events', 'cmb2' ),
        'id'  	=> $prefix . 'events',
        'type'    => 'custom_attached_posts',
        'options' => array(
            // 'show_thumbnails' => true, // Show thumbnails on the left
            'filter_boxes'    => true, // Show a text box for filtering the results
            'query_args'      => array( 'post_type' => 'event', 'posts_per_page' => 500 ), // override the get_posts args
        )
    ) );

}
