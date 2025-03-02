<?php
/**
 * The template part for displaying the program section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

$program_headline = get_post_meta( get_the_ID(), 'program_headline', true );

?>

<div id="program">
	<div class="content">
		<h2><?php print( esc_html( $program_headline ) ); ?></h2>
		<div class="teaser">
		<?php
		if ( have_rows( 'program_teaser' ) ) :
			while ( have_rows( 'program_teaser' ) ) :
				the_row();
				$page_link = get_sub_field( 'program_teaser_page_link' );
				$headline  = get_sub_field( 'program_teaser_headline' );
				$content   = get_sub_field( 'program_teaser_content' );

				if ( $page_link && $headline && $content ) :
					printf(
						'<div><h3><a href="%s">%s</a></h3>%s</div>',
						esc_url( $page_link ),
						esc_html( $headline ),
						wp_kses_post( $content )
					);
				endif;
			endwhile;
		endif;
		?>
		</div>
	</div>
</div>
