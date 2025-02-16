<?php
/**
 * The template part for displaying the program section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'Advanced Custom Fields plugin is required.' );

$program_headline = get_field( 'program_headline' );
$program_teaser   = get_field( 'program_teaser' );

?>

<div id="program">
	<div class="content">
		<h2><?php print( esc_html( $program_headline ) ); ?></h2>
		<div class="teaser">
		<?php
		foreach ( $program_teaser as $teaser ) {
			printf(
				'<div><h3>%s</h3>%s</div>',
				esc_html( $teaser['headline'] ),
				$teaser['content']
			);
		}
		?>
		</div>
	</div>
</div>
