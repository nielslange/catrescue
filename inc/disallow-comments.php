<?php
/**
 * Disallow comments
 *
 * @package Catrescue
 */

/**
 * Redirect users trying to access the comments page and disable comments features in the dashboard.
 */
function catrescue_disable_comments_in_dashboard() {
	global $pagenow;

	// Redirect any user trying to access comments page.
	if ( 'edit-comments.php' === $pagenow ) {
		wp_safe_redirect( admin_url() );
		exit;
	}

	// Remove comments metabox from dashboard.
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

	// Disable support for comments and trackbacks in post types.
	foreach ( get_post_types() as $post_type ) {
		if ( post_type_supports( $post_type, 'comments' ) ) {
			remove_post_type_support( $post_type, 'comments' );
			remove_post_type_support( $post_type, 'trackbacks' );
		}
	}
}
add_action( 'admin_init', 'catrescue_disable_comments_in_dashboard' );

/**
 * Remove comments page from the admin menu.
 */
function catrescue_remove_comments_page() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'catrescue_remove_comments_page' );

/**
 * Remove comments links from the admin bar.
 */
function catrescue_remove_comments_from_admin_bar() {
	if ( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}
}
add_action( 'init', 'catrescue_remove_comments_from_admin_bar' );

// Close comments on the front-end.
add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );

// Hide existing comments.
add_filter( 'comments_array', '__return_empty_array', 10, 2 );
