<?php

/*
 * Overwrite parent theme function
 */
if (!function_exists('ecommerce_plus_get_header_style')):

function ecommerce_plus_get_header_style(){

		global $post;
		
		if ($post){
		//parent theme setting used
			$style = get_post_meta( $post->ID, 'ecommerce-plus-header-style', true );	
			if ($style == 'shadow') {
				return "box-shadow";
			} elseif ($style == 'border'){
				return "header-border";
			} elseif ($style == 'transparent'){
				return "header-transparent";
			} elseif ($style == 'none'){
				return "header-style-none";	
			} else {

					return "none";
						
			}
		} else {

				return "none";
		
		}
		
	} //end function
endif;


/* counter script */
function wp_dark_counter_scripts()
{

	wp_register_script(
	   'wp-dark-counter-script',
	   get_stylesheet_directory_uri() . '/inc/time.js',
	   array('jquery'),
	   1.0,
	   true
   );

   wp_enqueue_script( 'wp-dark-counter-script' );
   
   $wp_dark_options  = ecommerce_plus_get_theme_options();
   
   $date = (isset($wp_dark_options['countdown_date']) ? $wp_dark_options['countdown_date'] : '' );
   $month = (isset($wp_dark_options['countdown_month']) ? $wp_dark_options['countdown_month'] : '' );
   $year = (isset($wp_dark_options['countdown_year']) ? $wp_dark_options['countdown_year'] : '' );
   
	
	$show_days = (isset($wp_dark_options['countdown_enable_days']) ? $wp_dark_options['countdown_enable_days'] : false );
	$show_hours = (isset($wp_dark_options['countdown_enable_hours']) ? $wp_dark_options['countdown_enable_hours'] : false );
	
	
   $script_params = array(          
	   'dateString' => absint($year) . '-' . absint($month) . '-' . absint($date),
	   'show_days' => $show_days,
	   'show_hours' => $show_hours
   );


   wp_localize_script( 'wp-dark-counter-script', 'megashopScriptParams', $script_params );

}
add_action( 'wp_enqueue_scripts', 'wp_dark_counter_scripts' );



