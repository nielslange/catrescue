<?php
/**
 * The template part for displaying the blog section on the homepage.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

class_exists( 'ACF' ) || exit( 'ACF is required.' );

/**
 * Note: This template uses Advanced Custom Fields (ACF) plugin.
 * The get_field() function is provided by ACF and may not be recognized by linters,
 * but it will work correctly when ACF is installed and activated.
 */
$blog_headline = get_field( 'blog_headline' );

if ( empty( $blog_headline ) ) {
	$blog_headline = 'Latest Blog Posts';
}

$args        = array(
	'posts_per_page' => 6,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_type'      => 'post',
	'post_status'    => 'publish',
);
$blog_teaser = new WP_Query( $args );
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
