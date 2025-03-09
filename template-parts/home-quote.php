<?php
/**
 * The template part for displaying the quote section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

if ( ! function_exists( 'get_field' ) ) {
	exit( 'ACF is required.' );
}

$quote_image  = get_field( 'quote_image' );
$quote_quote  = get_field( 'quote_quote' );
$quote_author = get_field( 'quote_author' );

?>

<div id="banner" class="hero" style="background-image: url(<?php print( esc_html( $quote_image['url'] ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h1><?php echo esc_html( $quote_quote ); ?></h1>
		<h2><?php echo esc_html( $quote_author ); ?></h2>
	</div>
</div>
