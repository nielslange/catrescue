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

// Include helper files.
require get_template_directory() . '/inc/disallow-comments.php';

/**
 * Load theme text domain.
 *
 * @return void
 */
function catrescue_load_theme_textdomain(): void {
	load_theme_textdomain( 'catrescue', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'catrescue_load_theme_textdomain' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @return void
 */
function catrescue_theme_setup(): void {
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

	register_nav_menus( array(
		'header-menu' => 'Header Menu',
		'mobile-menu' => 'Mobile Menu',
		'footer-menu' => 'Footer Menu',
	) );

	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'after_setup_theme', 'catrescue_theme_setup' );

/**
 * Enqueues styles and scripts for the theme.
 *
 * @return void
 */
function catrescue_enqueue_scripts(): void {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' );

	wp_enqueue_style( 'catrescue-style', get_stylesheet_uri(), array(), $version, 'all' );
	wp_enqueue_script( 'catrescue-script', get_template_directory_uri() . '/assets/js/menu.js', null, $version, true );

	if ( is_page( 'donation' ) || is_page( 'donasi' ) ) {
		wp_enqueue_script( 'catrescue-donation-script', get_template_directory_uri() . '/assets/js/donation.js', null, $version, true );
	}
}
add_action( 'wp_enqueue_scripts', 'catrescue_enqueue_scripts' );

/**
 * Hide Gutenberg editor on page when title is "Donation", but show the editor for other pages.
 *
 * @param bool    $use_block_editor Whether to use the block editor.
 * @param WP_Post $post The post object.
 * @return bool
 */
function hide_gutenberg_editor_for_donation_page( bool $use_block_editor, WP_Post $post ): bool {
	$excluded_pages = array( 'Donation', 'Donasi', 'Home EN', 'Home ID' );
	if ( in_array( $post->post_title, $excluded_pages, true ) ) {
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
