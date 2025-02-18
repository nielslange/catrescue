<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

get_header();
?>

<main>
	<div class="main-inner">
		<div class="main-content">
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', 'post-excerpt' );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}

		the_posts_pagination( array(
			'prev_text'          => __( '« Previous', 'catrescue' ),
			'next_text'          => __( 'Next »', 'catrescue' ),
			'screen_reader_text' => __( 'Post Navigation', 'catrescue' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'catrescue' ) . ' </span>',
			'after_page_number'  => '',
			'mid_size'           => 3,
			'end_size'           => 2,
		) );

		?>
		</div>
		<div class="main-sidebar">
			<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
				<aside id="secondary" class="widget-area">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
