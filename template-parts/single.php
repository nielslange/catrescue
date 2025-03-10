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
		<div class="post-meta">
			<span class="post-date"><?php the_date(); ?></span>
			<?php esc_html_e( 'by', 'catrescue' ); ?>
			<span class="post-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></span>
		</div>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'full' ); ?>
			</div>
		<?php endif; ?>
	</header>
	<div class="entry-content">
		<?php
		the_content();
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>
	</div>
</article>
