<?php

/**
 * Functions and definitions
 */

// Useful global constants
define( 'OS_WP_VERSION',      '0.1.0' );
define( 'OS_WP_URL',          get_stylesheet_directory_uri() );
define( 'OS_WP_TEMPLATE_URL', get_template_directory_uri() );
//define( 'OS_WP_PATH',         get_template_directory() . '/' );
define( 'OS_WP_PATH',         dirname( __FILE__ ) . '/' );
define( 'OS_WP_INC',          OS_WP_PATH . 'includes/' );
define( 'OS_WP_ASSETS',       OS_WP_TEMPLATE_URL . '/assets/' );

// Include compartmentalized functions
require_once OS_WP_INC . 'core.php';

require_once OS_WP_INC . 'cmb2.addons.php';
require_once OS_WP_INC . 'comments.php';
require_once OS_WP_INC . 'metaboxes.php';
require_once OS_WP_INC . 'post-types.php';
require_once OS_WP_INC . 'shortcodes.php';
require_once OS_WP_INC . 'taxonomies.php';
require_once OS_WP_INC . 'template-tags.php';

// Include lib classes
include( OS_WP_INC . 'libraries/extended-cpts.php' );
include( OS_WP_INC . 'libraries/extended-taxos.php' );
include( OS_WP_INC . 'libraries/cmb2/init.php' );
include( OS_WP_INC . 'libraries/cmb2-attached-posts/cmb2-attached-posts-field.php' );
include( OS_WP_INC . 'libraries/cmb2-post-search-field/cmb2_post_search_field.php' );

// Run the setup functions
OS_WP\Core\setup();
OS_WP\Comments\setup();
OS_WP\Shortcodes\setup();
OS_WP\PostTypes\setup();
OS_WP\Taxonomies\setup();
