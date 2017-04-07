<?php

/**
 * Custom Template Tags
 *
 * Place custom template tags in this file. 
 **/



/**
 * Retrieve the URL of an asset
 *
 * @param string $path : path to asset
 *
 * @return string The url of the asset
 */
function hsc_asset( $path ) {
	return get_template_directory_uri() . '/assets/' . $path;
}


/**
  * Output a series of Open Graph meta tags for social media sharing.
  *
  * @param bool $get : whether to return or echo results
  *
  * @return string Formatted html
  */
 function hsc_open_graph_tags( $echo = true ) {
  	global $post;
  	global $wp;

  	$tags = array(
  		'title' 		=> wp_title( '—', false, 'right' ) . get_bloginfo( 'name' ), // "{page title} - {site title}"
  		'site_name' 	=> get_bloginfo( 'name' ),
  		'description' 	=> get_bloginfo( 'description' ),
  		'url' 			=> home_url( add_query_arg( array(), $wp->request ) ), // get current page url
  		'type' 			=> 'page',
  		'image' 		=> ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( $post->ID, 'thumbnail' ) : hsc_asset( 'images/logo-hsc@2x.png' )
  	);

  	// Contexts
  	if ( is_single() ) {
  		$tags['type'] = 'article';
  	} elseif ( is_archive() ) {
  		$tags['type'] = 'archive';
  	} elseif ( is_search() ) {
  		$tags['type'] = 'search';
  	}

  	$tag_string = array();
  	foreach ( $tags as $prop => $content ) {
  		$tag_string[] = '<meta property="og:'. $prop .'" content="'. $content .'">';
  	}

  	if ( $echo ) {
  		echo implode( '', $tag_string );
  	} else {
  		return $tags;
  	}
  }