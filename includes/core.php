<?php
namespace HSC\Core;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );
	add_action( 'wp_enqueue_scripts', $n( 'styles' ) );
	add_action( 'after_setup_theme', $n( 'features' ) );
	add_action( 'pre_get_posts', $n( 'modify_queries' ) );
	add_action( 'init', $n( 'add_menus' ) );

	// Remove WordPress header cruft
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_generator' );
}

/**
 * Add feature support to theme
 */
function features() {
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_post_type_support( 'page', 'excerpt' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}

/**
 * Enqueue scripts for front-end.
 *
 * @param bool $debug Whether to enable loading uncompressed/debugging assets. Default false.
 *
 * @return void
 */
function scripts( $debug = false ) {
	global $post;
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Vendors
	wp_register_script( 'mapbox_js', 'https://api.mapbox.com/mapbox-gl-js/v0.36.0/mapbox-gl.js', array(), HSC_VERSION, true );
	wp_register_script( 'turf_js', 'https://api.mapbox.com/mapbox.js/plugins/turf/v2.0.2/turf.min.js', array(), HSC_VERSION, true );
	wp_register_script( 'scrollmagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array(), HSC_VERSION, true );
	wp_register_script( 'vue', HSC_TEMPLATE_URL . "/assets/js/vue{$min}.js", array(), HSC_VERSION, true );

	// Theme scripts
	wp_register_script( 'main', HSC_TEMPLATE_URL . "/assets/js/main{$min}.js", array(), HSC_VERSION, true );
	wp_register_script( 'page-news', HSC_TEMPLATE_URL . "/assets/js/page-news{$min}.js", array('vue'), HSC_VERSION, true );
	wp_register_script( 'single-project', HSC_TEMPLATE_URL . "/assets/js/project{$min}.js", array('vue', 'mapbox_js', 'turf_js', 'scrollmagic'), HSC_VERSION, true );
	wp_register_script( 'project-timeline', HSC_TEMPLATE_URL . "/assets/js/project-timeline{$min}.js", array('vue'), HSC_VERSION, true );
	wp_register_script( 'archive-project', HSC_TEMPLATE_URL . "/assets/js/archive-project{$min}.js", array('vue', 'mapbox_js', 'turf_js', 'scrollmagic'), HSC_VERSION, true );
	wp_register_script( 'archive-publication', HSC_TEMPLATE_URL . "/assets/js/archive-publication{$min}.js", array('vue'), HSC_VERSION, true );

	/* Main
	 * -------------------------------------------------------- */

	wp_enqueue_script('main');
	wp_localize_script( 'main', 'HSC', array(
		'api' => site_url('hsc-api/')
	));

	/* Specific Views
	 * -------------------------------------------------------- */
	
	if ( is_home() && ! is_front_page() ) {
		wp_enqueue_script( 'page-news' );
	}
	if ( is_singular('project') ) {
		wp_enqueue_script( 'single-project' );
		wp_enqueue_script( 'project-timeline' );
		wp_localize_script( 'project-timeline', 'projectData', array( 'id' => $post->ID ) );
	}
	if ( is_post_type_archive( 'project' ) ) {
		wp_enqueue_script( 'archive-project' );
		wp_localize_script( 'archive-project', 'projectFilterData', \HSC\Helpers\get_lcl_data_archive_project() );
	}
	if ( is_post_type_archive( 'publication' ) ) {
		wp_enqueue_script( 'archive-publication' );
		wp_localize_script( 'archive-publication', 'publicationFilterData', \HSC\Helpers\get_lcl_data_archive_publication() );
	}
}

/**
 * Enqueue styles for front-end.
 *
 * @param bool $debug Whether to enable loading uncompressed/debugging assets. Default false.
 *
 * @return void
 */
function styles( $debug = false ) {
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	if ( is_singular( 'project' ) || is_post_type_archive( 'project' ) ) {
		wp_enqueue_style(
			'mapbox_style',
			'https://api.mapbox.com/mapbox-gl-js/v0.36.0/mapbox-gl.css',
			array(),
			'0.36.0'
		);
	}

	wp_enqueue_style(
		'style',
		HSC_URL . "/assets/css/style{$min}.css",
		array(),
		HSC_VERSION
	);
}

/**
 * Modify default queries in specific areas of the site
 *
 * @param $query
 */
function modify_queries( $query ) {

   	// Perform query modifications here
	if ( ! is_admin() && $query->is_main_query() ) {

		if ( is_home() && ! is_front_page() ) {
			// $query->set('post_type', array( 'post', 'event' ));
			// $query->set('orderby', 'meta_value');
			// $query->set('meta_key', 'post_datetime');
			$query->set('posts_per_page', '5');
		}

	}

}

/**
 * Add Menus
 *
 * @param $query
 */
function add_menus() {
	// Register main footer and one for each school
	register_nav_menus(
		array(
			'primary' => 'Primary',
			'secondary' => 'Secondary',
			'footer-primary' => 'Footer Primary',
			'footer-secondary' => 'Footer Secondary',
		)
	);
}
