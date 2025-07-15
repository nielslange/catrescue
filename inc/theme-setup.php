<?php
/**
 * Theme setup functionality
 *
 * @package Catrescue
 * @since 1.0
 * @author Niels Lange
 * @license GPL v2 or later
 */

declare( strict_types=1 );
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'catrescue_add_theme_support' ) ) {
	/**
	 * Add theme support.
	 *
	 * @return void
	 */
	function catrescue_add_theme_support(): void {
		add_theme_support( 'align-wide' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
	}
	add_action( 'after_setup_theme', 'catrescue_add_theme_support' );
}

if ( ! function_exists( 'catrescue_register_nav_menus' ) ) {
	/**
	 * Register nav menus.
	 *
	 * @return void
	 */
	function catrescue_register_nav_menus(): void {
		register_nav_menus(
			[
				'header-menu' => 'Header Menu',
				'mobile-menu' => 'Mobile Menu',
				'footer-menu' => 'Footer Menu',
			]
		);
	}
	add_action( 'after_setup_theme', 'catrescue_register_nav_menus' );
}

if ( ! function_exists( 'catrescue_register_sidebar' ) ) {
	/**
	 * Register sidebar.
	 *
	 * @return void
	 */
	function catrescue_register_sidebar(): void {
		register_sidebar(
			[
				'name'          => 'Sidebar',
				'id'            => 'sidebar',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);
	}
	add_action( 'after_setup_theme', 'catrescue_register_sidebar' );
}

if ( ! function_exists( 'catrescue_load_theme_textdomain' ) ) {
	/**
	 * Load theme textdomain.
	 *
	 * @return void
	 */
	function catrescue_load_theme_textdomain(): void {
		load_theme_textdomain( 'catrescue', get_template_directory() . '/languages' );
	}
	add_action( 'after_setup_theme', 'catrescue_load_theme_textdomain' );
}
