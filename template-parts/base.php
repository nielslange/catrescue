<?php
/**
 * Base template part for displaying content
 *
 * @package Catrescue
 */

$content_type = isset( $args['content_type'] ) ? $args['content_type'] : 'content';
$show_sidebar = isset( $args['show_sidebar'] ) ? $args['show_sidebar'] : true;
$main_class   = isset( $args['main_class'] ) ? $args['main_class'] : '';
$inner_class  = isset( $args['inner_class'] ) ? $args['inner_class'] : '';
$show_title   = isset( $args['show_title'] ) ? $args['show_title'] : true;
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
						/* translators: %s: search query. */
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
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/' . $content_type );

				if ( ! is_search() && ( comments_open() || get_comments_number() ) ) {
					comments_template();
				}
			}

			if ( is_home() || is_archive() ) {
				the_posts_pagination( array(
					'prev_text'          => esc_html__( '«', 'catrescue' ),
					'next_text'          => esc_html__( '»', 'catrescue' ),
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
