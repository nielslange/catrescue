<?php

// Register Custom Post Type
function cats() {

	$labels = array(
		'name'                  => _x( 'Cats', 'Cat General Name', 'smntcs_cat' ),
		'singular_name'         => _x( 'Cat', 'Cat Singular Name', 'smntcs_cat' ),
		'menu_name'             => __( 'Cats', 'smntcs_cat' ),
		'name_admin_bar'        => __( 'Cat', 'smntcs_cat' ),
		'archives'              => __( 'Item Archives', 'smntcs_cat' ),
		'attributes'            => __( 'Item Attributes', 'smntcs_cat' ),
		'parent_item_colon'     => __( 'Parent Item:', 'smntcs_cat' ),
		'all_items'             => __( 'All Items', 'smntcs_cat' ),
		'add_new_item'          => __( 'Add New Item', 'smntcs_cat' ),
		'add_new'               => __( 'Add New', 'smntcs_cat' ),
		'new_item'              => __( 'New Item', 'smntcs_cat' ),
		'edit_item'             => __( 'Edit Item', 'smntcs_cat' ),
		'update_item'           => __( 'Update Item', 'smntcs_cat' ),
		'view_item'             => __( 'View Item', 'smntcs_cat' ),
		'view_items'            => __( 'View Items', 'smntcs_cat' ),
		'search_items'          => __( 'Search Item', 'smntcs_cat' ),
		'not_found'             => __( 'Not found', 'smntcs_cat' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'smntcs_cat' ),
		'featured_image'        => __( 'Featured Image', 'smntcs_cat' ),
		'set_featured_image'    => __( 'Set featured image', 'smntcs_cat' ),
		'remove_featured_image' => __( 'Remove featured image', 'smntcs_cat' ),
		'use_featured_image'    => __( 'Use as featured image', 'smntcs_cat' ),
		'insert_into_item'      => __( 'Insert into item', 'smntcs_cat' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'smntcs_cat' ),
		'items_list'            => __( 'Items list', 'smntcs_cat' ),
		'items_list_navigation' => __( 'Items list navigation', 'smntcs_cat' ),
		'filter_items_list'     => __( 'Filter items list', 'smntcs_cat' ),
	);
	$args = array(
		'label'                 => __( 'Cat', 'smntcs_cat' ),
		'description'           => __( 'Cat Description', 'smntcs_cat' ),
		'labels'                => $labels,
		'supports'              => [ 'title', 'thumbnail' ],
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-heart',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 							=> array( 'slug' => 'cats' ),
	);
	register_post_type( 'cats', $args );

}
add_action( 'init', 'cats', 0 );

add_action( 'after_setup_theme', 'lighthouse_after_setup_theme', 20 );
function lighthouse_after_setup_theme() {
	add_image_size( 'cat-thumbnail', 50, 50, false );
	add_image_size( 'cat-large', 300, 300, true );
}

add_action('admin_head', 'lighthouse_admin_head');
function lighthouse_admin_head() {
	echo '<style>
	.fixed .column-image {
		width: 55px;
	}
  </style>';
}

add_filter('manage_posts_columns', 'posts_columns', 5);
function posts_columns($defaults){
	$defaults['image'] = __('Image');
	return $defaults;
}
 
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_custom_columns( $column_name, $id ){
	if ( $column_name === 'image' ){
		echo get_the_post_thumbnail( $id, 'cat-thumbnail' );
	}
}

add_filter('manage_posts_columns', 'column_order');
function column_order($columns) {
  $n_columns = array();
  $move = 'image'; // what to move
  $before = 'title'; // move before this
  foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
}