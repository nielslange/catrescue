<?php
/**
 * The template for displaying the static homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

get_header();

echo '<main id="homepage">';

// Display the homepage banner section.
get_template_part( 'template-parts/home', 'banner' );

// Display the homepage program section.
get_template_part( 'template-parts/home', 'program' );

// Display the homepage location section.
get_template_part( 'template-parts/home', 'location' );

// Display the homepage blog section.
get_template_part( 'template-parts/home', 'blog' );

// Display the homepage quote section.
get_template_part( 'template-parts/home', 'quote' );

// Display the homepage partners section.
get_template_part( 'template-parts/home', 'partners' );

echo '</main>';

get_footer();
