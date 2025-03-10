<?php
/**
 * Adoptable Cats Custom Post Type
 *
 * @package YourTheme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Adoptable_Cats
 *
 * Handles registration and configuration of the Adoptable Cats custom post type
 */
class Adoptable_Cats {
	/**
	 * Post type name/key
	 *
	 * @var string
	 */
	private string $post_type = 'cats';

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );
		add_action( 'after_switch_theme', array( $this, 'flush_rewrite_rules' ) );
	}

	/**
	 * Register the custom post type
	 *
	 * @return void
	 */
	public function register_post_type(): void {
		$labels = array(
			'name'          => _x( 'Cats', 'Post type general name', 'catrescue' ),
			'singular_name' => _x( 'Cat', 'Post type singular name', 'catrescue' ),
			'menu_name'     => _x( 'Cats', 'Admin Menu text', 'catrescue' ),
			'add_new_item'  => __( 'Add New Cat', 'catrescue' ),
			'edit_item'     => __( 'Edit Cat', 'catrescue' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'supports'            => array( 'title', 'thumbnail' ),
			'menu_icon'           => 'dashicons-pets',
			'has_archive'         => true,
			'publicly_queryable'  => true,
			'show_in_rest'        => true,
			'hierarchical'        => false,
			'exclude_from_search' => false,
		);

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register the taxonomy
	 *
	 * @return void
	 */
	public function register_taxonomy(): void {
		$labels = array(
			'name'          => _x( 'Location', 'Location taxonomy general name', 'catrescue' ),
			'singular_name' => _x( 'Location', 'Location taxonomy singular name', 'catrescue' ),
			'add_new_item'  => __( 'Add New Location', 'catrescue' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_admin_column' => true,
		);

		register_taxonomy( 'location', array( $this->post_type ), $args );
	}

	/**
	 * Flush rewrite rules on theme switch
	 *
	 * @return void
	 */
	public function flush_rewrite_rules(): void {
		$this->register_post_type();
		flush_rewrite_rules();
	}
}

/**
 * Initialize the Adoptable_Cats class
 */
new Adoptable_Cats();
