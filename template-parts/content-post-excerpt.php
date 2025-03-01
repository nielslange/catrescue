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
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		</div>
	</header>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
