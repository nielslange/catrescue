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
			<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
			</header>
			<article>
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/archive' );
				endwhile;
				get_template_part( 'template-parts/pagination' );
			else :
				get_template_part( 'template-parts/no-posts' );
			endif;
			?>
			</article>
		</div>
		<aside>
			<?php get_sidebar(); ?>
		</aside>
	</div>
</main>

<?php

get_footer();
