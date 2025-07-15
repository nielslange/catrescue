<?php
/**
 * ACF compatibility check and configuration
 *
 * This file handles the Advanced Custom Fields (ACF) compatibility check
 * and configuration for the Leuchtturm theme. It ensures ACF is active and
 * sets up the JSON save location for ACF field groups.
 *
 * @package Catrescue
 * @since 1.0
 * @author Niels Lange
 * @license GPL v2 or later
 */

declare( strict_types=1 );
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ACF' ) ) {
	$message = 'ACF is not active. Please install and activate the Advanced Custom Fields plugin.';

	if ( ! is_admin() ) {
		wp_die( esc_html( $message ) );
	}

	add_action(
		'admin_notices',
		function () use ( $message ) {
			printf( '<div class="notice notice-error"><p>%s</p></div>', esc_html( $message ) );
		}
	);
}

add_action(
	'after_setup_theme',
	function () {
		add_filter( 'acf/settings/save_json', 'leuchtturm_save_json' );
		add_filter( 'acf/settings/load_json', 'leuchtturm_load_json' );
	}
);

if ( ! function_exists( 'leuchtturm_save_json' ) ) {
	/**
	 * Set the ACF JSON save location
	 *
	 * This function sets the directory where ACF will save its JSON files
	 * for field group synchronization. The JSON files are stored in the
	 * theme's inc/acf-json directory.
	 *
	 * @since 1.0.0
	 * @return string The path to the ACF JSON save directory
	 */
	function leuchtturm_save_json(): string {
		return get_stylesheet_directory() . '/inc/acf-json';
	}
}

if ( ! function_exists( 'leuchtturm_load_json' ) ) {
	/**
	 * Set the ACF JSON load location
	 *
	 * This function sets the directory where ACF will load its JSON files
	 * for field group synchronization. The JSON files are loaded from the
	 * theme's inc/acf-json directory.
	 *
	 * @since 1.0.0
	 * @return array The paths to the ACF JSON load directories
	 */
	function leuchtturm_load_json(): array {
		return [ get_stylesheet_directory() . '/inc/acf-json' ];
	}
}
