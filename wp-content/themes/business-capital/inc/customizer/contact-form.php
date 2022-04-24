<?php
/**
 * Contact Form Options
 *
 * @package Business_Capital
 */

class Business_Capital_Contact_Form_Options {
	public function __construct() {
		// Register Contact Form Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'business_capital_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_capital_contact_form_visibility' => 'disabled',
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_contact_form_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'business_capital_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'business-capital' ),
				'section'           => 'business_capital_ss_contact_form',
				'choices'           => Business_Capital_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'business_capital_contact_form_visibility', array(
			'selector' => '#contact-form-section',
		) );

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'business_capital_contact_form_page',
				'label'             => esc_html__( 'Select Page', 'business-capital' ),
				'section'           => 'business_capital_ss_contact_form',
				'active_callback'   => array( $this, 'is_section_visible' ),
				'input_attrs' => array(
					'post_type'      => 'page',
					'posts_per_page' => -1,
					'orderby'        => 'name',
					'order'          => 'ASC',
				),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'settings'          => 'business_capital_contact_form_custom_subtitle',
				'label'             => esc_html__( 'Top Subtitle', 'business-capital' ),
				'section'           => 'business_capital_ss_contact_form',
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);
	}

	/**
	 * Contact Form visibility active callback.
	 */
	public function is_section_visible( $control ) {
		return ( business_capital_display_section( $control->manager->get_setting( 'business_capital_contact_form_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$business_capital_ss_contact_form = new Business_Capital_Contact_Form_Options();
