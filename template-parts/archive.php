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
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
	</header>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>

</article>
