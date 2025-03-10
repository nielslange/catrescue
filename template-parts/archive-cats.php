<?php
/**
 * Template part for displaying single post content
 *
 * @package Catrescue
 */

?>
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
		$thumbnail = get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) ?
					get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) :
					'<img src="' . get_template_directory_uri() . '/assets/images/placeholder.jpg" alt="A placeholder image for Catrescue.id showing a playful cat" />';
		$title     = get_the_title();
		$link      = get_the_permalink();

		printf(
			'<a href="%s">%s <h2>%s</h2></a>',
			$link,
			$thumbnail,
			$title
		);

		?>

</section>
