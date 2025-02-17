<?php
/**
 * The template part for displaying the location section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'Advanced Custom Fields plugin is required.' );

$location_image_id = get_post_meta( get_the_ID(), 'location_image', true );
$location_image    = wp_get_attachment_image_src( $location_image_id, 'full' );
$location_headline = get_field( 'location_headline' );
$location_teaser   = get_field( 'location_teaser' );

print( '<pre>' );
var_dump( $location_image );
var_dump( $location_headline );
var_dump( $location_teaser );
print( '</pre>' );

?>

<div id="location" class="hero" style="background-image: url(<?php print( esc_html( $location_image[0] ) ); ?>)">
	<div class="content">
		<h2><?php print( esc_html( $location_headline ) ); ?></h2>
		<div class="teaser">
		<?php
		// foreach ( $location_teaser as $teaser ) {
		// printf(
		// '<div><h3>%s</h3>%s</div>',
		// esc_html( $teaser['headline'] ),
		// $teaser['content']
		// );
		// }
		?>
		</div>
	</div>
</div>

