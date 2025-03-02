<?php
/**
 * The template for displaying all pages
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
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
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
