<?php
/**
 * Blossom Magazine Theme Customizer
 *
 * @package Blossom_Magazine
 */

/**
 * Requiring customizer sections
*/

$blossom_magazine_sections     = array( 'info', 'site', 'footer', 'layout', 'appearance', 'general', 'home' );

foreach( $blossom_magazine_sections as $s ){
    require get_template_directory() . '/inc/customizer/' . $s . '.php';
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blossom_magazine_customize_preview_js() {
	wp_enqueue_script( 'blossom-magazine-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), BLOSSOM_MAGAZINE_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'blossom_magazine_customize_preview_js' );

function blossom_magazine_customize_script(){
    $array = array(
        'home'    => get_permalink( get_option( 'page_on_front' ) ),
    );
    
    wp_enqueue_style( 'blossom-magazine-customize', get_template_directory_uri() . '/inc/css/customize.css', array(), BLOSSOM_MAGAZINE_THEME_VERSION );
    wp_enqueue_script( 'blossom-magazine-customize', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery', 'customize-controls' ), BLOSSOM_MAGAZINE_THEME_VERSION, true );
    wp_localize_script( 'blossom-magazine-customize', 'blossom_magazine_cdata', $array );

    wp_localize_script( 'blossom-magazine-repeater', 'blossom_magazine_customize',
		array(
			'nonce' => wp_create_nonce( 'blossom_magazine_customize_nonce' )
		)
	);
}
add_action( 'customize_controls_enqueue_scripts', 'blossom_magazine_customize_script' );

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Active Callbacks
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/*
 * Notifications in customizer
 */
require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-install-helper.php';

require get_template_directory() . '/inc/customizer-plugin-recommend/plugin-install/class-plugin-recommend.php';