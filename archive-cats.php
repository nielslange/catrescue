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
			</header>
			<?php
			if ( have_posts() ) :
				echo '<article>';
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/archive-cats' );
				endwhile;
				echo '</article>';
				get_template_part( 'template-parts/pagination' );
			else :
				get_template_part( 'template-parts/no-posts' );
			endif;
			?>

		</div>
	</div>
</main>

<?php
get_footer();
