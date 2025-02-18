<?php
/**
 * The template part for displaying the location section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'ACF is required.' );

$location_image_id     = get_post_meta( get_the_ID(), 'location_image', true );
$location_image        = wp_get_attachment_image_src( $location_image_id, 'full' );
$location_headline     = get_post_meta( get_the_ID(), 'location_headline', true );
$location_teaser_count = get_post_meta( get_the_ID(), 'location_teaser', true );
$location_teaser       = array();

if ( $location_teaser_count ) {
	for ( $i = 0; $i < $location_teaser_count; $i++ ) {
		$location_teaser[] = array(
			'headline' => get_post_meta( get_the_ID(), 'location_teaser_' . $i . '_location_teaser_subline', true ),
			'content'  => get_post_meta( get_the_ID(), 'location_teaser_' . $i . '_location_teaser_content', true ),
		);
	}
}

?>

<div id="location" class="hero" style="background-image: url(<?php print( esc_html( $location_image[0] ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h2><?php print( esc_html( $location_headline ) ); ?></h2>
		<div class="teaser">
		<?php
		foreach ( $location_teaser as $teaser ) {
			printf(
				'<div><h3>%s</h3>%s</div>',
				esc_html( $teaser['headline'] ),
				wp_kses_post( $teaser['content'] )
			);
		}
		?>
		</div>
	</div>
</div>

