<?php if( ! defined( 'ABSPATH' ) ) exit;

/***********************************************************************************
 * Slide option
***********************************************************************************/

	function dark_slide( $wp_customize ) {
		$wp_customize->add_section( 'dark_slider_section' , array(
			'title'       => __( 'Dark Slider ', 'dark' ),

			'priority'		=> 2,
		) );
		
/*****************  Show Dark Slider on Home Page ******************/ 	
	
	$wp_customize->add_setting( 'display_dark_slider', array(
	'default'        => false,
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'esc_attr',
	 ) );

	$wp_customize->add_control( 'display_dark_slider', array(
		'section'   => 'dark_slider_section',
		'label'     => 'Show Dark Slider on Home Page',
		'type'      => 'checkbox'
		 )
	 );
	
/*****************  Slider Height ******************/ 

	$wp_customize->add_setting(
		'slider_height',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	 
	$wp_customize->add_control(
		'slider_height',
		array(
			'type' => 'select',
			'label' => 'Slider Height:',
			'section' => 'dark_slider_section',
			'choices' => array(
				'150' => '150',
				'160' => '160',
				'170' => '170',
				'180' => '180',
				'190' => '190',
				'200' => '200',
				'210' => '210',
				'220' => '220',
				'230' => '230',
				'240' => '240',
				'250' => '250',
				'260' => '260',
				'270' => '270',
				'280' => '280',
				'290' => '290',
				'300' => '300',
				'310' => '310',
				'320' => '320',
				'330' => '330',
				'340' => '340',
				'350' => '350',
				'360' => '360',
				'370' => '370',
				'380' => '380',
				'390' => '390',
				'400' => '400',
				'410' => '410',
				'420' => '420',
				'430' => '430',
				'440' => '440',
				'450' => '450',
				'460' => '460',
				'470' => '470',
				'480' => '480',
				'490' => '490',
				'500' => '500',
				'510' => '510',
				'520' => '520',
				'530' => '530',
				'540' => '540',
				'550' => '550',
				'560' => '560',
				'570' => '570',
				'580' => '580',
				'590' => '590',
				'600' => '600',
				'650' => '650',	
			),
		)
	);
	
/*****************  Slider Size ******************/ 
	
	$wp_customize->add_setting(
		'dark_slide_size',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	 
	$wp_customize->add_control(
		'dark_slide_size',
		array(
			'type' => 'select',
			'label' => 'Slider Title Size:',
			'section' => 'dark_slider_section',
			'choices' => array(
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'13' => '13',
				'14' => '14',
				'15' => '15',
				'16' => '16',
				'17' => '17',
				'18' => '18',
				'19' => '19',
				'20' => '20',
				'21' => '21',
				'22' => '22',
				'23' => '23',
				'24' => '24',
				'25' => '25',
				'26' => '26',
				'27' => '27',
				'28' => '28',
				'29' => '29',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
				'70' => '70',
				'80' => '80',
				'90' => '90',
			),
		)
	);
	
/***************** Slide Title Color ******************/ 	
	
		$wp_customize->add_setting('dark_slide_titles_color', array(         
		'default'     => '#fff',
		 'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dark_slide_titles_color', array(
		'label' => __('Slide Title Color', 'dark'),        
		 'section' => 'dark_slider_section',
		'settings' => 'dark_slide_titles_color'
		)));
		
		/***************** Slide Title Color ******************/ 	
	
		$wp_customize->add_setting('dark_slide_titles_hover_color', array(         
		'default'     => '',
		 'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dark_slide_titles_hover_color', array(
		'label' => __('Slide Title Hover Color', 'dark'),        
		 'section' => 'dark_slider_section',
		'settings' => 'dark_slide_titles_hover_color'
		)));
		
/***************** Slide Background Color ******************/ 	
	
		$wp_customize->add_setting('dark_slide_background_color', array(         
		'default'     => '',
		 'sanitize_callback' => 'sanitize_hex_color'
		)); 	

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dark_slide_background_color', array(
		'label' => __('Slide Background Color', 'dark'),        
		 'section' => 'dark_slider_section',
		'settings' => 'dark_slide_background_color'
		)));	
		
/***************** Slide 1 ******************/ 
	
		$wp_customize->add_setting( 'slider_img1', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( 
			$wp_customize, 
			'slider_img1', 
			array(
				'label'      => __( 'Slide 1 IMG:', 'dark' ),
				'section'    => 'dark_slider_section',
				'settings'   => 'slider_img1',
			) ) );
		
		$wp_customize->add_setting( 'slider_text1', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_text1', array(
			'label'    => __( 'Slide 1 Text:', 'dark' ),
			'section'  => 'dark_slider_section',
			'settings' => 'slider_text1',
			'type' => 'text',
		) ) );
			
		$wp_customize->add_setting( 'slider_url1', array (
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_url1', array(
			'label'    => __( 'Slide 1 URL:', 'dark' ),
			'section'  => 'dark_slider_section',
			'settings' => 'slider_url1',
		) ) );
		
/**********************************************************************************/

		$wp_customize->add_setting( 'slider_img2', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( 
			$wp_customize, 
			'slider_img2', 
			array(
				'label'      => __( 'Slide 2 IMG:', 'dark' ),
				'section'    => 'dark_slider_section',
				'settings'   => 'slider_img2',
			) ) );
		
		$wp_customize->add_setting( 'slider_text2', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_text2', array(
			'label'    => __( 'Slide 2 Text:', 'dark' ),
			'section'  => 'dark_slider_section',
			'settings' => 'slider_text2',
			'type' => 'text',
		) ) );
			
		$wp_customize->add_setting( 'slider_url2', array (
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'slider_url2', array(
			'label'    => __( 'Slide 2 URL:', 'dark' ),
			'section'  => 'dark_slider_section',
			'settings' => 'slider_url2',
		) ) );
			
}		
		add_action('customize_register', 'dark_slide');

		function dark_customize_css_slider() {
    ?>
		<style type="text/css">
		<?php if (get_theme_mod('dark_slide_size')){ ?>.container-slider h3 a, .container-slider h3 { font-size: <?php echo esc_attr(get_theme_mod('dark_slide_size')); ?>px;} <?php } ?>
		<?php if (get_theme_mod('dark_slide_titles_color')){ ?>.container-slider h3 a, .container-slider h3 { color: <?php echo esc_attr(get_theme_mod('dark_slide_titles_color')); ?> !important;}<?php } ?>
		<?php if (get_theme_mod('dark_slide_titles_hover_color')){ ?>.container-slider h3 a:hover, .container-slider h3:hover { color: <?php echo esc_attr(get_theme_mod('dark_slide_titles_hover_color')); ?> !important;}<?php } ?>
		<?php if (get_theme_mod('dark_slide_background_color')){ ?>.container-slider h3 { background: <?php echo esc_attr(get_theme_mod('dark_slide_background_color')); ?> !important;}<?php } ?>
		</style>
    <?php
	
}
		add_action('wp_head', 'dark_customize_css_slider');