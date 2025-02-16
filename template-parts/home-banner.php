<?php
/**
 * The template part for displaying the banner section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'Advanced Custom Fields plugin is required.' );

$banner_image_id = get_post_meta( get_the_ID(), 'banner_image', true );
$banner_image    = wp_get_attachment_image_src( $banner_image_id, 'full' );
$banner_headline = get_post_meta( get_the_ID(), 'banner_headline', true );
$banner_subline  = get_post_meta( get_the_ID(), 'banner_subline', true );

// print( '<pre>' );
// print_r( $banner_image );
// print_r( $banner_headline );
// print_r( $banner_subline );
// print( '</pre>' );

?>

<div id="banner" class="hero" style="background-image: url(<?php print( esc_html( $banner_image[0] ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h1><?php echo esc_html( $banner_headline ); ?></h1>
		<h2><?php echo esc_html( $banner_subline ); ?></h2>
	</div>
</div>
