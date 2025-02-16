<?php
/**
 * The template part for displaying the banner section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'Advanced Custom Fields plugin is required.' );

$banner_images   = get_field( 'banner_image' );
$banner_image    = $banner_images ? $banner_images[ array_rand( $banner_images ) ] : '';
$banner_headline = get_field( 'banner_headline' );
$banner_subline  = get_field( 'banner_subline' );

?>

<div id="banner" class="hero" style="background-image: url(<?php print( esc_html( $banner_image ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h1><?php echo esc_html( $banner_headline ); ?></h1>
		<h2><?php echo esc_html( $banner_subline ); ?></h2>
	</div>
</div>
