<?php
/**
 * The template part for displaying the partners section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'Advanced Custom Fields plugin is required.' );

$partners = get_field( 'partners_partners' );

if ( ! $partners ) {
	return;
}


?>

<div id="partners">
	<section class="main-inner">
		<div class="main-content">
		<?php
		foreach ( $partners as $partner ) {
			$partner_image = $partner['image'];
			$partner_url   = $partner['url'];
			printf( '<a href="%s" target="_blank"><img src="%s"></a>', esc_url( $partner_url ), esc_url( $partner_image ) );
		}
		?>
		</div>
	</section>
</div>
