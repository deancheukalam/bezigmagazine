<?php
/**
 * Set up the WordPress core custom header feature.
 *
 * @uses dark_header_style()
 */
function dark_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'dark_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '',
		'width'                  => 1000,
		'height'                 => 100,
		'flex-height'            => true,
		'wp-head-callback'       => 'dark_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'dark_custom_header_setup' );

if ( ! function_exists( 'dark_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see dark_custom_header_setup().
 */
function dark_header_style() {
	$dark_header_text_color = get_header_textcolor();


	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		header .site-branding .site-title  a,
		header .site-branding .site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		header .site-branding .site-title  a,
		header .site-branding .site-description {
			color: #<?php echo esc_attr( $dark_header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
