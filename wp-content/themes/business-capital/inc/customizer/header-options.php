<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package Business_Capital
 */

class Business_Capital_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'business_capital_header_options',
			array(
				'title' => esc_html__( 'Header Options', 'business-capital' ),
				'panel' => 'business_capital_theme_options'
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_capital_header_email',
				'sanitize_callback' => 'sanitize_email',
				'label'             => esc_html__( 'Email', 'business-capital' ),
				'section'           => 'business_capital_header_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_capital_header_phone',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Phone', 'business-capital' ),
				'section'           => 'business_capital_header_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_capital_header_address',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Address', 'business-capital' ),
				'section'           => 'business_capital_header_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_capital_header_open_hours',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Open Hours', 'business-capital' ),
				'section'           => 'business_capital_header_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_capital_header_button_text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Button Text', 'business-capital' ),
				'section'           => 'business_capital_header_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'business_capital_header_button_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Button Link', 'business-capital' ),
				'section'           => 'business_capital_header_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_header_button_target',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'business-capital' ),
				'section'           => 'business_capital_header_options',
			)
		);
	}
}

/**
 * Initialize class
 */
$business_capital_theme_options = new Business_Capital_Header_Options();
