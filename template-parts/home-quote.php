<?php
/**
 * The template part for displaying the quote section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

$quote_image_id = get_post_meta( get_the_ID(), 'quote_image', true );
$quote_image    = wp_get_attachment_image_src( $quote_image_id, 'full' );
$quote_quote    = get_post_meta( get_the_ID(), 'quote_quote', true );
$quote_author   = get_post_meta( get_the_ID(), 'quote_author', true );

?>

<div id="banner" class="hero" style="background-image: url(<?php print( esc_html( $quote_image[0] ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h1><?php echo esc_html( $quote_quote ); ?></h1>
		<h2><?php echo esc_html( $quote_author ); ?></h2>
	</div>
</div>
