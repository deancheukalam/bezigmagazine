<?php
/**
 * Slider Options
 *
 * @package Business_Capital
 */

class Business_Capital_Slider_Options {
	public function __construct() {
		// Register Slider Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 98 );

		// Add default options.
		add_filter( 'business_capital_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_capital_slider_visibility'     => 'disabled',
			'business_capital_slider_number'         => 2,
			'business_capital_slider_autoplay_delay' => 5000,
			'business_capital_slider_pause_on_hover' => 1,
			'business_capital_slider_navigation'     => 1,
			'business_capital_slider_pagination'     => 1,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add slider section and its controls
	 */
	public function register_options( $wp_customize ) {
		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_slider_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'business_capital_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'business-capital' ),
				'section'           => 'business_capital_ss_slider',
				'choices'           => Business_Capital_Customizer_Utilities::section_visibility(),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'business_capital_slider_number',
				'label'             => esc_html__( 'Number', 'business-capital' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'business-capital' ),
				'section'           => 'business_capital_ss_slider',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		$numbers = business_capital_gtm( 'business_capital_slider_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Business_Capital_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Capital_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'business_capital_text_sanitization',
					'settings'          => 'business_capital_slider_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'business-capital' )  . $j,
					'section'           => 'business_capital_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
				)
			);

			Business_Capital_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Capital_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'business_capital_slider_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'business-capital' ),
					'section'           => 'business_capital_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
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
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_slider_autoplay',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Autoplay', 'business-capital' ),
				'section'           => 'business_capital_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_slider_autoplay_delay',
				'type'              => 'number',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Autoplay Delay', 'business-capital' ),
				'description'       => esc_html__( '(in ms)', 'business-capital' ),
				'section'           => 'business_capital_ss_slider',
				'input_attrs'           => array(
					'width' => '10px',
				),
				'active_callback'   => array( $this, 'is_slider_autoplay_on' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_slider_pause_on_hover',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Pause On Hover', 'business-capital' ),
				'section'           => 'business_capital_ss_slider',
				'active_callback'   => array( $this, 'is_slider_autoplay_on' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_slider_navigation',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Navigation', 'business-capital' ),
				'section'           => 'business_capital_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_slider_pagination',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Pagination', 'business-capital' ),
				'section'           => 'business_capital_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);
	}

	/**
	 * Slider visibility active callback.
	 */
	public function is_slider_visible( $control ) {
		return ( business_capital_display_section( $control->manager->get_setting( 'business_capital_slider_visibility' )->value() ) );
	}

	/**
	 * Slider autoplay check.
	 */
	public function is_slider_autoplay_on( $control ) {
		return ( $this->is_slider_visible( $control ) && $control->manager->get_setting( 'business_capital_slider_autoplay' )->value() );
	}
}

/**
 * Initialize class
 */
$slider_ss_slider = new Business_Capital_Slider_Options();
