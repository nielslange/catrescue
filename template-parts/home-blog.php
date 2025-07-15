<?php
/**
 * The template part for displaying the blog section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

if ( ! function_exists( 'get_field' ) ) {
	exit( 'ACF is required.' );
}

$blog_headline = get_field( 'blog_headline' );
$args          = [
	'posts_per_page' => 6,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_type'      => 'post',
	'post_status'    => 'publish',
];
$blog_teaser   = new WP_Query( $args );
?>

<section id="blog">
	<div class="content">
		<h2><?php echo esc_html( $blog_headline ); ?></h2>
		<div class="blog-posts">
			<?php
			if ( $blog_teaser->have_posts() ) :
				while ( $blog_teaser->have_posts() ) :
					$blog_teaser->the_post();
					?>
					<article class="blog-post">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="post-thumbnail">
								<?php the_post_thumbnail( 'medium' ); ?>
							</a>
						<?php endif; ?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</article>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</section>
