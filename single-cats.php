<?php

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'lighthouse_loop' );
function lighthouse_loop() { 
	$id          = get_the_ID();
	$image       = get_the_post_thumbnail( $id );
	$title       = get_the_title( $id );
	$gender      = get_post_meta( $id, 'gender', true ); 
	$age         = get_post_meta( $id, 'age', true );
	$location    = get_post_meta( $id, 'location', true );
	$notes       = get_post_meta( $id, 'notes', true );
	$adoptable   = get_post_meta( $id, 'adoptable', true );
	$description = $notes ? sprintf( '<p>%s</p>', $notes ) : null;
	$previous 	 = get_previous_post_link('<div class="previous-post-link">← %link</div>', '<strong>%title</strong>' );
	$next 			 = get_next_post_link('<div class="next-post-link">%link →</div>', '<strong>%title</strong>' );
	$archive		 = get_post_type_archive_link( 'cats' );

	$content  = sprintf( '<h1>%s</h1>', get_the_title() );
	$content .= sprintf( '<table>' );
	$right .= sprintf( '<tr><th>%s</th><td>%s</td></tr>', __( 'Gender', 'monochrome-pro' ), $gender );
	$right .= sprintf( '<tr><th>%s</th><td>%s</td></tr>', __( 'Age', 'monochrome-pro' ), $age );
	$right .= sprintf( '<tr><th>%s</th><td>%s</td></tr>', __( 'Location', 'monochrome-pro' ), $location );
	$content .= sprintf( '</table>' );

	// Display cat image and information
	printf( '<div class="one-half first">%s</div>', $image );
	printf( '<div class="one-half">%s %s</div>', $content, $description );

	// Display post navigation
	printf( '<div class="one-third first">%s &nbsp;</div>', $previous );
	printf( '<div class="one-third center">↑ <a href="%2$s"><strong>%1$s</strong></a></div>', __( 'Back to all cats', 'monochrome-pro' ), $archive );
	printf( '<div class="one-third alignright">%s</div>', $next );
}

genesis();
