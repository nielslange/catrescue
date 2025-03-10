<?php
/**
 * The template part for displaying the location section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

if ( ! function_exists( 'get_field' ) ) {
	exit( 'ACF is required.' );
}

$location_image        = get_field( 'location_image' );
$location_headline     = get_field( 'location_headline' );
$location_teaser_count = get_field( 'location_teaser' );
?>

<div id="location" class="hero" style="background-image: url(<?php print( esc_html( $location_image['url'] ) ); ?>)">
	<div class="overlay"></div>
	<div class="content">
		<h2><?php print( esc_html( $location_headline ) ); ?></h2>
		<div class="teaser">
		<?php
		if ( have_rows( 'location_teaser' ) ) :
			while ( have_rows( 'location_teaser' ) ) :
				the_row();
				$subline = get_sub_field( 'location_teaser_subline' );
				$content = get_sub_field( 'location_teaser_content' );

				printf(
					'<div><h3>%s</h3>%s</div>',
					esc_html( $subline ),
					wp_kses_post( $content )
				);
			endwhile;
		endif;
		?>
		</div>
	</div>
</div>

