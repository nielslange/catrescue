<?php
/**
 * The template for displaying search results pages
 *
 * @package Catrescue
 */

get_header();
?>

<main>

	<div class="main-inner">

		<div class="main-content">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
					printf(
						/* translators: %s: search query. */
						esc_html__( 'Search results for: %s', 'catrescue' ),
						'<span class="search-query">' . get_search_query() . '</span>'
					);
					?>
				</h1>
			</header>

			<?php
			echo '<ul class="search-results-list">';
			while ( have_posts() ) :
				the_post();
				?>
				<li class="search-result-item">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</li>
				<?php
			endwhile;
			echo '</ul>';

			the_posts_pagination( array(
				'prev_text'          => esc_html__( '«', 'catrescue' ),
				'next_text'          => esc_html__( '»', 'catrescue' ),
				'screen_reader_text' => esc_html__( 'Post Navigation', 'catrescue' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'catrescue' ) . ' </span>',
				'after_page_number'  => '',
				'mid_size'           => 3,
				'end_size'           => 2,
			) );

		else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
		?>
		</div>

		<?php get_sidebar(); ?>

	</div>

</main>

<?php get_footer(); ?>
