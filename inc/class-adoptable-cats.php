<?php
/**
 * Custom Post Types and Taxonomies
 *
 * @package Catrescue
 * @since 1.0
 * @author Niels Lange
 * @license GPL v2 or later
 */

declare( strict_types=1 );
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'catrescue_register_post_type' ) ) {
	/**
	 * Register the custom post type
	 *
	 * @return void
	 */
	function catrescue_register_post_type(): void {
		$labels = [
			'name'          => _x( 'Cats', 'Post type general name', 'catrescue' ),
			'singular_name' => _x( 'Cat', 'Post type singular name', 'catrescue' ),
			'menu_name'     => _x( 'Cats', 'Admin Menu text', 'catrescue' ),
			'add_new_item'  => __( 'Add New Cat', 'catrescue' ),
			'edit_item'     => __( 'Edit Cat', 'catrescue' ),
		];

		$args = [
			'labels'              => $labels,
			'public'              => true,
			'supports'            => [ 'title', 'thumbnail' ],
			'menu_icon'           => 'dashicons-pets',
			'has_archive'         => true,
			'publicly_queryable'  => true,
			'show_in_rest'        => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
		];

		register_post_type( 'cats', $args );
	}
	add_action( 'init', 'catrescue_register_post_type' );
}

if ( ! function_exists( 'catrescue_register_taxonomy' ) ) {
	/**
	 * Register the custom taxonomy
	 *
	 * @return void
	 */
	function catrescue_register_taxonomy(): void {
		$labels = [
			'name'          => _x( 'Location', 'Location taxonomy general name', 'catrescue' ),
			'singular_name' => _x( 'Location', 'Location taxonomy singular name', 'catrescue' ),
			'add_new_item'  => __( 'Add New Location', 'catrescue' ),
		];

		$args = [
			'labels'            => $labels,
			'public'            => true,
			'show_admin_column' => true,
		];

		register_taxonomy( 'location', 'cats', $args );
	}
	add_action( 'init', 'catrescue_register_taxonomy' );
}

if ( ! function_exists( 'catrescue_flush_rewrite_rules' ) ) {
	/**
	 * Flush rewrite rules on theme switch
	 *
	 * @return void
	 */
	function catrescue_flush_rewrite_rules(): void {
		flush_rewrite_rules();
	}
	add_action( 'after_switch_theme', 'catrescue_flush_rewrite_rules' );
}
