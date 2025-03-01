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
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		<?php endif; ?>
		<div class="post-meta">
			<span class="post-date"><?php the_date(); ?></span>
			<?php esc_html_e( 'by', 'catrescue' ); ?>
			<span class="post-author"><?php the_author(); ?></span>
		</div>
	</header>


	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Page:', 'catrescue' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
