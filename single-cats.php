<?php
/**
 * The template for displaying all single posts
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
				get_template_part( 'template-parts/single-cats' );
			}
			?>
		</div>
	</div>
</main>

<?php
get_footer();
