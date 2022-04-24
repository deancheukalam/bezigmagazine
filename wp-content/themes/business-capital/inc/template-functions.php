<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Business_Capital
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_capital_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class with respect to layout selected.
	$layout  = business_capital_get_theme_layout();
	$sidebar = business_capital_get_sidebar_id();

	$layout_class = "layout-no-sidebar-full-width";

	if ( 'no-sidebar-full-width' === $layout ) {
		$layout_class = 'layout-no-sidebar-full-width';
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'layout-right-sidebar';
		}
	}

	$classes[] = $layout_class;

	// Add Site Layout Class.
	$classes[] = 'fluid-layout';

	// Add Archive Layout Class.
	$classes[] = 'grid';

	// Add header Style Class.
	$classes['header-class'] = 'header-one';

	// Add Color Scheme Class.
	$classes[] = esc_attr( business_capital_gtm( 'business_capital_color_scheme' ) . '-color-scheme' );

	$business_capital_enable = business_capital_gtm( 'business_capital_header_image_visibility' );

	if ( ! business_capital_display_section( $business_capital_enable ) || ( ! has_header_image() && ! ( is_header_video_active() && has_header_video() ) ) ) {
    	$classes[] = 'no-header-media';
    }

	return $classes;
}
add_filter( 'body_class', 'business_capital_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function business_capital_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'business_capital_pingback_header' );

if ( ! function_exists( 'business_capital_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 */
	function business_capital_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Theme Options
		$length	= business_capital_gtm( 'business_capital_excerpt_length' );

		return absint( $length );
	} // business_capital_excerpt_length.
endif;
add_filter( 'excerpt_length', 'business_capital_excerpt_length', 999 );

if ( ! function_exists( 'business_capital_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function business_capital_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = business_capital_gtm( 'business_capital_excerpt_more_text' );

		$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
		);

		return '&hellip;' . $link;
	}
endif;
add_filter( 'excerpt_more', 'business_capital_excerpt_more' );

if ( ! function_exists( 'business_capital_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 */
	function business_capital_custom_excerpt( $output ) {
		if ( is_admin() ) {
			return $output;
		}

		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = business_capital_gtm( 'business_capital_excerpt_more_text' );

			$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
			);

			$output .= '&hellip;' . $link;
		}

		return $output;
	} // business_capital_custom_excerpt.
endif;
add_filter( 'get_the_excerpt', 'business_capital_custom_excerpt' );

if ( ! function_exists( 'business_capital_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 */
	function business_capital_more_link( $more_link, $more_link_text ) {
		$more_tag_text = business_capital_gtm( 'business_capital_excerpt_more_text' );

		return str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	} // business_capital_more_link.
endif;
add_filter( 'the_content_more_link', 'business_capital_more_link', 10, 2 );

/**
 * Filter Homepage Options as selected in theme options.
 */
function business_capital_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = business_capital_gtm( 'business_capital_front_page_category' );

		if ( $cats ) {
			$query->query_vars['category__in'] = explode( ',', $cats );
		}
	}
}
add_action( 'pre_get_posts', 'business_capital_alter_home' );

/**
 * Display section as selected in theme options.
 */
function business_capital_display_section( $option ) {
	if ( 'entire-site' === $option || ( is_front_page() && 'homepage' === $option ) || ( ! is_front_page() && 'excluding-home' === $option ) ) {
		return true;
	}

	// Section is disabled.
	return false;
}

/**
 * Return theme layout
 * @return layout
 */
function business_capital_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = business_capital_gtm( 'business_capital_default_layout' );

		if ( is_home() || is_archive() ) {
			$layout = business_capital_gtm( 'business_capital_homepage_archive_layout' );
		}
	}

	return $layout;
}

/**
 * Return theme layout
 * @return layout
 */
function business_capital_get_sidebar_id() {
	$sidebar = '';

	$layout = business_capital_get_theme_layout();

	if ( 'no-sidebar-full-width' === $layout ) {
		return $sidebar;
	}

	return 'sidebar-1'; // sidebar-1 is main sidebar.
}


/**
 * Function to add Scroll Up icon
 */
function business_capital_scrollup() {
	echo '<a href="#masthead" id="scrollup" class="backtotop">' . '<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'business-capital' ) . '</span></a>' ;

}
add_action( 'wp_footer', 'business_capital_scrollup', 1 );

/**
 * Return args for specific section type
 */
function business_capital_get_section_args( $section_name ) {
	$numbers = business_capital_gtm( 'business_capital_' . $section_name . '_number' );

	// If post or page or product, then set post__in argument.
	$post__in = array();

	for( $i = 0; $i < $numbers; $i++ ) {
		$post__in[] = business_capital_gtm( 'business_capital_' . $section_name . '_page_' . $i );
	}

	$args = array(
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => absint( $numbers ),
		'post_type'           =>  'page',
		'orderby'             => 'post__in',
		'post__in'            => $post__in,
	);

	return $args;
}

/**
 * Add sections to appropriate hook.
 */
function business_capital_sections() {
	$default_sections = business_capital_get_default_sortable_sections();

	$sortable_options = array();

	$sortable_order = business_capital_gtm( 'business_capital_ss_order' );

	if ( $sortable_order ) {
		$sortable_options = explode( ',', $sortable_order );
	}

	$sortable_sections = $sortable_options + array_keys( $default_sections );

	$hook = 'business_capital_before_content';

	foreach( $sortable_sections as $section ){
		if ( 'main_content' === $section ) {
			$hook = 'business_capital_after_content';

			continue;
		}

		$template_part = 'template-parts/' . str_replace( '_', '-', $section ) .'/' . str_replace( '_', '-', $section );

		add_action( $hook, function() use ( $template_part ) {
			get_template_part( $template_part );
		});
	}
}
add_action( 'wp', 'business_capital_sections', 10 );

/**
 * Display content.
 */
function business_capital_display_content( $section ) {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php
}

/**
 * Section class format.
 */
function business_capital_display_section_classes( $classes ) {
	echo esc_attr( implode( ' ', $classes ) );
}
