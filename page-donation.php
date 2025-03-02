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

// Bail out if ACF is not installed.
if ( ! function_exists( 'get_field' ) ) {
	return;
}

$content       = get_field( 'content' );
$donations     = get_field( 'donations' );
$donation_data = array();

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
					<?php
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
					?>

					<div class="donation-form">
						<form id="donation-form" data-donation-urls='<?php echo esc_attr( wp_json_encode( $donation_data ) ); ?>'>
							<div class="form-group">
								<label for="donation-type"><?php esc_html_e( 'Package:', 'catrescue' ); ?></label>
								<select id="donation-type" name="donation-type">
									<option value=""><?php esc_html_e( 'Select package', 'catrescue' ); ?></option>
									<?php if ( ! empty( $donations ) && is_array( $donations ) ) : ?>
										<?php foreach ( $donations as $donation ) : ?>
											<option value="<?php echo esc_attr( $donation['name'] ); ?>" data-price="<?php echo esc_attr( $donation['price'] ); ?>">
												<?php echo esc_html( $donation['name'] ); ?> - <?php echo esc_html( $donation['currency'] ); ?> <?php echo esc_html( $donation['price'] ); ?>
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
		<div class="main-sidebar">
			<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
				<aside id="secondary" class="widget-area">
						<?php dynamic_sidebar( 'sidebar' ); ?>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
