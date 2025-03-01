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

/**
 * Include helper files.
 */
require get_template_directory() . '/inc/disallow-comments.php';

/**
 * Load theme text domain.
 */
function catrescue_load_theme_textdomain() {
	load_theme_textdomain( 'catrescue', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'catrescue_load_theme_textdomain' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function catrescue_theme_setup() {
	// Add theme support for features like title tag, post thumbnails, etc.
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

	// Add theme support for custom logo.
	$defaults = array(
		'height'      => 100,
		'width'       => 400,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	);
	add_theme_support( 'custom-logo', $defaults );

	// Register menus.
	register_nav_menus( array(
		'header-menu' => esc_html__( 'Header Menu', 'catrescue' ),
		'mobile-menu' => esc_html__( 'Mobile Menu', 'catrescue' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'catrescue' ),
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'catrescue' ),
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
 */
function catrescue_enqueue_scripts() {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' );

	wp_enqueue_style( 'catrescue-style', get_stylesheet_uri(), array(), $version, 'all' );
	wp_enqueue_script( 'catrescue-script', get_template_directory_uri() . '/assets/js/menu.js', null, $version, true );
}
add_action( 'wp_enqueue_scripts', 'catrescue_enqueue_scripts' );
