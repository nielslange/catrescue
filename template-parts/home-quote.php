<?php
/**
 * The template part for displaying the quote section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'Advanced Custom Fields plugin is required.' );

$quote_image  = get_field( 'quote_image' );
$quote_quote  = get_field( 'quote_quote' );
$quote_author = get_field( 'quote_author' );

if ( ! $quote_image || ! $quote_quote || ! $quote_author ) {
	return;
}

?>

<div id="quote" class="hero" style="background-image: url(<?php print( esc_html( $quote_image ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h2><?php echo esc_html( $quote_quote ); ?></h2>
		<h3><?php echo esc_html( $quote_author ); ?></h3>
	</div>
</div>
