<?php

add_filter('ecommerce_plus_default_theme_options', 'wp_dark_default_settings');

function wp_dark_default_settings($ecommerce_plus_default_options){
		
	$ecommerce_plus_default_options['site_header_layout'] = 'default';
		
	$ecommerce_plus_default_options['primary_color'] = '#dd0000';
	$ecommerce_plus_default_options['accent_color'] = '#f77d36';
	$ecommerce_plus_default_options['link_color'] = '#f2f2f2';
	$ecommerce_plus_default_options['text_color'] = '#f7f7f7';
	$ecommerce_plus_default_options['link_hover_color'] = '#178dff';
	
	$ecommerce_plus_default_options['header_tagline_color'] = '#f7f7f7';
	$ecommerce_plus_default_options['contact_bg_color'] = '#000000';

	
	$ecommerce_plus_default_options['header_title_color'] = '#f7f7f7';
	$ecommerce_plus_default_options['header_bg_color'] = '#262626';
	
	$ecommerce_plus_default_options['store_menu_color'] = '#f7f7f7';
	$ecommerce_plus_default_options['store_menubar_color'] = 'rgba(0,0,0,0.97)';
	
	$ecommerce_plus_default_options['menubar_border_height'] = 0;

	$ecommerce_plus_default_options['heading_font'] = 'Oswald';	
	$ecommerce_plus_default_options['body_font'] = 'Muli';	
	
	
	$ecommerce_plus_default_options['before_shop'] = 0;
	$ecommerce_plus_default_options['after_shop'] = 0;
	
	$ecommerce_plus_default_options['footer_bg_color'] = '#444444';
	$ecommerce_plus_default_options['footer_text_color'] = '#f9f9f9';
	
	$ecommerce_plus_default_options['topbar_login_label'] = esc_html__('Contact', 'wp-dark');
	
	$ecommerce_plus_default_options['breadcrumb_image'] = get_stylesheet_directory_uri().'/images/breadcrumb.jpg';
	$ecommerce_plus_default_options['breadcrumb_show'] = true;
	
	$ecommerce_plus_default_options['topbar_login_register_enable'] = false;

	
	return $ecommerce_plus_default_options;
}
