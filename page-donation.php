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

$content       = get_field( 'content' );
$donations     = get_field( 'donations' );
$donation_data = array();

if ( ! empty( $donations ) && is_array( $donations ) ) {
	foreach ( $donations as $donation ) {
		if ( isset( $donation['name'] ) ) {
			$donation_data[ $donation['name'] ] = array(
				'price'       => $donation['price'],
				'description' => $donation['description'],
				'once'        => $donation['url_once'],
				'monthly'     => $donation['url_monthly'],
				'yearly'      => $donation['url_yearly'],
			);
		}
	}
}

/**
 * Format price based on locale and currency.
 *
 * @param float  $price    The price to format.
 * @param string $currency The currency code (USD or IDR).
 * @return string          The formatted price.
 */
function catrescue_format_price( $price, $currency ) {
	return ( 'IDR' === $currency ) ?
		number_format( $price, 0, ',', '.' ) :
		number_format( $price, 2, '.', ',' );
}

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
									<?php if ( ! empty( $donations ) && is_array( $donations ) ) : ?>
										<?php foreach ( $donations as $donation ) : ?>
											<option value="<?php echo esc_attr( $donation['name'] ); ?>" data-price="<?php echo esc_attr( $donation['price'] ); ?>">
												<?php
												printf(
													'%s - %s %s',
													esc_html( $donation['name'] ),
													esc_html( $donation['currency'] ),
													esc_html( catrescue_format_price( $donation['price'], $donation['currency'] ) )
												);
												?>
											</option>
										<?php endforeach; ?>
									<?php endif; ?>
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

<?php get_footer(); ?>
