<?php
/**
 * The template part for displaying the program section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

$program_headline     = get_post_meta( get_the_ID(), 'program_headline', true );
$program_teaser_count = get_post_meta( get_the_ID(), 'program_teaser', true );
$program_teaser       = array();

if ( $program_teaser_count ) {
	for ( $i = 0; $i < $program_teaser_count; $i++ ) {
		$program_teaser[] = array(
			'program_teaser_page_link' => get_permalink( get_post_meta( get_the_ID(), 'program_teaser_' . $i . '_program_teaser_page_link', true ) ),
			'program_teaser_headline'  => get_post_meta( get_the_ID(), 'program_teaser_' . $i . '_program_teaser_headline', true ),
			'program_teaser_content'   => get_post_meta( get_the_ID(), 'program_teaser_' . $i . '_program_teaser_content', true ),
		);
	}
}

?>

<div id="program">
	<div class="content">
		<h2><?php print( esc_html( $program_headline ) ); ?></h2>
		<div class="teaser">
		<?php
		foreach ( $program_teaser as $teaser ) {
			printf(
				'<div><h3><a href="%s">%s</a></h3>%s</div>',
				esc_url( $teaser['program_teaser_page_link'] ),
				esc_html( $teaser['program_teaser_headline'] ),
				wp_kses_post( $teaser['program_teaser_content'] )
			);
		}
		?>
		</div>
	</div>
</div>
