<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package Business Capital
 */

class business_capital_dark_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );

		// Add default options.
		add_filter( 'business_capital_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_capital_header_style'            => 'header-two',
			'business_capital_header_top_color_scheme' => 'dark-top-header', 
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Image_Radio_Button_Custom_Control',
				'settings'          => 'business_capital_header_style',
				'sanitize_callback' => 'business_capital_radio_sanitization',
				'label'             => esc_html__( 'Header Style', 'business-capital-dark' ),
				'section'           => 'business_capital_header_options',
				'choices'           => array(
					'header-one'   => array(
						'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/header-1.png',
						'name'  => esc_html__( 'Header Style Default', 'business-capital-dark' ),
					),
					'header-two'   => array(
						'image' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/header-2.png',
						'name'  => esc_html__( 'Header Style Dark', 'business-capital-dark' ),
					)
				),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'radio',
				'settings'          => 'business_capital_header_top_color_scheme',
				'sanitize_callback' => 'business_capital_sanitize_select',
				'label'             => esc_html__( 'Header Top Color', 'business-capital-dark' ),
				'section'           => 'business_capital_header_options',
				'choices'           => array(
					'dark-top-header'  => esc_html__( 'Dark', 'business-capital-dark' ),
					'light-top-header' => esc_html__( 'Light', 'business-capital-dark' ),
				),
			)
		);
	}
}

/**
 * Initialize class
 */
$business_capital_dark_header_options = new business_capital_dark_Header_Options();
