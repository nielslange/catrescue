<?php
/**
 * Theme functions and definitions
 *
 * This file contains the main theme setup, functions, and customizations.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Catrescue
 * @since 1.0
 * @author Niels Lange
 * @license GPL v2 or later
 */

// Load required files.
require get_template_directory() . '/inc/acf.php';
require get_template_directory() . '/inc/class-adoptable-cats.php';
require get_template_directory() . '/inc/disallow-comments.php';
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Modifies the archive title for custom post type archives.
 *
 * @param string $title The archive title.
 * @return string Modified archive title.
 */
function catrescue_modify_archive_title( string $title ): string {
	if ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'catrescue_modify_archive_title' );

/**
 * Enqueues styles and scripts for the theme.
 *
 * @return void
 */
function catrescue_enqueue_scripts(): void {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' );

	wp_enqueue_style( 'catrescue-style', get_stylesheet_uri(), [], $version, 'all' );
	wp_enqueue_script( 'catrescue-script', get_template_directory_uri() . '/assets/js/menu.js', null, $version, true );

	if ( is_page( 'donation' ) || is_page( 'donasi' ) ) {
		wp_enqueue_script( 'catrescue-donation-script', get_template_directory_uri() . '/assets/js/donation.js', null, $version, true );
	}
}
add_action( 'wp_enqueue_scripts', 'catrescue_enqueue_scripts' );

/**
 * Hide Gutenberg editor on certain pages and CPTs.
 *
 * @param bool    $use_block_editor Whether to use the block editor.
 * @param WP_Post $post The post object.
 * @return bool
 */
function hide_gutenberg_editor_for_donation_page( bool $use_block_editor, WP_Post $post ): bool {
	$excluded_pages = [ 'Donation', 'Donasi', 'Home EN', 'Home ID' ];
	$excluded_cpts  = [ 'cats' ];
	if ( in_array( $post->post_title, $excluded_pages, true ) || in_array( $post->post_type, $excluded_cpts, true ) ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'hide_gutenberg_editor_for_donation_page', 10, 2 );

/**
 * Control the number of search results.
 *
 * @param WP_Query $query The query object.
 * @return void
 */
function show_all_search_results( WP_Query $query ): void {
	if ( $query->is_search() && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 10 );
	}
}
add_action( 'pre_get_posts', 'show_all_search_results' );

/**
 * Control the number of cats displayed per page on the archive page.
 *
 * @param WP_Query $query The query object.
 * @return void
 */
function catrescue_modify_cats_per_page( WP_Query $query ): void {
	if ( ! is_admin() && $query->is_post_type_archive( 'cats' ) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 12 );
		$query->set( 'post_status', [ 'publish' ] );

		// Add meta query for adoptable cats
		$query->set(
			'meta_query',
			[
				[
					'key'     => 'adoptable',
					'value'   => '1',
					'compare' => '=',
				],
			]
		);
	}
}
add_action( 'pre_get_posts', 'catrescue_modify_cats_per_page' );
