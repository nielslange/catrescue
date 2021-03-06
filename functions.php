<?php
/**
 * Monochrome Pro.
 *
 * This file adds functions to the Monochrome Pro Theme.
 *
 * @package Monochrome
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/monochrome/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Setup Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'monochrome_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function monochrome_localization_setup() {

	load_child_theme_textdomain( 'monochrome-pro', get_stylesheet_directory() . '/languages' );

}

// Adds the theme helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds Image upload and Color select to WordPress Theme Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Includes CPT.
require_once get_stylesheet_directory() . '/lib/cpt.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Includes the Customizer CSS for the WooCommerce plugin.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Includes notice to install Genesis Connect for WooCommerce.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'monochrome_theme_support', 1 );
/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 1.3.0
 */
function monochrome_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * Allows plugins to Removes support if required.
 *
 * @since 1.1.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'monochrome_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function monochrome_enqueue_scripts_styles() {

	wp_enqueue_style( 'monochrome-fonts', '//fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i|Open+Sans+Condensed:300', [], genesis_get_theme_version() );
	wp_enqueue_style( 'monochrome-ionicons', '//unpkg.com/ionicons@4.1.2/dist/css/ionicons.min.css', [], genesis_get_theme_version() );

	wp_enqueue_script( 'monochrome-global-script', get_stylesheet_directory_uri() . '/js/global.js', [ 'jquery' ], '1.0.0', true );
	wp_enqueue_script( 'monochrome-block-effects', get_stylesheet_directory_uri() . '/js/block-effects.js', [], '1.0.0', true );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'monochrome-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', [ 'jquery' ], genesis_get_theme_version(), true );
	wp_localize_script( 'monochrome-responsive-menu', 'genesis_responsive_menu', monochrome_responsive_menu_settings() );

	wp_enqueue_script( 'clear-search-form',  get_stylesheet_directory_uri() . '/js/clear-search-form.js', array( 'jquery' ), '1.0.0', true );
}

/**
 * Defines responsive menu settings.
 *
 * @since 1.1.0
 */
function monochrome_responsive_menu_settings() {

	$settings = [
		'mainMenu'         => __( 'Menu', 'monochrome-pro' ),
		'menuIconClass'    => 'ionicons-before ion-ios-menu',
		'subMenu'          => __( 'Submenu', 'monochrome-pro' ),
		'subMenuIconClass' => 'ionicons-before ion-ios-arrow-down',
		'menuClasses'      => [
			'combine' => [],
			'others'  => [
				'.nav-primary',
			],
		],
	];

	return $settings;

}

// Adds image sizes.
add_image_size( 'featured-blog', 600, 338, true );
add_image_size( 'sidebar-thumbnail', 80, 80, true );

add_filter( 'image_size_names_choose', 'monochrome_media_library_sizes' );
/**
 * Adds featured-blog image size to Media Library.
 *
 * @since 1.0.0
 *
 * @param array $sizes Array of image sizes and their names.
 * @return array The modified list of sizes.
 */
function monochrome_media_library_sizes( $sizes ) {

	$sizes['featured-blog'] = __( 'Featured Blog - 600px by 338px', 'monochrome-pro' );

	return $sizes;

}

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_after', 'genesis_do_subnav', 12 );

add_action( 'genesis_meta', 'monochrome_add_search_icon' );
/**
 * Adds the search icon to the header if the option is set in the Customizer.
 *
 * @since 1.0.0
 */
function monochrome_add_search_icon() {

	$show_icon = get_theme_mod( 'monochrome_header_search', monochrome_customizer_get_default_search_setting() );

	// Exit early if option set to false.
	if ( ! $show_icon ) {
		return;
	}

add_action( 'genesis_header', 'monochrome_do_header_search_form', 14 );
add_action( 'genesis_header', 'monochrome_add_search_menu_item' );

}

// Function to modify the menu item output of the Header Menu.
function monochrome_add_search_menu_item() {
  $search_toggle = sprintf( '<button class="btn-search">%s</button>', monochrome_get_header_search_toggle() );
  echo $search_toggle;
}

add_filter( 'wp_nav_menu_args', 'monochrome_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 1.0.0
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function monochrome_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}
	$args['depth'] = 1;
	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'monochrome_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function monochrome_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_post_info', 'monochrome_entry_meta_header' );
/**
 * Modifies the meta information in the entry header.
 *
 * @since 1.0.0
 *
 * @param string $post_info Current post info.
 * @return string New post info.
 */
function monochrome_entry_meta_header( $post_info ) {

	$post_info = '[post_author_posts_link] &middot; [post_date] &middot; [post_comments] [post_edit]';
	return $post_info;

}

add_filter( 'genesis_post_meta', 'monochrome_entry_meta_footer' );
/**
 * Modifies the entry meta in the entry footer.
 *
 * @since 1.0.0
 *
 * @param string $post_meta Current post info.
 * @return string The new entry meta.
 */
function monochrome_entry_meta_footer( $post_meta ) {

	$post_meta = '[post_categories before=""] [post_tags before=""]';
	return $post_meta;

}

add_filter( 'genesis_comment_list_args', 'monochrome_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 1.0.0
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function monochrome_comments_gravatar( $args ) {

	$args['avatar_size'] = 48;
	return $args;

}

add_filter( 'get_the_content_limit', 'monochrome_content_limit_read_more_markup', 10, 3 );
/**
 * Modifies the generic more link markup for posts.
 *
 * @since 1.0.0
 *
 * @param string $output The current full HTML.
 * @param string $content The content HTML.
 * @param string $link The link HTML.
 * @return string The new more link HTML.
 */
function monochrome_content_limit_read_more_markup( $output, $content, $link ) {

	$output = sprintf( '<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace( '&#x02026;', '', $link ) );

	return $output;

}

// Removes entry meta in entry footer.
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

add_action( 'genesis_before_footer', 'monochrome_before_footer_cta' );
/**
 * Hooks in before footer CTA widget area.
 *
 * @since 1.0.0
 */
function monochrome_before_footer_cta() {

	genesis_widget_area(
		'before-footer-cta',
		[
			'before' => '<div class="before-footer-cta"><div class="wrap">',
			'after'  => '</div></div>',
		]
	);

}

// Removes site footer.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Adds site footer.
add_action( 'genesis_after', 'genesis_footer_markup_open', 5 );
add_action( 'genesis_after', 'genesis_do_footer' );
add_action( 'genesis_after', 'genesis_footer_markup_close', 15 );

// Registers widget areas.
genesis_register_sidebar(
	[
		'id'          => 'before-footer-cta',
		'name'        => __( 'Before Footer CTA', 'monochrome-pro' ),
		'description' => __( 'This is the before footer CTA section.', 'monochrome-pro' ),
	]
);

/**
 * Modify site title
 *
 * @param string $title The original site title.
 * @return string The updated site title.
 */
function smntcs_genesis_seo_title( $title ) {
	$title = '<h1 itemprop="headline" class="site-title"><a title="Homepage" href="' . get_bloginfo( 'url' ) . '"><strong>CAT</strong>RESCUE.</a><strong>ID</strong></h1>';
	return $title;
}
add_filter( 'genesis_seo_title', 'smntcs_genesis_seo_title', 10, 1 );

/**
 * Show full width homepage
 *
 * @return void
 */
function smntcs_get_header() {
	if ( is_home() ) {
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
	}
}
add_action( 'get_header', 'smntcs_get_header' );

/**
 * Replace 'textdomain' with your plugin's textdomain. e.g. 'woocommerce'.
 * File to be named, for example, yourtranslationfile-en_GB.mo
 * File to be placed, for example, wp-content/lanaguages/textdomain/yourtranslationfile-en_GB.mo
 *
 * @param string $mofile The path of the original .mo file.
 * @param string $domain The name of the text domain.
 * @return string $mofile The path of the new .mo file.
 */
function smntcs_load_textdomain_mofile( $mofile, $domain ) {
	if ( 'textdomain' === $domain ) {
		$mofile = WP_LANG_DIR . '/textdomain/monochrome-pro-' . get_locale() . '.mo';
	}
	return $mofile;
}
add_filter( 'load_textdomain_mofile', 'smntcs_load_textdomain_mofile', 10, 2 );

/**
 * Add IDR to Ninja Form currencies
 *
 * @param array $array The original array.
 * @return array $array The updated array.
 */
function filter_ninja_forms_currency( $array ) {
	$array['IDR'] = [
		'label' => esc_attr__( 'Indonesian Rupiah', 'ninja-forms' ),
		'value' => 'IDR',
	];

	return $array;
};
add_filter( 'ninja_forms_currency', 'filter_ninja_forms_currency', 10, 1 );

/**
 * Add IDR to Ninja Form currency symbol
 *
 * @param array $array The original array.
 * @return array $array The updated array.
 */
function filter_ninja_forms_currency_symbol( $array ) {
	$array['IDR'] = 'IDR';

	return $array;
};
add_filter( 'ninja_forms_currency_symbol', 'filter_ninja_forms_currency_symbol', 10, 11 );

/**
 * Exclude certain pages from the search results
 * 
 * @param object $query The original query object.
 * @return array $array The updated query object.
 */
function exclude_pages_from_search( $query ) {
	if ( $query->is_search ) {
		$query->set( 'post__not_in', array( 2191 ) ); 
	}
	
	return $query;
}
add_filter( 'pre_get_posts', 'exclude_pages_from_search' );
