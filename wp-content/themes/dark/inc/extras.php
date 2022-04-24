<?php
/**
 * Adds custom classes to the array of body classes.
 */
function dark_body_classes( $dark_classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$dark_classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$dark_classes[] = 'hfeed';
	}

	return $dark_classes;
}
add_filter( 'body_class', 'dark_body_classes' );
