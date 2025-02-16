<?php
/**
 * Template part for displaying single post content
 *
 * @package Catrescue
 */

// Bail out if Polylang is not active.
class_exists( 'Polylang' ) || exit( 'Polylang not found!' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="post-title">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</header>

	<div class="entry-content">
		<?php
		if ( has_post_thumbnail() ) {
			echo '<div class="post-thumbnail">';
			the_post_thumbnail( 'thumbnail' );
			echo '</div>';
		}

		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . pll__( 'Page:' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
