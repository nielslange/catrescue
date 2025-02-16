<?php
/**
 * The template part for displaying the location section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'Advanced Custom Fields plugin is required.' );

$location_headline = get_field( 'location_headline' );
$location_image    = get_field( 'location_image' );
$location_teaser   = get_field( 'location_teaser' );

if ( ! $location_headline || ! $location_image || ! $location_teaser ) {
	return;
}

?>

<div id="location" class="hero" style="background-image: url(<?php print( esc_html( $location_image ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h2><?php print( esc_html( $location_headline ) ); ?></h2>
		<div class="teaser">
		<?php
		foreach ( $location_teaser as $teaser ) {
			printf(
				'<div><h3>%s</h3>%s</div>',
				esc_html( $teaser['headline'] ),
				$teaser['content']
			);
		}
		?>
		</div>
	</div>
</div>

