<?php
/**
 * Template part for displaying pagination
 *
 * @package Catrescue
 */

if ( ! ( is_home() || is_archive() ) ) {
	return;
}

the_posts_pagination(
	[
		'prev_text'          => esc_html__( '«', 'catrescue' ),
		'next_text'          => esc_html__( '»', 'catrescue' ),
		'screen_reader_text' => esc_html__( 'Post Navigation', 'catrescue' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'catrescue' ) . ' </span>',
		'after_page_number'  => '',
		'mid_size'           => 1,
		'end_size'           => 1,
	]
);
