<?php
/**
 * The template part for displaying the partners section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

$partner_headline = get_post_meta( get_the_ID(), 'partner_headline', true );
$partner_details  = get_post_meta( get_the_ID(), 'partner_details', true );

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

				if ( $logo ) :
					printf(
						'<div class="partner-logo"><a href="%s">%s</a></div>',
						esc_url( $url ),
						wp_get_attachment_image( $logo['ID'], array( 150, 150 ), false, array( 'loading' => 'lazy' ) )
					);
				endif;
			endwhile;
		endif;
		?>
		</div>
	</div>
</div>
