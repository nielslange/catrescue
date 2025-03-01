<?php
/**
 * Base template part for displaying content
 *
 * @package Catrescue
 */

// Get the content type (post, page, etc.)
$content_type = isset( $args['content_type'] ) ? $args['content_type'] : 'content';

// Get the sidebar visibility
$show_sidebar = isset( $args['show_sidebar'] ) ? $args['show_sidebar'] : true;

// Get custom class for main element
$main_class = isset( $args['main_class'] ) ? $args['main_class'] : '';

// Get custom class for inner container
$inner_class = isset( $args['inner_class'] ) ? $args['inner_class'] : '';

// Check if we should display the title
$show_title = isset( $args['show_title'] ) ? $args['show_title'] : true;

// Get custom title if provided
$custom_title = isset( $args['custom_title'] ) ? $args['custom_title'] : '';
?>

<main<?php echo $main_class ? ' class="' . esc_attr( $main_class ) . '"' : ''; ?>>
	<div class="main-inner<?php echo ! $show_sidebar ? ' full-width' : ''; ?><?php echo $inner_class ? ' ' . esc_attr( $inner_class ) : ''; ?>">

		<div class="main-content">

		<?php if ( $show_title && ( is_archive() || is_search() || $custom_title ) ) : ?>
			<header class="page-header">
				<?php
				if ( $custom_title ) {
					echo '<h1 class="page-title">' . esc_html( $custom_title ) . '</h1>';
				} elseif ( is_search() ) {
					printf(
						/* translators: %s: search query */
						'<h1 class="page-title">' . esc_html__( 'Search results for: %s', 'catrescue' ) . '</h1>',
						'<span>' . get_search_query() . '</span>'
					);
				} elseif ( is_archive() ) {
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				}
				?>
			</header>
		<?php endif; ?>

		<?php
		if ( have_posts() ) {
			// If this is a search page, start the unordered list
			if ( is_search() ) {
				echo '<ul class="search-results-list">';
			}

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/' . $content_type );

				// If comments are open or we have at least one comment, load up the comment template.
				// Only for non-search pages
				if ( ! is_search() && ( comments_open() || get_comments_number() ) ) {
					comments_template();
				}
			}

			// If this is a search page, end the unordered list
			if ( is_search() ) {
				echo '</ul>';
			}

			// Display pagination if needed
			if ( is_home() || is_archive() || is_search() ) {
				the_posts_pagination( array(
					'prev_text'          => esc_html__( '« Previous', 'catrescue' ),
					'next_text'          => esc_html__( 'Next »', 'catrescue' ),
					'screen_reader_text' => esc_html__( 'Post Navigation', 'catrescue' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'catrescue' ) . ' </span>',
					'after_page_number'  => '',
					'mid_size'           => 3,
					'end_size'           => 2,
				) );
			}
		} else {
			get_template_part( 'template-parts/content', 'none' );
		}
		?>
		</div>

		<?php if ( $show_sidebar ) : ?>
		<div class="main-sidebar">
			<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
				<aside id="secondary" class="widget-area">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</aside>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</main>
