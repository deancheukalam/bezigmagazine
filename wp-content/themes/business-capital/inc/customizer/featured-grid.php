<?php
/**
 * Featured Grid Options
 *
 * @package Business_Capital
 */

class Business_Capital_Featured_Grid_Options {
	public function __construct() {
		// Register Featured Grid Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'business_capital_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_capital_featured_grid_visibility'  => 'disabled',
			'business_capital_featured_grid_number'      => 3,
			'business_capital_featured_grid_button_link' => '#',
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
				'settings'          => 'business_capital_featured_grid_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'business_capital_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'business-capital' ),
				'section'           => 'business_capital_ss_featured_grid',
				'choices'           => Business_Capital_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'business_capital_featured_grid_visibility', array(
			'selector' => '#featured-grid-section',
		) );

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'settings'          => 'business_capital_featured_grid_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'business-capital' ),
				'section'           => 'business_capital_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_featured_grid_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'business-capital' ),
				'section'           => 'business_capital_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_featured_grid_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'business-capital' ),
				'section'           => 'business_capital_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_featured_grid_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'business-capital' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'business-capital' ),
				'section'           => 'business_capital_ss_featured_grid',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		$numbers = business_capital_gtm( 'business_capital_featured_grid_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Business_Capital_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Capital_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'business_capital_featured_grid_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'business-capital' ),
					'section'           => 'business_capital_ss_featured_grid',
					'active_callback'   => array( $this, 'is_featured_grid_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'settings'          => 'business_capital_featured_grid_button_text',
				'label'             => esc_html__( 'Button Text', 'business-capital' ),
				'section'           => 'business_capital_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'sanitize_callback' => 'esc_url_raw',
				'settings'          => 'business_capital_featured_grid_button_link',
				'label'             => esc_html__( 'Button Link', 'business-capital' ),
				'section'           => 'business_capital_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_featured_grid_button_target',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'business-capital' ),
				'section'           => 'business_capital_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);
	}

	/**
	 * Featured Grid visibility active callback.
	 */
	public function is_featured_grid_visible( $control ) {
		return ( business_capital_display_section( $control->manager->get_setting( 'business_capital_featured_grid_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$business_capital_ss_featured_grid = new Business_Capital_Featured_Grid_Options();
