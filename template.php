<?php
/**
 * The unified template file
 *
 * This template can be used for various content types by passing
 * different parameters to the base template part.
 *
 * @package Catrescue
 */

get_header();

// Default parameters
$params = array(
	'content_type' => 'content',
	'show_sidebar' => true,
	'show_title'   => true,
);

// Modify parameters based on template context
if ( is_page() ) {
	$params['content_type'] = 'content-page';
} elseif ( is_single() ) {
	$params['content_type'] = 'content-post';
} elseif ( is_404() ) {
	$params['content_type'] = 'content-404';
	$params['show_sidebar'] = true;
} elseif ( is_search() ) {
	$params['content_type'] = 'content-search';
	$params['show_title']   = true;
	$params['custom_title'] = sprintf(
		/* translators: %s: search query */
		esc_html__( 'Search results for: %s', 'catrescue' ),
		get_search_query()
	);
}

// Check for full width template
if ( is_page_template( 'template-full-width.php' ) ) {
	$params['show_sidebar'] = false;
}

// Check for donation page template
if ( is_page_template( 'template-donation.php' ) ) {
	$params['content_type'] = 'content-donation';
}

// Allow filtering of parameters
$params = apply_filters( 'catrescue_template_params', $params );

// Load the base template with appropriate parameters
get_template_part( 'template-parts/base', null, $params );

get_footer();
