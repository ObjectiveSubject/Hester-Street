<?php

/**
 * Include metabox on front page
 * @author Ed Townend
 * @link https://github.com/WebDevStudios/CMB2/wiki/Adding-your-own-show_on-filters
 *
 * @param bool $display
 * @param array $meta_box
 * @return bool display metabox
 */
function ed_metabox_include_front_page( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'] ) ) {
        return $display;
    }

    if ( 'front-page' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return false;
    }

    // Get ID of page set as front page, 0 if there isn't one
    $front_page = get_option( 'page_on_front' );

    // there is a front page set and we're on it!
    return $post_id == $front_page;
}
add_filter( 'cmb2_show_on', 'ed_metabox_include_front_page', 10, 2 );


/**
 * Gets the nav menus that have been created
 *
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_nav_menus() {

    $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

    if ( ! $menus )
        return array();

    foreach ( $menus as $menu ) {
        $menu_array[$menu->slug] = $menu->name;
    }

    return $menu_array;
}


/**
 * Gets a number of terms and displays them as options
 *
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_concentrations() {

	$taxonomy = '_area_of_study';
	$terms = (array) get_terms( $taxonomy );

	$concentrations = array();

	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$term_children = get_term_children( $term->term_id, $taxonomy );

			foreach ( $term_children as $child ) {
				$term = get_term_by( 'id', $child, $taxonomy );
				$concentrations[ $term->term_id ] = $term->name;
			}
		}
	}

	return $concentrations;
}

/**
 * Exclude metabox on non top level posts
 * @author Travis Northcutt
 * @link https://gist.github.com/gists/2039760
 *
 * @param bool $display
 * @param array $meta_box
 * @return bool display metabox
 */
function ba_metabox_add_for_top_level_posts_only( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'] ) || 'parent-id' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return $display;
    }

    // If the post doesn't have ancestors, show the box
    if ( ! get_post_ancestors( $post_id ) ) {
        return $display;
    }

    // Otherwise, it's not a top level post, so don't show it
    return false;
}
add_filter( 'cmb2_show_on', 'ba_metabox_add_for_top_level_posts_only', 10, 2 );

/**
 * Metabox for Page Template
 * @author Kenneth White
 * @link https://github.com/WebDevStudios/CMB2/wiki/Adding-your-own-show_on-filters
 *
 * @param bool $display
 * @param array $meta_box
 * @return bool display metabox
 */
function be_metabox_show_on_template( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'], $meta_box['show_on']['value'] ) ) {
        return $display;
    }

    if ( 'template' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return false;
    }

    $template_name = get_page_template_slug( $post_id );
    $template_name = ! empty( $template_name ) ? substr( $template_name, 0, -4 ) : '';

    // See if there's a match
    return in_array( $template_name, (array) $meta_box['show_on']['value'] );
}
add_filter( 'cmb2_show_on', 'be_metabox_show_on_template', 10, 2 );


/**
 * Show metabox if post meta equals provided value
 * @author Tanner Moushey
 * @link https://github.com/WebDevStudios/CMB2/wiki/Adding-your-own-show_on-filters
 *
 * @param bool $display
 * @param array $meta_box
 * @return bool display metabox
 */
function cmb_show_on_meta_value( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['meta_key'] ) ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return $display;
    }

    $value = get_post_meta( $post_id, $meta_box['show_on']['meta_key'], true );

    if ( empty( $meta_box['show_on']['meta_value'] ) ) {
        return (bool) $value;
    }

    return $value == $meta_box['show_on']['meta_value'];
}
add_filter( 'cmb2_show_on', 'cmb_show_on_meta_value', 10, 2 );
