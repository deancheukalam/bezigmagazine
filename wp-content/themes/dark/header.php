<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dark
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
        <?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } else { do_action( 'wp_body_open' ); } ?>
<div id="page" class="site" >
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'dark' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="dark-header" role="banner" style="background-image: url('<?php header_image(); ?>'); min-height:<?php echo esc_url(get_custom_header()->height); ?>px;">	
			<div class="site-branding">
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$dark_description = get_bloginfo( 'description', 'display' );
				if ( $dark_description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $dark_description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif;  ?>
			</div><!-- .site-branding -->
		
		</div>	
	<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'dark' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->	

	</header><!-- #masthead -->
			
	<div id="content" class="site-content">
		<?php
		if ( is_front_page() or is_home() )  : 
			if ( get_theme_mod('display_dark_slider') and !get_theme_mod('display_dark_slider_all_pages' )) : 
				echo dark_slider(); 
			endif; 
		endif;
		?>