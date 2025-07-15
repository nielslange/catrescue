<?php
/**
 * Template part for displaying single post content
 *
 * @package Catrescue
 */

/**
 * Get the current language for adoption URL
 *
 * @return string The adoption URL based on current language
 */
function catrescue_get_adoption_url(): string {
	if ( function_exists( 'pll_current_language' ) ) {
		$current_lang = pll_current_language();
		return $current_lang === 'id' ? '/adopsi/' : '/en/adoption/';
	}

	// Fallback to English if Polylang is not available
	return '/en/adoption/';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="post-title">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</header>
	<div class="entry-content">
		<div class="post-thumbnail">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'full' ); ?>
			<?php else : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="A placeholder image for Catrescue.id showing a playful cat" />
			<?php endif; ?>
		</div>
		<?php

		$location  = get_the_terms( get_the_ID(), 'location' );
		$gender    = get_field( 'gender' );
		$age       = get_field( 'age' );
		$notes     = get_field( 'notes' );
		$instagram = get_field( 'instagram' );

		// Build table content
		$table_content = sprintf(
			'<tr><td>%s</td><td>%s</td></tr>',
			esc_html__( 'Location', 'catrescue' ),
			esc_html( ! empty( $location[0]->name ) ? $location[0]->name : __( 'Unknown', 'catrescue' ) )
		);

		$table_content .= sprintf(
			'<tr><td>%s</td><td>%s</td></tr>',
			esc_html__( 'Gender', 'catrescue' ),
			esc_html( ucfirst( $gender ) )
		);

		$table_content .= sprintf(
			'<tr><td>%s</td><td>%s</td></tr>',
			esc_html__( 'Age', 'catrescue' ),
			esc_html( ! empty( $age ) ? $age : __( 'Unknown', 'catrescue' ) )
		);

		$table_content .= sprintf(
			'<tr><td>%s</td><td>%s</td></tr>',
			esc_html__( 'Instagram', 'catrescue' ),
			! empty( $instagram )
			? sprintf(
				'<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
				esc_url( $instagram ),
				esc_html__( 'Show Instagram', 'catrescue' )
			)
			: esc_html__( 'Not available', 'catrescue' )
		);

		// Create the adoption button
		$adoption_button = sprintf(
			'<a href="%s" class="button">%s</a>',
			catrescue_get_adoption_url(),
			sprintf(
				esc_html__( 'Make %s part of your family', 'catrescue' ),
				'<strong>' . esc_html( get_the_title() ? get_the_title() : esc_html__( 'this cat', 'catrescue' ) ) . '</strong>'
			)
		);

		// Build the complete block content
		$block_content = sprintf(
			'<!-- wp:table {"className":"is-style-stripes"} -->
			<figure class="wp-block-table is-style-stripes">
			<table>%s</table>
			<div class="notes">%s</div>
			%s
			</figure>
			<!-- /wp:table -->',
			$table_content,
			wp_kses_post( ! empty( $notes ) ? $notes : '' ),
			$adoption_button
		);

		// Render the block properly using WordPress block rendering
		echo do_blocks( $block_content );
		?>
	</div>
</article>
