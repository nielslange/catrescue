<?php
/**
 * Template Name: Donation Page
 * Template Post Type: page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

get_header();

if ( ! function_exists( 'get_field' ) ) {
	exit( 'ACF is required.' );
}

/**
 * Get formatted donation data from ACF repeater field.
 *
 * @return array Formatted donation data with URLs and details.
 */
function catrescue_get_donation_data(): array {
	$donation_data = array();

	if ( have_rows( 'donations' ) ) {
		while ( have_rows( 'donations' ) ) {
			the_row();
			$name = get_sub_field( 'name' );

			if ( $name ) {
				$donation_data[ $name ] = array(
					'price'       => get_sub_field( 'price' ),
					'description' => get_sub_field( 'description' ),
					'once'        => get_sub_field( 'url_once' ),
					'monthly'     => get_sub_field( 'url_monthly' ),
					'yearly'      => get_sub_field( 'url_yearly' ),
				);
			}
		}
	}

	return $donation_data;
}

/**
 * Format price based on locale and currency.
 *
 * @param float  $price    The price to format.
 * @param string $currency The currency code (USD or IDR).
 * @return string          The formatted price.
 */
function catrescue_format_price( float $price, string $currency ): string {
	return ( 'IDR' === $currency )
		? number_format( $price, 0, ',', '.' )
		: number_format( $price, 2, '.', ',' );
}

$content       = get_field( 'content' );
$donation_data = catrescue_get_donation_data();

?>

<main>
	<div class="main-inner">
		<div class="main-content">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content">
					<?php echo wp_kses_post( $content ); ?>
					<div class="donation-form">
						<form id="donation-form" data-donation-urls='<?php echo esc_attr( wp_json_encode( $donation_data ) ); ?>'>
							<div class="form-group">
								<label for="donation-type"><?php esc_html_e( 'Package:', 'catrescue' ); ?></label>
								<select id="donation-type" name="donation-type">
									<option value=""><?php esc_html_e( 'Select package', 'catrescue' ); ?></option>
									<?php
									if ( have_rows( 'donations' ) ) :
										while ( have_rows( 'donations' ) ) :
											the_row();
											$name     = get_sub_field( 'name' );
											$price    = get_sub_field( 'price' );
											$currency = get_sub_field( 'currency' );
											?>
											<option value="<?php echo esc_attr( $name ); ?>" data-price="<?php echo esc_attr( $price ); ?>">
												<?php
												printf(
													'%s - %s %s',
													esc_html( $name ),
													esc_html( $currency ),
													esc_html( catrescue_format_price( $price, $currency ) )
												);
												?>
											</option>
											<?php
										endwhile;
									endif;
									?>
								</select>
							</div>
							<div id="donation-description" class="description-box"></div>
							<div class="form-group">
								<label for="donation-frequency"><?php esc_html_e( 'Frequency:', 'catrescue' ); ?></label>
								<select id="donation-frequency" name="donation-frequency">
									<option value=""><?php esc_html_e( 'Select frequency', 'catrescue' ); ?></option>
									<option value="once"><?php esc_html_e( 'One-time', 'catrescue' ); ?></option>
									<option value="monthly"><?php esc_html_e( 'Monthly', 'catrescue' ); ?></option>
									<option value="yearly"><?php esc_html_e( 'Yearly', 'catrescue' ); ?></option>
								</select>
							</div>
							<button type="button" id="donate-button" class="button"><?php esc_html_e( 'Donate now', 'catrescue' ); ?></button>
						</form>
					</div>
				</div>
			</article>
		</div>
		<aside>
			<?php get_sidebar(); ?>
		</aside>
	</div>
</main>

<?php
get_footer();
