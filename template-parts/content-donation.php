<?php
/**
 * Template part for displaying donation page content
 *
 * @package Catrescue
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php
		the_content();
		?>
		<?php
		// Donation URLs array
		$donation_urls = array(
			'Medication'           => array(
				'price'       => 5,
				'description' => esc_html__( 'Provide lifesaving treatment for rescued cats in need. Your donation helps cover the cost of antibiotics, wound care, and other essential medications to ensure sick and injured cats receive the medical attention they deserve. Every contribution brings them one step closer to a healthy and happy life.', 'catrescue' ),
				'once'        => 'https://buy.stripe.com/aEU2aw03oeQg9eU14b',
				'monthly'     => 'https://buy.stripe.com/cN25mI2bw23ufDieUV',
				'yearly'      => 'https://buy.stripe.com/fZe9CY4jE9vWaiYeV3',
			),
			'Deworm & Deflea'      => array(
				'price'       => 10,
				'description' => esc_html__( 'Help keep rescued cats healthy by covering the cost of essential parasite treatment. Your donation ensures that each cat receives proper deworming and flea prevention, protecting them from common health issues and improving their well-being.', 'catrescue' ),
				'once'        => 'https://buy.stripe.com/4gwcPadUe4bC76M9AL',
				'monthly'     => 'https://buy.stripe.com/28o6qMcQa6jK4YEeUW',
				'yearly'      => 'https://buy.stripe.com/7sIeXi5nIgYo3UA3cm',
			),
			'Male Sterilisation'   => array(
				'price'       => 25,
				'description' => esc_html__( 'Help prevent overpopulation and improve the health of street cats by sponsoring the sterilization of a male cat. This procedure reduces aggressive behaviour, the spread of diseases, and unwanted litters. Your donation directly supports a humane and sustainable solution for community cats.', 'catrescue' ),
				'once'        => 'https://buy.stripe.com/14k02o4jE4bCcr65kC',
				'monthly'     => 'https://buy.stripe.com/6oEcPa7vQ7nO62IfYY',
				'yearly'      => 'https://buy.stripe.com/dR6dTeeYidMc76M28g',
			),
			'Female Sterilisation' => array(
				'price'       => 50,
				'description' => esc_html__( 'Support our Trap-Neuter-Return (TNR) efforts by funding the sterilization of a female cat. Sterilization helps prevent overpopulation, reduces health risks, and gives rescued cats a better quality of life. Your donation directly contributes to a humane and sustainable solution for street cats.', 'catrescue' ),
				'once'        => 'https://buy.stripe.com/4gw6qM9DYbE41Ms14h',
				'monthly'     => 'https://buy.stripe.com/28o16sbM67nO76MdQT',
				'yearly'      => 'https://buy.stripe.com/aEU4iEdUedMc9eUcMY',
			),
			'Small TNR (5 Cats)'   => array(
				'price'       => 150,
				'description' => esc_html__( 'Help us humanely manage the street cat population by sponsoring the sterilization of five cats. This donation covers their surgery, post-care, and essential treatments, ensuring they live healthier lives while preventing the birth of countless homeless kittens. Your support makes a lasting impact!', 'catrescue' ),
				'once'        => 'https://buy.stripe.com/7sI2aw9DYaA00IodR5',
				'monthly'     => 'https://buy.stripe.com/6oE7uQ4jE6jKbn2aEJ',
				'yearly'      => 'https://buy.stripe.com/fZedTe5nI8rSeze14i',
			),
			'Big TNR (10 Cats)'    => array(
				'price'       => 300,
				'description' => esc_html__( 'Make a significant impact by sponsoring the sterilization of ten street cats. Your donation covers their surgery, recovery, and essential care, helping to control overpopulation and improve the well-being of entire cat colonies. Together, we can create a healthier and more sustainable future for street cats.', 'catrescue' ),
				'once'        => 'https://buy.stripe.com/6oE16s9DYfUkgHm7sJ',
				'monthly'     => 'https://buy.stripe.com/7sI5mI3fAaA09eU9AG',
				'yearly'      => 'https://buy.stripe.com/dR69CY03o4bC62I00g',
			),
		);
		?>

		<div class="donation-form">
			<form id="donation-form" data-donation-urls='<?php echo esc_attr( json_encode( $donation_urls ) ); ?>'>
				<div class="form-group">
					<label for="donation-type"><?php esc_html_e( 'Type of Donation:', 'catrescue' ); ?></label>
					<select id="donation-type" name="donation-type">
						<option value=""><?php esc_html_e( 'Select donation type', 'catrescue' ); ?></option>
						<?php foreach ( $donation_urls as $type => $details ) : ?>
							<option value="<?php echo esc_attr( $type ); ?>" data-price="<?php echo esc_attr( $details['price'] ); ?>">
								<?php echo esc_html( $type ); ?> - USD <?php echo esc_html( $details['price'] ); ?>
							</option>
						<?php endforeach; ?>
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

		<script src="<?php echo get_template_directory_uri(); ?>/assets/js/donation.js"></script>
	</div>
</article>
