<?php
/**
 * The template part for displaying the partners section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

if ( ! function_exists( 'get_field' ) ) {
	exit( 'ACF is required.' );
}

$partner_headline = get_field( 'partner_headline' );
$partner_details  = get_field( 'partner_details' );
?>

<div id="partners">
	<div class="content">
		<h2><?php print( esc_html( $partner_headline ) ); ?></h2>
		<div class="teaser">
		<?php
		if ( have_rows( 'partner_details' ) ) :
			while ( have_rows( 'partner_details' ) ) :
				the_row();
				$logo = get_sub_field( 'partner_details_logo' );
				$url  = get_sub_field( 'partner_details_link' );

				printf(
					'<div class="partner-logo"><a href="%s" target="_blank">%s</a></div>',
					esc_url( $url ),
					wp_get_attachment_image( $logo['ID'], array( 150, 150 ), false, array( 'loading' => 'lazy' ) )
				);
			endwhile;
		endif;
		?>
		</div>
	</div>
</div>
