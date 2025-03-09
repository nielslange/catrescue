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
		<?php if ( have_posts() ) { ?>
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
			while ( have_posts() ) {
				the_post();
				?>
				<li class="search-result-item">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</li>
				<?php
			}
			echo '</ul>';
			get_template_part( 'template-parts/pagination' );
		} else {
			get_template_part( 'template-parts/content', 'none' );
		}
		?>
		</div>
		<aside>
			<?php get_sidebar(); ?>
		</aside>
	</div>
</main>

<?php
get_footer();
