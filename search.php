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
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
					printf(
						/* translators: %s: search query. */
						esc_html__( 'Search results for: %s', 'catrescue' ),
						'<span><strong>' . get_search_query() . '</strong></span>'
					);
					?>
					<?php get_search_form(); ?>
				</h1>
			</header>

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;

			the_posts_navigation();

		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</div>
</main>

<?php get_footer(); ?>
