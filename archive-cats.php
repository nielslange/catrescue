<?php

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'lighthouse_loop' );
function lighthouse_loop() { 

	$args      = [
		'post_type'   => 'cats',
		'post_status' => 'publish',
		'orderby'     => 'date',
		'order'       => 'ASC',
		'meta_query'	=> array(
			array(
				'key' 		=> 'adoptable',
				'value' 	=> '1',
				'compare' => '=='
			),
		),
	];
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		$count = 0;

		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$id        = get_the_ID();
			$link      = get_the_permalink( $id );
			$image     = get_the_post_thumbnail( $id, 'post-thumbnail' );
			$title     = get_the_title( $id );
			$gender    = get_post_meta( $id, 'gender', true ); 
			$age       = get_post_meta( $id, 'age', true );
			$location  = get_post_meta( $id, 'location', true );
			$instagram = get_post_meta( $id, 'instagram', true );

			$left   = sprintf( '<a href="%1$s" title="%2$s" class="image">%3$s <strong>%2$s</strong></a>', $link, $title, $image );
			$right  = sprintf( '<table>' );
			$right .= sprintf( '<tr><th>%s</th><td>%s</td></tr>', __( 'Name', 'monochrome-pro' ), $title );
			$right .= sprintf( '<tr><th>%s</th><td>%s</td></tr>', __( 'Gender', 'monochrome-pro' ), $gender );
			$right .= sprintf( '<tr><th>%s</th><td>%s</td></tr>', __( 'Age', 'monochrome-pro' ), $age );
			$right .= sprintf( '<tr><th>%s</th><td>%s</td></tr>', __( 'Location', 'monochrome-pro' ), $location );
			$right .= sprintf( '</table>' );
			$right .= sprintf( '<ul>' );
			$right .= sprintf( '<li><a href="%2$s" title="%2$s"><strong>%1$s %3$s</strong></a></li>', __( 'Adopt', 'monochrome-pro' ), $link, $title );
			$right .= sprintf( '<li><a href="%2$s" title="%3$s">%1$s</a></li>', __( 'More information', 'monochrome-pro' ), $link, $title );
			if ( $instagram ) {
				$right .= sprintf( '<li><a href="%2$s" title="%3$s" target="_blank">%1$s</a></li>', __( 'Instragram photos', 'monochrome-pro' ), $instagram, $title );
			}
			$right .= sprintf( '</ul>' );
	
			printf( '<div class="one-half %s">', 0 === $count % 2 ? 'first' : null );
			printf( '<article itemtype="http://schema.org/CreativeWork" itemscope="itemscope" class="post-%s page type-page status-publish entry">', esc_html( $id ) );
			printf( '<div class="entry-content" itemprop="text">' );
			printf( '<div class="one-half first">%s</div>', $left );
			printf( '<div class="one-half">%s</div>', $right );
			printf( '</div></article></div>' );
			
			$count++;
		}
	}

	wp_reset_postdata();
}

genesis();
