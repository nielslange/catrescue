<?php
/**
 * Template part for displaying single post content
 *
 * @package Catrescue
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="post-title">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</header>
	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'medium' ); ?>
			</div>
		<?php else : ?>
			<div class="post-thumbnail">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="A placeholder image for Catrescue.id showing a playful cat" />
			</div>
		<?php endif; ?>
		<?php

		$location  = get_field( 'location' );
		$gender    = get_field( 'gender' );
		$age       = get_field( 'age' );
		$notes     = get_field( 'notes' );
		$instagram = get_field( 'instagram' );

		// Create a table with the following meta data:
		// - Location
		// - Gender
		// - Age
		// - Notes
		// - Instagram

		printf(
			'<!-- wp:table {"className":"is-style-stripes"} -->
			<figure class="wp-block-table is-style-stripes">
			<table>
				<tr>
					<td>Gender</td>
					<td>%s</td>
				</tr>
				<tr>
					<td>Age</td>
					<td>%s</td>
				</tr>

				<tr>
					<td>Instagram</td>
					<td>%s</td>
				</tr>
			</table>
			</figure>
			<!-- /wp:table -->',
			esc_html( $location ),
			esc_html( $gender ),
			esc_html( $age ),
			esc_url( $instagram )
		);
		?>
	</div>
</article>
