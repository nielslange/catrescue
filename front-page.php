<?php
/**
 * The template for displaying the static homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

get_header();

/**
 * Filter the homepage sections.
 *
 * @param array $sections Array of homepage sections.
 */
$homepage_sections = apply_filters( 'catrescue_homepage_sections',
	array(
		'banner',
		'program',
		'location',
		'blog',
		'quote',
		'partners',
	) );

echo '<main id="homepage">';

// Load each homepage section
foreach ( $homepage_sections as $section ) {
	get_template_part( 'template-parts/home', $section );
}

echo '</main>';

get_footer();
