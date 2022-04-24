<?php
/**
 * Business CapitalTheme Customizer
 *
 * @package Business_Capital
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_capital_sortable_sections( $wp_customize ) {
	$wp_customize->add_panel( 'business_capital_sp_sortable', array(
		'title'       => esc_html__( 'Sections', 'business-capital' ),
		'priority'    => 150,
	) );

	$default_sections = business_capital_get_default_sortable_sections();

	$sortable_options = array();

	$sortable_order = business_capital_gtm( 'business_capital_ss_order' );

	if ( $sortable_order ) {
		$sortable_options = explode( ',', $sortable_order );
	}

	$sortable_sections = array_unique( $sortable_options + array_keys( $default_sections ) );
		
	foreach ( $sortable_sections as $section ) {
		if ( isset( $default_sections[$section] ) ) {
			// Add sections.
			$wp_customize->add_section( 'business_capital_ss_' . $section,
				array(
					'title' => $default_sections[$section],
					'panel' => 'business_capital_sp_sortable'
				)
			);
		}
		
		unset($default_sections[$section]);
	}

	if ( count( $default_sections ) ) {
		foreach ($default_sections as $key => $value) {
			// Add new sections.
			$wp_customize->add_section( 'business_capital_ss_' . $key,
				array(
					'title' => $value,
					'panel' => 'business_capital_sp_sortable'
				)
			);
		}
	}

	// Add hidden section for saving sorted sections.
	Business_Capital_Customizer_Utilities::register_option(
		array(
			'settings'          => 'business_capital_ss_order',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Section layout', 'business-capital' ),
			'section'           => 'business_capital_ss_main_content',
		)
	);
}
add_action( 'customize_register', 'business_capital_sortable_sections', 1 );

/**
 * Default sortable sections order
 * @return array
 */
function business_capital_get_default_sortable_sections() {
	return $default_sections = array (
		'slider'           => esc_html__( 'Slider', 'business-capital' ),
		'wwd'              => esc_html__( 'What We Do', 'business-capital' ),
		'hero_content'     => esc_html__( 'Hero Content', 'business-capital' ),
		'featured_grid'    => esc_html__( 'Featured Grid', 'business-capital' ),
		'testimonial'      => esc_html__( 'Testimonials', 'business-capital' ),
		'contact_form'     => esc_html__( 'Contact Form', 'business-capital' ),
	);
}
