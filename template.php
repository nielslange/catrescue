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

// Default parameters.
$params = array(
	'content_type' => 'content',
	'show_sidebar' => true,
	'show_title'   => true,
);

// Modify parameters based on template context.
if ( is_page() ) {
	$params['content_type'] = 'content-page';
} elseif ( is_single() ) {
	$params['content_type'] = 'content-post';
} elseif ( is_404() ) {
	$params['content_type'] = 'content-404';
	$params['show_sidebar'] = true;
}

// Allow filtering of parameters.
$params = apply_filters( 'catrescue_template_params', $params );

// Load the base template with appropriate parameters.
get_template_part( 'template-parts/base', null, $params );

get_footer();
