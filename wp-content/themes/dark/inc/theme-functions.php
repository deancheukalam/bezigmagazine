<?php
/**
 * dark functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dark
 */
 
/************************************* Basic *************************************/

if ( ! function_exists( 'dark_setup' ) ) :

function dark_setup() {

	load_theme_textdomain( 'dark-lang', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'custom-header' );	
	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'dark' ),
	) );
	

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dark_custom_background_args', array(
		'default-color' => '333',
		'default-image' => get_template_directory_uri(). '/img/back.png',

	) ) );
	
}
	endif;
	
	add_action( 'after_setup_theme', 'dark_setup' );
	
	function dark_add_editor_styles() {
		add_editor_style( 'editor-style.css' );
	}
	add_action( 'admin_init', 'dark_add_editor_styles' );

	function dark_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'dark_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'dark_content_width', 0 );

/************************************* Widgets *************************************/

function dark_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dark' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dark' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'dark_widgets_init' );


/************************************* Enqueue scripts and styles. *************************************/
 
function dark_scripts() {
    wp_enqueue_style( 'dashicons' );	
	wp_enqueue_style( 'dark-style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );

	wp_enqueue_style( 'dark-animation', get_template_directory_uri() . '/css/animate.css' );
	
	wp_enqueue_script( 'jquery-aniview-js', get_template_directory_uri() . '/js/jquery.aniview.js');
	
	wp_enqueue_style( 'dark-woo-css', get_template_directory_uri() . '/woocommerce/woo-css.css');
	
	wp_enqueue_style( 'dark-google-fonts', '//fonts.googleapis.com/css?family=Fjalla+One|Nunito|Passion+One', false );
	
	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js');
	
	wp_enqueue_style( 'dark-slick-css', get_template_directory_uri() . '/css/slick.css');
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dark_scripts' );

/************************************* Include *************************************/

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/woocommerce/woo-functions.php' ;
require get_template_directory() . '/slider/slider.php' ;
require get_template_directory() . '/inc/slider-customize.php' ;

/*********************************************************************************************************
* Excerpt
**********************************************************************************************************/
	
function dark_excerpt_more( $dark_link ) {
	if ( is_admin() ) {
		return $dark_link;
	}

	$dark_link = sprintf( '<p class="link-more"><a href="%1$s" class="read-more">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'dark' ), esc_attr(get_the_title( get_the_ID() ) ))
	);
	return ' &hellip; ' . $dark_link;
}
add_filter( 'excerpt_more', 'dark_excerpt_more' );
