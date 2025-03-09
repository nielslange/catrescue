<?php
/**
 * The template part for displaying the banner section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

if ( ! function_exists( 'get_field' ) ) {
	exit( 'ACF is required.' );
}

$banner_image    = get_field( 'banner_image' );
$banner_headline = get_field( 'banner_headline' );
$banner_subline  = get_field( 'banner_subline' );

?>

<div id="banner" class="hero" style="background-image: url(<?php print( esc_html( $banner_image['url'] ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h1><?php echo esc_html( $banner_headline ); ?></h1>
		<h2><?php echo esc_html( $banner_subline ); ?></h2>
	</div>
</div>
