<?php

/**
 * Functions and definitions
 */

// Useful global constants
define( 'HSC_VERSION',      '0.1.0' );
define( 'HSC_URL',          get_stylesheet_directory_uri() );
define( 'HSC_TEMPLATE_URL', get_template_directory_uri() );
//define( 'HSC_PATH',         get_template_directory() . '/' );
define( 'HSC_PATH',         dirname( __FILE__ ) . '/' );
define( 'HSC_INC',          HSC_PATH . 'includes/' );
define( 'HSC_ASSETS',       HSC_TEMPLATE_URL . '/assets/' );

// Include compartmentalized functions
require_once HSC_INC . 'core.php';

require_once HSC_INC . 'cmb2.addons.php';
require_once HSC_INC . 'api.php';
require_once HSC_INC . 'comments.php';
require_once HSC_INC . 'metaboxes.php';
require_once HSC_INC . 'post-types.php';
require_once HSC_INC . 'shortcodes.php';
require_once HSC_INC . 'taxonomies.php';
require_once HSC_INC . 'template-tags.php';

// Include lib classes
include( HSC_INC . 'libraries/extended-cpts.php' );
include( HSC_INC . 'libraries/extended-taxos.php' );
include( HSC_INC . 'libraries/cmb2/init.php' );
include( HSC_INC . 'libraries/cmb2-attached-posts/cmb2-attached-posts-field.php' );
include( HSC_INC . 'libraries/cmb2-post-search-field/cmb2_post_search_field.php' );

// Run the setup functions
HSC\Core\setup();
HSC\API\setup();
HSC\Comments\setup();
HSC\Shortcodes\setup();
HSC\PostTypes\setup();
HSC\Taxonomies\setup();
