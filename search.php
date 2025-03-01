<?php
/**
 * The template for displaying search results pages
 *
 * @package Catrescue
 */

get_header();
?>

<main id="search">
	<div class="main-inner">
		<div class="main-content">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<h1 class="page-title">
						<?php
						printf(
							/* translators: %s: search query */
							esc_html__( 'Search results for: %s', 'catrescue' ),
							'<span>' . get_search_query() . '</span>'
						);
						?>
					</h1>
				</header>

				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content' );
				endwhile;

				the_posts_pagination( array(
					'prev_text'          => __( '« Previous', 'catrescue' ),
					'next_text'          => __( 'Next »', 'catrescue' ),
					'screen_reader_text' => __( 'Post Navigation', 'catrescue' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'catrescue' ) . ' </span>',
					'after_page_number'  => '',
					'mid_size'           => 3,
					'end_size'           => 2,
				) );

			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
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
