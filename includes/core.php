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
	$min = ( $debug || defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script(
		'main',
		HSC_TEMPLATE_URL . "/assets/js/main{$min}.js",
		array(),
		HSC_VERSION,
		true
	);
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
			$query->set('post_type', array( 'post', 'event' ));
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
			'footer-primary' => 'Footer Primary',
			'footer-secondary' => 'Footer Secondary',
		)
	);
}
