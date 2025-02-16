<?php
/**
 * The template part for displaying the article section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'Advanced Custom Fields plugin is required.' );

$article_headline = get_field( 'article_headline' );
$args             = array(
	'posts_per_page' => 5,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_type'      => 'post',
	'post_status'    => 'publish',
);
$article_teaser   = ( new WP_Query( $args ) )->posts;
setlocale( LC_TIME, 'id_ID.utf8', 'id_ID', 'Indonesian_Indonesia' );


?>

<div id="article">
	<div class="content">
		<h2><?php print( esc_html( $article_headline ) ); ?></h2>
		<div class="teaser">
		<?php

		// print( '<pre>' );
		// print_r( $article_teaser );
		// print( '</pre>' );

		foreach ( $article_teaser as $teaser ) {
			// Format the posts as follows:
			// Left hand side: post title
			// Right hand side: post date


			printf(
				'<article>
					<div>%s</div>
					<div>%s</div>
					</article>',
				esc_html( $teaser->post_title ),
				date( 'Y-m-d', strtotime( esc_html( $teaser->post_date ) ) ),
			);
		}
		printf( '<p>%s<p>', 'read more posts' );
		?>
		</div>

	</div>
</div>
