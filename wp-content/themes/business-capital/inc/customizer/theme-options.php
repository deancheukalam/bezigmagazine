<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package Business_Capital
 */

class Business_Capital_Theme_Options {
	public function __construct() {
		// Register our Panel.
		add_action( 'customize_register', array( $this, 'add_panel' ) );

		// Register Breadcrumb Options.
		add_action( 'customize_register', array( $this, 'register_breadcrumb_options' ) );

		// Register Excerpt Options.
		add_action( 'customize_register', array( $this, 'register_excerpt_options' ) );

		// Register Homepage Options.
		add_action( 'customize_register', array( $this, 'register_homepage_options' ) );

		// Register Layout Options.
		add_action( 'customize_register', array( $this, 'register_layout_options' ) );

		// Register Search Options.
		add_action( 'customize_register', array( $this, 'register_search_options' ) );

		// Add default options.
		add_filter( 'business_capital_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			// Header Media.
			'business_capital_header_image_visibility' => 'entire-site',

			// Breadcrumb
			'business_capital_breadcrumb_show' => 1,

			// Layout Options.
			'business_capital_default_layout'          => 'right-sidebar',
			'business_capital_homepage_archive_layout' => 'no-sidebar-full-width',

			// Excerpt Options
			'business_capital_excerpt_length'    => 30,
			'business_capital_excerpt_more_text' => esc_html__( 'Continue reading', 'business-capital' ),

			// Footer Options.
			'business_capital_footer_editor_style'      => 'one-column',
			'business_capital_footer_editor_text'       => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'business-capital' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ) . ' &#124; ' . esc_html__( 'Business Capitalby', 'business-capital' ). '&nbsp;<a target="_blank" href="'. esc_url( 'https://fireflythemes.com' ) .'">Firefly Themes</a>',
			'business_capital_footer_editor_text_left'  => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'business-capital' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ),
			'business_capital_footer_editor_text_right' => esc_html__( 'Business Capitalby', 'business-capital' ). '&nbsp;<a target="_blank" href="'. esc_url( 'https://fireflythemes.com' ) .'">Firefly Themes</a>',

			// Homepage/Frontpage Options.
			'business_capital_front_page_category'   => '',
			'business_capital_show_homepage_content' => 1,

			// Search Options.
			'business_capital_search_text'         => esc_html__( 'Search...', 'business-capital' ),
		);


		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Register the Customizer panels
	 */
	public function add_panel( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'business_capital_theme_options',
		 	array(
				'title' => esc_html__( 'Theme Options', 'business-capital' ),
			)
		);
	}

	/**
	 * Add breadcrumb section and its controls
	 */
	public function register_breadcrumb_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'business_capital_breadcrumb_options',
			array(
				'title' => esc_html__( 'Breadcrumb', 'business-capital' ),
				'panel' => 'business_capital_theme_options',
			)
		);

		if ( function_exists( 'bcn_display' ) ) {
			Business_Capital_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Business_Capital_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'business-capital' ),
					'description'       =>  sprintf( esc_html__( 'Since Breadcrumb NavXT Plugin is installed, edit plugin\'s settings %1$shere%2$s', 'business-capital' ), '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=breadcrumb-navxt' ) ) . '" target="_blank">', '</a>' ),
					'section'           => 'ff_multiputpose_breadcrumb_options',
				)
			);

			return;
		}

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_breadcrumb_show',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Display Breadcrumb?', 'business-capital' ),
				'section'           => 'business_capital_breadcrumb_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_breadcrumb_show_home',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Show on homepage?', 'business-capital' ),
				'section'           => 'business_capital_breadcrumb_options',
			)
		);
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_layout_options( $wp_customize ) {
		// Add layouts section.
		$wp_customize->add_section( 'business_capital_layouts',
			array(
				'title' => esc_html__( 'Layouts', 'business-capital' ),
				'panel' => 'business_capital_theme_options'
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'business_capital_default_layout',
				'sanitize_callback' => 'business_capital_sanitize_select',
				'label'             => esc_html__( 'Default Layout', 'business-capital' ),
				'section'           => 'business_capital_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'business-capital' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'business-capital' ),
				),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'business_capital_homepage_archive_layout',
				'sanitize_callback' => 'business_capital_sanitize_select',
				'label'             => esc_html__( 'Homepage/Archive Layout', 'business-capital' ),
				'section'           => 'business_capital_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'business-capital' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'business-capital' ),
				),
			)
		);
	}

	/**
	 * Add excerpt section and its controls
	 */
	public function register_excerpt_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'business_capital_excerpt_options',
			array(
				'title' => esc_html__( 'Excerpt Options', 'business-capital' ),
				'panel' => 'business_capital_theme_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'business_capital_excerpt_length',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Excerpt Length (Words)', 'business-capital' ),
				'section'           => 'business_capital_excerpt_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'business_capital_excerpt_more_text',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Excerpt More Text', 'business-capital' ),
				'section'           => 'business_capital_excerpt_options',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_homepage_options( $wp_customize ) {
		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'settings'          => 'business_capital_front_page_category',
				'description'       => esc_html__( 'Filter Homepage/Blog page posts by following categories', 'business-capital' ),
				'label'             => esc_html__( 'Categories', 'business-capital' ),
				'section'           => 'static_front_page',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'business-capital' ) => Business_Capital_Customizer_Utilities::get_terms( 'category' ) ),
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Business_Capital_Toggle_Switch_Custom_control',
				'settings'          => 'business_capital_show_homepage_content',
				'sanitize_callback' => 'business_capital_switch_sanitization',
				'label'             => esc_html__( 'Show Home Content/Blog', 'business-capital' ),
				'section'           => 'static_front_page',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_search_options( $wp_customize ) {
		// Add Homepage/Frontpage Section.
		$wp_customize->add_section( 'business_capital_search',
			array(
				'title' => esc_html__( 'Search', 'business-capital' ),
				'panel' => 'business_capital_theme_options',
			)
		);

		Business_Capital_Customizer_Utilities::register_option(
			array(
				'settings'          => 'business_capital_search_text',
				'sanitize_callback' => 'business_capital_text_sanitization',
				'label'             => esc_html__( 'Search Text', 'business-capital' ),
				'section'           => 'business_capital_search',
				'type'              => 'text',
			)
		);
	}
}

/**
 * Initialize class
 */
$business_capital_theme_options = new Business_Capital_Theme_Options();
