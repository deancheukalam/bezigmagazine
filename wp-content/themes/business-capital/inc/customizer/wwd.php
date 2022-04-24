<?php
/**
 * WWD Options
 *
 * @package Business_Capital
 */

class Business_Capital_WWD_Options {
	public function __construct() {
		// Register WWD Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'business_capital_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'business_capital_wwd_visibility'   => 'disabled',
			'business_capital_wwd_number'       => 6,
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
				'settings'          => 'business_capital_wwd_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'business_capital_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'business-capital' ),
				'section'           => 'business_capital_ss_wwd',
				'choices'           => Business_Capital_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'business_capital_wwd_visibility', array(
			'selector' => '#wwd-section',
		) );

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'settings'          => 'business_capital_wwd_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'business-capital' ),
				'section'           => 'business_capital_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_wwd_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'business-capital' ),
				'section'           => 'business_capital_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_wwd_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'business-capital' ),
				'section'           => 'business_capital_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_wwd_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'business-capital' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'business-capital' ),
				'section'           => 'business_capital_ss_wwd',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'business_capital_wwd_icon_note',
				'label'             =>  esc_html__( 'Info', 'business-capital' ),
				/* translators: 1: Link Start html, 2: Link end html. */
				'description'       =>  sprintf( esc_html__( 'If you want camera icon, save "fas fa-camera". For more classes, check %1$sthis%2$s', 'business-capital' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ),
				'section'           => 'business_capital_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		$numbers = business_capital_gtm( 'business_capital_wwd_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Business_Capital_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Capital_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'business_capital_text_sanitization',
					'settings'          => 'business_capital_wwd_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'business-capital' )  . $j,
					'section'           => 'business_capital_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Business_Capital_Customizer_Utilities::register_option(
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'business_capital_wwd_custom_icon_' . $i,
					'label'             => esc_html__( 'Icon Class', 'business-capital' ),
					'section'           => 'business_capital_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Business_Capital_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Capital_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'business_capital_wwd_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'business-capital' ),
					'section'           => 'business_capital_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}
	}

	/**
	 * WWD visibility active callback.
	 */
	public function is_wwd_visible( $control ) {
		return ( business_capital_display_section( $control->manager->get_setting( 'business_capital_wwd_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$business_capital_ss_wwd = new Business_Capital_WWD_Options();
