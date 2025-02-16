<?php
/**
 * The template for displaying the static homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

get_header();

print( '<main>' );
get_template_part( 'template-parts/home-banner' );
get_template_part( 'template-parts/home-program' );
// get_template_part( 'template-parts/home-location' );
// get_template_part( 'template-parts/home-article' );
get_template_part( 'template-parts/home-quote' );
// get_template_part( 'template-parts/home-partners' );
print( '</main>' );

get_footer();
